<?php

namespace App\Http\Controllers;

use App\OauthAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Course;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string' ,
            'universita'=> 'required|int',
            'corsoDiLaurea'=> 'required|int',
        ]);

        $password = bcrypt($request->password);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->corso_laurea = $request->corsoDiLaurea;

        $dominio =  substr($user->email, strpos($user->email, '@')+1);

        $uniMailValidation = Course::join('universities', 'universities.id', '=', 'courses.universita')
            ->where('courses.id', '=', $request->corsoDiLaurea)
            ->where('universities.dominio', '=', $dominio)
            ->get();

        if($uniMailValidation->isEmpty()){

            return response()->json([
                'message' => 'Le credenziali inserite non sono valide'
            ], 403);

        }

        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'=> $user,
            'access_token'=> $accessToken
        ]);
    }



    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        if(!Auth::guard('api')->check()){
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $credentials = $request->only(['email', 'password']);

            if(!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);


            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response([
                'user'=> auth()->user(),
                'access_token'=> $accessToken
            ]);
        }

        return response([
            'message' => 'sei gia loggato'
        ], 401);



    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {

         $request->user()->token()->revoke();

            return response()->json([
                'message' => 'Logout andato a buon fine'
            ], 200);


        return response()->json([
            'message' => 'Logout non andato a buon fine'
        ], 403);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }



}
