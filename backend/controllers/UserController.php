<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionProfile()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = User::find(\Yii::$app->user->id)->one();
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
}
