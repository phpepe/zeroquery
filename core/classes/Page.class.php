<?php



class Page  {
	
	var $path ;
	
	var $alias ;
	
	var $id ;
	
	var $css = null ; 
	
	var $content ; 
	
	function __construct($path = null , $alias = null, $id = null ) {
		$this->alias = $alias ;		
		$this->path = "content/pages/$path/";
		$this->id = ($id) ? $id : $alias ;
	}
	function output() {
		if (is_mobile() && file_exists($this->path."index.mobile.php")) {
			include_once $this->path."index.mobile.php" ;		
		}else{
			include_once $this->path."index.php" ;
		}
		
	} 
	

	function css() {
		$dir = $this->path."css";
		if (is_dir($dir)) {
			if ($handle = opendir ( $dir )) {
				while ( false !== ($file = readdir ( $handle )) ) {		
					$parts = explode(".", $file) ;
					if ( $file != "." && $file != ".." && end($parts) == "css") {	
						echo 	'<link rel="stylesheet" href="'.$dir."/".$file .'" type="text/css" media="screen">';
					}				 
				}
				closedir ( $handle );
			} 
		}
	}
	
	
	function js() {
		$dir = $this->path."js";
		if (is_dir($dir)) {
			if ($handle = opendir ( $dir )) {
				while ( false !== ($file = readdir ( $handle )) ) {		
					$parts = explode(".", $file) ;
					if ( $file != "." && $file != ".." && end($parts) == "js") {	
						echo '<script src="'.$dir.'/'.$file.'"></script> ';
						
					}				 
				}
				closedir ( $handle );
			} 
		}
	}
	
	
}
