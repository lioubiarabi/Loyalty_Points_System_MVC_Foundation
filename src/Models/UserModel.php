<?php

class UserModel
{
    public function __construct(
        private PDO $db
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
            $user['total_points'],
            $user['createdat']
        );
    }

    public function create(string $name, string $email, string $passwordHash): bool
    {
        $sql = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$name, $email, $passwordHash]);
    }

    public function updatePoints(int $userId, int $newBalance): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET total_points = ? WHERE id = ?");
        return $stmt->execute([$newBalance, $userId]);
    }
}
