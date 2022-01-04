<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResumeForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <h2>Education</h2>

    <?php
    foreach ($model->educations as $i => $education)
    {
        echo $this->render("_education_field", ['model' => $education, 'i' => $i, 'form' => $form]);
    }
    echo Html::button('Add more', ['class' => 'btn btn-secondary btn-clone']);
    ?>

    <h2>Experience</h2>

    <?php
    foreach ($model->experiences as $i => $experience)
    {
        echo $this->render("_experience_field", ['model' => $experience, 'i' => $i, 'form' => $form]);
    }
    echo Html::button('Add more', ['class' => 'btn btn-secondary btn-clone']);
    ?>

    <h2>Skills</h2>

    <?php
    foreach ($model->skills as $i => $skill)
    {
        echo $this->render("_skill_field", ['model' => $skill, 'i' => $i, 'form' => $form]);
    }
    echo Html::button('Add more', ['class' => 'btn btn-secondary btn-clone']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
