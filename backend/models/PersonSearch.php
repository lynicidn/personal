<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Group;
use common\models\Skill;
use common\models\Person;

/**
 * PersonSearch represents the model behind the search form of `common\models\Person`.
 */
class PersonSearch extends Model
{
    public $lastName;
    public $isOnline;
    public $skillIds = [];
    public $groupIds = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['isOnline', 'boolean'],
            ['skillIds', 'exist', 'targetClass' => Skill::className(), 'targetAttribute' => 'id', 'allowArray' => true],
            ['groupIds', 'exist', 'targetClass' => Group::className(), 'targetAttribute' => 'id', 'allowArray' => true],
            ['lastName', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lastName' => 'Last Name',
            'isOnline' => 'Online',
            'skillIds' => 'Skills',
            'groupIds' => 'Groups',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Person::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'is_online' => $this->isOnline,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->lastName]);

        if (!empty($this->groupIds)) {
            $query->innerJoinWith('groups', false)->andWhere(['group.id' => $this->groupIds]);
        }

        if (!empty($this->skillIds)) {
            $query->innerJoinWith('skills', false)->andWhere(['skill.id' => $this->skillIds]);
        }

        return $dataProvider;
    }
}
