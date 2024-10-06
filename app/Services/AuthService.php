<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;

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

    public function register(string $firstName, string $lastName, string $email, string $password)
    {
        $user = User::where('email', $email)->exists();

        if(!empty($user)) {
            throw new UserHasBeenTakenException();
        }

        $userPassword = bcrypt($password ?? Str::random(10));

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60)
        ]);

        return $user;
    }
}
