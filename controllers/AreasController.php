<?php

namespace app\controllers;

use Yii;
use app\models\Areas;
use app\models\Events;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * AreasController implements the CRUD actions for Areas model.
 */
class AreasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['edit, create, update, delete'],
                'rules' => [
                    [
                        'actions' => ['edit, create, update, delete'],
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
     * Lists all Areas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Areas::find();

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);

        $events = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'areas' => $events,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Lists all Areas models.
     * @return mixed
     */
    public function actionEdit()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Areas::find(),
        ]);
        return $this->render('edit', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Areas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = Events::find();

        $pagination = new Pagination([
            'defaultPageSize' => 9,
        ]);
        $events = $query->addSelect('*')
            ->orderBy('date')
            ->with('show')
            ->where('events.area_id=:id', [':id' => $id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $pagination->defaultPageSize = count($events);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'events' => $events,
            'pagination' => $pagination
        ]);
    }

    /**
     * Creates a new Areas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Areas();
        if ($model->load(Yii::$app->request->post())) {

            $model->image  = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                $model->img = 'areas/' . $model->image->baseName . '.' . $model->image->extension;

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Areas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                $model->img = 'areas/' . $model->image->baseName . '.' . $model->image->extension;

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Areas model.
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
     * Finds the Areas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Areas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Areas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
