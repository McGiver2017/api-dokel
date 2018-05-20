<?php

namespace App\Http\Controllers\JWT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Tymon\JWTAuth\Providers\AbstractProvider;
use Tymon\JWTAuth\Providers\ProviderInterface;
use Validator;
use Response;
use Auth;

class ApiController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        //$pasajero = User::first();

        //Almaceno los datos del usuario en mi variable $customClaims:
        $customClaims = ['datos' => User::first()];

        $token = null;
        try {
            //Llamo a mi varaible $customClaims para generar el token con los datos del usuario:
            if (!$token = JWTAuth::attempt($credentials, $customClaims)) {
                return response()->json(['Usuario o Contraseña incorrectos'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['Error al crear el token'], 500);
        }

        // Dentro de mi variable $user voy a generar el token con los datos del usuario mediante JWTAuth::toUser() metodo nativo de la librería que instanciamos:
        $user = JWTAuth::toUser($token);

        // Retorno los datos dentro de un token en formato JSON:
        return response()->json(compact('token', 'user'));
    }
    public function logout(){
        JWTAuth::invalidate();
        return response(['success' => 'success',
            'success' => 'Logged out Successfully'], 200);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $customClaims = ['datos' => $user];
        $token = JWTAuth::fromUser($user , $customClaims);
        // Dentro de mi variable $user voy a generar el token con los datos del usuario mediante JWTAuth::toUser() metodo nativo de la librería que instanciamos:
        $user = JWTAuth::toUser($token);
        // Retorno los datos dentro de un token en formato JSON:
        return response()->json(compact('token', 'user'));
    }
}
