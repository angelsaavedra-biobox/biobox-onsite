<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<?php #echo AHtml::ngOpenApp('biobox'); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
	
	<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.printElement.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/biobox.css" />
</head>

<body>

<?php 
if(Yii::app()->user->isGuest) {
	$this->widget('bootstrap.widgets.TbNavbar',array(
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'items'=>array(
	                array('label'=>'Inicio', 'url'=>array('/site/index')),
	                array('label'=>'Acerca de BioBox', 'url'=>array('/site/page', 'view'=>'about')),
	                array('label'=>'Identificarse', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	            ),
	        ),
	    ),
	)); 
} else {
	$this->widget('bootstrap.widgets.TbNavbar',array(
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'items'=>array(
                    array('label'=>'Informes', 'url'=>array('/informe/index')),
	            	array('label'=>'Configuración', 'visible'=>Yii::app()->user->isUsuario(), 'items'=>array(
						array('label'=>'Usuarios', 'visible'=>Yii::app()->user->isAdmin(), 'url'=>array('/usuario/index')),
						array('label'=>'Pacientes', 'visible'=>Yii::app()->user->isUsuario(), 'url'=>array('/paciente/index')),
						array('label'=>'Log Informes', 'visible'=>Yii::app()->user->isUsuario(), 'url'=>array('/logInforme/index')),
						)
					),
	                array('label'=>'Salir ('.Yii::app()->user->getNombre().')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
	            ),
	        ),
	    )
	)); 
}


?>

<div class="contenedor" id="page">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	<?php # echo Yii::app()->params->adminEmail ?>
	</div><!-- footer -->

</div><!-- page -->
</body>
<?php
#echo AHtml::closeTag('html');

// use AngularJS widget to embed script files
#$this->widget('ext.AngularJS');
?>
</html>
