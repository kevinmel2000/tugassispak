<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php
        // force include css gridview
        $baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
        Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css'); 
        
		// admin layout
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin/admin.css', 'screen, projection');
        
        // fuzzy css
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin/fuzzy.css', 'screen, projection');
		
		// default yii css 
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css', 'screen, projection');
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/form.css', 'screen, projection');
        
		// register jquery
		Yii::app()->clientScript->registerCoreScript('jquery');
		
		// include ddaccordian css and js
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/ddaccordian/ddaccordian.css', 'screen, projection');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/ddaccordian/ddaccordion.js', 0);
        
	?>
	
	<script type="text/javascript">
		/***********************************************
		* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
		* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
		* This notice must stay intact for legal use
		***********************************************/
		ddaccordion.init({
			headerclass: "expandable", //Shared CSS class name of headers group that are expandable
			contentclass: "categoryitems", //Shared CSS class name of contents group
			revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
			mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
			collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
			defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
			onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
			animatedefault: false, //Should contents open by default be animated into view?
			persiststate: true, //persist state of opened contents within browser session?
			toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
			togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
			animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
			oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
				//do nothing
			},
			onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
				//do nothing
			}
		})
	</script>
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
			var xPaddingMargin = 41;
			var sidebarLogoHeight = 41;
            var xPaddingLogo = 42;
			
			// set content height
			var mainContentHeight = bodyHeight - (headerHeight + footerHeight + xPaddingMargin);
			$("#wrapped_content").height(mainContentHeight);
			
			/// set sidebar height
			var leftSideBar = bodyHeight - (sidebarLogoHeight + footerHeight);
			$("#left_sidebar").height(leftSideBar);
            
            var arrowlistmenu = leftSideBar - sidebarLogoHeight + xPaddingLogo ;
            $(".arrowlistmenu").height(arrowlistmenu);
		}
	</script>
</head>

<body>
<div id="wrapper">

<div id="header">
	<div id="header_logo">
		<div id="logo_text">
			<a href="#"> Gen Sistem Pakar</a>
		</div>
	</div>
	<div id="module_name">
		<a href="#"> 
            <?php echo isset($this->moduleName) ? $this->moduleName : ""; ?>
        </a>
	</div>
    <div id="user_short_info">
        <a href="<?php echo Yii::app()->createUrl('appUser/profile') ?>">
            <span class="icon_user"></span>
                <?php 
                    echo isset(Yii::app()->user->name) ?  Yii::app()->user->name : ""; 
                    echo isset(Yii::app()->user->userLevelName) ?  '('.Yii::app()->user->userLevelName.')': ""; 
                ?>
        </a>
        |
        <a href="<?php echo Yii::app()->createUrl('userAuth/logout') ?>" onclick="return confirm('Are you sure to logout?');">
            <span class="icon_logout"></span>
            Logout
        </a>
    </div>
</div>

<div id="left_sidebar">
	<div id="left_sidebar_container">
		<div class="arrowlistmenu">
			<h3 class="menuheader expandable">
				<span class="icon_app">
					Home
				</span>
			</h3>
			<ul class="categoryitems">
<!--                <li><a href="<?php echo Yii::app()->createUrl('appUser/index') ?>">Home</a></li>-->
				<li><a href="<?php echo Yii::app()->createUrl('appUser/profile') ?>">Profile</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('appUser/changePasswd') ?>">Change Password</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('userAuth/logout') ?>" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
			</ul>
            
            <?php foreach($this->modules as $module): ?>
			<h3 class="menuheader expandable">
				<span class="icon_app">
					<?php echo $module->name; ?>
				</span>
			</h3>
			<ul class="categoryitems">
				<?php if(isset($module->childs) && count($module->childs) > 0): ?>
					<?php foreach($module->childs as $subModule): ?>
						<li><a href="<?php echo Yii::app()->createUrl($subModule->url); ?>"><?php echo $subModule->name ?></a></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
            <?php endforeach; ?>
		</div>
	</div>
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
