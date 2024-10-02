<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(string $email, string $password)
    {
        $login = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = Auth::attempt($login)) {
            throw new LoginInvalidException();
        }

        return [
            'acess_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
