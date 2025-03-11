<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validar datos
        $credentials = $request->validate([
            'email'=>'required|email',
             'password' => 'required'
        ]);
        //verificar si el correo o contraseña son correctos
        if (!Auth::attempt($credentials)) {
            //si son correctos
            return response()->json(['message' => 'Credenciales incorrectos'], 401);
        }
        //generar token
        $token = $request->user()->createToken('authToken')->plainTextToken;

        //response
        return response()->json(['token' => $token,"user"=> $request->user()],201); 

    }


    public function register(Request $request)
    {
        return ['message' => 'register'];
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user],200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada'],200);
    }
}
