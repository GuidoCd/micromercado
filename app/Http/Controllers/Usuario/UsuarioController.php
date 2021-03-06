<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Models\User;



use App\Models\Bitacora\Bitacora;

class UsuarioController extends Controller
{
    //Listado de los recusos
    public function index(){
        $usuarios = User::paginate(10);
        return view('usuarios.index',compact('usuarios'));
    }

    //Formulario de creacion
    public function create(){
        $roles = Role::get();
        return view('usuarios.create',compact('roles'));
    }

    //guardado del formulario
    public function store(Request $request){
        $inputs = $request->all();
        $inputs['password'] = \bcrypt($inputs['password']);
        $usuario = User::create($inputs);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_CREO,
            'tabla' => 'Usuarios',
            'objeto' => json_encode($usuario),
        ]);
        return redirect()->route('usuarios.index')->with('success','Usuario Creado con éxito!');
    }

    //vista de un recurso en especifico
    public function show(User $usuario){
        dd($usuario);
    }
   
    //formulario de act
    public function edit(User $usuario){
        return view('usuarios.edit',compact('usuario'));
    }

    //actualizacion del recurso
    public function update(Request $request){
        
        $inputs = $request->all();

        $usuario = User::find($inputs["usuario_id"]);
        $usuarioAnterior = User::find($inputs["usuario_id"]);

        if($inputs["password"] != null){
            $usuario->update([
                'name' => $inputs["name"],
                'email' => $inputs["email"],
                'password' => \bcrypt($inputs["password"])
            ]);
        }else{
            $usuario->update([
                'name' => $inputs["name"],
                'email' => $inputs["email"],
            ]);
        }
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_EDITO,
            'tabla' => 'Usuarios',
            'objeto' => json_encode($usuarioAnterior) . '__' . json_encode($usuario),
        ]);
        return redirect()->route('usuarios.index')->with('success','Usuario actualizado con éxito!');
    }

    //eliminar de recurso
    public function destroy(Request $request){
        $inputs = $request->all();
        $id = $inputs["usuario_id"];
        $usuario = User::find($id);
        $usuario->delete();
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_ELIMINO_ANULO,
            'tabla' => 'Usuarios',
            'objeto' => json_encode($usuario),
        ]);
        return redirect()->route('usuarios.index')->with('success','Usuario eliminado con éxito!');
    }
}
