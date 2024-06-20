<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;
use mmr\todolist\Model\User;

class EditUserController
{
  public static function processaRequisicao(UserRepository $userRepository)
  {
    $response = file_get_contents("php://input");
    $userData = json_decode($response, true);

    var_dump($userData);

    // $user = new User(
    //   $userData['id'] = null,
    //   $userData['username_user'],
    //   $userData['password_user'],
    //   $userData['name_user'],
    //   $userData['email_user']
    // );

    // $userRepository->add($user);
  }
}
