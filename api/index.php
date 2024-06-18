<?php

use mmr\todolist\Aplication\UserController;

require __DIR__ . "/../vendor/autoload.php";

use mmr\todolist\Infrastructure\Persistence\ConnectionCreate;
use mmr\todolist\Infrastructure\Repository\UserRepository;

$connection = ConnectionCreate::CreateConnection();
$repository = new UserRepository($connection);

if ($_SERVER['REQUEST_URI'] === "/api/getUsers" && $_SERVER['REQUEST_METHOD'] === "GET") {
  $controller = UserController::processaRequisicao($repository);
  // var_dump($controller);
}
