<?php
namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\controllers\ActiveModeController;

class UserController extends ActiveModeController
{
    public $modelClass = 'backend\models\User';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }

    public function actionByUsername($username)
    {
        $res = User::findOne(['username' => $username]);
        if (empty($res)) {
            Yii::$app->response->statusCode = 404;
            return ["name" => "Not Found", "message" => "Object not found: " . $username,
            "code" => 0, "status" => 404, "type" => "yii\\web\\NotFoundHttpException"];
        }
        return $res;
    }
}