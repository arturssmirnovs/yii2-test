<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $i integer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row btn-clone-target">
    <div class="col-xs-12 col-md-6">
        <?= $form->field($model, '['.$i.']name')->textInput()->label("Name") ?>
    </div>

    <?= Html::button('X', ['class' => 'btn btn-danger btn-close']); ?>
</div>