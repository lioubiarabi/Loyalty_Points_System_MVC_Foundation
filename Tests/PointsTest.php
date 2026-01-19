<?php

use App\Core\Database;
use App\Models\PointsModel;
use App\Models\UserModel;
use App\Services\AuthService;

$userM = new UserModel(Database::connect(), new AuthService);
$pointM = new PointsModel(Database::connect());

/* find User by email */
$user = $userM->findUser('arabi@gmail.com');

/* get user points */

var_dump($pointM->getUserPoints($user));

/* update user points */
$pointM->updatePoints($user, 500);
var_dump($pointM->getUserPoints($user));

/* get history */

var_dump($pointM->getHistory($userM->findUser('james.smith@example.com')));