<?php

require __DIR__ . "/../vendor/autoload.php";

use mmr\todolist\Aplication\AddUserController;
use mmr\todolist\Aplication\EditUserController;
use mmr\todolist\Aplication\UserController;
use mmr\todolist\Infrastructure\Persistence\ConnectionCreate;
use mmr\todolist\Infrastructure\Repository\UserRepository;

$connection = ConnectionCreate::CreateConnection();
$repository = new UserRepository($connection);

if ($_SERVER['REQUEST_URI'] === "/api/getUsers" && $_SERVER['REQUEST_METHOD'] === "GET") {
  $controller = UserController::processaRequisicao($repository);
} else if ($_SERVER['REQUEST_URI'] === "/api/addUsers" && $_SERVER['REQUEST_METHOD'] === "POST") {
  $controller = AddUserController::processaRequisicao($repository);
} else if ($_SERVER['REQUEST_URI'] === "/api/editUsers" && $_SERVER['REQUEST_METHOD'] === "PUT") {
  $controller = EditUserController::processaRequisicao($repository);
}
