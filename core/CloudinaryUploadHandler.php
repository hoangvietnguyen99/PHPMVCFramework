<?php


namespace app\core;



use app\utils\StringUtil;
use Cloudinary;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;

class CloudinaryUploadHandler
{
    private string $secret;
    private string $key;

    /**
     * CloudinaryUploadHandler constructor.
     */
    public function __construct(array $config)
    {
        $this->secret = $config['SECRET'];
        $this->key = $config['KEY'];
    }

    #[ArrayShape(['url' => "string", 'api_key' => "string", 'timestamp' => "int", 'public_id' => "string", 'signature' => "string"])] public function getSignature(string $publicId = '') {
        if (!$publicId) {
            $publicId = 'trithucso/'.StringUtil::generateRandomString();
        }
        $timestamp = (new DateTime())->getTimestamp();

        return [
            'url' => 'https://api.cloudinary.com/v1_1/nhviet99/image/upload',
            'api_key' => $this->key,
            'timestamp' => $timestamp,
            'public_id' => $publicId,
            'signature' => Cloudinary\Api\ApiUtils::signParameters([
                'timestamp' => $timestamp,
                'public_id' => $publicId
            ], $this->secret)
        ];
    }
}