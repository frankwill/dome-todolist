<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;

class RemoveUserController
{
  public static function processaRequisicao(UserRepository $userRepository)
  {
    $response = file_get_contents("php://input");
    $userData = json_decode($response, true);

    $userRepository->remove($userData['id']);
  }
}
