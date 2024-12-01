<?php


namespace mmr\todolist\Infrastructure\Service;

date_default_timezone_set('America/Sao_Paulo');

class JWT
{
  private static function base64Encode($jsonEncode)
  {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jsonEncode));
  }

  public static function encode(array $payload)
  {
    $header = self::base64Encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));

    $payloadDefault = [
      "iat" => time(),
      // "exp" => time() + (24 * 60 * 60),
      "exp" => time() + 60,
    ];
    $payload = array_merge($payloadDefault, $payload);
    $payload = self::base64Encode(json_encode($payload));

    // chave deve ficar em um arquivo .env
    $signature = hash_hmac("sha256", "$header.$payload", 'senha-secreta', true);
    $signature = self::base64Encode($signature);

    $token = "$header.$payload.$signature";

    return $token;
  }

  public static function base64Decode(string $text): string
  {
    return base64_decode(str_replace(["-", "_"], ["+", "/"], $text), true);
  }

  public static function validate(string $token)
  {
    $arrayParts = explode(".", $token);

    $headerFromToken = $arrayParts[0];
    $payloadFromToken = $arrayParts[1];
    $signatureFromToken = $arrayParts[2];

    $stringHeaderFromToken = JWT::base64Decode($headerFromToken);
    $encodedHeaderFromToken = JWT::base64Encode($stringHeaderFromToken);

    $stringPayloadFromToken = JWT::base64Decode($payloadFromToken);
    $decodedPayloadFromToken = json_decode($stringPayloadFromToken, true);
    $timeCreated = $decodedPayloadFromToken['iat'];
    $timeExpire = $decodedPayloadFromToken['exp'];
    $encodedPayloadFromToken = JWT::base64Encode($stringPayloadFromToken);

    $signatureToCompare = hash_hmac("sha256", "$encodedHeaderFromToken.$encodedPayloadFromToken", 'senha-secreta', true);
    $signatureToCompare = self::base64Encode($signatureToCompare);

    $revalidatedToken = "$encodedHeaderFromToken.$encodedPayloadFromToken.$signatureToCompare";

    if (time() > $timeExpire) {
      return json_encode(["message" => "Token expirado"]);
    } else if (count($arrayParts) != 3) {
      return json_encode(["message" => "Token inválido"]);
    } else if ($signatureFromToken != $signatureToCompare) {
      return json_encode(["message" => "Assinatura do token inválida"]);
    } else {
      return json_encode(["token" => $revalidatedToken]);
    }
  }
}
