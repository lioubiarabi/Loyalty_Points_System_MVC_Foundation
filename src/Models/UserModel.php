<?php

class UserModel
{
    public function __construct(
        private PDO $db,
        private AuthService $authService
    ) {}

    public function findUser(string $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch();
        if (!$user) {
            return null;
        }
        return new User(
            $user['id'],
            $user['email'],
            $user['name'],
            $user['password_hash'],
            $user['createdat']
        );
    }

    public function create(string $name, string $email, string $password): bool
    {
        if (!$this->authService->validateRegister($name, $email, $password)) return false;
        if ($this->findUser($email)) return false;

        $stmt = $this->db->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");

        return $stmt->execute([$name, $email, $this->authService->hashPassword($password)]);
    }
}
