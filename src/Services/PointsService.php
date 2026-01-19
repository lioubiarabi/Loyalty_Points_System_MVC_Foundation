<?php

namespace App\Services;

class PointsService
{
    public function __construct() {}

    public function calculateAward(float $amountSpent): int
    {
        if ($amountSpent < 100) {
            return 0;
        }
        return floor($amountSpent / 100) * 10;
    }
}
