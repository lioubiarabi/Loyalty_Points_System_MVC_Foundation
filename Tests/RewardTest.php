<?php

use App\Core\Database;
use App\Models\RewardModel;

$rewardModel = new RewardModel(Database::connect());

/* get all rewards */
var_dump($rewardModel->getAllRewards());