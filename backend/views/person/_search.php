<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $groupLabels string[] */
/* @var $skillLabels string[] */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'lastName')->textInput() ?>

    <?= $form->field($model, 'isOnline')->dropDownList([1 => 'Yes', 0 => 'No'], ['prompt' => 'All']) ?>

    <?= $form->field($model, 'groupIds')->dropDownList($groupLabels, ['prompt' => 'All']) ?>

    <?= $form->field($model, 'skillIds')->dropDownList($skillLabels, ['prompt' => 'All']) ?>

    <?php ActiveForm::end(); ?>

</div>
