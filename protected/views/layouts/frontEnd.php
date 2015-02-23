<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php	
		// admin layout
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin/login.css', 'screen, projection');
		
		// default yii css 
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css', 'screen, projection');
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/form.css', 'screen, projection');
        
        // bootstrap
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.min.css', 'screen, projection');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap.min.js', 0);
        
        // frontEnd 
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/frontEnd.css', 'screen, projection');
        
        // slider
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-slider.css', 'screen, projection');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap-slider.js', 0);
        
        // register jquery
		Yii::app()->clientScript->registerCoreScript('jquery');
	?>
    
  
</head>

<body>
<div id="wrapper">

<div id="content_container">
<?php 
	// main content
	echo $content; 
?>
</div>
    

</div>

</body>
</html>
