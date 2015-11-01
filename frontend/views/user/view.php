<?php

/* @var $this yii\web\View */
/* @var $user \common\models\User */

use yii\helpers\Html;
use himiklab\thumbnail\EasyThumbnailImage;

$this->title = 'View';
$this->params['breadcrumbs'][] = [
    'label' => 'Users',
    'url' => ['/user']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($user->username) ?></h1>

    <p><?= $user->phone ?></p>

    <div class="row">
        <div class="col-lg-5">
                <?php
                    echo EasyThumbnailImage::thumbnailImg(
                        Yii::getAlias('@common/') . $user->avatar,
                        150,
                        150,
                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $user->username]
                    );
                ?>
        </div>
    </div>
</div>
