<?php
/* @var $this StudyController */
/* @var $model Study */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'study-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'patient_fk'); ?>
		<?php echo $form->textField($model,'patient_fk',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'patient_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accno_issuer_fk'); ?>
		<?php echo $form->textField($model,'accno_issuer_fk',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'accno_issuer_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_iuid'); ?>
		<?php echo $form->textField($model,'study_iuid',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_iuid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_id'); ?>
		<?php echo $form->textField($model,'study_id',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_datetime'); ?>
		<?php echo $form->textField($model,'study_datetime'); ?>
		<?php echo $form->error($model,'study_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accession_no'); ?>
		<?php echo $form->textField($model,'accession_no',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'accession_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_physician'); ?>
		<?php echo $form->textField($model,'ref_physician',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ref_physician'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_phys_fn_sx'); ?>
		<?php echo $form->textField($model,'ref_phys_fn_sx',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ref_phys_fn_sx'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_phys_gn_sx'); ?>
		<?php echo $form->textField($model,'ref_phys_gn_sx',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ref_phys_gn_sx'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_phys_i_name'); ?>
		<?php echo $form->textField($model,'ref_phys_i_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ref_phys_i_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_phys_p_name'); ?>
		<?php echo $form->textField($model,'ref_phys_p_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ref_phys_p_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_desc'); ?>
		<?php echo $form->textField($model,'study_desc',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_custom1'); ?>
		<?php echo $form->textField($model,'study_custom1',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_custom1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_custom2'); ?>
		<?php echo $form->textField($model,'study_custom2',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_custom2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_custom3'); ?>
		<?php echo $form->textField($model,'study_custom3',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_custom3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_status_id'); ?>
		<?php echo $form->textField($model,'study_status_id',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'study_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mods_in_study'); ?>
		<?php echo $form->textField($model,'mods_in_study',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'mods_in_study'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuids_in_study'); ?>
		<?php echo $form->textField($model,'cuids_in_study',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cuids_in_study'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_series'); ?>
		<?php echo $form->textField($model,'num_series'); ?>
		<?php echo $form->error($model,'num_series'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_instances'); ?>
		<?php echo $form->textField($model,'num_instances'); ?>
		<?php echo $form->error($model,'num_instances'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ext_retr_aet'); ?>
		<?php echo $form->textField($model,'ext_retr_aet',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ext_retr_aet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'retrieve_aets'); ?>
		<?php echo $form->textField($model,'retrieve_aets',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'retrieve_aets'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fileset_iuid'); ?>
		<?php echo $form->textField($model,'fileset_iuid',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'fileset_iuid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fileset_id'); ?>
		<?php echo $form->textField($model,'fileset_id',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'fileset_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'availability'); ?>
		<?php echo $form->textField($model,'availability'); ?>
		<?php echo $form->error($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_status'); ?>
		<?php echo $form->textField($model,'study_status'); ?>
		<?php echo $form->error($model,'study_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checked_time'); ?>
		<?php echo $form->textField($model,'checked_time'); ?>
		<?php echo $form->error($model,'checked_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_time'); ?>
		<?php echo $form->textField($model,'updated_time'); ?>
		<?php echo $form->error($model,'updated_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
		<?php echo $form->error($model,'created_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_attrs'); ?>
		<?php echo $form->textField($model,'study_attrs'); ?>
		<?php echo $form->error($model,'study_attrs'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->