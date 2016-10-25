<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property integer $id
 * @property string $last_name
 * @property integer $is_online
 *
 * @property Skill[] $skills [[getSkills()]]
 * @property Group[] $groups [[getGroups()]]
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'is_online'], 'required'],
            [['is_online'], 'integer'],
            [['last_name'], 'string', 'max' => 255],
            [['last_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Last Name',
            'is_online' => 'Is Online',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])
            ->viaTable('{{%person_skill}}', ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])
            ->viaTable('{{%person_group}}', ['person_id' => 'id']);
    }
}
