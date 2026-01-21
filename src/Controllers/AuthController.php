<?php

use App\Services\AuthService;

class AuthController
{
    public function __construct(
        private AuthService $AuthService
    ) {}

    
}
