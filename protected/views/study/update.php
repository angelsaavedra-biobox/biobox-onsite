<?php
/* @var $this StudyController */
/* @var $model Study */

$this->breadcrumbs=array(
	'Studies'=>array('index'),
	$model->pk=>array('view','id'=>$model->pk),
	'Update',
);

$this->menu=array(
	array('label'=>'List Study', 'url'=>array('index')),
	array('label'=>'Create Study', 'url'=>array('create')),
	array('label'=>'View Study', 'url'=>array('view', 'id'=>$model->pk)),
	array('label'=>'Manage Study', 'url'=>array('admin')),
);
?>

<h1>Update Study <?php echo $model->pk; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>