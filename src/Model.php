<?php

namespace beejee;

use Medoo\Medoo;

/**
 * Class Model
 * @package beejee
 */
abstract class Model
{

    /**
     * @var int
     */
    public $id;

    /**
     * @throws \Exception
     * @return string
     */
    protected static function getTableName()
    {
        throw new \Exception('getTableName не определен');
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @param string $sortOrder
     * @return static[]
     * @throws \Exception
     */
    public static function fetchAll($limit = 0, $offset = 0, $sort = 'id', $sortOrder = 'DESC')
    {
        $constraints = [];
        if ($limit !== 0 || $offset !== 0) {
            $constraints['LIMIT'] = [$offset, $limit];
        }
        $possibleSortValues = array_keys((array)(new static()));
        if (!in_array($sort, $possibleSortValues)) {
            $sort = 'id';
        }
        if (!in_array($sortOrder, ['ASC', 'DESC'])) {
            $sortOrder = 'DESC';
        }

        $constraints['ORDER'] = [$sort => $sortOrder];
        return static::parseRows($constraints);
    }

    /**
     * @param $constraints
     * @return static[]
     * @throws \Exception
     */
    private static function parseRows($constraints) {
        $rows = Application::instance()->getDb()->select(static::getTableName(), '*', $constraints);
        $return = [];
        foreach ($rows as $row) {
            $model = new static();
            foreach ($row as $key => $value) {
                $model->{$key} = $value;
            }
            $return[] = $model;
        }
        return $return;
    }

    /**
     * @param $id
     * @return static
     * @throws \Exception
     */
    public static function getById($id)
    {
        $id = intval($id);
        if (!$id) {
            return null;
        }
        $rows = static::parseRows(['id' => $id]);
        $model = reset($rows);
        return $model;
    }

    /**
     * @return bool|int|mixed|string
     * @throws \Exception
     */
    public static function count()
    {
        return Application::instance()->getDb()->count(static::getTableName());
    }


    /**
     * @return bool|\PDOStatement
     * @throws \Exception
     */
    public function save()
    {
        $fields = (array)$this;
        if (!$fields['id']) {
            unset($fields['id']);
        }

        if (!$this->id) {
            $success = Application::instance()->getDb()->insert(static::getTableName(), $fields);
            if ($success) {
                $this->id = Application::instance()->getDb()->id();
            }
        } else {
            $success = Application::instance()->getDb()->update(static::getTableName(), $fields, ['id' => $this->id]);
        }
        return $success;
    }
}