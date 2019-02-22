<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190102_152416_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        $this->createTable('trd_user', [
            'id' => $this->primaryKey(),
            'added' => $this->integer(),
            'username' => $this->string(),
            'email' => $this->string(),
            'passhash' => $this->string(100),
            'authKey' => $this->string(100),
            'status' => $this->integer(1)->defaultValue(2)->comment('1 - admin; 2- user')

        ],
            $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('trd_user');
    }
}
