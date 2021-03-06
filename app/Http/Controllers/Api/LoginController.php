<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobile' => 'required|digits:10|unique:users',
        ]);
        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors()->all(), 404);
        }
        $request['password'] = Hash::make($request['password']);
        $user = User::create([
            'name' => $request->first_name . '' . $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
        ]);
        $user->token = $user->createToken('MyApp')->accessToken;

        return $this->sendresponse($user, 'User Register successfully.', 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response([
                'message' => ['These Email does not match with database.']
            ]);
        } else if (!Hash::check($request->password, $user['password'])) {
            return response([
                'message' => ['Please enterCorrect Password ']
            ]);
        }
        $user->token = $user->createToken('MyApp')->accessToken;
        return $this->sendResponse($user, 'User Login successfully.', 200);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $token = Auth::guard('api')->user()->token();
            $token->revoke();
            $user->save();
            return $this->sendResponse($user, 'user logout Succesfully.', 200);
        } else {
            return $this->sendResponse($user, 'You are not login.Please login once then logout', 422);
        }
    }
}
