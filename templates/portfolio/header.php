<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>MinCMS - The easyest way to build your site</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    			
    <!--[if IE]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!--[if IE 7]>
    	<link rel="stylesheet" href="ie7.css" type="text/css" media="screen" />
    <![endif]-->
    
    <link rel="stylesheet" href="<?php echo TEMPLATE_PATH ?>style.css" type="text/css" media="screen" />
    <?php $page->css();?> <!-- Include page specific css -->
    <script src="<?php echo TEMPLATE_PATH ?>js/jquery.min.js" type="text/javascript"></script>
	<?php $page->js() ?> <!-- include page specific js -->
    
</head>

<body>

    <header> <!-- HTML5 header tag -->
    
    	<div id="headercontainer">
        	<h1><a class="introlink anchorLink" href="">MINCMS - Min Is Not CMS</a></h1>
    		<nav> <!-- HTML5 navigation tag -->
    			<ul>
					<?php get_menu() ?>
    			</ul>				
    		</nav>
    	
    	</div>
    
    </header>

    <section id="contentcontainer"> <!-- HTML5 section tag for the content 'section' -->    
    	<section id="<?php get_page_id();?>">
		