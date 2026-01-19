<?php

use App\Core\Database;
use App\Models\RewardModel;

$rewardModel = new RewardModel(Database::connect());

/* get all rewards */
var_dump($rewardModel->getAllRewards());

/* get reward by id */
echo "<br>";
var_dump($rewardModel->getRewardById(13));