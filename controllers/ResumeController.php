<?php

namespace app\controllers;

use app\models\Resume;
use app\models\ResumeEducation;
use app\models\ResumeExperience;
use app\models\ResumeForm;
use app\models\ResumeSearch;
use app\models\ResumeSkill;
use kartik\mpdf\Pdf;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Resume models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resume model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $item = $this->findModel($id);

        $content = $this->renderPartial('_pdf', [
            'item' => $item,
            'educations' => $item->getResumeEducations()->orderBy(['started' => 'DESC'])->all(),
            'experiences' => $item->getResumeExperiences()->orderBy(['started' => 'DESC'])->all(),
            'skills' => $item->getResumeSkills()->orderBy(['name' => 'ASC'])->all(),
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'options' => ['title' => 'Awesome PDF Resume'],
            'methods' => [
                'SetHeader' => ['Awesome PDF Resume'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return array|string|Response
     */
    public function actionCreate()
    {
        $model = new ResumeForm();

        $count = count(\Yii::$app->request->post('ResumeEducation', []));
        $model->educations = [new ResumeEducation()];
        for($i = 1; $i < $count; $i++) {
            $model->educations[] = new ResumeEducation();
        }

        $count = count(\Yii::$app->request->post('ResumeExperience', []));
        $model->experiences = [new ResumeExperience()];
        for($i = 1; $i < $count; $i++) {
            $model->experiences[] = new ResumeExperience();
        }

        $count = count(\Yii::$app->request->post('ResumeSkill', []));
        $model->skills = [new ResumeSkill()];
        for($i = 1; $i < $count; $i++) {
            $model->skills[] = new ResumeSkill();
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())
                && Model::loadMultiple($model->educations, \Yii::$app->request->post())
                && Model::loadMultiple($model->skills, \Yii::$app->request->post())
                && Model::loadMultiple($model->experiences, \Yii::$app->request->post())
                && $model->saveForm(new Resume())) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $item = $this->findModel($id);

        $model = new ResumeForm();

        $model->setAttributes($item->getAttributes());

        $model->experiences = $item->resumeExperiences ?: [new ResumeExperience()];
        $model->educations = $item->resumeEducations ?: [new ResumeEducation()];
        $model->skills = $item->resumeSkills ?: [new ResumeSkill()];

        if ($this->request->isPost) {

            $model->experiences = [];
            $model->educations = [];
            $model->skills = [];

            $count = count(\Yii::$app->request->post('ResumeEducation', []));
            for($i = 0; $i < $count; $i++) {
                $model->educations[] = new ResumeEducation();
            }

            $count = count(\Yii::$app->request->post('ResumeExperience', []));
            for($i = 0; $i < $count; $i++) {
                $model->experiences[] = new ResumeExperience();
            }

            $count = count(\Yii::$app->request->post('ResumeSkill', []));
            for($i = 0; $i < $count; $i++) {
                $model->skills[] = new ResumeSkill();
            }

            if ($model->load($this->request->post())
                && Model::loadMultiple($model->educations, \Yii::$app->request->post())
                && Model::loadMultiple($model->skills, \Yii::$app->request->post())
                && Model::loadMultiple($model->experiences, \Yii::$app->request->post())
                && $model->saveForm($item)) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'item' => $item
        ]);
    }

    /**
     * Deletes an existing Resume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
