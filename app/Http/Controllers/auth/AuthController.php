<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function index()
    {


        return view('auth');
    }
    public function register(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'name' => 'required|min:3',
                'password' => 'required|min:6',
                
            ]);

            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => (bcrypt($request->password)),
          
            ]);

            auth()->login($user);
            session()->flash('sucess', 'Inscription réussie');

            return response()->json([
                'redirect' => route('dashboard'),

            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => ['Une erreur est survenue lors de l\'inscription']
            ], 400);
        }




    }

    public function login (Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
       
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'redirect' => route('dashboard'),
            ]);
        }

        return response()->json([
            'error' => ['Identifiants invalides']
        ], 401);
    }
}
