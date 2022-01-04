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
    <div class="col-xs-12 col-md-6">
        <?= $form->field($model, '['.$i.']position')->textInput()->label("Position") ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <?= $form->field($model,'['.$i.']started')->widget(\yii\jui\DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control datepicker']
        ])->label("Started") ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <?= $form->field($model,'['.$i.']finished')->widget(\yii\jui\DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control datepicker']
        ])->label("Finished") ?>
    </div>
    <div class="col-xs-12 col-md-12">
        <?= $form->field($model, '['.$i.']description')->textarea()->label("Description") ?>
    </div>

    <?= Html::button('X', ['class' => 'btn btn-danger btn-close']); ?>
</div>