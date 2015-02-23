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
        
        // register jquery
		Yii::app()->clientScript->registerCoreScript('jquery');
	?>
    
    <script type="text/javascript">
		// on page load set height
		$(document).ready(function() 
		{
			resize();
		});
		
		// on window resize reset height
		$(window).resize(function() 
		{
			resize();
		});
		
		function resize()
		{
			var bodyHeight = document.body.offsetHeight;
			
            //alert("body height : " + bodyHeight);
			var headerHeight = 40 + 10;
			var footerHeight = 34;
			var xPaddingMargin = 82;
			
			// set content height
			var mainContentHeight = bodyHeight - (headerHeight + footerHeight + xPaddingMargin);
			$("#wrapped_content").height(mainContentHeight);
		}
	</script>
</head>

<body>
<div id="wrapper">

<div id="header">
</div>

<div id="content_container">
<?php 
	// main content
	echo $content; 
?>
</div>
    
    
<div id="footer">
    <div id="footer_container">
       Copyright 2013 AR
    </div>
</div>    

</div>

</body>
</html>
