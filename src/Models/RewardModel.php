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

        if (!$reward) return null;

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

            $stmt = $this->db->prepare("SELECT total_points FROM users where id = ?");
            $stmt->execute([$user->getId()]);

            $CurrentUserPoints =  $stmt->fetchColumn();

            if (!$reward->isAvailable()) {
                throw new \Exception("Reward is out of stock");
            }


            if ($CurrentUserPoints < $reward->getPointsRequired()) {
                throw new \Exception("User do't have enough points");
            }

            $this->db->beginTransaction();

            $stmt = $this->db->prepare("UPDATE users SET total_points = total_points - ? WHERE id = ?");
            $stmt->execute([$reward->getPointsRequired(), $user->getId()]);

            if ($reward->getStock() !== -1) {
                $stmtStock = $this->db->prepare("UPDATE rewards SET stock = stock - 1 WHERE id = ? AND stock > 0");
                $stmtStock->execute([$reward->getId()]);
            }

            $newBalance = $CurrentUserPoints - $reward->getPointsRequired();
            $stmtLog = $this->db->prepare("INSERT INTO points_transactions 
                (user_id, type, amount, description, balance_after) 
                VALUES (?, 'redeemed', ?, ?, ?)");
            $stmtLog->execute([
                $user->getId(),
                -$reward->getPointsRequired(),
                "Echange: " . $reward->getName(),
                $newBalance
            ]);

            
            $stmtAward = $this->db->prepare("INSERT INTO user_rewards 
                (user_id, reward_id, status) 
                VALUES (?, ?, 'active')");
            $stmtAward->execute([$user->getId(), $reward->getId()]);
            
            $this->db->commit();
            return true;
        } catch (\Exception $th) {
            $this->db->rollBack();
            ErrorLogger::log($th);
        }
    }
}
