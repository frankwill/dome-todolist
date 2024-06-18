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

    return json_encode($dataArray, JSON_PRETTY_PRINT);

    // return $this->hydrateUsers($dataArray);
  }

  public function add()
  {
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
      $userObjects[] = new User(
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
