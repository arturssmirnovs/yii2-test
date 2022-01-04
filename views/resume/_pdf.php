<?php

/* @var $this yii\web\View */
/* @var $item app\models\Resume */
/* @var $educations app\models\ResumeEducation[] */
/* @var $experiences app\models\ResumeExperience[] */
/* @var $skills app\models\ResumeSkill[] */

?>

<?= \yii\helpers\Html::tag("h1", $item->name." ".$item->surname) ?>

<?= \yii\helpers\Html::tag("h3", $item->location) ?>

<?= \yii\helpers\Html::tag("h3", "T: ".$item->phone." E: ".$item->email) ?>

<?php

if ($educations)
{
    echo  \yii\helpers\Html::tag("h2", "Education");

    echo  \yii\helpers\Html::tag("hr");

    foreach ($educations as $education)
    {
        echo \yii\helpers\Html::tag('h3', $education->name." ($education->faculty)");
        echo \yii\helpers\Html::tag('h4', $education->started."".($education->finished ? " - ".$education->finished : ""));
        if ($education->field)
        {
            echo \yii\helpers\Html::tag('h5', $education->field);
        }
        if ($education->level)
        {
            echo \yii\helpers\Html::tag('h5', $education->level);
        }
        echo \yii\helpers\Html::tag('p', $education->description);
    }
}

if ($experiences)
{
    echo  \yii\helpers\Html::tag("h2", "Experience");

    echo  \yii\helpers\Html::tag("hr");

    foreach ($experiences as $experience)
    {
        echo \yii\helpers\Html::tag('h3', $experience->name." ($experience->position)");
        echo \yii\helpers\Html::tag('h4', $experience->started."".($experience->finished ? " - ".$experience->finished : ""));
        echo \yii\helpers\Html::tag('p', $experience->description);
    }
}

if ($skills)
{
    echo  \yii\helpers\Html::tag("h2", "Skills");

    echo  \yii\helpers\Html::tag("hr");

    foreach ($skills as $skill)
    {
        echo \yii\helpers\Html::tag('p', $skill->name);
    }
}
?>