<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\manager\models\ManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Managers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Manager'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'patronymic',
            'salary',
            'count_request',
            'month' => [
                'value' => function ($model) {
                    // todo: Сделать нормальный класс для работы с датами, а также добавить переводчик
                    return date('F', strtotime($model->month));
                }
            ],
            'sum_salary' => [
                'label' => Yii::t('models', 'Итоговая зп'),
                'value' => function (\common\models\Manager $model) {
                    return $model->getSumSalary();
                }
            ],
            //'updated_at',
            //'created_at',
            //'deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
