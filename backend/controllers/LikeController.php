<?php
namespace backend\controllers;

use backend\controllers\ActiveModeController;

class LikeController extends ActiveModeController
{
    public $modelClass = 'backend\models\Likes';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}