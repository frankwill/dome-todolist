<?php

require __DIR__ . "/../vendor/autoload.php";

use mmr\todolist\Infrastructure\Persistence\ConnectionCreate;

$connection = ConnectionCreate::CreateConnection();

var_dump($connection);
