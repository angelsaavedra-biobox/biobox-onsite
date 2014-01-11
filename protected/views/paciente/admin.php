<h2>Administrar Pacientes</h2>

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'paciente-grid',
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
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{registro}',
            'buttons'=>array(
                'registro'=> array(
                    'label'=>'Imprimir Registro',           
                    'options'=>array(
                        "class"=>"btn nowrap",
                        "target"=>'_blank',
                    ),
                    #'click' => 'function(){ver($(this).attr("href")); return false;}',
                    'url'=>'Yii::app()->controller->createUrl("paciente/registro/$data->cuil")',
                ),
            )
        ),
		'cuil',
		'nombre',
		'apellido',
		'nacimiento',
		'alta',
		'registro',
        array(
            'name'=>'sexo',
            'value'=>'Paciente::getSexos($data->sexo)',
            'filter'=>Paciente::getSexos()
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
		),
	),
));
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'Agregar Paciente',
		'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'url'=>array('create'), // null, 'large', 'small' or 'mini'
)); ?>
