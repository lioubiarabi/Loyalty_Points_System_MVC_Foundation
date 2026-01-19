<?php

use App\Core\Database;
use App\Models\UserModel;
use App\Services\AuthService;

$userM = new UserModel(Database::connect(), new AuthService);
/* find User by email and return its id */
var_dump($userM->findUser('james.smith@example.com')->getId());

/* create new user and return false invalide values */
var_dump($userM->create("", "lssdsds", "fefe"));

/* create new user and return true*/
var_dump($userM->create("arabi", "arabi@gmail.com", "password"));