<h2>Administrar Usuarios</h2>

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'usuario-grid',
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
		'username',
		'nombre_completo',
		'email',
		array(
			'name'=>'rol',
			'value'=>'Usuario::getRoles($data->rol)',
			'filter'=>Usuario::getRoles()
		),
		array(
			'name'=>'activo',
			'value'=>'Usuario::getEstados($data->activo)',
			'filter'=>Usuario::getEstados()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update} {delete}'
		),
	),
)); 


$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'Agregar Usuario',
		'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'url'=>array('create'), // null, 'large', 'small' or 'mini'
));
?>