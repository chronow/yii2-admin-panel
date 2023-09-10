<?php

namespace common\models;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property string $fio ФИО / Имя
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $text Сообщение
 * @property int $status Статус
 * @property int $created_at Время создания
 * @property int $updated_at Время обновления
 */
class Notifications extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status', 'object_id'], 'integer'],
            //['fio', 'required', 'message' => 'Укажите имя'],
            ['phone', 'required', 'message' => 'Укажите телефон'],
            //['email', 'required', 'message' => 'Укажите email'],
            [['email'], 'email', 'message' => 'Неверный email'],

            [['text', 'refLink'], 'string'],
            [['created_at', 'updated_at', 'status', 'object_id'], 'default', 'value' => 0],
            [['fio', 'phone', 'email', 'refTitle'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО / Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'text' => 'Сообщение',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'status' => 'Статус',
            'refTitle' => 'Обратный заголовок',
            'refLink' => 'Обратная ссылка',
            'object_id' => 'Присланно на',
        ];
    }

    /**
     * Статус
     * @param null $id
     * @return string|string[]
     */
    public static function getStatus($id = null)
    {
        $array = [
            0 => 'Новое сообщение',
            1 => 'Прочитано',
            2 => 'Обработанно',
        ];
        if ($id !== null) return $array[intval($id)];
        return $array;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        if (empty($email)) return false;

        $html = 'Имя: '.$this->fio;
        $html .= ' Телефон: '.$this->phone;
        $html .= ' Email: '.$this->email;
        return Yii::$app->config->initMailer()->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->config->email_from => $this->fio])
            ->setSubject('Уведомление с сайта')
            ->setTextBody($html)
            ->send();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasOne(Objects::class, ['id' => 'object_id']);
    }

    /**
     * @return string
     */
    public function  getObjectsName()
    {
        $objects = $this->objects;
        return $objects ? $objects->name : '';
    }
}
