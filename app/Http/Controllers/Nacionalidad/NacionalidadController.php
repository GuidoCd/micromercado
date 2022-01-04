<?php

namespace App\Http\Controllers\Nacionalidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Nacionalidad\Nacionalidad;
use App\Models\Bitacora\Bitacora;


class NacionalidadController extends Controller
{
    //Listado de los recusos
    public function index(){
        $nacionalidades = Nacionalidad::paginate(10);
        return view('nacionalidades.index',compact('nacionalidades'));
    }

    //Formulario de creacion
    public function create(){
        
        return view('nacionalidades.create');

    }

    //guardado del formulario
    public function store(Request $request){
        
        $inputs = $request->all();


        $nacionalidad = Nacionalidad::create($inputs);

        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 2,
            'tabla' => 'nacionalidades',
            'objeto' => 'AA',
    
           ]);

        return redirect()->route('nacionalidades.index')->with('success','Nacionalidad Creada con éxito!');

    }

    //vista de un recurso en especifico
    public function show(Nacionalidad $usuario){
        
    }

    //formulario de act
    public function edit(Nacionalidad $nacionalidad){

        return view('nacionalidades.edit',compact('nacionalidad'));

    }

    //actualizacion del recurso
    public function update(Request $request){
        
        $inputs = $request->all();

        $nacionalidad = Nacionalidad::find($inputs["nacionalidad_id"]);

        $nacionalidad->update($inputs);

        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 1,
            'tabla' => 'nacionalidades',
            'objeto' => 'AA',
    
           ]);

        return redirect()->route('nacionalidades.index')->with('success','Nacionalidad actualizada con éxito!');
        
    }

    //eliminar de recurso
    public function destroy(Request $request){

        return redirect()->route('usuarios.index')->with('success','Usuario eliminado con éxito!');
    }
}
