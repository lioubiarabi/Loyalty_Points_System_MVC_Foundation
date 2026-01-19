<?php
namespace App\Entities;

class PointsTransaction
{
    public function __construct(
        private int $id,
        private int $userId,
        private string $type,
        private int $amount,
        private string $description,
        private int $balanceAfter,
        private \DateTime $createdAt
    ) {}
}
