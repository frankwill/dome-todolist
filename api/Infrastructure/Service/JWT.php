<?php

namespace mmr\todolist\Infrastructure\Service;

class JWT
{
  public static function base64Encode($jsonEncode)
  {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jsonEncode));
  }

  public static function encode(array $payload, string $key)
  {
    $header = self::base64Encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));
    $payload = self::base64Encode(json_encode($payload));

    // chave deve ficar em um arquivo .env
    $signature = hash_hmac("sha256", "$header.$payload", $key, true);
    $signature = self::base64Encode($signature);

    $token = "$header.$payload.$signature";

    $isValidToken = self::validate($token);
    if (!$isValidToken) {
      return "Token inválido";
    }

    return $token;
  }

  public static function validate(string $token): string
  {

    $arrayParts = explode(".", $token);
    if (count($arrayParts) != 3) {
      echo "Token inválido";
      exit();
    }

    $header = $arrayParts[0];
    $payload = $arrayParts[1];
    $signature = $arrayParts[2];

    $valid = hash_hmac('sha256', "$header.$payload", 'senha-secreta', true);
    $valid = self::base64Encode($valid);

    if ($signature == $valid) {
      return $token = "$header.$payload.$signature";
    } else {
      return false;
    }
  }
}
