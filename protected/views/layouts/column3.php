<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<?php #echo AHtml::ngOpenApp('biobox'); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/biobox.css" />
</head>

<body onload="window.print()">

<?php echo $content; ?>

</body>
</html>