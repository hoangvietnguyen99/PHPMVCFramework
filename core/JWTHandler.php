<?php


namespace app\core;


use app\models\User;
use Exception;
use Firebase\JWT\JWT;
use MongoDB\BSON\ObjectId;

class JWTHandler
{
    private string $secret;
    private string $alg = 'HS256';

    /**
     * JWT constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->secret = $config['SECRET'];
    }

    /**
     * @throws Exception
     */
    public function generateJWT(User $user)
    {
        $payload = array(
            "user_id" => $user->getId()->__toString(),
            "iat" => strtotime('now'),
            "exp" => strtotime('now') + (3600 * 24 * 7)
        );

        return JWT::encode($payload, $this->secret, $this->alg);
    }

    public function validate(string $token)
    {
        $decoded = (array) JWT::decode($token, $this->secret, array($this->alg));
        $userId = new ObjectId($decoded['user_id']);
        $user = User::findOne(['_id' => $userId]);
        if (!$user) {
            Application::$application->response->send(401, ['message' => 'User not found.']);
        }
        Application::$application->user = $user;
    }
}