<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;

class UserController
{

  public static function processaRequisicao(UserRepository $userRepository)
  {
    return $userRepository->all();
  }
}
