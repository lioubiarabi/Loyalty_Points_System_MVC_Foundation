<?php
namespace App\Models;
use App\Entities\{User, PointsTransaction};
use App\Services\PointsService;

class PointsModel
{
    public function __construct(
        private \PDO $db,
        private PointsService $pointsService
    ) {}

    public function getUserPoints(User $user)
    {
        $stmt = $this->db->prepare("SELECT total_points FROM users where id = ?");
        $stmt->execute([$user->getId()]);

        return $stmt->fetchColumn();
    }

    public function addAward(User $user, int $amountSpent): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET total_points = total_points + ? WHERE id = ?");
        return $stmt->execute([$this->pointsService->calculateAward($amountSpent), $user->getId()]);
    }

    public function discount(User $user, int $points): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET total_points = total_points - ? WHERE id = ?");
        return $stmt->execute([$points, $user->getId()]);
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
            $history[$transaction['id']] = new PointsTransaction(
                $transaction['id'],
                $transaction['user_id'],
                $transaction['type'],
                $transaction['amount'],
                $transaction['description'],
                $transaction['balance_after'],
                new \DateTime($transaction['createdat'])
            );
        }

        return $history;
    }
}
