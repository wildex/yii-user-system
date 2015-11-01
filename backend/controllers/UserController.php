<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use common\models\FileRepository;
use yii\web\UploadedFile;

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

        $user = User::findIdentity(\Yii::$app->user->id);
        $fileRepo = new FileRepository();

        if (Yii::$app->request->isPost) {
            $user->load(Yii::$app->request->post());
            $fileRepo->imageFile = UploadedFile::getInstance($fileRepo, 'imageFile');
            if ($fileRepo->imageFile
                && ($path = $fileRepo->upload())) {
                $user->avatar = $path;
            }
            $user->save();
        }

        return $this->render('profile', compact('user', 'fileRepo'));
    }
}
