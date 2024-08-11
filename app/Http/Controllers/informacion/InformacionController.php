<?php

namespace App\Http\Controllers\Informacion;

use App\Http\Controllers\Controller;
use App\Interfaces\MELI\UserRepositoryInterface;
use App\Interfaces\MELI\tokenRepositoryInterface;

class InformacionController extends Controller
{
    private $userRepository;
    private $tokenRepository;

    public function __construct(UserRepositoryInterface $userRepository, tokenRepositoryInterface $tokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function index()
    {
        $this->tokenRepository->refreshToken(env('MELI_REFRESH_TOKEN'));
        $user = $this->userRepository->getUserMe();
        return view('informacion', compact('user'));
    }
}