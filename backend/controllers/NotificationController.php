<?php
namespace backend\controllers;

use backend\controllers\ActiveModeController;

class NotificationController extends ActiveModeController
{
    public $modelClass = 'backend\models\Notifications';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}