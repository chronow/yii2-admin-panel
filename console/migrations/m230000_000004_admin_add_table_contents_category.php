<?php

use yii\db\Migration;

/**
 * Class m230000_000004_admin_add_table_contents_category
 */
class m230000_000004_admin_add_table_contents_category extends Migration
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
        $table = 'contents_category';
        if ($this->db->getTableSchema($table, true) === null) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'key' => $this->string(255)->defaultValue(NULL)->comment('Ключ'),
                'gr' => $this->string(255)->defaultValue(NULL)->comment('Группа'),
                'title' => $this->string(255)->defaultValue(NULL)->comment('Название раздела'),
                'description' => $this->text()->defaultValue(NULL)->comment('Краткое описание'),
                'isPublic' => $this->boolean()->notNull()->defaultValue(1)->comment('Опубликованно'),
                'isFather' => $this->boolean()->notNull()->defaultValue(0)->comment('Родитель (д/н)'),
                'idParent' => $this->integer()->notNull()->defaultValue(0)->comment('ID родителя'),
                'level' => $this->integer()->notNull()->defaultValue(0)->comment('Вложенность'),
                'sorting' => $this->integer()->notNull()->defaultValue(0)->comment('Внутренний № п/п'),
                'byOrder' => $this->integer()->notNull()->defaultValue(0)->comment('Рейтинг вывода'),
            ], $tableOptions);

            $this->batchInsert(
                $table,
                ['key', 'gr', 'title', 'byOrder'],
                [
                    ['key-1', 'block', 'Текстовый блок', 100],
                    ['key-2', 'page', 'Страница', 200],
                    ['key-3', 'news', 'Новости', 300],
                    ['key-4', 'event', 'События', 400],
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contents_category}}');
    }
}
