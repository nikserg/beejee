<?php

namespace beejee;

use Medoo\Medoo;

class Application
{
    /**
     * @var Application
     */
    private static $instance;

    /**
     * Параметры приложения
     *
     *
     * @var
     */
    public $params;

    /**
     * @var Medoo
     */
    protected $db;

    /**
     * @return Medoo
     */
    public function getDb()
    {
        return $this->db;
    }
    /**
     * Application constructor.
     * @param Medoo $db
     * @param array $params
     * @throws \Exception
     */
    private function __construct(Medoo $db, array $params)
    {
        if (self::$instance) {
            throw new \Exception('Приложение уже инициировано');
        }
        $this->db = $db;
        $this->params = $params;
    }

    /**
     * @param Medoo $db
     * @param array $params
     * @throws \Exception
     */
    public static function init(Medoo $db, array $params) {
        self::$instance = new Application($db, $params);
    }

    /**
     * @return Application
     * @throws \Exception
     */
    public static function instance()
    {
        if (!self::$instance) {
            throw new \Exception('Приложение не инициировано');
        }
        return self::$instance;
    }

    public function run()
    {
        //Определяем роутинг и создаем контроллер
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $pathPieces = explode('/', $path);
        if (!isset($pathPieces[1]) || !$pathPieces[1]) {
            $pathPieces = explode('/', $this->params['defaultUrl']);
        }

        //Имя контролленра
        $controllerName = "\\beejee\\controller\\" . ucfirst($pathPieces[1]);

        //Имя экшна
        $actionName = 'action' . ucfirst($pathPieces[2]);

        //Запускаем приложение
        $controller = new $controllerName();
        $controller->$actionName();
    }
}