<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "interest".
 *
 * @property integer $id
 * @property string $title
 */
class Interest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title'], 'required'],
            [['id'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['title'], 'unique']
        ];
    }

    /**
     * @return assoc array of interest (key - id, value - title)
     */
    public static function getInterestAsArray()
    {
        $models_arr = self::find()->asArray()->all();
        $result_array = ArrayHelper::map($models_arr, 'id', 'title');

        return $result_array;

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
}
