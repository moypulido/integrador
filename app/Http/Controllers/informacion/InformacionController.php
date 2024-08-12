<?php

namespace App\Http\Controllers\Informacion;

use App\Http\Controllers\Controller;
use App\Interfaces\MELI\MELIUserRepositoryInterface;
use App\Interfaces\MELI\MELItokenRepositoryInterface;

class InformacionController extends Controller
{
    private $MELIuserRepository;
    private $MELItokenRepository;

    public function __construct(MELIUserRepositoryInterface $MELIuserRepository, MELItokenRepositoryInterface $MELItokenRepository)
    {
        $this->MELIuserRepository = $MELIuserRepository;
        $this->MELItokenRepository = $MELItokenRepository;
    }

    public function index()
    { 
        $token = $this->MELItokenRepository->refreshToken('TG-66b55c3776dc9d0001c93b21-1756613137');
        
        $user = $this->MELIuserRepository->getUserMe();
        return view('informacion', compact('user'));
    }
}