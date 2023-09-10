<?php

namespace backend\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

class GalleryImages extends \yii\db\ActiveRecord
{
    public $imageFiles;
    public $dirRoot = '';
    public $nameController = '';
    public static $fileAttributes = 0755;
    public static $mainFolder = 'uploads';
    public static $folder = 'attachments';

    const TYPE_SQUARE  = 1;
    const TYPE_RECTANGLE = 2;

    public function __construct()
    {
        $this->dirRoot = self::getDirRoot();
        $this->nameController = static::getNameController();
    }

    /**
     * Путь к папке с изображением
     * (чаще всего для проверки наличия файла)
     * @return bool|string|string[]
     */
    public static function getDirRoot($path = null)
    {
        return str_replace('frontend', 'frontend/web', Yii::getAlias('@frontend')) . $path;
    }

    /**
     * @return string
     */
    static public function getNameController()
    {
        return Yii::$app->controller->id;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallary_images';
    }

    public function rules()
    {
        return [
            [['is_main'], 'boolean'],
            [['marker', 'title', 'description', 'original', 'resize1', 'resize2', 'resize3'], 'string'],
            [['marker', 'title', 'original', 'resize1', 'resize2', 'resize3'], 'default', 'value' => null],
            [['id_model', 'order_image', 'type'], 'integer'],
            [['id_model', 'order_image', 'type'], 'default', 'value' => 0],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 100, 'checkExtensionByMimeType' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_main' => 'Главное изображение',
            'id_model' => 'Id записи',
            'marker' => 'Маркер (контроллер)',
            'title' => 'Подпись изображения',
            'description' => 'Описание',
            'original' => 'Путь к оригиналу',
            'resize1' => 'Путь к обрезке',
            'resize2' => 'Путь к обрезке',
            'resize3' => 'Путь к обрезке',
            'order_image' => 'Порядок вывода',
            'imageFiles' => 'Изображение (jpg, png)',
            'type' => 'Тип изображения', //0 - галерея, 1 - для отображения обложки квадрат, 2 - для отображения обложки прямоугольник
        ];
    }

    /**
     * Загрузка изображениЙ
     * @param int $id
     * @return array|false
     */
    public function getUploads($id = 0)
    {
        if ($this->imageFiles) {
            $folder = static::$folder;
            $mainFolder = static::$mainFolder;
            foreach ($this->imageFiles as $key => $file) {
                if ($id == 0) {
                    $img = "/{$mainFolder}/" . uniqid() . rand(0, 1000) . '.' . $file->extension;
                } else {
                    $dir = "{$this->dirRoot}/{$mainFolder}/{$folder}/{$this->nameController}/{$id}/original/";
                    if (!is_dir($dir) && mkdir($dir, self::$fileAttributes, true) && !is_dir($dir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
                    };

                    $img = "/{$mainFolder}/{$folder}/{$this->nameController}/{$id}/original/" . uniqid() . rand(0, 1000) . '.' . $file->extension;
                }
                $path = $this->dirRoot . $img;

                $file->saveAs($path);
                $mas[] = $img;
            }
            return $mas;
        }
        Yii::$app->session->setFlash('danger', $this->errors['imageFiles']);
        return false;
    }

    /**
     * Обрезка изображений по id
     * @param $id
     * @return bool
     */
    public function getImagineBox($id)
    {
        $model = $this->findOne($id);
        if (!file_exists($this->dirRoot . $model->original)) {
            Yii::$app->session->setFlash('danger', 'Файла не существует<br/>' . $model->original);
            return false;
        }
        $model->resize1 = self::getThumbnail($model, ['width' => 600, 'height' => 600, 'type' => 'thumbnail']);
        $model->resize2 = self::getThumbnail($model, ['width' => 500, 'height' => 500, 'type' => 'thumbnail']);
        $model->resize3 = self::getThumbnail($model, ['width' => 360, 'height' => 360, 'type' => 'thumbnail']);

        $model->save();
        //$model->getChoiceMain($model->id);
        return true;
    }

    /**
     * @param $model
     * @param $param
     * @return string
     */
    public function getThumbnail($model, $param)
    {
        $FileName = "/" . basename($model->original);
        $pathOriginal = $this->dirRoot . $model->original;
        $mainFolder = static::$mainFolder;
        $folder = static::$folder;
        $pathToFolder = "{$this->dirRoot}/{$mainFolder}/{$folder}/{$this->nameController}/{$model->id_model}";
        if (!is_dir($pathToFolder)) mkdir($pathToFolder, self::$fileAttributes, true);

        $url = "/{$mainFolder}/{$folder}/{$this->nameController}/{$model->id_model}/{$param['width']}x{$param['height']}";
        $dir = $this->dirRoot . $url;
        $path = $this->dirRoot . $url . $FileName;

        if (!is_dir($dir)) mkdir($dir, self::$fileAttributes, true);

        if (isset($param['type']) && $param['type'] == 'thumbnail') {
            Image::thumbnail($pathOriginal, $param['width'], $param['height'])->save($path, ['quality' => 82]);
        } else {
            Image::getImagine()->open($pathOriginal)->thumbnail(new Box($param['width'], $param['height']))->save($path, ['quality' => 85]);
        }
        return $url . $FileName;
    }

    /**
     * Размер изображения
     * @param $path
     * @return false|string
     */
    public static function getImageSize($path)
    {
        if ($path != '') {
            $path = Yii::getAlias(static::getDirRoot() . $path);
            if (file_exists($path)) {
                $fileSize = getimagesize($path);
                return $fileSize[0] . 'x' . $fileSize[1];
            }
        }
        return false;
    }

    /**
     * Вес изображения
     * @param $path
     * @return false|string
     */
    public static function getFileSize($path)
    {
        if ($path != '') {
            $path = Yii::getAlias(static::getDirRoot() . $path);
            if (file_exists($path)) {
                $fileSize = filesize($path);
                return Yii::$app->formatter->asShortSize($fileSize, 2);
            }
        }
        return false;
    }

    /**
     * Присваиваем изображению статус главного
     * (в случае отсутствия такого статуса у других)
     * @param $id
     * @return bool
     */
    public static function getChoiceMain($id)
    {
        $model = self::findOne($id);
        if ($model) {
            $is_main = self::findOne(['id_model' => $model->id_model, 'marker' => $model->marker, 'is_main' => 1]);
            if (!$is_main) {
                $model->is_main = 1;
                $model->save();
                return true;
            }
        }
        return false;
    }

    /**
     * Удаляет файлы одной записи
     * @param $id
     * @return bool
     */
    public static function getDeleteOne($id)
    {
        $item = self::findOne($id);
        if ($item) {
            self::getDeleteFile($item->original);
            self::getDeleteEmptyFolder($item->original);

            self::getDeleteFile($item->resize1);
            self::getDeleteEmptyFolder($item->resize1);

            self::getDeleteFile($item->resize2);
            self::getDeleteEmptyFolder($item->resize2);

            self::getDeleteFile($item->resize3);
            self::getDeleteEmptyFolder($item->resize3);

            $mainFolder = static::$mainFolder;
            $folder = static::$folder;
            $nameController = static::getNameController();
            $folder = "/{$mainFolder}/{$folder}/{$nameController}/{$item->id_model}/";
            self::getDeleteEmptyFolder($folder);
            return true;
        }
        return false;
    }

    /**
     * Удаляет все файлы
     * @param $id
     * @return bool
     */
    public static function getDeleteAll($id)
    {
        $model = self::find()->where(['id_model' => $id, 'marker' => static::getNameController()])->all();

        if ($model) {
            foreach ($model as $item) {
                self::getDeleteFile($item->original);
                self::getDeleteEmptyFolder($item->original);

                self::getDeleteFile($item->resize1);
                self::getDeleteEmptyFolder($item->resize1);

                self::getDeleteFile($item->resize2);
                self::getDeleteEmptyFolder($item->resize2);

                self::getDeleteFile($item->resize3);
                self::getDeleteEmptyFolder($item->resize3);

                $mainFolder = static::$mainFolder;
                $folder = static::$folder;
                $nameController = static::getNameController();
                $folder = "/{$mainFolder}/{$folder}/{$nameController}/{$item->id_model}/";
                self::getDeleteEmptyFolder($folder);
                $item->delete();
            }
            return true;
        }
        return false;
    }

    /**
     * Удаляет файл
     * @param $path
     * @return bool
     */
    public static function getDeleteFile($path)
    {
        if ($path != '') {
            $path = Yii::getAlias(self::getDirRoot() . $path);
            return (file_exists($path)) ? unlink($path) : false;
        }
        return false;
    }

    /**
     * Удаляет пустую дирректорию
     * @param $path
     * @return bool
     */
    public static function getDeleteEmptyFolder($path)
    {
        $path = Yii::getAlias(self::getDirRoot() . $path);
        if (is_dir($path)) {
            return (!glob($path . '/*')) ? rmdir($path) : false;
        } else {
            $path = pathinfo($path)['dirname'];
            if (is_dir($path)) return (!glob($path . '/*')) ? rmdir($path) : false;
        }
        return false;
    }

    /**
     * Получаем главное изображение
     * @param null $marker
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getMain($marker = null)
    {
        $marker = $marker ?? static::getNameController();
        return self::find()->where(['marker' => $marker, 'is_main' => 1])->one();
    }

    /**
     * Проверка файла на существование
     * @param null $path
     * @return bool
     */
    public static function getFileEx($path = null)
    {
        return (!empty($path)) ? file_exists(self::getDirRoot($path)) : false;
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        self::getDeleteOne($this->id);
        return parent::beforeDelete();
    }

    /**
     * Соединяем карточку и текст
     * @param int $cid
     * @param null $string
     * @return string
     */
    public function getСombinationImageText($cid=0, $string=null)
    {
        mb_internal_encoding("UTF-8");

        if ($this->type == self::TYPE_SQUARE) {
            $FileName = "/0.png";//картинка 1023x1023
            $halfHeight = 511;
            $halfWidth = 860;
            $width = 1023;
        } elseif ($this->type == self::TYPE_RECTANGLE) {
            $FileName = "/000.png";//картинка 1024x512
            $halfHeight = 256;
            $halfWidth = 450;
            $width = 1024;
        }

        $FileFinishName = "/" . $cid . ".png";
        $pathOriginal = $this->dirRoot . '/img' . $FileName;

        $mainFolder = static::$mainFolder;
        $folder = static::$folder;
        $pathToFolder = "{$this->dirRoot}/{$mainFolder}/{$folder}/{$this->nameController}/{$this->id_model}";
        if (!is_dir($pathToFolder)) mkdir($pathToFolder, self::$fileAttributes, true);

        if ($this->type == self::TYPE_SQUARE) {
            $url = "/{$mainFolder}/{$folder}/{$this->nameController}/users/1023x1023";
        } elseif ($this->type == self::TYPE_RECTANGLE) {
            $url = "/{$mainFolder}/{$folder}/{$this->nameController}/users/1024x512";
        }

        $dir = $this->dirRoot . $url;
        $path = $this->dirRoot . $url . $FileFinishName;

        if (!is_dir($dir)) mkdir($dir, self::$fileAttributes, true);

        //Сохраняем картинку
        $image = Image::getImagine()->open($pathOriginal)->thumbnail(new Box(1023, 1023))->save($path);

        $y=0; //Символов в строке
        $row=1; //Строка
        $text = ''; //Весь текст
        $str = ''; //Текст в строке
        $maxLetterRow = 0;
        $space = 0;

        $string = $this->title ?? $string ?? '';
        $string = mb_strtoupper($string, "utf-8");
        $stringLength = mb_strlen(urldecode($string));

        if (strlen($string) >= 99) {
            $fontSize = 26;
            $letterWidth = 24;
            $letterHeight = 20;
        } elseif (strlen($string) >= 50) {
            $fontSize = 36;
            $letterWidth = 34;
            $letterHeight = 25;
        } elseif ($stringLength >= 20) {
            $fontSize = 45;
            $letterWidth = 44;
            $letterHeight = 25;
        } else {
            $fontSize = 46;
            $letterWidth = 45;
            $letterHeight = 30;
        }

        $countLetterInRow = floor($halfWidth/$letterWidth);

        for ($i=0; $i<$stringLength; $i++) {
            if (mb_substr($string, $i, 1) == ' ' && $y==1 ) continue;

            $strLength = mb_strlen( urldecode($str) );
            $text .= mb_substr($string, $i, 1);
            $str .= mb_substr($string, $i, 1);

            if ($y >= $countLetterInRow-2) {

                if (($strLength * $letterWidth) >= $halfWidth || mb_substr($string, $i, 1) == ' '){

                    $space = floor(floor($halfWidth - ($strLength * $letterWidth)) / $letterWidth / 2);
                    $space = ($space<0) ? 0 : $space;
                    $textRow[$row]['row'] = $str;
                    $textRow[$row]['countLetter'] = $strLength;
                    $textRow[$row]['countSpace'] = $space;

                    $text .= "\n";
                    $y = 0;
                    $maxLetterRow = ($maxLetterRow < $strLength) ? $strLength : $maxLetterRow ;
                    $str = '';
                    $row++;
                }
            }
            $y++;
            $m[] = mb_substr($string, $i, 1);

            if ($str != '') {
                $space = floor(floor($halfWidth - ($strLength * $letterWidth)) / $letterWidth / 2);
                $space = ($space<0) ? 0 : $space;
                $textRow[$row]['row'] = $str;
                $textRow[$row]['countLetter'] = $strLength;
                $textRow[$row]['countSpace'] = $space;
            }
        }

        $textAlignCenter='';
        if ($textRow) foreach ($textRow as $key => $byRow) {
            $sp='';
            for($ll=0; $ll<=$byRow['countSpace']; $ll++) $sp .="  ";
            $textAlignCenter .= $sp . $byRow['row'] . "\n";
        }

        if ($maxLetterRow == 0) $maxLetterRow = $stringLength;
        if ($maxLetterRow > floor($halfWidth/$letterWidth)) $maxLetterRow = floor($halfWidth/$letterWidth);

        $osY = $halfHeight - $letterHeight * $row;
        $osX = ($this->type == self::TYPE_SQUARE) ? floor(($width - $maxLetterRow * $letterWidth)/2) : 500 + floor(($halfWidth - $maxLetterRow * $letterWidth)/2);

        $fontOptions = [
            'size'  => $fontSize,    // Размер шрифта
            'color' => 'FFF', // цвет шрифта
        ];

        $fontFile = Yii::getAlias('@webroot/fonts/CenturyGothic/CenturyGothic-Bold.ttf');
        $img = Image::text($pathOriginal, $text, $fontFile, [$osX, $osY], $fontOptions);
        $img->save($path);

        return $url . $FileFinishName;
    }

    /**
     * Загрузка изображениЙ по ссылке
     * @param int $id
     * @return array|false
     */
    public function getUploadUrl($id = 0)
    {
        if ($this->imageFiles) {
            $folder = static::$folder;
            $mainFolder = static::$mainFolder;
            foreach ($this->imageFiles as $key => $file) {

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $file);
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($curl);
                curl_close($curl);

                if (strlen($response) < 300) continue;

                $extension = pathinfo($file, PATHINFO_EXTENSION);

                if ($id == 0) {
                    $img = "/{$mainFolder}/" . uniqid() . rand(0, 1000) . '.' . $extension;
                } else {
                    $dir = "{$this->dirRoot}/{$mainFolder}/{$folder}/{$this->nameController}/{$id}/original/";
                    if (!is_dir($dir) && mkdir($dir, self::$fileAttributes, true) && !is_dir($dir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
                    };

                    $img = "/{$mainFolder}/{$folder}/{$this->nameController}/{$id}/original/" . uniqid() . rand(0, 1000) . '.' . $extension;
                }
                $path = $this->dirRoot . $img;

                file_put_contents($path, $response);
                $mas[] = $img;
            }
            return $mas ?? [];
        }
        Yii::$app->session->setFlash('danger', 'Произошла ошибка скачивания');
        return false;
    }

    /**
     * Оптимизация изображения по переданному пути
     * @param $path
     * @return bool
     */
    static function getImagineResize($path, $quality = 75)
    {
        if (!empty($path)) {
            $absPath = self::getDirRoot() . $path;
            list($width, $height) = getimagesize(Yii::getAlias($absPath));
            $image = Image::getImagine()->open($absPath);
            $image->resize(new Box($width, $height))->save($absPath, ['quality' => $quality]);
            return $path;
        }
        return false;
    }

    /**
     * Поворот изображения
     * @param $pathOriginal
     * @param $path
     */
    public static function getRotate($pathOriginal, $path)
    {
        $image = Image::getImagine()->open(static::getDirRoot() . $path);
        $exif = @exif_read_data(static::getDirRoot() . $pathOriginal);
        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $image->rotate(180);
                    break;
                case 6:
                    $image->rotate(90);
                    break;
                case 8:
                    $image->rotate(-90);
                    break;
            }
        }
        $image->save(static::getDirRoot() . $path, ['quality' => 80]);
    }
}