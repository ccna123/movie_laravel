<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function login($request)
    {
        $form_data = $request->validate([
            "email" => ["required", "email"]
        ]);

        $user = User::where("email", $form_data["email"])->first();

        if ($user) {
            auth()->login($user);
            $request->session()->regenerate();
            $request->session()->save();
            return response()->json([
                "status" => "success"
            ]);
        }
        return response()->json([
            "status" => "error"
        ]);
    }

    public function logout($request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
