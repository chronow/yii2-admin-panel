<?php

use yii\db\Migration;

/**
 * Class m230000_000002_admin_add_table_gallary_images
 */
class m230000_000002_admin_add_table_gallary_images extends Migration
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

        if ($this->db->getTableSchema('{{%gallary_images}}', true) === null) {
            $this->createTable('{{%gallary_images}}', [
                'id' => $this->primaryKey(),
                'is_main' => $this->boolean()->defaultValue(0)->comment('Главное изображение'),
                'id_model' => $this->integer()->defaultValue(0)->comment('Id записи'),
                'marker' => $this->string()->defaultValue(NULL)->comment('Маркер (контроллер)'),
                'title' => $this->string()->defaultValue(NULL)->comment('Подпись изображения'),
                'description' => $this->text()->defaultValue(NULL)->comment('Описание'),
                'original' => $this->string()->defaultValue(NULL)->comment('Путь к оригиналу'),
                'resize1' => $this->string()->defaultValue(NULL)->comment('Путь к обрезке'),
                'resize2' => $this->string()->defaultValue(NULL)->comment('Путь к обрезке'),
                'resize3' => $this->string()->defaultValue(NULL)->comment('Путь к обрезке'),
                'order_image' => $this->integer()->defaultValue(0)->comment('Порядок вывода'),
                'type' => $this->smallInteger()->defaultValue(0)->comment('Тип изображения'),
            ], $tableOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%gallary_images}}');
    }
}
