<?php

namespace mmr\todolist\Infrastructure\Repository;

use mmr\todolist\Model\User;
use PDO;

class UserRepository
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function all(): array
  {
    $statement = $this->pdo->query("SELECT * FROM user");
    $dataArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $this->hydrateUsers($dataArray);
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

  public function edit(User $user): bool
  {
    $sql = "UPDATE user
            SET
              username_user = :username_user,
              password_user = :password_user,
              name_user     = :name_user,
              email_use     = :email_user
            WHERE
              id = :id";

    $statement = $this->pdo->prepare($sql);
    $result = $statement->execute([
      ":username_user" => $user->getUsername(),
      ":password_user" => $user->getPassword(),
      ":name_user" => $user->getName(),
      ":email_user" => $user->getEmail()
    ]);

    return $result;
  }

  public function remove()
  {
  }

  private function hydrateUsers(array $dataArray)
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
