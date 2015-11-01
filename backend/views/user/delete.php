<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $deleteForm \backend\models\DeleteForm */

$this->title = 'Account cancellation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please re-enter your password to confirm:</p>

    <?php if(!empty(Yii::$app->session->getFlash('error'))) { ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-delete']); ?>
            <?= $form->field($deleteForm, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
