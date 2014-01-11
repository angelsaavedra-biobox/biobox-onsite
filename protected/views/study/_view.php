<?php
/* @var $this StudyController */
/* @var $data Study */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk), array('view', 'id'=>$data->pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_fk')); ?>:</b>
	<?php echo CHtml::encode($data->patient_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accno_issuer_fk')); ?>:</b>
	<?php echo CHtml::encode($data->accno_issuer_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_iuid')); ?>:</b>
	<?php echo CHtml::encode($data->study_iuid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_id')); ?>:</b>
	<?php echo CHtml::encode($data->study_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->study_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accession_no')); ?>:</b>
	<?php echo CHtml::encode($data->accession_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_physician')); ?>:</b>
	<?php echo CHtml::encode($data->ref_physician); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_phys_fn_sx')); ?>:</b>
	<?php echo CHtml::encode($data->ref_phys_fn_sx); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_phys_gn_sx')); ?>:</b>
	<?php echo CHtml::encode($data->ref_phys_gn_sx); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_phys_i_name')); ?>:</b>
	<?php echo CHtml::encode($data->ref_phys_i_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_phys_p_name')); ?>:</b>
	<?php echo CHtml::encode($data->ref_phys_p_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_desc')); ?>:</b>
	<?php echo CHtml::encode($data->study_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_custom1')); ?>:</b>
	<?php echo CHtml::encode($data->study_custom1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_custom2')); ?>:</b>
	<?php echo CHtml::encode($data->study_custom2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_custom3')); ?>:</b>
	<?php echo CHtml::encode($data->study_custom3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->study_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mods_in_study')); ?>:</b>
	<?php echo CHtml::encode($data->mods_in_study); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuids_in_study')); ?>:</b>
	<?php echo CHtml::encode($data->cuids_in_study); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_series')); ?>:</b>
	<?php echo CHtml::encode($data->num_series); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_instances')); ?>:</b>
	<?php echo CHtml::encode($data->num_instances); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ext_retr_aet')); ?>:</b>
	<?php echo CHtml::encode($data->ext_retr_aet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retrieve_aets')); ?>:</b>
	<?php echo CHtml::encode($data->retrieve_aets); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileset_iuid')); ?>:</b>
	<?php echo CHtml::encode($data->fileset_iuid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileset_id')); ?>:</b>
	<?php echo CHtml::encode($data->fileset_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('availability')); ?>:</b>
	<?php echo CHtml::encode($data->availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_status')); ?>:</b>
	<?php echo CHtml::encode($data->study_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('checked_time')); ?>:</b>
	<?php echo CHtml::encode($data->checked_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_time')); ?>:</b>
	<?php echo CHtml::encode($data->updated_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_attrs')); ?>:</b>
	<?php echo CHtml::encode($data->study_attrs); ?>
	<br />

	*/ ?>

</div>