<?php

namespace App\Http\Controllers\Informacion;

use App\Http\Controllers\Controller;
use App\Interfaces\MELI\MELIUserRepositoryInterface;
use App\Interfaces\MELI\MELItokenRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

class InformacionController extends Controller
{
    private $MELIuserRepository;
    private $MELItokenRepository;
    private $userRepository;

    public function __construct(
        MELIUserRepositoryInterface $MELIuserRepository,
        MELItokenRepositoryInterface $MELItokenRepository,
        UserRepositoryInterface $userRepository)
    {
        $this->MELIuserRepository = $MELIuserRepository;
        $this->MELItokenRepository = $MELItokenRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $code = $this->userRepository->getCodeAuthenticatedUser();
        $token = $this->MELItokenRepository->refreshToken($code);


        $user = $this->MELIuserRepository->getUserMe();
        return view('informacion', compact('user'));
    }
}
