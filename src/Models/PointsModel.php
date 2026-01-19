<?php
namespace App\Models;
use App\Entities\{User, RewardTransaction};

class PointsModel
{
    public function __construct(
        private \PDO $db
    ) {}

    public function getUserPoints(User $user)
    {
        $stmt = $this->db->prepare("SELECT total_points FROM users where id = ?");
        $stmt->execute([$user->getId()]);

        return $stmt->fetchColumn();
    }

    public function updatePoints(User $user, int $newBalance): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET total_points = ? WHERE id = ?");
        return $stmt->execute([$newBalance, $user->getId()]);
    }

    public function getHistory(User $user)
    {
        $stmt = $this->db->prepare("SELECT * FROM points_transactions where user_id=?");
        $stmt->execute([$user->getId()]);

        $history = [];
        foreach ($stmt->fetchAll() as $transaction) {
            $history[$transaction['id']] = new RewardTransaction(
                $transaction['id'],
                $transaction['userId'],
                $transaction['type'],
                $transaction['amount'],
                $transaction['description'],
                $transaction['balanceAfter'],
                $transaction['createdat']
            );
        }

        return $history;
    }
}
