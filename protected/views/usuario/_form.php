<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
  	'type'=>'horizontal',
	'focus'=>array($model,'username'),
	'enableAjaxValidation'=>true,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->passwordFieldRow($model,'new_password',array('class'=>'span5','maxlength'=>250)); ?>
	
	<?php echo $form->passwordFieldRow($model,'repeat_password',array('class'=>'span5','maxlength'=>250)); ?>
	
	<?php echo $form->textFieldRow($model,'nombre_completo',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255,'prehold'=>'@')); ?>

	<?php echo $form->dropDownListRow($model, 'rol', Usuario::getRoles()); ?>

	<?php echo $form->dropDownListRow($model, 'activo', Usuario::getEstados()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Cancelar',
	    'size'=>'small',// null, 'large', 'small' or 'mini'
	    'url'=>array('index'), 
		));  ?>
	</div>

<?php $this->endWidget(); ?>
