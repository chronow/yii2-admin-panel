<?php

namespace common\models;

use backend\models\GalleryImages;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contents".
 *
 * @property int $id
 * @property int $id_contents_category Категория
 * @property string $url Url / Чпу
 * @property string $title Название
 * @property string $description Краткое описание
 * @property string $keywords Ключевые слова / метки (через запятую)
 * @property string $text Полное описание / текст
 * @property int $byOrder Порядок вывода
 */
class Contents extends \yii\db\ActiveRecord
{
    public $mainImage;
    public $imageFiles;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contents';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_DELETE => ['deleted_at'],
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
            [['id_contents_category', 'byOrder', 'id_content', 'created_at', 'updated_at', 'deleted_at', 'isPublic'], 'integer'],
            [['id_contents_category', 'byOrder', 'id_content', 'created_at', 'updated_at', 'deleted_at', 'isPublic'], 'default', 'value' => 0],
            [['description', 'text', 'annotation', 'key'], 'string'],
            ['published', 'safe'],
            [['url', 'title', 'keywords', 'key'], 'string', 'max' => 255],
            [['title', 'id_contents_category'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Ключ / артикул (необяз.)',
            'id_contents_category' => 'Категория',
            'url' => 'Чпу / url',
            'title' => 'Название / title',
            'description' => 'Краткое описание / description',
            'keywords' => 'Ключевые слова / keywords',
            'annotation' => 'Аннотация',
            'text' => 'Основной текст',
            'id_content' => 'Связь с записью',
            'byOrder' => 'Порядок вывода',
            'mainImage' => 'Главная обложка',
            'imageFiles' => 'Выберите файлы галереи',
            'published' => 'Дата публикации',
            'isPublic' => 'Опубликовано',
        ];
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        ContentsList::deleteAll(['id_contents' => $this->id]);
        GalleryImages::getDeleteAll($this->id);
        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentsCategory()
    {
        return $this->hasOne(ContentsCategory::class, ['id' => 'id_contents_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(ContentsCategory::class, ['id' => 'id_contents_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(GalleryImages::class, ['id_model' => 'id'])->andWhere(['is_main' => 1]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasMany(GalleryImages::class, ['id_model' => 'id'])->andWhere(['is_main' => 0]);
    }
}
