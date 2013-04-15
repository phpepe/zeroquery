<?php 
	session_start();
	
	global $CONF ;
	global $page ;
	define ('TEMPLATES_PATH',"templates") ;
	define ('TEMPLATE_PATH', TEMPLATES_PATH."/".$CONF['template']."/") ;
	define ('BASE_URL', baseurl());
	load_libraries();
	fire('before_process');
	
	$pages_dir = "content/pages/" ;
	$router = new Router();
	$main_menu = new Menu();
	$main_menu->name = "mainMenu" ;
	
	// Scan pages files 
	$first = true ; // If some elem needs special code
	if ($handle = opendir ( $pages_dir )) {
		while ( false !== ($file = readdir ( $handle )) ) {				
			if (is_dir($pages_dir.$file) && $file != "." && $file != ".." && substr($file,0,1) != "." ) {
				$current_page_dir = $pages_dir.$file ;
				$title = trim(substr(strstr($file,'.'),1));
				$alias = strtolower($title);
				$order = (int)substr($file,0,strpos($file,"."));
				$link = (!empty($_SERVER['FRIENDLY_URLS'])) ? BASE_URL."/".strtolower($alias) : BASE_URL."?p=".$alias ;
				if ( strtolower($alias) == $CONF['home'] ) {
					$link = BASE_URL ;
				};
				$item = new MenuItem ($file, $title, $link, $alias , 0 , $order );					
				$main_menu->addItem( $item );
				
				// Scan Subpages
				$subpages_container_dir = $current_page_dir."/pages/" ;
				if (is_dir($subpages_container_dir)) {
					if ($handle2 = opendir ($subpages_container_dir )) {
						while ( false !== ($file2 = readdir ( $handle2 )) ) {
							$subpage_dir= $subpages_container_dir.$file2 ;
							if (is_dir($subpage_dir) && $file2 != "." && $file2 != ".." && substr($file2,0,1) != "." ) {
								$title = trim(substr(strstr($file2,'.'),1));
								$alias = strtolower($title);
								$order = (int)substr($file2,0,strpos($file,"."));
								$link = (!empty($_SERVER['FRIENDLY_URLS'])) ? BASE_URL."/".strtolower($item->alias)."/".strtolower($alias) : BASE_URL."?p=".strtolower($item->alias)."/".strtolower($alias) ;		
								$subpage_item = new MenuItem ($file."/pages/".$file2, $title, $link, $alias , 0 , $order );
								$item->addChild($subpage_item);
							}
						}
					}
				}
				
				$first = false;
			}				 
		}
		closedir ( $handle );
	}
	fire('after_process');
	
	// Load Template
	$menu_item = $main_menu->getItem($router->getCurrentPageCanonical(),$router->getParentPageCanonical() );
	
	$menu_item->active = true;
	if ($menu_item instanceof MenuItem) {
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

