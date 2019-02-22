<?php

use yii\db\Migration;

/**
 * Handles the creation of table `trd_comments`.
 * Has foreign keys to the tables:
 *
 * - `trd_articles`
 */
class m190103_174117_create_trd_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('trd_comments', [
            'id' => $this->primaryKey(),
            'created' => $this->integer(),
            'article_id' => $this->integer(),
            'username' => $this->string(),
            'email' => $this->string(),
            'comment' => $this->text(),
            'parent' => $this->integer()->defaultValue(0)
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            'idx-trd_comments-article_id',
            'trd_comments',
            'article_id'
        );

        // add foreign key for table `trd_articles`
        $this->addForeignKey(
            'fk-trd_comments-article_id',
            'trd_comments',
            'article_id',
            'trd_articles',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `trd_articles`
        $this->dropForeignKey(
            'fk-trd_comments-article_id',
            'trd_comments'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            'idx-trd_comments-article_id',
            'trd_comments'
        );

        $this->dropTable('trd_comments');
    }
}
