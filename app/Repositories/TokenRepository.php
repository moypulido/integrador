<?php

namespace App\Repositories;

use App\Interfaces\TokenRepositoryInterface;
use App\Models\Token;

class TokenRepository implements TokenRepositoryInterface
{
    public function getLastToken()
    {
        return Token::where('user_id', auth()->id())->latest()->first();
    }

    public function updateOrCreateToken($token)
    {
        Token::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'access_token' => $token['access_token'],
                'refresh_token' => $token['refresh_token'],
                'expires_at' => $token['expires_at'],
                'token_type' => $token['token_type'] ?? null,
                'scope' => $token['scope'] ?? null,
            ]
        );
        return Token::where('user_id', auth()->id())->latest()->first();
    }
}
