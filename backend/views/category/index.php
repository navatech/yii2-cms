<?php
use common\models\Category;
use kartik\grid\GridView;
use navatech\language\Translate;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**@var int $type */
$this->title                   = Translate::category();
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<p>
		<?= Html::a(Translate::create_x(Translate::category()), [
			'create',
			'type' => $type,
		], [
			'class' => 'btn btn-success',
			'style' => 'height:50px',
		]) ?>
	</p>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'export'       => false,
		'responsive'   => true,
		'hover'        => true,
		'pjax'         => true,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'image',
				'value'     => function (Category $data) {
					return Html::img($data->getPictureUrl('image'), [
						'class' => 'img-thumbnail',
						'style' => 'height:50px',
					]);
				},
				'filter'    => false,
				'format'    => 'raw',
			],
			[
				'attribute' => 'parent_id',
				'value'     => function (Category $data) {
					return $data->parent != null ? $data->parent->name : '';
				},
				'filter'    => Category::getDependCategories(),
			],
			'name',
			'order',
			[
				'attribute' => 'status',
				'value'     => function (Category $data) {
					return $data->statusText;
				},
				'filter'    => Category::filter(),
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
