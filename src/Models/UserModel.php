<?php

class UserModel
{
    public function __construct(
        private PDO $db
    ) {}

    public function findUser(string $email){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        $user = $stmt->fetch();
        return $user ?: null;
    }

    
}
