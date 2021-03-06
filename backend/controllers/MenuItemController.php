<?php
namespace backend\controllers;

use backend\components\Controller;
use common\models\MenuItem;
use common\models\search\MenuItemSearch;
use navatech\language\Translate;
use navatech\role\filters\RoleFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * MenuItemController implements the CRUD actions for MenuItem model.
 */
class MenuItemController extends Controller {

	/**
	 * @inheritdoc
	 */
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
			'role'  => [
				'class'   => RoleFilter::className(),
				'name'    => Translate::menu_item(),
				'actions' => [
					'index'  => Translate::lists(),
					'view'   => Translate::view(),
					'create' => Translate::create(),
					'update' => Translate::update(),
					'delete' => Translate::delete(),
				],
			],
		];
	}

	/**
	 * Lists all MenuItem models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new MenuItemSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single MenuItem model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new MenuItem model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new MenuItem();
		if ($model->load(Yii::$app->request->post())) {
			if ($_POST['MenuItem']['parent_id'] == '') {
				$model->parent_id = 0;
			}
			if ($model->save()) {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing MenuItem model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post())) {
			if ($_POST['MenuItem']['parent_id'] == '') {
				$model->parent_id = 0;
			}
			if ($model->save()) {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing MenuItem model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the MenuItem model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return MenuItem the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = MenuItem::findOneTranslated($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
