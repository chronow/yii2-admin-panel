<?php

use yii\db\Migration;

/**
 * Class m230125_142344_add_table_config
 */
class m230125_142344_add_table_config extends Migration
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

                    ['Контакты', 'phone1', 'Телефон 1', 'string', '', 15, 0],
                    ['Контакты', 'phone2', 'Телефон 2', 'string', '', 15, 0],
                    ['Контакты', 'email1', 'Отображаемый Email 1', 'string', '', 15, 0],
                    ['Контакты', 'email2', 'Отображаемый Email 2', 'string', '', 15, 0],
                    ['Контакты', 'addres1', 'Адрес офиса', 'string', '', 15, 0],
                    ['Контакты', 'time_work', 'Время работы', 'string', '', 15, 0],

                    ['Exsel/Информация', 'check_number', '№ документа', 'string', 'C:1', 25, 0],
                    ['Exsel/Информация', 'check_date', 'Дата', 'string', 'C:2', 25, 0],
                    ['Exsel/Информация', 'provider_name', 'Поставщик', 'string', 'C:3', 25, 0],
                    ['Exsel/Информация', 'provider_inn', 'ИНН поставщика', 'string', 'C:4', 25, 0],
                    ['Exsel/Информация', 'recipient_name', 'Получатель', 'string', 'C:5', 25, 0],
                    ['Exsel/Информация', 'recipient_inn', 'ИНН получателя:', 'string', 'C:6', 25, 0],
                    ['Exsel/Информация', 'final_summ', 'Сумма документа без налога:', 'string', 'G:50', 25, 0],
                    ['Exsel/Информация', 'final_summ_nds', 'Сумма документа c налогом', 'string', 'K:50', 25, 0],

                    ['Exsel/Товары', 'tovar_pp', '№п/п', 'string', 'A:10', 25, 0],
                    ['Exsel/Товары', 'tovar_article', 'Код товара', 'string', 'B:10', 25, 0],
                    ['Exsel/Товары', 'tovar_name', 'Название товара', 'string', 'C:10', 25, 0],
                    ['Exsel/Товары', 'tovar_meit_name', 'Ед. измерения', 'string', 'D:10', 25, 0],
                    ['Exsel/Товары', 'tovar_volume', 'Кол-во/объем', 'string', 'E:10', 25, 0],
                    ['Exsel/Товары', 'tovar_price', 'Цена за ед.', 'string', 'F:10', 25, 0],
                    ['Exsel/Товары', 'tovar_all_price', 'Стоимость товаров без НДС (tovar_volume * tovar_price)', 'string', 'G:10', 25, 0],
                    ['Exsel/Товары', 'tovar_excise', 'Сумма акциза', 'string', 'H:10', 25, 0],
                    ['Exsel/Товары', 'tovar_tax_rate', 'Налоговая ставка', 'string', 'I:10', 25, 0],
                    ['Exsel/Товары', 'tovar_item_summ', 'Сумма налога, предъявляемая покупателю (tovar_all_price * tovar_tax_rate / 100)', 'string', 'J:10', 25, 0],
                    ['Exsel/Товары', 'tovar_all_summ_nds', 'Стоимость товаров с НДС (tovar_all_price + tovar_item_summ)', 'string', 'K:10', 25, 0],
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
