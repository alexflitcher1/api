<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;

class ActiveModeController extends ActiveController
{
    public function __construct($id, $module, $config = [])
    {
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');
        parent::__construct($id, $module, $config = []);
    }

    public function checkFor404($check, $ret)
    {
        if (empty($check)) {
            Yii::$app->response->statusCode = 404;
            return ["name" => "Not Found", "message" => "Object not found: " . $ret,
            "code" => 0, "status" => 404, "type" => "yii\\web\\NotFoundHttpException"];
        }
        return ['code' => 1];
    }
}
