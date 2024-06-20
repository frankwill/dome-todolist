<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;
use mmr\todolist\Model\User;

class EditUserController
{
  public static function processaRequisicao(UserRepository $userRepository)
  {
    $response = file_get_contents("php://input");
    $userList = json_decode($response, true);

    if (empty($userList)) {
      $responseJson = [
        "code" => 400,
        "message" => "Falha ao atualizar os dados.",
      ];
      http_response_code($responseJson['code']);
      echo json_encode($responseJson);
      exit();
    }

    $userData = new User(
      $userList['id_user'],
      $userList['username_user'],
      $userList['password_user'],
      $userList['name_user'],
      $userList['email_user']
    );

    $userRepository->edit($userData, $userList['id_user']);
  }
}
