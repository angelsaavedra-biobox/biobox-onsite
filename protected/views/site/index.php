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
?>
<p>Bienvenido </p>
<?php
}
?>


