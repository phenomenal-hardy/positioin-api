<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use \Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{

    public function validationRules() {

        return [
            'email' => 'required|email',
            'password' => 'required',
        ];

    }

    public function validationMessages() {
        return [
            'email.required' => 'Email requerido',
            'email.email' => 'Ingrese el correo electronico en un formato valido',
            'password.required' => 'Contraseña requerida'
        ];
    }

    public function unauthorizedCredentailsMessage() {
        return 'Credenciales no autorizadas.';
    }

    public function handleLogin(Request $request) {

        $validator = Validator::make($request->all(), $this->validationRules(), $this->validationMessages());

        if ($validator->fails()) {        
            return response()->json(['success' => false, 'message' => 'Validacion fallo']);
        }
        
        $credentials = $request->only('email', 'password');
        $authorized = Auth::guard('web')->attempt($credentials);

        if($authorized){ 

            $authUserId = Auth::id();

            $user = User::find($authUserId, ['id', 'name', 'email']);
                
            return response()->json([
                'success' => true, 
                'message' => 'Usuario logeado exitosamente',
                'user' => $user,
            ]);

        } else{ 

            return response()->json(['success' => false, 'message' => 'Credenciales no autorizadas']);
        } 
    }

    public function handleLogout(Request $request) 
    {

        $request->user()->token() ? $request->user()->token()->revoke() : null;

        $request->session()->flush();

        auth()->logout();                
    }
  
  
}