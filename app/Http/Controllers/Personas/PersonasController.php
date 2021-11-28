<?php

namespace App\Http\Controllers\Personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona\Persona;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas=Persona::paginate(10);
        return view('personas.index',compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->all();
        $persona=Persona::create($inputs);
        return redirect()->route('personas.index')->with('success','persona creada con exito');
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
        return view('personas.edit',compact('persona'));
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
            $inputs=$request->all();
            //dd($inputs,$persona);
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
              
             return redirect()->route('personas.index')->with('success','Persona Editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            $inputs=$request->all();
            $id=$inputs['persona_id'];
            $usuario=Persona::find($id);

            $usuario->delete();
            return redirect()->route('personas.index')->with('success','usuarios elimanado con exito');
    }
}
