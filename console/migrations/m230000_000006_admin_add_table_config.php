<?php

use yii\db\Migration;

/**
 * Class m230000_000006_admin_add_table_config
 */
class m230000_000006_admin_add_table_config extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $table = 'config';
        if ($this->db->getTableSchema($table, true) === null) {
            $this->createTable($table, [
                'id' => $this->primaryKey(),
                'group' => $this->string()->defaultValue(null),
                'key' => $this->string()->defaultValue(null),
                'name' => $this->string()->defaultValue(null),
                'type' => $this->string()->defaultValue(null),
                'value' => $this->text()->defaultValue(null),
                'tabsType' => $this->smallInteger()->defaultValue(0),
                'byOrder' => $this->smallInteger()->defaultValue(100),
            ], $tableOptions);

            $this->batchInsert(
                $table,
                ['group', 'key', 'name', 'type', 'value', 'tabsType', 'byOrder'],
                [
                    ['Файлы', 'file_rulles_1', 'Правила', 'file', '', 0, 0],
                    ['Файлы', 'file_agreements_1', 'Соглашения', 'file', '', 0, 0],
                    ['Файлы', 'file_policy_1', 'Политика конфиденциальности', 'file', '', 0, 0],

                    ['Email', 'sitename', 'Sitename', 'string', '', 5, 0],
                    ['Email', 'email_from', 'Email From', 'string', '', 5, 0],
                    ['Email', 'email_to', 'Email To', 'string', '', 5, 0],

                    ['SMTP', 'use_smtp', 'Использовать SMTP', 'boolean', '', 5, 0],
                    ['SMTP', 'smtp_server', 'Сервер SMTP', 'string', '', 5, 0],
                    ['SMTP', 'smtp_login', 'Логин SMTP', 'string', '', 5, 0],
                    ['SMTP', 'smtp_pass', 'Пароль SMTP', 'password', '', 5, 0],
                    ['SMTP', 'smtp_secure', 'Использовать SSL', 'boolean', '', 5, 0],
                    ['SMTP', 'smtp_port', 'Порт SSL (по-умолчанию 465)', 'number', '', 5, 0],

                    ['Open Graph', 'op_site_name', 'Название сайта (site name)', 'string', '', 10, 0],
                    ['Open Graph', 'op_url', 'Ссылка (url)', 'string', '', 10, 0],
                    ['Open Graph', 'op_title', 'Заголовок (title)', 'string', '', 10, 0],
                    ['Open Graph', 'op_description', 'Описание (description)', 'string', '', 10, 0],
                    ['Open Graph', 'op_image', 'Изображение (image)', 'file', '', 10, 0],
                    ['Telegram', 'telegram_url', 'Telegram ссылка', 'string', '', 10, 0],
                    ['Viber', 'viber_url', 'Viber ссылка', 'string', '', 10, 0],
                    ['Whatsapp', 'whatsapp_url', 'Whatsapp ссылка', 'string', '', 10, 0],
                    ['Youtube', 'youtube_url', 'Youtube ссылка', 'string', '', 10, 0],
                    ['Вконтакте', 'vk_url', 'Вконтакте ссылка', 'string', '', 10, 0],
                    ['Вконтакте', 'vk_image', 'Вконтакте картинка', 'file', '', 10, 0],
                    ['Вконтакте', 'vk_text', 'Вконтакте текст', 'string', '', 10, 0],
                    ['Одноклассники', 'ok_url', 'Одноклассники ссылка', 'string', '', 10, 0],
                    ['Одноклассники', 'ok_image', 'Одноклассники картинка', 'file', '', 10, 0],
                    ['Одноклассники', 'ok_text', 'Одноклассники текст', 'string', '', 10, 0],

                    ['Контакты', 'phone1', 'Телефон 1', 'string', '', 15, 0],
                    ['Контакты', 'phone2', 'Телефон 2', 'string', '', 15, 0],
                    ['Контакты', 'email1', 'Отображаемый Email 1', 'string', '', 15, 0],
                    ['Контакты', 'email2', 'Отображаемый Email 2', 'string', '', 15, 0],
                    ['Контакты', 'addres1', 'Адрес офиса', 'string', '', 15, 0],
                    ['Контакты', 'time_work', 'Время работы', 'string', '', 15, 0],
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%config}}');
    }
}
