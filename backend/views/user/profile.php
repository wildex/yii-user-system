<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $fileRepo \common\models\FileRepository */
/* @var $user \common\models\User */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\thumbnail\EasyThumbnailImage;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-manage">
    <h1><?= Html::encode($user->username) ?></h1>

    <p>Edit profile</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'profile-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php
                    echo EasyThumbnailImage::thumbnailImg(
                        Yii::getAlias('@common/') . $user->avatar,
                        150,
                        150,
                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $user->username]
                    );
                ?>
                <?= $form->field($fileRepo, 'imageFile')->fileInput()->label('User avatar') ?>
                <?= $form->field($user, 'phone') ?>

                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
