<?php

// app/Interfaces/MELI/tokenRepositoryInterface.php
namespace App\Interfaces\MELI;

interface MELItokenRepositoryInterface
{
    public function refreshToken($refreshToken);
}


