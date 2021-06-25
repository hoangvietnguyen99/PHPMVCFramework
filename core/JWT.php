<?php


namespace app\core;


use app\models\User;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class JWT
{
    private string $secret;

    /**
     * JWT constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->secret = $config['SECRET'];
    }

    public function base64UrlEncode($data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64UrlDecode($data): bool|string
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function generateJWT(User $user)
    {
        // Create the token header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

// Create the token payload
        $payload = json_encode([
            'user_id' => $user->getId(),
            'exp' => strtotime('now') + 7 * 24 * 3600
        ]);

// Encode Header
        $base64UrlHeader = $this->base64UrlEncode($header);

// Encode Payload
        $base64UrlPayload = $this->base64UrlEncode($payload);

// Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->secret, true);

// Encode Signature to Base64Url String
        $base64UrlSignature = $this->base64UrlEncode($signature);

// Create JWT
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public function validate(string $token)
    {
        $jwt = $token;

        // split the token
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signatureProvided = $tokenParts[2];

// check the expiration time - note this will cause an error if there is no 'exp' claim in the token
        $expiration = Carbon::createFromTimestamp(json_decode($payload)->exp);
        $tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) < 0);

// build a signature based on the header and payload using the secret
        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

// verify it matches the signature provided in the token
        $signatureValid = ($base64UrlSignature === $signatureProvided);

        echo "Header:\n" . $header . "\n";
        echo "Payload:\n" . $payload . "\n";

        if ($tokenExpired) {
            echo "Token has expired.\n";
        } else {
            echo "Token has not expired yet.\n";
        }

        if ($signatureValid) {
            echo "The signature is valid.\n";
        } else {
            echo "The signature is NOT valid\n";
        }
    }
}