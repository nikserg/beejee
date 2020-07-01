<?php

namespace beejee\controller;

use beejee\Application;
use beejee\Controller;

/**
 * Class Admin
 * @package beejee\controller
 */
class Admin extends Controller
{
    /**
     * Разлогиниться
     */
    public function actionLogout()
    {
        if ($this->getIsAdmin()) {
            $this->setFlashMessage('Вы успешно вышли');
            $this->setIsAdmin(false);
        }
        $this->redirect('/front/index');
    }

    /**
     * Залогиниться
     *
     *
     * @throws \Exception
     */
    public function actionLogin()
    {
        if (isset($_POST['password'])) {
            if (Application::instance()->params['adminLogin'] != $_POST['login'] ||
                !password_verify($_POST['password'], Application::instance()->params['adminPassword'])) {
                $this->setFlashMessage('Логин или пароль неверны');
            } else {
                $this->setFlashMessage('Вы успешно вошли');
                $this->setIsAdmin(true);
                $this->redirect('/front/index');
            }
        }
        echo $this->render('admin/login.php');
    }
}
