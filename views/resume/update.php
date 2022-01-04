<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResumeForm */
/* @var $item app\models\Resume */

$this->title = 'Update Resume: ' . $model->name.' '.$model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Resumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name.' '.$model->surname, 'url' => ['view', 'id' => $item->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resume-update">

    <h1 class="mb-5"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
