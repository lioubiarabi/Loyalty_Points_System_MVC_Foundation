<?php

namespace App\Models;

use App\Entities\Reward;

class RewardModel
{
    public function __construct(
        private \PDO $db
    ) {}

    public function getAllRewards()
    {
        $rewards = [];
        foreach ($this->db->query("SELECT * FROM rewards")->fetchAll() as $reward) {
            $rewards[$reward['id']] = new Reward(
                $reward['id'],
                $reward['name'],
                $reward['points_required'],
                $reward['description'],
                $reward['stock']
            );
        }

        return $rewards;
    }
    
}
