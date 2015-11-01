<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\data\Pagination;

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
                        'actions' => ['view', 'index'],
                        'allow' => true,
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $query = User::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $users = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('index', [
            'users' => $users,
            'pages' => $pages,
        ]);
    }

    public function actionView()
    {
        $user = User::findIdentity(intval(Yii::$app->request->get('id')));
        return $this->render('view', compact('user'));
    }
}
