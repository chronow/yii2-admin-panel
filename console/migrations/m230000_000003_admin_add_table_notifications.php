<?php

use yii\db\Migration;

/**
 * Class m230000_000003_admin_add_table_notifications
 */
class m230000_000003_admin_add_table_notifications extends Migration
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

        if ($this->db->getTableSchema('{{%notifications}}', true) === null) {
            $this->createTable('{{%notifications}}', [
                'id' => $this->primaryKey(),
                'fio' => $this->string(255)->defaultValue(NULL)->comment('ФИО / Имя'),
                'phone' => $this->string(255)->defaultValue(NULL)->comment('Телефон'),
                'email' => $this->string(255)->defaultValue(NULL)->comment('Email'),
                'text' => $this->text()->defaultValue(NULL)->comment('Сообщение'),
                'status' => $this->smallInteger()->defaultValue(0)->comment('Статус'),
                'refTitle' => $this->string(255)->defaultValue(NULL)->comment('Обратный заголовок'),
                'refLink' => $this->text()->defaultValue(NULL)->comment('Обратная ссылка'),
                'object_id' => $this->smallInteger()->defaultValue(0)->comment('ID объекта'),
                'created_at' => $this->integer()->defaultValue(0)->comment('Созданно'),
                'updated_at' => $this->integer()->defaultValue(0)->comment('Обновленно'),
            ], $tableOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notifications}}');
    }
}
