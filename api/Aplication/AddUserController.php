<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;

class AddUserController
{
  public static function processaRequisicao(UserRepository $userRepository)
  {
    $request = file_get_contents("php://input");
    var_dump("frank" . $request);
  }
}
