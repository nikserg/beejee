<?php
namespace beejee\model;
use beejee\Model;

/**
 * Class Task
 * @package beejee\model
 */
class Task extends Model {

    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $email;
    /**
     * @var bool
     */
    public $done;
    /**
     * @var bool
     */
    public $edited;

    protected static function getTableName()
    {
        return 'task';
    }
}