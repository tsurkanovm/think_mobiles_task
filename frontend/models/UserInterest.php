<?php

namespace app\models;

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
     * @return \yii\db\ActiveQuery
     */
    public function getIdInterest()
    {
        return $this->hasOne(Interest::className(), ['id' => 'id_interest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
