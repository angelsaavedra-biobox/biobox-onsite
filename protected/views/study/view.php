<?php
/* @var $this StudyController */
/* @var $model Study */

$this->breadcrumbs=array(
	'Studies'=>array('index'),
	$model->pk,
);

$this->menu=array(
	array('label'=>'List Study', 'url'=>array('index')),
	array('label'=>'Create Study', 'url'=>array('create')),
	array('label'=>'Update Study', 'url'=>array('update', 'id'=>$model->pk)),
	array('label'=>'Delete Study', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Study', 'url'=>array('admin')),
);
?>

<h1>View Study #<?php echo $model->pk; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk',
		'patient_fk',
		'accno_issuer_fk',
		'study_iuid',
		'study_id',
		'study_datetime',
		'accession_no',
		'ref_physician',
		'ref_phys_fn_sx',
		'ref_phys_gn_sx',
		'ref_phys_i_name',
		'ref_phys_p_name',
		'study_desc',
		'study_custom1',
		'study_custom2',
		'study_custom3',
		'study_status_id',
		'mods_in_study',
		'cuids_in_study',
		'num_series',
		'num_instances',
		'ext_retr_aet',
		'retrieve_aets',
		'fileset_iuid',
		'fileset_id',
		'availability',
		'study_status',
		'checked_time',
		'updated_time',
		'created_time',
		'study_attrs',
	),
)); ?>
