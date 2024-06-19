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

  public function all()
  {
    $statement = $this->pdo->query("SELECT * FROM user");
    $dataArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $this->hydrateUsers($dataArray);
  }

  public function add(User $user)
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

  public function edit()
  {
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
