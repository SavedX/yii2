<?php

namespace app\controllers;

use app\models\Shows;
use Yii;
use app\models\Events;
use app\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Events::find();

        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);

        $events = $query->addSelect('*')
            ->orderBy('date')
            ->with('show')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'events' => $events,
            'pagination' => $pagination,
        ]);
    }

    public function actionEdit()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('edit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $show_id = $model->show_id;
        $show = Shows::findOne($show_id);

        $show['image'] = $show->img;
        $show['name'] = $show->name;
        $show['description'] = $show->description;

        return $this->render('view', [
            'model' => $model,
            'show' => $show
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Events();
        $modelShow = new Shows();

        if ($model->load(Yii::$app->request->post()) && $modelShow->load(Yii::$app->request->post())) {

            $modelShow->image  = UploadedFile::getInstance($modelShow, 'image');

            if ($modelShow->upload()) {
                $modelShow->img = 'shows/' . $modelShow->image->baseName . '.' . $modelShow->image->extension;
            }
            if ($modelShow->save(false)) {
                $model->show_id = $modelShow->id;

                $model->save();

            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelShow' => $modelShow,
            ]);
        }
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelShow = Shows::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $modelShow->load(Yii::$app->request->post())) {

            $modelShow->image = UploadedFile::getInstance($modelShow, 'image');

            if ($modelShow->upload()) {
                $modelShow->img = 'shows/' . $modelShow->image->baseName . '.' . $modelShow->image->extension;
                if ($modelShow->save(false)) {
                    $model->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelShow' => $modelShow
            ]);
        }
    }

    /**
     * Deletes an existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}