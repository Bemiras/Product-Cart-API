<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return[
            'message'=> 'Logged out'
        ];
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        }
        else{
            // Check email
            $user = User::where('email', $request->email)->first();

            // Check password
            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json([
                    'status'=>401,
                    'message' => 'Invalid Credentials'
                ]);
            }
            else{
                $token = $user->createToken('myapptoken')->plainTextToken;

                return response()->json([
                    'status' => 'success',
                    'msg' => 'Login successfully',
                    'content' => [
                    'status_code' => 200,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                ]]);
            }
        }
    }
}
