<script>var base='<?php echo Yii::app()->baseUrl.'/' ?>';</script><?php 
    echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/AudioContextMonkeyPatch.js');
    echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/audiodisplay.js');
    echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/recorder_new.js');
    echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/main.js');
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'grabacion-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<?php echo $form->errorSummary($model); ?>
<script>
var estudio = '<?php echo $model->study_iuid ?>';
</script>
<style>
    canvas { 
        display: inline-block; 
        background: #202020; 
        width: 95%;
        max-height: 100px;
        box-shadow: 0px 0px 10px blue;
    }
    #controls {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }
    #record { height: 15vh; }
    #record.recording { 
        background: red;
        background: -webkit-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
    }
    #save { height: 10vh; }
    #viz {
        height: 80%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }
    @media (orientation: landscape) {
        /*body { flex-direction: row;}
        /*#controls { flex-direction: column; height: 100%; width: 10%;}
        #viz { height: 100%; width: 90%;}*/
    }
    .oculto {
        display: none;
    }

    </style>
<h3>Grabar Audio</h3>
<div class="container-fluid">
    <div class="row-fluid" id="grabacion">
        <div class="span6">
            <div id="viz">
            <canvas id="analyser"></canvas>
            <!-- <canvas id="wavedisplay"></canvas> -->
            <audio controls id="audioCtl" class="oculto">
              <source src="<?php echo "/wav/{$model->study_iuid}.ogg?".md5(rand(1,99999)) ?>" type="audio/ogg" id="audio" />
            Your browser does not support the audio element.
            </audio>
            </div>
        </div>
        <div class="span6">
            <div id="controls">
                <img id="record" src="<?php echo Yii::app()->baseUrl ?>/images/mic128.png" onclick="toggleRecording(this);">
                <!-- <img id="save" src="<?php echo Yii::app()->baseUrl ?>/images/save.svg" onclick="saveAudio();"> -->
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success oculto" id="mensajeEnvioOK">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Bien!</h4>
  Ahora puede escuchar el audio grabado...
</div>
<div class="alert alert-block oculto" id="mensajeEnvio">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Espere!</h4>
  Se está enviando la grabación al servidor...
</div>
    <input id="Informe_estado" type="hidden" name="Informe[estado]" value="transcribir"/>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
            'label'=>'Listo para Transcribir',
        )); ?>
        
    <?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'Cancelar', 'url'=>array('index'), ));  ?>
</div>

<?php $this->endWidget(); ?>

