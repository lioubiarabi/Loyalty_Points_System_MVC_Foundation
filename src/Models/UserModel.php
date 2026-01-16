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
}
