<?php
/**
 *
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var webvimark\modules\UserManagement\models\rbacDB\Permission $model
 */

use webvimark\modules\UserManagement\UserManagementModule;

$this->title = UserManagementModule::t('back', 'Permission creation');
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

 <!-- Main content -->
<section class="content">
<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title"><?= $this->title ?></h3>
	<div class="box-body">
		<?= $this->render('_form', [
			'model'=>$model,
		]) ?>
	</div>
</div>
</div>
</section>