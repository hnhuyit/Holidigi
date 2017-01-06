<?php

namespace backend\controllers;

use Yii;
use common\models\Agency;
use common\models\Plan;
use common\models\Website;
use common\models\User;
use common\models\Bill;
use common\models\AgencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgencyController implements the CRUD actions for Agency model.
 */
class AgencyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Agency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agency model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // set token
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Creates a new Agency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agency();
        $model->status = 1;
        
        //list plan is agency
        $planModel = new Plan();
        $plans = $planModel->getListPlan('agency');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->token = $this->generateRandomString(30);
            $model->create_by = Yii::$app->user->id;
            if($model->save()){

                //$this->createNewAgencyWebsite(Yii::$app->request->post(), $model->id);
                //$this->createNewAgencyBill(Yii::$app->request->post(), $model->id);
                $this->createNewAgencyUser(Yii::$app->request->post(), $model->id);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'plans' => $plans,
            ]);
        }
    }
    // public function createNewAgencyWebsite($params, $agencyId){
    //     $data['Website'] = $params['Agency']; 
    //     $model = new Website();
    //     if ($model->load($data)) {

    //         $model->status = 1;
    //         $model->agency_id = $agencyId;
    //         $model->create_by = \Yii::$app->user->id;
            
    //         if($model->save()) {
    //             /// Do something if My account created successfully
                
    //         }
    //     }
    // }

    // create bill for Agency
    // public function createNewAgencyBill($params, $agencyId){
    //     $data['User'] = $params['Agency']; 
    //     $model = new User();
    //     if ($model->load($data)) {

    //         $model->is_supper = 0;
    //         $model->is_owner = 1;

    //         if($model->password_hash == ""){
    //             $model->password_hash = rand(000000000, 99999999);
    //         }

    //         $password = $model->password_hash;

    //         $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);

    //         $model->status = 1;
    //         $model->generateAuthKey();
    //         $model->agency_id = $agencyId;
    //         $model->create_by = Yii::$app->user->id;
    //         $model->role = 'Agency';
    //         if($model->save()) {
    //             /// Do something if My account created successfully
                
    //         }
    //     }
    // }

    // create user is agency
    public function createNewAgencyUser($params, $agencyId){
        $data['User'] = $params['Agency']; 
        $model = new User();
        if ($model->load($data)) {

            $model->is_supper = 0;
            $model->is_owner = 1;

            if($model->password_hash == ""){
                $model->password_hash = rand(000000000, 99999999);
            }

            $password = $model->password_hash;

            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);

            $model->status = 1;
            $model->generateAuthKey();
            $model->agency_id = $agencyId;
            $model->create_by = Yii::$app->user->id;
            $model->role = 'Agency';
            if($model->save()) {
                /// Do something if My account created successfully
                
            }
        }
    }

    /**
     * Updates an existing Agency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //list plan is agency
        $planModel = new Plan();
        $plans = $planModel->getListPlan('agency');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'plans' => $plans,
            ]);
        }
    }

    /**
     * Deletes an existing Agency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Agency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
