<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var auth\models\User $model
 */

$this->title = $model->username;
?>
<div class="user-view">

	<h1>Widok użytkownika: '<?= Html::encode($this->title) ?>'</h1>

	<p>
		<?= Html::a(Yii::t('auth.user', 'Aktualizuj'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a(Yii::t('auth.user', 'Usuń'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Czy jesteś pewny, że chcesz usunąć tego użytkownika?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'id',
			'username',
			'email:email',
			'password_hash',
			'password_reset_token',
			'auth_key',
			[
				'attribute' => 'status',
				'value' => $model->getStatus()
			],
			'last_visit_time',
			'create_time',
			'update_time',
			'delete_time',
		],
	]); ?>

</div>
