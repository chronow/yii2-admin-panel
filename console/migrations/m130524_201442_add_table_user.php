<?php

use yii\db\Migration;

class m130524_201442_add_table_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $table = 'user';
        if ($this->db->getTableSchema($table, true) === null) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'name' => $this->string()->defaultValue(null),
                'job_title' => $this->string()->defaultValue(null),
                'auth_key' => $this->string(32)->defaultValue(null),
                'password_hash' => $this->string()->defaultValue(null),
                'password_reset_token' => $this->string()->unique(),
                'verification_token' => $this->string()->defaultValue(null),
                'email' => $this->string()->notNull()->unique(),
                'phone' => $this->string()->defaultValue(null),
                'comment' => $this->text()->defaultValue(null),
                'status' => $this->smallInteger()->notNull()->defaultValue(10),
                'type' => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);

            $this->insert($table, [
                'username' => 'admin',
                'name' => 'Евгений',
                'job_title' => 'Web Developer',
                'auth_key' => 'SnxgK_fjsU17Ny7DrKv681hGeiFJXv9l',
                'password_hash' => '$2y$13$Wc0Ai6WOCHqetxjo7Rg/9ud1wM1Dcgx4rfxnVlGCEdk3a15XZX.Ke',
                'password_reset_token' => NULL,
                'email' => 'web_script@mail.ru',
                'phone' => '',
                'comment' => NULL,
                'status' => 10,
                'type' => 10,
                'created_at' => time(),
                'updated_at' => 0,
            ]);
        }
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
