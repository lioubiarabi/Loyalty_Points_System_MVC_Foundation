<?php

namespace App\Models;

use App\Core\ErrorLogger;
use App\Entities\Reward;
use App\Entities\User;

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

    public function getRewardById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM rewards where id=?");
        $stmt->execute([$id]);

        $reward = $stmt->fetch();

        if(!$reward) return null;

        return new Reward(
            $reward['id'],
            $reward['name'],
            $reward['points_required'],
            $reward['description'],
            $reward['stock']
        );
    }

    public function reedem(User $user, Reward $reward)
    {
        try {
            $this->db->beginTransaction();


            $this->db->commit();
            return true;
        } catch (\Throwable $th) {
            $this->db->rollBack();
            ErrorLogger::log($th);
        }
    }
}
