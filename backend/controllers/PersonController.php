<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Group;
use common\models\Skill;
use backend\models\PersonSearch;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groupLabels' => Group::find()->select(['name', 'id'])->indexBy('id')->asArray()->column(),
            'skillLabels' => Skill::find()->select(['name', 'id'])->indexBy('id')->asArray()->column(),
        ]);
    }
}
