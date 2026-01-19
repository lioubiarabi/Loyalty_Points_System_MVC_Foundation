<?php

class PointsModel {
    public function __construct(
        private PDO $db
    ) {}

    public function getUserPoints(User $user) {
        $stmt = $this->db->prepare("SELECT total_points FROM users where id = ?");
        $stmt->execute([$user->getId()]);

        return $stmt->fetchColumn();
    }

    public function updatePoints(User $user, int $newBalance): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET total_points = ? WHERE id = ?");
        return $stmt->execute([$newBalance, $user->getId()]);
    }
}