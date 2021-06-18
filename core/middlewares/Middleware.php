<?php


namespace app\core\middlewares;


abstract class Middleware
{
    protected array $actions;

    /**
     * Middleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    abstract public function execute();
}