<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Self_;
use Yii;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property int $tabsType
 * @property string|null $group
 * @property string|null $key
 * @property string|null $name
 * @property string|null $type
 * @property string|null $value
 * @property int|null $byOrder
 */
class Config extends \yii\db\ActiveRecord
{
    public $file;

    const TYPE_DEFAULT = 0;
    const TYPE_MAILING = 5;
    const TYPE_SOCIAL = 10;
    const TYPE_CONTACT = 15;
   // const TYPE_TG = 35;

    public static $type = [
        self::TYPE_DEFAULT => 'Файлы / ссылки / документы',
        self::TYPE_MAILING => 'Отправка почты',
        self::TYPE_SOCIAL => 'Соц.сети',
        self::TYPE_CONTACT => 'Контакты',
        //self::TYPE_TG => 'Telegram',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'value'], 'string'],
            [['byOrder', 'tabsType'], 'integer'],
            [['byOrder', 'tabsType'], 'default', 'value' => 0],
            [['group', 'key', 'name'], 'string', 'max' => 255],
            [['file'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, webp, pdf',
                'mimeTypes' => 'image/png, image/jpeg, image/webp, application/pdf',
                'checkExtensionByMimeType' => true,
                'message' => 'Вы можете загрузить файл только определенного типа: png, jpg, jpeg, webp, pdf',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tabsType' => 'Вкладка',
            'group' => 'Группа',
            'key' => 'Ключ',
            'name' => 'Название',
            'type' => 'Тип',
            'value' => 'Значение',
            'byOrder' => 'Сортировка',
            'file' => 'Выберите файл',
        ];
    }

    /**
     * Загрузка
     * @param int $id
     * @return array|false
     */
    public function getUpload($id)
    {
        if ($file = $this->file) {
            $dirRoot = Yii::getAlias('@frontend');
            $nameController = '';//Yii::$app->controller->id;
            $folder = '';
            $mainFolder = 'uploads';
            if (!empty($file)) {
                $dir = "{$dirRoot}/{$mainFolder}/{$folder}/{$nameController}/{$id}/";
                $dir = str_replace(['///', '//'], '/', $dir);
                if (!is_dir($dir) && mkdir($dir, 0755, true) && !is_dir($dir)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
                }
                $img = "/{$mainFolder}/{$folder}/{$nameController}/{$id}/" . time() . '.' . $file->extension;
                $img = str_replace(['///', '//'], '/', $img);
                $path = $dirRoot . $img;
                $path = str_replace(['///', '//'], '/', $path);
                $file->saveAs($path);
                return $img;
            }
        }
        return false;
    }

    /**
     * Удаляет файл
     * @param $path
     * @return bool
     */
    public function getDeleteFile()
    {
        if (!empty($this->value)) {
            $path = Yii::getAlias('@frontend' . $this->value);
            return (file_exists($path)) ? unlink($path) : false;
        }
        return false;
    }
}
