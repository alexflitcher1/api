<?php
namespace backend\controllers;

use backend\controllers\ActiveModeController;

class FriendController extends ActiveModeController
{
    public $modelClass = 'backend\models\Friends';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}