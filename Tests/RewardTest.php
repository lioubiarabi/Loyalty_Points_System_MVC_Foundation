<?php

use App\Core\Database;
use App\Models\PointsModel;
use App\Models\RewardModel;
use App\Models\UserModel;
use App\Services\AuthService;
use App\Services\PointsService;

$rewardModel = new RewardModel(Database::connect());

/* get all rewards */
var_dump($rewardModel->getAllRewards());

/* get reward by id */
echo "<br>";
var_dump($rewardModel->getRewardById(13));

/* a user reedem a reward */
$pointM = new PointsModel(Database::connect(), new PointsService);
echo "\n";

$userM = new UserModel(Database::connect(), new AuthService);
$user = $userM->findUser('arabi@gmail.com');
echo "<br>User update:<br>";
var_dump($pointM->getUserPoints($user));

echo "<br>";
var_dump($rewardModel->reedem($user, $rewardModel->getRewardById(13)));
echo "<br>Reward update:<br>";
var_dump($rewardModel->getRewardById(13));
echo "<br>User update:<br>";
var_dump($pointM->getUserPoints($user));
