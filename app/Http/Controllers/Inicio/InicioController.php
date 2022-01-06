<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->created_at == $user->updated_at){
            return view('vendor.adminlte.auth.passwords.change');
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cambiarPassword(Request $request)
    {    
        $credentials = $request->only(['password','password_confirmation']);
        if($credentials['password'] == null || $credentials['password_confirmation'] == null){
            return redirect()->back()->with('error', 'Debe rellenar los campos');
        }
        if($credentials['password'] != $credentials['password_confirmation']){
            return redirect()->back()->with('error', 'Las contraseñas no coinciden!');
        }
        $user = Auth::user();
        $user->update([
            'password' => bcrypt($credentials['password'])
        ]);
        return redirect()->to('inicio');
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
            'accion' => 2,
            'tabla' => 'roles',
            'objeto' => 'AA',
    
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
    public function update(Request $request,Role $role)
    {
            $inputs = $request->all();
            $role->update($inputs);

            $permisos = $inputs['permissions'];
            $role->syncPermissions($permisos);

            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => 1,
                'tabla' => 'roles',
                'objeto' => 'AA',
        
               ]);

            return redirect()->route('roles.index')->with('success','Rol editado con exito');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['rol_id'];
        $rol = Role::find($id);
        $rol->delete();

        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 3,
            'tabla' => 'roles',
            'objeto' => 'AA',
    
           ]);

        return redirect()->route('roles.index')->with('success','Elimano con Exito');
    }
}
