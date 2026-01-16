<?php

class AuthController
{
    private ?User $current_user;
    public function __construct() {}

    public function isLogin():bool {
        if($this->current_user) return true;
        return false;
    }

    
}
