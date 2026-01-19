<?php

class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $name,
        private string $password,
        private DateTime $createdAt
    ) {}

    public function auth($email, $password){
        if($this->email == $email && $this->password == $password) return true;
        return false;
    }

    public function getId() {
        return $this->id;
    }
    public function gatName() {
        return $this->email;
    }

    public function getEmail() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    
}
