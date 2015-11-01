<?php
namespace common\traits;

use common\models\User;
use yii\web\NotFoundHttpException;

/**
 * Functionality, that used in front and backend
 * UserControllers.
 *
 * Class UserTrait
 * @package common\traits
 */
trait UserTrait {
    /**
     * @param $id
     * @return User
     * @throws NotFoundHttpException
     */
    protected function getUser($id) {
        $user = User::findIdentity($id);

        if(is_null($user)) {
            throw new NotFoundHttpException('user doesn\'t exist');
        }

        return $user;
    }
}