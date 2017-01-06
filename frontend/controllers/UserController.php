<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use common\helpers\PreHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'actions' => ['team', 'info', 'create', 'view', 'updateinfo', 'changepassword'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    //Show info User Profile
    public function actionInfo() {
        $is_user = Yii::$app->user->identity->id;
        $model = $this->findModel($is_user);
        
        return $this->render('info', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionTeam()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->andFilterWhere(['=', 'create_by', Yii::$app->user->id]),
                //->andFilterWhere(['=', 'is_owner', 0])
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        return $this->render('team', [
            'dataProvider' => $dataProvider,
            'agency_id'     => Yii::$app->user->identity->agency_id,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        $model->status = 1;
        $model->generateAuthKey();

        

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->create_by = \Yii::$app->user->id;
            //$model->role = 
            if($model->password_hash != ""){
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            }
            if($model->save()) {
                return $this->redirect(['team']);
            }  
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    //Change password
    public function actionChangepassword()
    {      
        $model = Yii::$app->user->identity;
        $user = $model->load(Yii::$app->request->post());

        if($user && $model->validate()) {
            $model->password = $model->new_password;
            $model->save();
            Yii::$app->session->setFlash('success', 'You have successful changed your password');
            return $this->refresh();
        }
        return $this->render('changepassword', [
           'model' => $model,     
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateinfo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update_info', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing User model.
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
