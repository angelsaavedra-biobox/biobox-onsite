<div class="controls">
	<div class="input-prepend">
		<span class="add-on"><i class="icon-search"></i></span>
		<input class="span2" placeholder="Cuil sin Puntos" id="Paciente_cuil_search" type="text" maxlength="11">
		<button class="btn" type="button" id="buscarPaciente">
			Buscar Paciente
		</button>
	</div>
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'paciente-form',
  	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'apellido',array('class'=>'span5','maxlength'=>45)); ?>

    <?php echo $form->textFieldRow($model,'cuil',array('class'=>'span2','maxlength'=>11, 'readonly'=>($model->getScenario()=='update'))); ?>
    
    <?php echo $form->dropDownListRow($model, 'sexo', Paciente::getSexos()); ?>
    
	<input type="hidden" id="Paciente_registro" name="Paciente[registro]" maxlength="11" class="span2">
	
    <input type="hidden" id="Existe" name="existe" maxlength="11" class="span2" value="0">
	<div class="control-group ">
	<?php echo $form->labelEx($model,'nacimiento',array('class'=>'control-label')); ?>
	<div class="controls">
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'model'=>$model,
								'attribute'=>'nacimiento',
								'language'=>'es',
								'htmlOptions'=>array('class'=>'span2',),
								'options'=>array(
                                    'dateFormat'=>'dd-mm-yy',
                                    'altFormat' => 'dd-mm-yy', // show to user format
									'duration'=>'fast',
									'constrainInput'=>'false',	
									'showAnim'=>'slide'
								)
							)
	); 
	?>
	</div>
	
	<?php #echo $form->error($model,'fecha'); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Cargar' : 'Guardar',
		)); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Cancelar',
	    'size'=>'small',// null, 'large', 'small' or 'mini'
	    'url'=>array('index'), 
		));  ?>
	</div>

<?php $this->endWidget(); ?>
<script>
$("#Paciente_cuil_search").focus();
$("#paciente-form").hide();
$('#buscarPaciente').click(function(){
    if(!validaCuit($("#Paciente_cuil_search").val())){
        alert('debe ingresar un número de CUIL válido!');
        $("#Paciente_cuil_search").focus();
    }
    else {
        $.ajax({
            url: "http://<?php echo ($_SERVER['HTTP_HOST']!='biobox.local')? $_SERVER['HTTP_HOST'] : 'biobox.local' ?>/paciente/existe",
            data: {cuil: $("#Paciente_cuil_search").val()},
            dataType: 'json',
            type: 'POST',
            crossDomain: true,
        }).done(function(o) {
            
            if(o != null && typeof o === 'object'){
                
                
                if(o.ok){
                    if(o.local){
                        alert('El paciente ya se encuentra cargado!');
                        $("#Paciente_cuil_search").val('').focus();
                    } else {
                        $("#Paciente_cuil").val(o.data.cuil);
                        $("#Paciente_nombre").val(o.data.nombre);
                        $("#Paciente_apellido").val(o.data.apellido);
                        $("#Paciente_nacimiento").val(o.data.nacimiento);
                        $("#Paciente_registro").val(o.data.registro);
                        $("#Existe").val(1);
                        $("#Paciente_cuil, #Paciente_nombre, #Paciente_apellido, #Paciente_nacimiento").attr('readonly','readonly');
                        $("#paciente-form").show();
                    }
                    
                } else {
                    $("#paciente-form").show();
                    alert('CUIL no encontrado!');
                    $("#Paciente_cuil").val($("#Paciente_cuil_search").val());
                    $("#Paciente_nombre").val('');
                    $("#Paciente_apellido").val('');
                    $("#Paciente_nacimiento").val('');
                    $("#Paciente_registro").val('');
                    $("#Existe").val(0);
                    $("#Paciente_cuil, #Paciente_nombre, #Paciente_apellido, #Paciente_nacimiento").removeAttr('readonly');
                }            
            } else {
                alert('Intente de nuevo');
            }
                
        }).error(function(o,text){
            //alert(o.statusCode());
        }).fail(function( jqXHR, textStatus ) {
            alert(jqXHR.status);
          alert( "Request failed: " + textStatus );
        });
    }
})

function validaCuit(cuit) {
    if (typeof (cuit) == 'undefined')
        return true;
    cuit = cuit.toString().replace(/[-_]/g, "");
    if (cuit == '')
        return false; //No estamos validando si el campo esta vacio, eso queda para el "required"
    if (cuit.length != 11)
        return false;
    else {
        var mult = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
        var total = 0;
        for (var i = 0; i < mult.length; i++) {
            total += parseInt(cuit[i]) * mult[i];
        }
        var mod = total % 11;
        var digito = mod == 0 ? 0 : mod == 1 ? 9 : 11 - mod;
    }
    return digito == parseInt(cuit[10]);
}
</script>
