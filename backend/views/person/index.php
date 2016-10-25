<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', [
        'model' => $searchModel,
        'groupLabels' => $groupLabels,
        'skillLabels' => $skillLabels,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterSelector' => ".person-search input, .person-search select",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'last_name',
            'skills' => [
                'attribute' => 'skills',
                'value' => function (\common\models\Person $model) {
                    $skills = \yii\helpers\ArrayHelper::getColumn($model->skills, 'name');
                    return implode(PHP_EOL, $skills);
                },
                'format' => 'html',
            ],
            'groups' => [
                'attribute' => 'groups',
                'value' => function (\common\models\Person $model) {
                    $groups = \yii\helpers\ArrayHelper::getColumn($model->groups, 'name');
                    return implode(PHP_EOL, $groups);
                },
                'format' => 'html',
            ],
            'is_online:boolean',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
