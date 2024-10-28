<?php

namespace mmr\todolist\Aplication;

use mmr\todolist\Infrastructure\Repository\UserRepository;

class OauthUserController
{

  public static function processaRequisicao(UserRepository $userRepository)
  {
    $request = file_get_contents("php://input");
    $response = json_decode($request, true);

    if (empty($response['username_user'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Parâmetros não enviados']);
      return;
    }

    $user = $userRepository->find($response['username_user']);

    if ($user === false) {
      http_response_code(401);
      echo json_encode(['message' => 'Usuário ou senha inválidas']);
    } else {
      header('Content-Type: application/json');
      echo json_encode($user);
    }
  }
}
