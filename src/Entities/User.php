<?php

class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $name,
        private int $totalPoints,
        private DateTime $createdAt
    ) {}

    public function updatePoints(int $points) {
        $this->totalPoints = $points;
    }
}
