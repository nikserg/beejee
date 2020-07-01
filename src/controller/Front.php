<?php

namespace beejee\controller;

use beejee\Application;
use beejee\Controller;
use beejee\model\Task;
use voku\helper\Paginator;

/**
 * Class Front
 *
 * Интерфейс посетителя
 *
 *
 * @package beejee\controller
 */
class Front extends Controller
{

    /**
     * Список задач
     */
    public function actionIndex()
    {
        //Пагинация
        $pager = new Paginator(3, 'page');
        $pager->set_total(Task::count());

        //Сортировка
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
        $sort = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'DESC';

        $tasks = Task::fetchAll($pager->get_limit_raw()[1], $pager->get_limit_raw()[0], $sort, $sortOrder);
        echo $this->render('front/index.php', [
            'pager' => $pager->page_links('?sort='.$sort.'&sortOrder='.$sortOrder.'&'),
            'tasks' => $tasks,
            'sort' => $sort,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Создание задачи
     *
     *
     */
    public function actionCreate()
    {
        $model = new Task();
        if (isset($_POST['email'])) {
            $this->processModel($model);
            $this->setFlashMessage('Создана задача номер ' . $model->id);
            $this->redirect('/front/index');
        }

        echo $this->render('front/create.php', [
            'model' => $model
        ]);
    }

    /**
     * Редактирование задачи
     *
     *
     * @throws \Exception
     */
    public function actionEdit()
    {
        if (!$this->getIsAdmin()) {
            throw new \Exception('Доступ запрещен', 403);
        }
        $model = Task::getById($_GET['id']);
        if (!$model) {
            throw new \Exception('Запись не найдена', 404);
        }

        if (isset($_POST['email'])) {
            $this->processModel($model);
            $this->setFlashMessage('Обновлена задача номер ' . $model->id);
            $this->redirect('/front/index');
        }

        echo $this->render('front/edit.php', ['model' => $model]);
    }

    /**
     * Сохранение задачи в БД
     *
     *
     * @param Task $task
     * @return bool|\PDOStatement
     */
    private function processModel(Task $task)
    {
        $task->email = $_POST['email'];
        $task->username = $_POST['username'];
        if ($task->description != $_POST['description']) {
            $task->edited = true;
        }
        $task->description = $_POST['description'];
        if (isset($_POST['done'])) {
            $task->done = $_POST['done'];
        }

        return $task->save();
    }
}
