<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Cancellation account
 */
class DeleteForm extends Model
{
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string'],
        ];
    }

    /**
     * Delete user
     *
     * @param User $user
     */
    public function delete(User $user)
    {
        $user->status = User::STATUS_DELETED;
        $user->save();
    }
}
