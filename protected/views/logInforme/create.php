<?php
$this->breadcrumbs=array(
	'Log Informes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogInforme','url'=>array('index')),
	array('label'=>'Manage LogInforme','url'=>array('admin')),
);
?>

<h1>Create LogInforme</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>