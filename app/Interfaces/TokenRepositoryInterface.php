<?php

namespace App\Interfaces;

interface TokenRepositoryInterface
{
    public function getLastToken();

    public function saveToken($token);
}