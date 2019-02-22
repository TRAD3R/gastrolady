<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 * Has foreign keys to the tables:
 *
 * - `trd_user`
 */
class m190102_153154_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        $this->createTable('trd_articles', [
            'id' => $this->primaryKey(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'author_id' => $this->integer(),
        ],
            $tableOptions);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-articles-author_id',
            'trd_articles',
            'author_id'
        );

        // add foreign key for table `trd_user`
        $this->addForeignKey(
            'fk-articles-author_id',
            'trd_articles',
            'author_id',
            'trd_user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `trd_user`
        $this->dropForeignKey(
            'fk-articles-author_id',
            'trd_articles'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-articles-author_id',
            'trd_articles'
        );

        $this->dropTable('trd_articles');
    }
}
