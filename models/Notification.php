<?php


namespace app\models;


use app\constants\Status;
use app\constants\Type;
use app\core\db\DbModel;

class Notification extends DbModel
{
    public string $title;
    public string $type;
    public string $message;
    public string $status;

    /**
     * Notification constructor.
     * @param string $title
     * @param string $type
     * @param string $message
     * @param string $status
     */
    public function __construct(string $title, string $type, string $message, string $status)
    {
        parent::__construct();
        $this->title = $title;
        $this->type = $type;
        $this->message = $message;
        $this->status = $status;
    }


    public static function collectionName(): string
    {
        return 'NOTIFICATIONS';
    }

    /**
     * @inheritDoc
     */
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'status' => $this->status
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->type = $data['type'];
        $this->status = $data['status'];
    }
}