<?php

namespace mmr\todolist\Infrastructure\Persistence;

use PDO;

class ConnectionCreate
{
  public static function CreateConnection(): PDO
  {
    // $pdo = new PDO("mysql:host=localhost;dbname=mmr", 'root', 'admin');
    $dbPath = __DIR__ . "/../../banco.sqlite";
    $pdo = new PDO("sqlite:$dbPath");
    return $pdo;
  }
}
