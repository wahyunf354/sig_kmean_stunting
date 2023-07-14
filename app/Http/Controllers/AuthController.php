<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private function login(string $user, string $password): bool
    {
        $credentials = ["email" => $user, "password" => $password];
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }

    public function signin(Request $request)
    {
        // do validated
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return redirect()->back()->with('error', 'Credentials are wrong.');
        }

        // Melakukan login
        if ($this->login($user->email, $request->password)) {
            return redirect()->route('admin.dashboard')->with('success', "Berhasil login");
        }
        return redirect()->back()->with('error', 'Credentials are wrong.');
    }
}
