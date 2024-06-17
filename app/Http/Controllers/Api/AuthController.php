<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validData = Validator::make($request->all(), [
                'email' => 'required|email|string',
                'password' => 'required|string|min:8'
            ]);

            if ($validData->fails()) {
                return ResponseFormatter::error([
                    'message' => 'Invalid email or password',
                ], 'Authentication Failed', 400);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = Auth::user();
            if ($user) {
                $accessToken = Auth::user()->createToken('authToken')->accessToken;
                return ResponseFormatter::success([
                    // 'user_id'      => $user['id'],
                    'user'         => $user,
                    'access_token' => $accessToken
                ], 'Authenticated');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Your account can\'t to access.'
                ], 'Authentication Failed', 500);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }



    public function profile(Request $request)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $permission = $user->getAllPermissions();
        return response([
            'success' => 1,
            'user' => $user
        ]);
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        // match old password
        if (Hash::check($request->old_password, Auth::user()->password)) {

            User::find(auth()->user()->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);

            return response([
                'message' => 'Password has been changed',
                'status'  => 1
            ]);
        }
        return response([
            'message' => 'Password not matched!',
            'status'  => 0
        ]);
    }


    public function updateProfile(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $user = Auth::user();
        // check unique email except this user
        if (isset($request->email)) {
            $check = User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->count();
            if ($check > 0) {
                return response([
                    'message' => 'The email address is already used!',
                    'success' => 0
                ]);
            }
        }

        $user->update($validData);


        return response([
            'message' => 'Profile updated successfully!',
            'status'  => 1
        ]);
    }


    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response([
            'message' => 'Logged out succesfully!',
            'status'  => 0
        ]);
    }
}
