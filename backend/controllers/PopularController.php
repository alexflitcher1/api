<?php
namespace backend\controllers;

use backend\models\Popular;
use backend\controllers\ActiveModeController;

class PopularController extends ActiveModeController
{
    public $modelClass = 'backend\models\Popular';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }

    public function actionLimit($count)
    {
        $res = Popular::find()
        ->orderBy(['count' => SORT_DESC])
        ->limit($count)
        ->offset(0)
        ->all();
        $check = $this->checkFor404($res, $count);
        if (!$check['code']) return $check;

        return $res;
    }
}
