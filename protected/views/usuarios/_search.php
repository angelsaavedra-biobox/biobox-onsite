<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->passwordFieldRow($model,'passwd',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'rol',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'activo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'nombre_completo',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
