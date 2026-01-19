<?php
namespace App\Entities;

class Reward
{
    public function __construct(
        private int $id,
        private string $name,
        private int $pointsRequired,
        private string $description,
        private int $stock
    ) {}

    
}
