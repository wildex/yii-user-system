<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use yii\data\Pagination;
use \common\traits\UserTrait;

/**
 * Site controller
 */
class UserController extends Controller
{
    use UserTrait;

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

    /**
     * List all users
     *
     * @return string
     */
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

    /**
     * View user info
     *
     * @param $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $user = $this->getUser(intval($id));

        return $this->render('view', compact('user'));
    }

}
