<?php 
	session_start();
	
	global $CONF ;
	global $page ;
	define ('TEMPLATES_PATH',"templates/") ;
	define ('TEMPLATE_PATH', TEMPLATES_PATH."/".$CONF['template']."/") ;
	define ('BASE_URL', baseurl());
	load_libraries();
	fire('before_process');
	
	$pages_dir = "content/pages/" ;
	$content = new Content ();
	$main_menu = new Menu();
	$main_menu->name = "mainMenu" ;
	
	// Scan pages files 
	$first = true ; // If some elem needs special code
	if ($handle = opendir ( $pages_dir )) {
		while ( false !== ($file = readdir ( $handle )) ) {				
			if (is_dir($pages_dir.$file) && $file != "." && $file != ".." && substr($file,0,1) != "." ) {
	
				$title = trim(substr(strstr($file,'.'),1));
				$alias = strtolower($title);
				$order = (int)substr($file,0,strpos($file,"."));
				
				$link = (!empty($_SERVER['FRIENDLY_URLS'])) ? BASE_URL."/".strtolower($alias) : BASE_URL."?p=".$alias ;
				
				if ( strtolower($alias) == $CONF['home'] ) {
					$link = BASE_URL ;
				};
				
				$item = new MenuItem ($file, $title, $link, $alias , 0 , $order );	
				
				
				$pageProps = new PageProperties($pages_dir . $file);
				
				if ($pageProps->isExternalLink()) {
					$item->link = $pageProps->prop("source");
					$item->target = $pageProps->prop("target");
				}
								
				$main_menu->addItem( $item );
				
				$first = false;
			}				 
		}
		closedir ( $handle );
	}
	fire('after_process');
	
	// Load Template
	$menu_item = $main_menu->getItem($content->getCurrentPage());
	$menu_item->active = true;
	if ($menu_item) {
		$page = $menu_item->getPage() ;
		if (is_mobile() && file_exists( TEMPLATE_PATH."/index.mobile.php" )){
			include_once TEMPLATE_PATH."/index.mobile.php" ;
		}else{
			include_once TEMPLATE_PATH."/index.php" ;
		}
	}else {
		
		$page = new Page();
		include_once TEMPLATE_PATH."/404.php" ;	
	}

