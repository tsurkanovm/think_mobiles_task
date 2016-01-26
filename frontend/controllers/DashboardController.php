<?php

namespace frontend\controllers;

use app\models\UserInterest;
use common\components\CustomVarDamp;
use common\models\Interest;
use Yii;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DashboardController implements the CRUD actions for User model.
 */
class DashboardController extends Controller
{
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex()
    {
        $id =  Yii::$app->user->identity->getId();
        $current_interests_arr = UserInterest::getUserInterest( $id, true );
        return $this->render('index', [
            'model' => $this->findModel($id),
            'current_interests_arr' => $current_interests_arr
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // find user model
        $model = $this->findModel($id);
        // create user interests model
        $user_interest_model = new UserInterest();
        $post_arr = Yii::$app->request->post();
        if ( $model->load( $post_arr ) && $user_interest_model->load( $post_arr ) && $model->save() ) {
            $user_interest_model->updateInterests();
            return $this->redirect(['index']);

        } else {
            // get whole array of interest (for making a choice in update view)
            $interest_arr = Interest::getInterestAsArray();
            // get array of interest that user already choose
            $checked_interest_arr = UserInterest::getUserInterest($id);
            // set chosen interest
            $user_interest_model->id_interest = $checked_interest_arr;
            $user_interest_model->id_user = $id;

            return $this->render('update', [
                'model' => $model,
                'user_interest_model' => $user_interest_model,
                'interest_arr' => $interest_arr,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
