<?php

/* @var $this yii\web\View */
/* @var $users \common\models\User[] */
/* @var $pages int */

use yii\widgets\LinkPager;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <?php
        foreach($users as $user) {
    ?>
            <div class="row">
                <h2><a href="<?= Url::to(['user/view', 'id' => $user->id])?>"><?= $user->username ?></a></h2>
                <?= EasyThumbnailImage::thumbnailImg(
                    Yii::getAlias('@common/') . $user->avatar,
                    100,
                    100,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    ['alt' => $user->username]
                ) ?>
            </div>
    <?php
        }
    ?>
    <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
    ?>
</div>
