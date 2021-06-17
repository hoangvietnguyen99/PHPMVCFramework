<?php


namespace app\core\db;


use MongoDB\Client;
use MongoDB\Collection;

class Database
{
    public Client $client;
    public \MongoDB\Database $database;
    /**
     * Database constructor.
     */
    public function __construct(array $config)
    {
        if ($config["TYPE"] === 'local') $connectionString = $config["LOCAL"] ?? "";
        else $connectionString = $config["CLOUD"] ?? "";

        $this->client = new Client($connectionString);

        $this->database = $this->client->vnsocial;
    }

    public function getCollection(string $collectionName): Collection
    {
        return $this->database->$collectionName;
    }
}