<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contents_category".
 *
 * @property int $id
 * @property string $title Название
 * @property string $description Краткое описание
 * @property int $byOrder Порядок вывода
 */
class ContentsCategory extends \yii\db\ActiveRecord
{
    public $i;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contents_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'key', 'gr'], 'string'],
            [['byOrder', 'idParent', 'isFather', 'level', 'sorting'], 'integer'],
            [['byOrder', 'idParent', 'isFather', 'level', 'sorting'], 'default', 'value' => 0],
            ['title', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Ключ / артикул',
            'gr' => 'Группа',
            'title' => 'Название категории',
            'description' => 'Краткое описание',
            'byOrder' => 'Порядок вывода',
            'isPublic' => 'Опубликовано',
            'idParent' => 'ID родителя',
            'isFather' => 'Родитель',
            'level' => 'Уровень',
            'sorting' => 'Внутреняя сортировка',
        ];
    }

    /**
     * Сортируем и присваиваем все записи родителям
     * @return true
     */
    public function getCategorySort()
    {
        $table = ContentsCategory::find()->orderBy(['idParent' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();

        if ($table) {
            foreach ($table as $key => $value) {
                $mas[$value['idParent']][$value['byOrder']][$value['id']]['name'] = $value['title'];
                $mas[$value['idParent']][$value['byOrder']][$value['id']]['nom'] = 0;
                $mas[$value['idParent']][$value['byOrder']][$value['id']]['children'] = array();
            }
            //Сортируем по отцу от большего к меньшему
            krsort($mas);
            //Сортируем по byOrder от большего к меньшему
            foreach ($mas as $k1 => $v1) {
                krsort($mas[$k1]);
            }
            foreach ($mas as $k1 => $v1) {
                foreach ($v1 as $k2 => $v2) {
                    foreach ($v2 as $k3 => $v3) {
                        $mas2[$k1][$k3] = $v3;
                    }
                }
            }
            $mas = $mas2;
            unset($mas2);

            if ($mas) {
                foreach ($mas as $k => $v) {
                    foreach ($mas as $k1 => $v1) {
                        foreach ($v1 as $k2 => $v2) {
                            if ($k == $k2) {
                                $mas[$k1][$k2]['name'] = $v2['name'];
                                $mas[$k1][$k2]['children'] = $mas[$k];
                                unset($mas[$k]);
                            }
                        }
                    }
                }
            }
        }
        $mas = $this->categoryNomRec($mas[0]);
        return true;
    }

    /**
     * Рекурсия. Каждой записи присваиваем порядковый номер
     * @param $mas
     * @return array|mixed
     */
    public function categoryNomRec($mas = array())
    {
        if ($mas) {
            foreach ($mas as $key => $value) {
                $this->i++;
                $mas[$key]['nom'] = $this->i;
                $model = self::findOne($key);
                $model->sorting = $this->i;
                $model->save();
                if ($value['children']) $mas[$key]['children'] = self::categoryNomRec($value['children']);
            }
        }
        return $mas;
    }

    /**
     * Рекурсия. Обновляем уровень по id
     * @param int $id
     * @return bool
     */
    public static function getUpdateLevelRec($id = 0)
    {
        if ($id) {
            $children = ContentsCategory::find()->where(['idParent' => $id])->all();
            if ($children) {
                foreach ($children as $key => $value) {
                    $value->level = $value->level - 1;
                    $value->save();
                    if ($value->isFather) self::getUpdateLevelRec($value->id);
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Построение массива для выпадающего списка
     * @return array
     */
    public static function getDropDownList()
    {
        $array = ContentsCategory::find()->where(['isPublic' => 1])->asArray()->orderBy(['sorting'=>SORT_ASC, 'byOrder'=>SORT_DESC])->all();
        //$items[0] = 'Без категории';
        if ($array) foreach ($array as $key => $value) {
            $string = '';
            for ($i=0; $i < $value['level']; $i++) $string .= html_entity_decode('&emsp;');

            if ($value['isFather']) {
                $items[$value['id']] = $string . "[ " . $value['title'] . " ]";
            } else {
                $items[$value['id']] = $string . $value['title'];
            }
        }
        return $items ?? [];
    }

    /**
     * Получаем кол-во записей в категории
     * @param $id
     * @return int
     */
    public static function getCount($id)
    {
        return Contents::find()->where(['id_contents_category' => $id])->count();
    }
}
