<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string()->notNull()->unique(),
            'is_online' => $this->boolean()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%skill}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('{{%person_skill}}', [
            'person_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%person_group}}', [
            'person_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->loadDemoData();
    }

    public function down()
    {
        $this->dropTable('{{%person_group}}');
        $this->dropTable('{{%person_skill}}');
        $this->dropTable('{{%group}}');
        $this->dropTable('{{%skill}}');
        $this->dropTable('{{%person}}');
        $this->dropTable('{{%user}}');
    }

    protected function loadDemoData()
    {
        $this->batchInsert('{{%person}}', ['last_name', 'is_online'], [
            ['Сотрудник1', true],
            ['Сотрудник2', false],
            ['Сотрудник3', true],
            ['Сотрудник4', false],
            ['Сотрудник5', true],
            ['Сотрудник6', false],
        ]);

        $this->batchInsert('{{%group}}', ['name'], [
            ['1'], ['2'], ['3'], ['4'],
        ]);

        $this->batchInsert('{{%skill}}', ['name'], [
            ['a'], ['b'], ['c'],
        ]);

        $this->batchInsert('{{%person_group}}', ['person_id', 'group_id'], [
            [1, 1],
            [1, 3],
            [1, 4],
            [2, 1],
            [2, 2],
            [3, 3],
            [3, 4],
            [4, 1],
            [4, 4],
            [5, 3],
            [6, 2],
        ]);

        $this->batchInsert('{{%person_skill}}', ['person_id', 'skill_id'], [
            [1, 1],
            [1, 3],
            [1, 2],
            [2, 1],
            [2, 2],
            [3, 3],
            [3, 3],
            [4, 1],
            [4, 2],
            [5, 3],
            [6, 2],
        ]);
    }
}
