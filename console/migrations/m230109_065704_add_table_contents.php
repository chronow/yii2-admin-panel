<?php

use yii\db\Migration;

/**
 * Class m230109_065704_add_table_contents
 */
class m230109_065704_add_table_contents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $table = 'contents';
        if ($this->db->getTableSchema($table, true) === null) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'key' => $this->string()->notNull()->defaultValue(NULL)->comment('Ключ / артикул'),
                'id_contents_category' => $this->integer()->notNull()->defaultValue(1)->comment('Категория'),
                'url' => $this->string(255)->defaultValue(NULL)->comment('Url / Чпу'),
                'title' => $this->string(255)->defaultValue(NULL)->comment('Название'),
                'description' => $this->text()->defaultValue(NULL)->comment('Краткое описание'),
                'keywords' => $this->text()->defaultValue(NULL)->comment('Ключевые слова / метки (через запятую)'),
                'annotation' => $this->text()->defaultValue(NULL)->comment('Аннотация'),
                'text' => $this->text()->defaultValue(NULL)->comment('Полное описание / текст'),
                'id_content' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Связь с записью'),
                'byOrder' => $this->integer()->notNull()->defaultValue(0)->comment('Порядок вывода'),

                'isPublic' => $this->boolean()->notNull()->defaultValue(1)->comment('Опубликованно'),
                'published' => $this->integer()->notNull()->defaultValue(0)->comment('Время для публикации'),
                'created_at' => $this->integer()->notNull()->defaultValue(0),
                'updated_at' => $this->integer()->notNull()->defaultValue(0),
                'deleted_at' => $this->integer()->notNull()->defaultValue(0),
            ], $tableOptions);

            // creates index for column `id_contents_category`
            $this->createIndex(
                'idx-' . $table . '-id_contents_category',
                $table,
                'id_contents_category'
            );
            // add foreign key for table `contents_category`
            $this->addForeignKey(
                'fk-' . $table . '-id_contents_category',
                $table,
                'id_contents_category',
                'contents_category',
                'id',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-contents-id_contents_category',
            'contents'
        );
        $this->dropIndex(
            'idx-contents-id_contents_category',
            'contents'
        );
        $this->dropTable('{{%contents}}');
    }
}
