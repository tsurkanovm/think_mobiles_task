<?php

namespace app\models;

use common\components\CustomVarDamp;
use Yii;

/**
 * This is the model class for table "user_interest".
 *
 * @property integer $id_user
 * @property integer $id_interest
 *
 * @property Interest $idInterest
 * @property User $idUser
 */
class UserInterest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_interest'], 'required'],
            [['id_user', 'id_interest'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_interest' => 'Id Interest',
        ];
    }

    /**
     * @param integer - $id_user user id for whom will be get interests
     * @return array of user interest (as value - id_interest)
     */
    public static function getUserInterest($id_user)
    {
        $models_arr = self::find(['id_user' => $id_user])->asArray()->all();
        $result_array = array_column($models_arr, 'id_interest');

        return $result_array;

    }
}
