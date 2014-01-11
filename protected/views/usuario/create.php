<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear',
);
?>

<h1>Crear Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>