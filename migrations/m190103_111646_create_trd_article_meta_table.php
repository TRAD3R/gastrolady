<?php

use yii\db\Migration;

/**
 * Handles the creation of table `trd_article_meta`.
 * Has foreign keys to the tables:
 *
 * - `trd_articles`
 */
class m190103_111646_create_trd_article_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('trd_article_meta', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'lang' => $this->string(),
            'url' => $this->string(),
            'title' => $this->string(),
            'content' => $this->text(),
            'main_image' => $this->string(),
            'gallery' => $this->text(),
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            'idx-trd_article_meta-article_id',
            'trd_article_meta',
            'article_id'
        );

        // add foreign key for table `trd_articles`
        $this->addForeignKey(
            'fk-trd_article_meta-article_id',
            'trd_article_meta',
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
            'fk-trd_article_meta-article_id',
            'trd_article_meta'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            'idx-trd_article_meta-article_id',
            'trd_article_meta'
        );

        $this->dropTable('trd_article_meta');
    }
}
