<?php

namespace App\Http\Controllers\Personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona\Persona;
use App\Models\Auxiliar\Auxiliar;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Bitacora\Bitacora;

use DB;
use Auth;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::paginate(10);
        return view('personas.index',compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('personas.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        try {
            DB::transaction(function () use ($inputs) {   
                $persona = Persona::create($inputs);
                if($persona->tipo == Persona::CLIENTE){
                    $inputs['persona_id'] = $persona->id;
                    $auxiliar = Auxiliar::create($inputs);
                    $bitacora = Bitacora::create([
                        'user_id' => auth()->user()->id,
                        'accion' => Bitacora::TIPO_CREO,
                        'tabla' => 'Cliente | Datos Facturar',
                        'objeto' => json_encode($auxiliar),
                    ]);
                }else{
                    $user = $this->crearUsuario($persona, $inputs['email'], $inputs['role_id']);
                }
            });
            return redirect()->route('personas.index')->with('success','persona creada con exito');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return view('personas.show',compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        $roles = Role::get();
        $user = User::where('persona_id',$persona->id)->first();
        return view('personas.edit',compact('persona','roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Persona $persona)
    {
            $inputs = $request->all();
            $persona->update([
                 'nombre'=>$inputs['nombre'],
                 'ci'=>$inputs['ci'],
                 'sexo'=>$inputs['sexo'],
                 'fecha_nacimiento'=>$inputs['fecha_nacimiento'],
                 'direccion'=>$inputs['direccion'],
                 'telefono'=>$inputs['telefono'],
                 'tipo'=>$inputs['tipo'],
                 'estado'=>$inputs['estado'],
             ]);
             if($persona->tipo == Persona::EMPLEADO){
                $user = User::where('persona_id',$persona->id)->first();
                if($user == null){
                    $this->crearUsuario($persona, $inputs['email'], $inputs['role_id']);
                }else{
                    $userAnterior = User::where('persona_id',$persona->id)->first();
                    $user->update([
                        'email' => $inputs['email'],
                        'role_id' => $inputs['role_id'],
                    ]);
                    $bitacora = Bitacora::create([
                        'user_id' => auth()->user()->id,
                        'accion' => Bitacora::TIPO_EDITO,
                        'tabla' => 'Empleado | Usuario',
                        'objeto' => json_encode($userAnterior) . '__' . json_encode($user),
                    ]);
                }
             }else if($persona->tipo == Persona::CLIENTE){
                $auxiliar = Auxiliar::where('persona_id',$persona->id)->first();
                if($auxiliar == null){
                    $auxiliar = Auxiliar::create([
                        'nit' => $inputs['nit'],
                        'razon_social' => $inputs['razon_social'],
                    ]);
                    $bitacora = Bitacora::create([
                        'user_id' => auth()->user()->id,
                        'accion' => Bitacora::TIPO_CREO,
                        'tabla' => 'Cliente | Datos Facturar',
                        'objeto' => json_encode($auxiliar),
                    ]);
                }else{
                    $auxiliarAnterior = Auxiliar::where('persona_id',$persona->id)->first();
                    $auxiliar->update([
                        'nit' => $inputs['nit'],
                        'razon_social' => $inputs['razon_social'],
                    ]);
                    $bitacora = Bitacora::create([
                        'user_id' => auth()->user()->id,
                        'accion' => Bitacora::TIPO_EDITO,
                        'tabla' => 'Cliente | Datos Facturar',
                        'objeto' => json_encode($auxiliarAnterior) . '__' . json_encode($auxiliar),
                    ]);
                }
             }
             return redirect()->route('personas.index')->with('success','Persona actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            $inputs = $request->all();
            $id = $inputs['persona_id'];
            $usuario = Persona::find($id);

            $usuario->update([
                'estado' => Persona::DESHABILITADO
            ]);
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_ELIMINO_ANULO,
                'tabla' => 'Cliente | Empleado',
                'objeto' => json_encode($usuario),
            ]);
            return redirect()->route('personas.index')->with('success','usuarios elimanado con exito');
    }

    private function crearUsuario($persona, $email, $role_id){
        $existe = User::where('email',$email)->first();
        if($existe != null){
            throw new \Exception('Ya existe un usuario con el email: ' . $email);
        }else{
            $role = Role::find($role_id);
            $user = User::create([
                'name' => $persona->nombre,
                'password' => \bcrypt('123456'),
                'email' => $email,
                'role_id' => $role_id,
                'persona_id' => $persona->id
            ]);

            $user->assignRole($role->name);
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_CREO,
                'tabla' => 'Empleado | Usuario',
                'objeto' => json_encode($user),
            ]);
            return $user;
        }
    }
}
