<?php
namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\Posts;
use backend\controllers\ActiveModeController;

class PostController extends ActiveModeController
{
    public $modelClass = 'backend\models\Posts';

    public function actions()
    {
        // $headers = Yii::$app->response->headers;
        // $headers->add('Access-Control-Allow-Origin', '*');
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }

    public function actionByAuthor($username)
    {
        $authorid = User::findOne(['username' => $username]);
        $check = $this->checkFor404($authorid, $username);
        if (!$check['code']) return $check;

        $res = Posts::find()->where(['userid' => $authorid->id])->all();
        $check = $this->checkFor404($res, $username);
        if (!$check['code']) return $check;

        return $res;
    }

    public function actionByAuthorId($id)
    {
        $res = Posts::find()->where(['userid' => $id])->all();
        $check = $this->checkFor404($res, $id);
        if (!$check['code']) return $check;

        return $res;
    }

    public function actionReplies($id)
    {
        $res = Posts::find()->where(['replyid' => $id])->all();
        $check = $this->checkFor404($res, $id);
        if (!$check['code']) return $check;

        return $res;
    }

    public function actionLimit($offset, $page)
    {
        $res = Posts::find()
        ->where(['replyid' => '0'])
        ->orderBy(['date' => SORT_DESC])
        ->limit($offset)
        ->offset($page*$offset)
        ->all();
        $check = $this->checkFor404($res, $page);
        if (!$check['code']) return $check;

        return $res;
    }
}
