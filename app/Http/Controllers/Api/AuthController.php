<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()]
        ]);
        if ($validator->fails()) {
            return  ApiResponse::response($validator->errors(), 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $data['token'] = $user->createToken('registerUser')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::response($data, 201, 'User Registerd Sucessfully');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', Password::defaults()]
        ]);
        if ($validator->fails()) {
            return  ApiResponse::response($validator->errors(), 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $logginUser = Auth::user();
            $data['token'] = $logginUser->createToken('LogginUser')->plainTextToken;
            $data['name'] = $logginUser->name;
            $data['email'] = $logginUser->email;
            return ApiResponse::response($data, 200);
        } else {
            return ApiResponse::response(null, 401, "User Doesn't be exsits");
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::response("", 200, 'Logout Sucessfully');
    }
}
