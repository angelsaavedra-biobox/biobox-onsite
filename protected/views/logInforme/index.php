<?php
$this->breadcrumbs=array(
	'Log Informes',
);

$this->menu=array(
	array('label'=>'Create LogInforme','url'=>array('create')),
	array('label'=>'Manage LogInforme','url'=>array('admin')),
);
?>

<h1>Log Informes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
