<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function getProfile(){

        return response()->json([
            'status' => true,
            'user' => auth()->user(),
        ]);
    }

    public function getPaymentMethod(){
        return response()->json([
            'paymentMethod' => auth()->user()->paymentMethod,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validate = $request->validate([
            'new_name' => 'sometimes|nullable',
            'new_surname' => 'sometimes|nullable',
            'new_password' => ['sometimes', 'nullable', Password::default()],
        ]);

        $data = [];

        if ($request['new_name']) {
            $data['name'] = $request['new_name'];
        }

        if ($request['new_surname']) {
            $data['surname'] = $request['new_surname'];
        }

        if ($request->new_password) {
            $data['password'] = Hash::make($request['new_password']);
        }

        if (! empty($data)) {
            auth()->user()->update($data);
        }

        return response()->json([
            'status' => true,
            'profile' => auth()->user(),
        ]);
    }
}
