<?php

namespace mmr\todolist\Infrastructure\Repository;

use mmr\todolist\Infrastructure\Service\JWT;
use mmr\todolist\Model\User;
use PDO;

class UserRepository
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function find(string $username)
  {

    $payload = ["username" => $username];

    $sql = "SELECT password_user FROM user WHERE username_user = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $username);
    $statement->execute();

    $password_user = $statement->fetch(PDO::FETCH_ASSOC)['password_user'] ?? "";

    if (is_null($password_user) || $password_user == false) {
      $response = ["message" => "Usuário ou senha inválidos"];
      http_response_code(400);
      echo json_encode($response);
      exit();
    }

    return JWT::encode($payload);
  }

  public function add(User $user): bool
  {
    $sql = "INSERT INTO user (
        username_user,
        password_user,
        name_user,
        email_user
      ) VALUES (
        :username_user,
        :password_user,
        :name_user,
        :email_user
      )";

    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(":username_user", $user->getUsername());
    $statement->bindValue(":password_user", $user->getPassword());
    $statement->bindValue(":name_user", $user->getName());
    $statement->bindValue(":email_user", $user->getEmail());

    return $statement->execute();
  }

  public function edit(User $user, int $id): bool
  {
    $sql = "UPDATE user
            SET
              username_user = :username_user,
              password_user = :password_user,
              name_user     = :name_user,
              email_user    = :email_user
            WHERE
              id_user = :id_user";

    $statement = $this->pdo->prepare($sql);

    $result = $statement->execute([
      ":username_user" => $user->getUsername(),
      ":password_user" => $user->getPassword(),
      ":name_user" => $user->getName(),
      ":email_user" => $user->getEmail(),
      ":id_user" => $id,
      PDO::PARAM_INT
    ]);

    return $result;
  }

  public function remove(int $id): bool
  {
    $sql = "DELETE FROM user WHERE id_user = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $id, PDO::PARAM_INT);

    return $statement->execute();
  }

  private function hydrateUsers(array $dataArray): array
  {
    $dataObject = array_map(function ($data) {
      $userObjects = new User(
        $data['id_user'],
        $data['username_user'],
        $data['password_user'],
        $data['name_user'],
        $data['email_user']
      );
      return $userObjects;
    }, $dataArray);

    return $dataObject;
  }
}
