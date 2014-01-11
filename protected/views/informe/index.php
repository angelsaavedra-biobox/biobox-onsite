<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
if(Yii::app()->user->isGuest) {
    $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
        'heading'=>'Bienvenido a '.CHtml::encode(Yii::app()->name),
    ));
    ?><p></p><?php
    $this->endWidget(); 
} else {
    #$weasis = "http://192.168.62.25:8080/weasis-pacs-connector/viewer.jnlp?studyUID=";
    $weasis = ($_SERVER['SERVER_NAME']=='dorregomall-mza.dc.biobox.com.ar')? 'http://209.13.157.53:8080' : 'http://192.168.62.25:8080';
    $weasis.= "/weasis-pacs-connector/viewer.jnlp?studyUID=";
    
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#study-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>


<!-- swfobject is a commonly used library to embed Flash content -->
<script type="text/javascript"
    src="/js/swfobject.js"></script>

<!-- Setup the recorder interface -->
<script type="text/javascript" src="/js/recorder.js"></script>

<!-- GUI code... take it or leave it -->
<script type="text/javascript" src="/js/gui.js?n=<?php echo rand(1,999999999999)?>"></script>
<?php #print_r($_SERVER); ?>
<script>
var archivo='';
var gui = null;
var continua = false;
var myRecordUrl = "<?php echo Yii::app()->getBaseUrl().'/wav/'?>input.php?name=";
var Nuevo = 0;
//myRecordUrl+archivo+".wav&nuevo=".$("#nuevo").val(),

    function setupRecorder() {
        Wami.setup({
            id : "wami",
            onReady : setupGUI
        });
    }

    function setupGUI() {
        gui = new Wami.GUI({
            id : "wami",
            recordUrl : myRecordUrl+archivo+"&nuevo="+$("#nuevo").val(),
            playUrl : "<?php echo Yii::app()->getBaseUrl().'/wav/'?>"+archivo+".wav"
        });
    }

/*
    function grabar(eid, ini, id){
        continua = false;
        $("#nuevo").val((ini)? 1 : 0);
        $("#eid").val(eid);
        $("#iid").val(id);
        //alert(id);
        archivo=eid;
        $("#iniciarGrabacion").modal('show');
        Nuevo = 1;
        $("#valor").val(myRecordUrl+archivo+"&nuevo="+$("#nuevo").val());
        setupRecorder();
        //alert((ini)? false : true );
        //gui.setPlayEnabled((ini)? false : true );
    }*/

    function asignarPaciente(ref, ori){
        //alert(ori.parent().attr("class"));
        jQuery.post('<?php echo Yii::app()->getBaseUrl()?>'+ref, 
            function(data,text,jqXHR){
                if(data.ok){
                    /*continua = false;
                    $("#nuevo").val((ini)? 1 : 0);
                    $("#eid").val(data.eid);
                    $("#iid").val(data.id);
                    //alert(id);
                    archivo=data.eid;
                    $("#iniciarGrabacion").modal('show');
                    Nuevo = 1;
                    $("#con_audio").val(data.con_audio);
                    $("#valor").val(myRecordUrl+archivo+"&nuevo="+$("#nuevo").val());
                    setupRecorder();
                    */
                    $("#AsignarPaciente").modal('show');
                    //$("#verInforme").modal('show');
                    //$("#textoInforme").html(data.texto);
                } else {
                    alert(data.problema);
                }           
            },
            'json'
        );  
    }
    
    function informe(ref,ini, ori){
        //alert(ori.parent().attr("class"));
        jQuery.post('<?php echo Yii::app()->getBaseUrl()?>'+ref, 
            function(data,text,jqXHR){
                if(data.ok){
                    continua = false;
                    $("#nuevo").val((ini)? 1 : 0);
                    $("#eid").val(data.eid);
                    $("#iid").val(data.id);
                    //alert(id);
                    archivo=data.eid;
                    $("#informe").modal('show');
                    Nuevo = 1;
                    $("#con_audio").val(data.con_audio);
                    $("#valor").val(myRecordUrl+archivo+"&nuevo="+$("#nuevo").val());
                    setupRecorder();
                    
                    //$("#verInforme").modal('show');
                    //$("#textoInforme").html(data.texto);
                } else {
                    alert(data.problema);
                }           
            },
            'json'
        );  
    }
    
    function grabar(ref,ini, ori){
        //alert(ori.parent().attr("class"));
        jQuery.post('<?php echo Yii::app()->getBaseUrl()?>'+ref, 
            function(data,text,jqXHR){
                if(data.ok){
                    continua = false;
                    $("#nuevo").val((ini)? 1 : 0);
                    $("#eid").val(data.eid);
                    $("#iid").val(data.id);
                    //alert(id);
                    archivo=data.eid;
                    $("#iniciarGrabacion").modal('show');
                    Nuevo = 1;
                    $("#con_audio").val(data.con_audio);
                    $("#valor").val(myRecordUrl+archivo+"&nuevo="+$("#nuevo").val());
                    setupRecorder();
                    
                    //$("#verInforme").modal('show');
                    //$("#textoInforme").html(data.texto);
                } else {
                    alert(data.problema);
                }           
            },
            'json'
        );  
    }
        

    function guardarCambios(){
        jQuery.post('<?php echo Yii::app()->getBaseUrl().'/informe/grabarAudio'?>', 
            {accion: 'saveAudio', eid: $("#eid").val(), id: $("#iid").val(), con_audio: $("#con_audio").val()}, 
            function(data,text,jqXHR){
                if(data.ok){
                    $("#iniciarGrabacion").modal('hide');
                    $('#grabar-grid').yiiGridView.update('grabar-grid');
                } else {
                }
                
            },
            'json'
        );
    }

    function listoTranscribir(){
        var ok = confirm("Está seguro de enviar este estudio a transcribir?");
        if(ok){
            jQuery.post('<?php echo Yii::app()->getBaseUrl().'/informe/enviarTranscribir'?>', 
                {accion: 'solicitaTranscripcion', eid: $("#eid").val(), id: $("#iid").val()}, 
                function(data,text,jqXHR){
                    if(data.ok){
                        $("#iniciarGrabacion").modal('hide');
                        //$("#e_"+data.id).addClass('oculto');
                        $('#grabar-grid').yiiGridView.update('grabar-grid');
                    } else {
                    }
                    
                },
                'json'
            );
        } 
    }
</script>
<input type="hidden" id="valor" style="width:900px;" />
<?php #$widget->run(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grabar-grid',
    'template'=>'{summary}{items}{pager}',
    'summaryText'=>'Mostrando {start}-{end} de {count} registros en {pages} páginas.',
    'enableSorting'=>true,
    'ajaxUpdate'=>true,
    'pager'=>array(
            'header'=>'',
            'cssFile'=>false,
            'maxButtonCount'=>10,
            'selectedPageCssClass'=>'active',
            'hiddenPageCssClass'=>'disabled',
            'firstPageLabel'=>'<<',
            'lastPageLabel'=>'>>',
    ),
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'name'=>'study_datetime',
            'value'=>'date("d/m/Y H:i:s", strtotime($data->study_datetime))',
            'filter'=>''
        ),
        array(
            'name'=>'mods_in_study',
            'filter'=>array('CT'=>'CT','MR'=>'MR','US'=>'US','CR'=>'CR','OT'=>'OT')
        ),
        'study_desc',
        array(
            'name'=>'pat_name',
            'value'=>'trim(str_replace("^"," ",$data->pat_name))'
        ),
        array(
            'name'=>'paciente_cuil',
            'value'=>'$data->cuil." - ".$data->nombre." ".$data->apellido',
        ),
        array(
            'name'=>'estado',
            'value'=>'Informe::getEstados($data->estado)',
            'filter'=>Informe::getEstados()
        ),
        /*array( 'class'=>'CLinkColumn', //here is the link column
                        'header'=>'Informe',
                        'label'=>'Informe.pdf',
                        'urlExpression'=>'Yii::app()->createUrl("/informe/descargar", array("id"=>$data["id"]))',
                        'visible'=>'false',
                ),*/
        #array(
            #'name'=>'archivo',
            #'value'=>'"informe.pdf"',
            #'class'=>'CLinkColumn',
            #'header'=>'Informe',
            #'labelExpression'=>'Informe.pdf',
            #'value'=>'"/informes/".$data->study_iuid.".pdf"',
            # 'url'=>'Yii::app()->controller->createUrl("grabar",array("id"=>$data->id))',
            #
        #),
        array(
            //'class'=>'bootstrap.widgets.TbButtonColumn',
            'header'=>'Acciones',
            #'value'=>'CHtml::link("Ver Estudio", "/weasis-pacs-connector/viewer.jnlp?studyUID=".$data->study_iuid, array("class"=>"btn btn-primary btn-lg"));'
            #'value'=>'echo <button id="ig_$data->id" class="btn btn-lg grabar" onclick="grabar($data->id)">Iniciar Grabación</button>',
            'class'=>'CButtonColumn',
            'htmlOptions'=>array('class'=>'nowrap'),
            'template'=>'{verEstudio} {informar} {grabar} {descargar}',
            #'template'=>'{verEstudio} {iniciarGrabacion} {continuarGrabacion} {regrabar} {subirInforme}',
            'buttons'=>array(
                'verEstudio'=> array(
                    'label'=>'Ver Estudio',         
                    'options'=>array("class"=>"btn btn-lg nowrap"),
                    'url'=>'"http://192.168.62.25:8080/weasis-pacs-connector/viewer.jnlp?studyUID=".$data->study_iuid',
                    #'url'=>'Yii::app()->controller->createUrl("/weasis-pacs-connector/viewer.jnlp?studyUID=".$data->study_iuid)',
                ),
                'grabar'=>array(
                    'label'=>'Informe',
                    'options'=>array("class"=>"btn btn-lg nowrap rg"),
                    'url'=>'Yii::app()->controller->createUrl("grabar",array("id"=>$data->id))',
                    'visible'=>'$data->estado=="grabar"',
                ),
                'informar'=>array(
                    'label'=>'Informe',
                    'options'=>array("class"=>"btn btn-lg nowrap rg"),
                    'url'=>'Yii::app()->controller->createUrl("informe",array("id"=>$data->id))',
                    'visible'=>'$data->estado!="grabar"',
                ),
                'descargar'=>array(
                    'label'=>'Descargar',
                    'options'=>array("class"=>"btn btn-success btn-lg nowrap rg"),
                    'url'=>'Yii::app()->controller->createUrl("descargar",array("id"=>$data->id))',
                    'visible'=>'$data->estado=="entregar"',
                ),
                /*'iniciarGrabacion' => array(
                    'label'=>'Iniciar Grabación',           
                    'options'=>array("class"=>"btn btn-primary btn-lg nowrap ig"),
                    'click' => 'function(){grabar($(this).attr("href"),1, $(this)); return false;}',
                    'url'=>'Yii::app()->controller->createUrl("get",array("id"=>$data->id))',
                    'visible'=>'$data->con_audio==0',
                ),
                'continuarGrabacion' => array(
                    'label'=>'Continuar Grabación',         
                    'options'=>array("class"=>"btn btn-primary btn-lg nowrap cg"),
                    'click' => 'function(){grabar($(this).attr("href"),0, $(this)); return false;}',
                    'url'=>'Yii::app()->controller->createUrl("get",array("id"=>$data->id))',
                    'visible'=>'$data->con_audio==1',
                ),
                'regrabar' => array(
                        'label'=>'Regrabar',
                        'options'=>array("class"=>"btn btn-primary btn-lg nowrap rg"),
                        'click' => 'function(){grabar($(this).attr("href"),1, $(this)); return false;}',
                        'url'=>'Yii::app()->controller->createUrl("get",array("id"=>$data->id))',
                        'visible'=>'$data->con_audio==1',
                ),
                'subirInforme' => array(
                        'label'=>'Informe',
                        'options'=>array("class"=>"btn btn-primary btn-lg nowrap rg"),
                        'click' => 'function(){informe($(this).attr("href"),1, $(this)); return false;}',
                        'url'=>'Yii::app()->controller->createUrl("get",array("id"=>$data->id))',
                        'visible'=>'$data->estado=="transcribir"',
                ),*/
                /*'asignarPaciente' => array(
                    'label'=>'Asignar Paciente',            
                    'options'=>array("class"=>"btn btn-primary btn-lg nowrap rg"),
                    'click' => 'function(){asignarPaciente($(this).attr("href"),$(this)); return false;}',
                    'url'=>'Yii::app()->controller->createUrl("get",array("id"=>$data->id))',
                    'visible'=>'$data->paciente_id!=null',
                ),*/
            )
        ),
    ),
)); 
?>
          
          <!-- Modal -->
          <div class="modal fade" id="iniciarGrabacion" tabindex="-1" role="dialog" aria-labelledby="iniciarGrabacionLabel" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Iniciar Grabacion</h4>
                </div>
                <div class="modal-body" style="height: 200px;">
                  <div id="wami" style="margin-left: 100px; height: 160px;"></div>
                  <!-- <div class="control-group  validating">
                    <label for="Usuario_email" class="control-label required">Asignar Paciente:
                        <input type="text" id="Usuario_email" name="Usuario[email]" prehold="@" maxlength="255" class="span3">
                        <span style="display: none" id="Usuario_email_em_" class="help-inline error"></span>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label'=>'Buscar',
                            //'size'=>'small',// null, 'large', 'small' or 'mini'
                            'url'=>'/paciente', 
                            ));  ?>
                    </label>
                  </div> -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="nuevo" value="0" />
                    <input type="hidden" name="eid" id="eid" value="" />
                    <input type="hidden" id="iid" value="" />
                    <input type="hidden" id="con_audio" value="0" />
                  <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
                  <button type="button" class="btn btn-success" onclick="listoTranscribir()">Listo para Transcribir</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          
          <!-- Modal -->
          <div class="modal fade" id="informe" tabindex="-1" role="dialog" aria-labelledby="iniciarGrabacionLabel" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Informe</h4>
                </div>
                <div class="modal-body" style="height: 200px;">
                  <div id="wami" style="margin-left: 100px; height: 160px;"></div>
                  <!-- <div class="control-group  validating">
                    <label for="Usuario_email" class="control-label required">Asignar Paciente:
                        <input type="text" id="Usuario_email" name="Usuario[email]" prehold="@" maxlength="255" class="span3">
                        <span style="display: none" id="Usuario_email_em_" class="help-inline error"></span>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label'=>'Buscar',
                            //'size'=>'small',// null, 'large', 'small' or 'mini'
                            'url'=>'/paciente', 
                            ));  ?>
                    </label>
                  </div> -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="nuevo" value="0" />
                    <input type="hidden" name="eid" id="eid" value="" />
                    <input type="hidden" id="iid" value="" />
                    <input type="hidden" id="con_audio" value="0" />
                  <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
                  <button type="button" class="btn btn-success" onclick="listoTranscribir()">Entregar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          
          
          <!-- Modal -->
          <div class="modal fade" id="AsignarPaciente" tabindex="-1" role="dialog" aria-labelledby="iniciarGrabacionLabel" aria-hidden="true" style="display:none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Asignar Paciente</h4>
                </div>
                <div class="modal-body" style="height: 200px;">
                  <div id="wami" style="margin-left: 100px;"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Asignar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
<div id='AjFlash' class="flash-success" style="display:none"></div>
<?php
}
?>


