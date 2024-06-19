<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;

class UserController
{

  public static function processaRequisicao(UserRepository $userRepository)
  {
    $videoListJson = array_map(function ($data) {
      return [
        "id" => $data->getId(),
        "username" => $data->getUsername(),
        "password" => $data->getPassword(),
        "name" => $data->getName(),
        "email" => $data->getEmail()
      ];
    }, $userRepository->all());

    echo json_encode($videoListJson);
  }
}
