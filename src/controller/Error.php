<?php

namespace beejee\controller;

use beejee\Application;
use beejee\Controller;

/**
 * Class Error
 * @package beejee\controller
 */
class Error extends Controller
{
    public function show(\Throwable $e)
    {
        echo $this->render('error/show.php', [
            'error' => $e
        ]);
    }
}
