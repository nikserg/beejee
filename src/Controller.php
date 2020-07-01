<?php

namespace beejee;

use Medoo\Medoo;

abstract class Controller
{

    /**
     * Отображение шаблона
     *
     *
     * @param string $template
     * @param array $params
     * @return false|string
     */
    protected function render($template, $params = [])
    {
        //Flash-сообщение
        $flashMessage = $this->getFlashMessage();

        //Является админом
        $isAdmin = $this->getIsAdmin();

        //Рендерим страницу
        $templateName = __DIR__ . '/view/' . $template;
        extract($params);
        ob_start();
        include $templateName;
        $content = ob_get_clean();

        //Вписываем в layout
        ob_start();
        include __DIR__ . '/view/layout.php';
        $output = ob_get_clean();
        return $output;
    }

    /**
     * @param $message
     */
    protected function setFlashMessage($message)
    {
        $_SESSION['flash'] = $message;
    }

    /**
     * @return mixed
     */
    protected function getFlashMessage()
    {
        $return = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $return;
    }

    /**
     * @return mixed
     */
    protected function getIsAdmin()
    {
        return $_SESSION['admin'];
    }

    /**
     * @param $status
     */
    protected function setIsAdmin($status)
    {
        $_SESSION['admin'] = $status;
    }

    /**
     * @param $url
     */
    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}