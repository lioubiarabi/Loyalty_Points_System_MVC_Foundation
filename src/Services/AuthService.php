<?php
session_start();

class AuthService {
    
    public function isLogged(): bool {
        return isset($_SESSION['user_id']);
    }
    
}