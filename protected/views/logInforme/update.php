<?php
$this->breadcrumbs=array(
	'Log Informes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogInforme','url'=>array('index')),
	array('label'=>'Create LogInforme','url'=>array('create')),
	array('label'=>'View LogInforme','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage LogInforme','url'=>array('admin')),
);
?>

<h1>Update LogInforme <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>