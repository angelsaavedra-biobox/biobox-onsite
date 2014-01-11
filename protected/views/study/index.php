<?php
/* @var $this StudyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Studies',
);

$this->menu=array(
	array('label'=>'Create Study', 'url'=>array('create')),
	array('label'=>'Manage Study', 'url'=>array('admin')),
);
?>

<h1>Studies</h1>

<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>

<?php $widget->run(); ?>
