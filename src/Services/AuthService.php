<?php
session_start();

class AuthService
{

    public function __construct() {}

    public function getCurrentUser(): ?string
    {
        if (isset($_SESSION['user_email'])) return $_SESSION['user_email'];
        return null;
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }

    public function validateRegister(string $name, string $email, string $password)
    {
        if (!empty($name)) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 8) return false;
        return true;
    }

    public function validateLogin($email, $password, $passhash)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 8) return false;
        return true;
    }


    public function login($email)
    {
        $_SESSION['user_email'] = $email;
        return true;
    }
}
