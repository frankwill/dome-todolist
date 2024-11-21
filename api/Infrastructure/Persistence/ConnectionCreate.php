<?php

namespace mmr\todolist\Infrastructure\Persistence;

use PDO;

class ConnectionCreate
{
  public static function CreateConnection(): PDO
  {
    $envPath = dirname(__DIR__, 3) . '/env.ini';
    $envArray = parse_ini_file($envPath);

    $host = $envArray['MYSQL_HOST'];
    $db = $envArray['MYSQL_DB'];
    $user = $envArray['MYSQL_USER'];
    $password = $envArray['MYSQL_PASSWORD'];

    $pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$password");
    return $pdo;
  }
}
