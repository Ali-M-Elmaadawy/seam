<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request) {

        $validator = \Validator::make($request->all(), [
            'phone'     => 'required|exists:users,phone',
            'password'  => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->all()], 200);
        }

        $credentials = request(['phone', 'password']);
        try {

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['success' => false, 'error' => ['Wrong Data']], 200);
            }


        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => ['Please Try Again Later']], 200);
        }
        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token) {

        $user = \Auth::user();
        $user_details = [];
        $user_details['id']                 = $user->id;
        $user_details['phone']              = $user->phone;  
        $user_details['token']              = $token;

        return response()->json(['success' => true, 'data' => $user_details]);        

    }



    public function register(Request $request) {

        $validator = \Validator::make($request->all(), [
            'phone'         => 'required|min:10|unique:users',
            'password'      => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->all()], 200);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $credentials = request(['phone', 'password']);
        $token = auth()->attempt($credentials);
        $user_details = [];
        $user_details['id']                 = $user->id;
        $user_details['phone']              = $user->phone;  
        $user_details['token']              = $token;


        return response()->json(['success' => true, 'data' => $user_details]);
    }


    public function logout() {
        auth()->logout();
        return response()->json(['success' => true , 'data' => 'You Logged Out Success'] , 200);
    }



}
