<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Bienvenido a '.CHtml::encode(Yii::app()->name),
)); ?>

<p></p>

<?php $this->endWidget(); ?>


