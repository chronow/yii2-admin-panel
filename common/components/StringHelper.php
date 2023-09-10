<?php

namespace common\components;

use Yii;

class StringHelper extends \yii\base\Component
{
    private $limit;

    public function __construct()
    {
        $this->limit = Yii::$app->params['shortTextLimit'] ?? 255;
    }

    /**
     * @param $string
     * @param null $limit
     * @param string $dot
     * @return false|string
     */
    public function getShort($string, $limit = null, $dot = '...')
    {
        if ($limit === null) $limit = $this->limit;
        if (!empty($string)) {
            $string = strip_tags($string);
            $string = rtrim($string, "!,.-");
            return (strlen($string) > $limit) ? substr($string, 0, $limit) . $dot : $string;
        }
        return false;
    }

    /**
     * Обрезка по словам
     * @param $string
     * @param string $limit
     * @param string $dot
     * @return string
     */
    public function do_excerpt($string, $limit = 15, $dot = '...') {
        $words = explode(' ', $string, ($limit + 1));
        if (count($words) > $limit) array_pop($words);
        return implode(' ', $words) . $dot;
    }
}