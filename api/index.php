<?php

require __DIR__ . "/../vendor/autoload.php";

header('Access-Control-Allow-Origin: http://localhost:9000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');

use mmr\todolist\Aplication\AddUserController;
use mmr\todolist\Aplication\EditUserController;
use mmr\todolist\Aplication\OauthUserController;
use mmr\todolist\Aplication\RemoveUserController;
use mmr\todolist\Infrastructure\Persistence\ConnectionCreate;
use mmr\todolist\Infrastructure\Repository\UserRepository;

$connection = ConnectionCreate::CreateConnection();
$repository = new UserRepository($connection);

if ($_SERVER['REQUEST_URI'] === "/api/OauthUsers" && $_SERVER['REQUEST_METHOD'] === "POST") {
  $controller = OauthUserController::processaRequisicao($repository);
} else if ($_SERVER['REQUEST_URI'] === "/api/addUsers" && $_SERVER['REQUEST_METHOD'] === "POST") {
  $controller = AddUserController::processaRequisicao($repository);
} else if ($_SERVER['REQUEST_URI'] === "/api/editUsers" && $_SERVER['REQUEST_METHOD'] === "PUT") {
  $controller = EditUserController::processaRequisicao($repository);
} else if ($_SERVER['REQUEST_URI'] === "/api/removeUsers" && $_SERVER['REQUEST_METHOD'] === "DELETE") {
  $controller = RemoveUserController::processaRequisicao($repository);
}
