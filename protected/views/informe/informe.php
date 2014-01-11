<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'paciente-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<?php echo $form->errorSummary($model); ?>

<div class="control-group ">
    <label for="Informe_fecha" class="control-label">Audio</label>
    <div class="controls">
        <?php 
        
        $archivo = "wav/{$model->study_iuid}.ogg";
        if(file_exists($archivo))
        {        
        ?>
        <audio controls>
          <source src="<?php echo "/wav/{$model->study_iuid}.ogg?".md5(rand(1,99999)) ?>" type="audio/ogg" id="audio2" />
        Your browser does not support the audio element.
        </audio>
        <?php
        } 
        else
        {
            echo "<strong>No tiene un audio grabado.</strong>";
        }
        ?>
    </div>
</div>

<?php echo $form->uneditableRow($model, 'fecha'); ?>

<div class="control-group ">
    <label for="Informe_fecha" class="control-label">Fecha Realizado</label>
    <div class="controls">
        <span class="uneditable-input"><?php echo $estudio->study_datetime ?></span>
    </div>
</div>

<div class="control-group ">
    <label for="Informe_fecha" class="control-label">Tipo</label>
    <div class="controls">
        <span class="uneditable-input"><?php echo $estudio->mods_in_study ?></span>
    </div>
</div>

<div class="control-group ">
    <label for="Informe_fecha" class="control-label">Estudio</label>
    <div class="controls">
        <span class="uneditable-input"><?php echo $estudio->study_desc ?></span>
    </div>
</div>

<?php echo $form->uneditableRow($model, 'pat_name'); ?>

<div class="control-group ">
    <input id="estudio_id" type="hidden">
    <input id="paciente_cuil" type="hidden">
    <label class="control-label" for="Informe_archivo">Paciente</label>
    <div class="controls">    
        
        <span id="usoPaciente"><strong><?php 
            echo ($model->paciente)? $model->paciente->cuil.' - '.$model->paciente->nombre.' '.$model->paciente->apellido: "(sin asignar)" ?></strong></span><br/> 
        <input id="Informe_paciente_cuil" type="hidden" name="Informe[paciente_cuil]" value="<?php echo ($model->paciente)? $model->paciente->cuil: ""  ?>"/>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input class="span2" placeholder="Cuil sin Puntos" id="Paciente_cuil_search" type="text" maxlength="11">
            <button class="btn" type="button" id="buscarPaciente">
                Buscar Paciente
            </button>
        </div>
    </div>
    <div class="alert alert-info paciente oculto">Paciente encontrado: <strong><span id="cuil_contrado"></span></strong>
    <button class="btn btn-success" id="usarPaciente">Asignar Paciente</button>
    </div>
</div>

<div class="control-group ">
    <label for="Informe_archivo" class="control-label">Archivo del Informe</label>
    <div class="controls">
        <strong><?php 
        if($model->archivo)
        {
            echo CHtml::link('Informe.pdf','/informe/descargar/'.$model->id);
        }
        ?></strong>
        <input type="hidden" name="Informe[archivo]" value="" id="ytInforme_archivo">
        <input type="file" id="Informe_archivo" name="Informe[archivo]">
        <span style="display: none" id="Informe_archivo_em_" class="help-inline error"></span>
    </div>
</div>

<?php echo $form->dropDownListRow($model, 'estado', Informe::getEstados()); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Cargar' : 'Guardar',
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Cancelar',
    'size'=>'small',// null, 'large', 'small' or 'mini'
    'url'=>array('index', 'estado'=>$model->estado), 
    ));  ?>
</div>

<?php $this->endWidget(); ?>
<script>
function asignar(id){
    $("#asignarPacienteEstudio").hide();
    $(".paciente").hide();
    if(id>0){
        $("#estudio_id").val(id);
        $("#asignarPaciente").modal('show');
        $("#Paciente_cuil_search").focus();
    }
}

$("#usarPaciente").click(function(){
    $("#usoPaciente strong").html($("#cuil_contrado").html());
    $("#Informe_paciente_cuil").val( $("#paciente_cuil").val() );
    
    $(".paciente").hide();
    return false;
});
$("#asignarPacienteEstudio").click(function(){
    var eid = $("#estudio_id").val();
    var cuil = $("#paciente_cuil").val();
    if(eid!='' && cuil!='')
    {
        jQuery.post('<?php echo Yii::app()->controller->createUrl("asignar") ?>',
            {eid: eid, cuil: cuil},
            function(data,text,jqXHR){
                if(data.ok){
                    $("#asignarPaciente").hide();          
                              
                    $.fn.yiiGridView.update('entregados-grid');
                } else {
                    alert(text);
                }           
            },
            'json'
        );
    }
    else
    {
        alert('Debe elegir un paciente!');
    }    
});

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
                        $(".paciente").show();
                        $("#asignarPacienteEstudio").show();
                        //alert('El paciente encontrado! ');
                        $("#paciente_cuil").val(o.data.cuil);
                        $("#cuil_contrado").html(o.data.cuil+' - '+o.data.nombre+' '+o.data.apellido);
                        $("#Paciente_cuil_search").val('').focus();
                    } else {
                        alert('El paciente NO encontrado!');
                        /*$("#Paciente_cuil").val(o.data.cuil);
                        $("#Paciente_nombre").val(o.data.nombre);
                        $("#Paciente_apellido").val(o.data.apellido);
                        $("#Paciente_nacimiento").val(o.data.nacimiento);
                        $("#Paciente_registro").val(o.data.registro);
                        $("#Existe").val(1);
                        $("#Paciente_cuil, #Paciente_nombre, #Paciente_apellido, #Paciente_nacimiento").attr('readonly','readonly');
                        $("#paciente-form").show();*/
                    }
                    
                } else {
                    alert('CUIL no encontrado!');
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


