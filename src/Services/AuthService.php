<?php
session_start();

class AuthService {
    
    public function getCurrentUser(): ?string {
        if(isset($_SESSION['user_email'])) return $_SESSION['user_email'];
        return null;
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
    }
}