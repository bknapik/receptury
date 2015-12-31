<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var auth\models\User $model
 */

$this->title = Yii::t('auth.user', 'Edytuj użytkownika') . ': ' . $model->username;
?>
<div class="user-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
