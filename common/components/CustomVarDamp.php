<?php
/**
 * Created by PhpStorm.
 * User: Mihail
 * Date: 27.08.2015
 * Time: 16:58
 */

namespace common\components;
use yii\helpers\BaseVarDumper;

class CustomVarDamp extends BaseVarDumper  {

    public static function dumpAndDie($var, $depth = 10, $highlight = false)
    {
        echo "<pre>";
        echo static::dumpAsString($var, $depth, $highlight);
        echo "</pre>";
        die;
    }
}