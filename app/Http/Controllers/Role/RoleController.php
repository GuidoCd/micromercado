<?php

namespace App\Http\Controllers\Role;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Bitacora\Bitacora;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $permisos = Permission::get();  
        return view('roles.create',compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $input = $request->all();
        $permisos = $input['permissions'];
        $role = Role::create($input);
        $role->syncPermissions($permisos);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_CREO,
            'tabla' => 'Roles',
            'objeto' => json_encode($role),
        ]);
        return redirect()->route('roles.index')->with('success','Rol Creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permisos = Permission ::get();

        foreach ($permisos as $permiso) {
            $hasPermission = $role->hasPermissionTo($permiso->name);
            if($hasPermission){
                $permiso->checked = 1;
            }
        }
        
        return view('roles.edit',compact('role','permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role){
            $inputs = $request->all();
            $role->update($inputs);
            $permisos = $inputs['permissions'];
            $permisosAnteriores = $role->permissions;
            $role->syncPermissions($permisos);
            $permisos = $role->permissions;
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_EDITO,
                'tabla' => 'Roles',
                'objeto' => json_encode($permisosAnteriores) . '__' . json_encode($permisos),
            ]);
            return redirect()->route('roles.index')->with('success','Rol editado con exito');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        try {
            $users = User::get();
            $id = $request['rol_id'];
            $rol = Role::find($id);
            foreach($users as $user){
                if($user->hasRole($rol->name)){
                    throw new ValidationException('Acción no autorizada, existen usuarios con este role!');
                }
            }
            $rol->delete();
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_ELIMINO_ANULO,
                'tabla' => 'Roles',
                'objeto' => json_encode($rol)
            ]);
            return redirect()->route('roles.index')->with('success','Elimano con Exito');
        } catch (ValidationException $th) {
            return redirect()->back()->with('error',$th->getMessage());
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Ups! Ocurrio un error, por favor contactarse con el área de sistema!');
        }
    }
}
