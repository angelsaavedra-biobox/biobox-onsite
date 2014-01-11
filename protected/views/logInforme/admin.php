<h2>Log de informes</h2>

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'log-informe-grid',
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
		'id',
		'informe_id',
		array(
			'name'=>'fecha',
			'value'=>'date("d/m/Y H:i:s", strtotime($data->fecha))',
			'filter'=>'',
		),
		'estado',
		array(
			'name'=>'usuario_id',
			'value'=>'$data->usuario->username',
		),
		array(
			'name'=>'nombre_completo',
			'header'=>'Nombre Completo',
			'value'=>'$data->usuario->nombre_completo',
		),
	),
)); ?>
