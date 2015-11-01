<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use common\models\FileRepository;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
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
                        'actions' => ['profile', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Allows user to manage his profile
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = User::findIdentity(Yii::$app->user->id);
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

    /**
     * Deletes an existing user.
     *
     * @throws ForbiddenHttpException
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $id = intval($id);
        if($id === Yii::$app->user->id) {
            Yii::$app->user->logout();
            $this->getUser($id)->delete();
            return $this->redirect('/site/index/');
        }
        else {
            throw new ForbiddenHttpException;
        }
    }
}
