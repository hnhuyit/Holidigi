<?php

namespace frontend\controllers;

use Yii;
use common\models\Task;
use common\models\Website;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\PreHelper;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
                        'actions' => ['create', 'delete', 'index', 'view', 'siteowner', 'mytask'],
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->andFilterWhere(['=', 'create_by', Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 4,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionSiteowner()
    {
        $site_owner_id = Yii::$app->user->identity->site_owner_id;
        $website_id = Website::find()->andFilterWhere(['=', 'site_owner_id', $site_owner_id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->andFilterWhere(['=', 'website_id', $website_id->id]),
        ]);

        return $this->render('task_site_owner', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionMytask()
    {
        $site_owner_id = Yii::$app->user->identity->site_owner_id;
        $website_id = Website::find()->andFilterWhere(['=', 'site_owner_id', $site_owner_id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->andFilterWhere(['=', 'website_id', $website_id->id])->andFilterWhere(['=', 'user_id', Yii::$app->user->id]),
        ]);

        return $this->render('task_my_task', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
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
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        $model->status = 1;
        $model->create_by = Yii::$app->user->id;

        $modelWebsite = new Website();
        $websites = $modelWebsite->getListWebsites();

        $modelUser = new User();
        $users = $modelUser->getListUsers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'websites' => $websites,
                'users' => $users,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
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
     * Deletes an existing Task model.
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
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
