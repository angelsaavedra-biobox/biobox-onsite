<?php
/* @var $this StudyController */
/* @var $model Study */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pk'); ?>
		<?php echo $form->textField($model,'pk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_fk'); ?>
		<?php echo $form->textField($model,'patient_fk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accno_issuer_fk'); ?>
		<?php echo $form->textField($model,'accno_issuer_fk',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_iuid'); ?>
		<?php echo $form->textField($model,'study_iuid',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_id'); ?>
		<?php echo $form->textField($model,'study_id',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_datetime'); ?>
		<?php echo $form->textField($model,'study_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accession_no'); ?>
		<?php echo $form->textField($model,'accession_no',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_physician'); ?>
		<?php echo $form->textField($model,'ref_physician',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_phys_fn_sx'); ?>
		<?php echo $form->textField($model,'ref_phys_fn_sx',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_phys_gn_sx'); ?>
		<?php echo $form->textField($model,'ref_phys_gn_sx',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_phys_i_name'); ?>
		<?php echo $form->textField($model,'ref_phys_i_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_phys_p_name'); ?>
		<?php echo $form->textField($model,'ref_phys_p_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_desc'); ?>
		<?php echo $form->textField($model,'study_desc',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_custom1'); ?>
		<?php echo $form->textField($model,'study_custom1',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_custom2'); ?>
		<?php echo $form->textField($model,'study_custom2',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_custom3'); ?>
		<?php echo $form->textField($model,'study_custom3',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_status_id'); ?>
		<?php echo $form->textField($model,'study_status_id',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mods_in_study'); ?>
		<?php echo $form->textField($model,'mods_in_study',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuids_in_study'); ?>
		<?php echo $form->textField($model,'cuids_in_study',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_series'); ?>
		<?php echo $form->textField($model,'num_series'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_instances'); ?>
		<?php echo $form->textField($model,'num_instances'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ext_retr_aet'); ?>
		<?php echo $form->textField($model,'ext_retr_aet',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'retrieve_aets'); ?>
		<?php echo $form->textField($model,'retrieve_aets',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fileset_iuid'); ?>
		<?php echo $form->textField($model,'fileset_iuid',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fileset_id'); ?>
		<?php echo $form->textField($model,'fileset_id',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'availability'); ?>
		<?php echo $form->textField($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_status'); ?>
		<?php echo $form->textField($model,'study_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'checked_time'); ?>
		<?php echo $form->textField($model,'checked_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_time'); ?>
		<?php echo $form->textField($model,'updated_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_attrs'); ?>
		<?php echo $form->textField($model,'study_attrs'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->