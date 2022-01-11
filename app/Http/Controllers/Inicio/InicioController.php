<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use App\Models\Bitacora\Bitacora;
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
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_INGRESO,
            'tabla' => 'Inicio',
            'objeto' => json_encode($user),
        ]);
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
}
