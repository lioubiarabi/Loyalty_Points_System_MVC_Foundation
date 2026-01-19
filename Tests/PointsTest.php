<?php

use App\Core\Database;
use App\Models\PointsModel;
use App\Models\UserModel;
use App\Services\AuthService;
use App\Services\PointsService;

$userM = new UserModel(Database::connect(), new AuthService);
$pointM = new PointsModel(Database::connect(), new PointsService);

/* find User by email */
$user = $userM->findUser('arabi@gmail.com');

/* get user points */

var_dump($pointM->getUserPoints($user));

/* update user points */
$pointM->updatePoints($user, 500);
var_dump($pointM->getUserPoints($user));

/* get history */

var_dump($pointM->getHistory($userM->findUser('james.smith@example.com')));

/* add a reward to user it must add 50 points */
echo "\n";
var_dump($pointM->getUserPoints($user));

var_dump($pointM->addAward($user, 563));

var_dump($pointM->getUserPoints($user));
