<?php
use common\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'parent_id',
                'value'     => function(Category $data) {
                    return $data->getCategoryById($data->parent_id);
                },
                'filter'    => $model->getParentCategory($_GET['type']),
            ],
            'name',
            [
                'attribute' => 'status',
                'value'     => function(Category $data) {
                    return $data->getType($data->status);
                },
                'filter'    => $searchModel->getType(),
            ],
            'order',
            [
                'attribute' => 'image',
                'value'     => function(Category $data) {
                    return Html::img($data->getPictureUrl('image'), ['class' => 'img-thumbnail']);
                },
                'filter'    => false,
                'format'    => 'raw',
            ],
            [
                'attribute' => 'status',
                'value'     => function(Category $data) {
                    return $data->getStatus($data->status);
                },
                'filter'    => $searchModel->getStatus(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>