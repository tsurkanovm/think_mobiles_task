<?php

namespace app\models;

use common\components\CustomVarDamp;
use common\models\Interest;
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
            [['id_user', 'id_interest'], 'required', 'enableClientValidation' => false],
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
            'id_interest' => 'Интересы',
        ];
    }

    /**
     * @param integer - $id_user user id for whom will be get interests
     * @param bool - $with_title - if true - result array will be has as value - title from Interest table, otherwise - id_interest
     * @return array of user interest
     */
    public static function getUserInterest($id_user, $with_title = false)
    {
        $models_arr = self::find(['id_user' => $id_user])->asArray()->all();
        $result_array = array_column($models_arr, 'id_interest');
        // for with_title mode - replace id to title from Interest model
        if ( $with_title ) {
            // get all interests
            $all_interest_arr = Interest::getInterestAsArray();
            $result_array = array_map( function($value) use ($all_interest_arr) {
                if ( empty( $all_interest_arr[$value] ) ) {
                    // it's almost impossible, anyway handle this situation
                    return '';
                }else{
                    return $all_interest_arr[$value];
                }
            }, $result_array );
        }

        return $result_array;

    }

    /**
     * update values - existing items - delete, new ones - inserts
     * @throws \Exception
     */
    public function updateInterests(){

        // get exist interests from db
        $exist_interests_arr = self::getUserInterest( $this->id_user );
        // get interests  - that user choose (if user didn't choose anything - get empty array)
        $chosen_interests_arr = is_array( $this->id_interest ) ? $this->id_interest : array();

        // get interests that was choose but not exist in db
        $new_interests_arr = array_diff($chosen_interests_arr, $exist_interests_arr);

        // get interests that will be deleted, since user has unchecked them
        $old_interests_arr = array_diff($exist_interests_arr, $chosen_interests_arr);

        // delete old interests
        $this->deleteAll( ['id_user' => $this->id_user, 'id_interest' => $old_interests_arr] );

        // add new ones
        foreach ( $new_interests_arr as $item ) {
            $this->setOldAttributes( null );
            $this->id_interest = $item;
            $this->insert();
        }


    }

}
