<?php

namespace frontend\controllers;

use Yii;
use common\models\SiteOwner;
use common\models\Website;
use common\models\Plan;
use common\models\User;
use common\models\SiteOwnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

/**
 * SiteOwnerController implements the CRUD actions for SiteOwner model.
 */
class SiteOwnerController extends Controller
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
                        'actions' => ['create', 'index', 'info', 'updateinfo'],
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
     * Lists all SiteOwner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteOwnerSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => SiteOwner::find()->andFilterWhere(['=', 'create_by', Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'agency_id'     => Yii::$app->user->identity->agency_id,
        ]);
    }

    /**
     * Displays a single SiteOwner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single SiteOwner model.
     * @param integer $id
     * @return mixed
     */
    public function actionInfo()
    {
        return $this->render('info', [
            'model' => $this->findModel(Yii::$app->user->identity->site_owner_id),
        ]);
    }

    /**
     * Creates a new SiteOwner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SiteOwner();
        $model->status = 1;

        //list plan is agency
        $planModel = new Plan();
        $plans = $planModel->getListPlan('site owner', Yii::$app->user->identity->agency_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->create_by = Yii::$app->user->id;
            $model->agency_id = Yii::$app->user->identity->agency_id;            
            if($model->save()) {

                $this->createWebsiteSO($model);
                $this->createUserSO(Yii::$app->request->post(), $model->id);

                return $this->redirect(['index']);
            }
                
        } else {
            return $this->render('create', [
                'model' => $model,
                'plans' => $plans,
            ]);
        }
    }
    ///Create website for SiteOwner
    public function createWebsiteSO($model) {
        $websiteModel = new Website();
        $websiteModel->name = $model->website;
        $websiteModel->des = $model->website;
        $websiteModel->status = 1;
        $websiteModel->create_by = \Yii::$app->user->id;
        $websiteModel->site_owner_id = $model->id;
        $websiteModel->save(true);
    }
    ///Create user for SiteOwner
    public function createUserSO($params, $site_owner_id) {
        $data['User'] = $params['SiteOwner'];
        $model = new User();
        if($model->load($data)) {
            
            $model->is_supper = 0;
            $model->is_owner = 1;
            
            if($model->password_hash == ""){
                $model->password_hash = rand(000000000, 99999999);
            }

            $password = $model->password_hash;

            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);

            $model->status = 1;
            $model->generateAuthKey();
            $model->site_owner_id = $site_owner_id;
            $model->create_by = \Yii::$app->user->id;
            $model->role = 'Site Owner';
            $model->save();
//            if($model->save()) {
//                /// Do something if My account created successfully
//                
//            }
        }
    }


    /**
     * Updates an existing SiteOwner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['info']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SiteOwner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateinfo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['info']);
        } else {
            return $this->render('update_info', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SiteOwner model.
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
     * Finds the SiteOwner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SiteOwner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiteOwner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
