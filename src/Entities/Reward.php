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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPointsRequired(): int
    {
        return $this->pointsRequired;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
}
