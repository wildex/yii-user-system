<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use common\models\FileRepository;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use common\traits\UserTrait;
use backend\models\DeleteForm;

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
            $deleteForm = new DeleteForm();


            if(Yii::$app->request->isPost) {
                $user = $this->getUser($id);
                $deleteForm->load(Yii::$app->request->post());

                if($user->validatePassword($deleteForm->password)) {
                    $deleteForm->delete($user);
                    Yii::$app->user->logout();
                    return $this->redirect('/site/index/');
                }
                else {
                    Yii::$app->session->setFlash('error', "Invalid password!");
                }
            }
            return $this->render('delete', compact('deleteForm'));
        }
        else {
            throw new ForbiddenHttpException;
        }
    }
}
