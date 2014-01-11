<?php
$this->breadcrumbs=array(
	'Log Informes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LogInforme','url'=>array('index')),
	array('label'=>'Create LogInforme','url'=>array('create')),
	array('label'=>'Update LogInforme','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete LogInforme','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogInforme','url'=>array('admin')),
);
?>

<h1>View LogInforme #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'informe_id',
		'fecha',
		'estado',
		'accion',
		'usuario_id',
	),
)); ?>
