<?php
session_start();

class AuthService
{

    public function __construct(
        private UserModel $userModel
    ) {}
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

    public function register(string $name, string $email, string $password): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 8) return false;
        if ($this->userModel->findUser($email)) return false;

        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->create($name, $email, $hash);
    }

    public function login($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($password) < 8) return false;

        $user = $this->userModel->findUser($email);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user_email'] = $user->getEmail();
            return true;
        }
        return false;
    }
}
