<?php
// TODO Move all core functions to here and deprecate plugin_engine


function baseurl() {
	$protocol = ! empty ( $_SERVER ['HTTPS'] ) ? "https" : "http";
	return rtrim ( $protocol . "://" . $_SERVER ['HTTP_HOST'] . dirname ( $_SERVER ['SCRIPT_NAME'] ), "/" );
}

function load_libraries() {
	global $CONF;
	if (! empty ( $CONF ['libraries'] )) {
		foreach ( $CONF ['libraries'] as $library ) {
			$file = ROOT . "/libraries/$library.php";
			if (file_exists ( $file )) {
				include_once $file;
			}
		}
	}
}

function is_mobile() {
	static $is_mobile = null ;
	if ( $is_mobile === null ) {
		if (isset($_REQUEST['nomobile'])){
			$_SESSION['nomobile'] = true; 
			header("Location:". BASE_URL );
		}else if ( isset($_SESSION['nomobile']) ){
			 return false ; 
		}else{
			if ( class_exists("Mobile_Detect") ) {
				$detect = new Mobile_Detect();
				$is_mobile = $detect->isMobile() ;
			}else{
				$is_mobile = false ; 
			}
		}
	}
	return $is_mobile ;
}