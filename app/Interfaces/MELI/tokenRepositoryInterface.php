<?php

// app/Interfaces/MELI/tokenRepositoryInterface.php
namespace App\Interfaces\MELI;

interface tokenRepositoryInterface
{
    public function refreshToken($refreshToken);
}


