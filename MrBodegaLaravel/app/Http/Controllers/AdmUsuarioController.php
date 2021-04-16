<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdmUsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    
    public function acceder(Request $request) {

    if ($request->has('fileUpload')) {
        $fileUpload = $request->input('fileUpload');
        dd($fileUpload);

        $usuarios = HTTP::get('http://localhost:5000/api/Usuario');
        $ArrayUsuarios = $usuarios->json();
        return view('adm-usuario')->with('ArrayUsuarios', $ArrayUsuarios);
    } else {
        $token = null;
        $email = $request->input('email');
        $password = $request->input('password');

        $data = Http::post('http://localhost:5000/api/Usuario/authenticate', [
            'correo' => $email,
            'Password' => $password
        ]);


        //Storage::disk('local')->get('token');
        //Storage::disk('local')->put('token', $data['token']);
  
        if ($data['token']) {
            $usuarios = HTTP::get('http://localhost:5000/api/Usuario');
            $ArrayUsuarios = $usuarios->json();
            return view('adm-usuario')->with('ArrayUsuarios', $ArrayUsuarios);
        } else {
            return "Credenciales incorrectas";
        }
    }
       
        
    }
    
    public function index()
    {
        $usuarios = HTTP::get('http://localhost:5000/api/Usuario');
        $ArrayUsuarios = $usuarios->json();
        return view('adm-usuario')->with('ArrayUsuarios', $ArrayUsuarios);
       
    }

    public function exportPDF() {
        return 'a';
    }


}