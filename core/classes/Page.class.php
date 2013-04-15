<?php



class Page  {
	
	var $path ;
	
	var $alias ;
	
	var $id ;
	
	var $css = null ; 
	
	var $content ; 
	
	var $menuItem ;
	
	function __construct($path = null , $alias = null, $id = null ) {
		$this->alias = $alias ;		
		$this->path = "content/pages/$path/";
		$this->id = ($id) ? $id : $alias ;
	}
	
	
	/**
	 * @return the $path
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @return the $alias
	 */
	public function getAlias() {
		return $this->alias;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $css
	 */
	public function getCss() {
		return $this->css;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @return the $menuItem
	 */
	public function getMenuItem() {
		return $this->menuItem;
	}

	/**
	 * @param string $path
	 */
	public function setPath($path) {
		$this->path = $path;
	}

	/**
	 * @param field_type $alias
	 */
	public function setAlias($alias) {
		$this->alias = $alias;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param NULL $css
	 */
	public function setCss($css) {
		$this->css = $css;
	}

	/**
	 * @param field_type $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @param field_type $menuItem
	 */
	public function setMenuItem($menuItem) {
		$this->menuItem = $menuItem;
	}

	function output() {
		if (is_mobile() && file_exists($this->path."index.mobile.php")) {
			include_once $this->path."index.mobile.php" ;		
		}else{
			include_once $this->path."index.php" ;
		}
		
	} 
	
	function getSubmenu() {
		$submenu =  new Menu() ;
		if ($menuItem = $this->getMenuItem()) {
			foreach ($menuItem->children as $child) {
				$submenu->addItem($child);
			}
		}
		return $submenu ;
	}
	

	function css() {
		$dir = $this->path."css";
		if (is_dir($dir)) {
			if ($handle = opendir ( $dir )) {
				while ( false !== ($file = readdir ( $handle )) ) {		
					$parts = explode(".", $file) ;
					if ( $file != "." && $file != ".." && end($parts) == "css") {	
						echo '<link rel="stylesheet" href="'.$dir."/".$file .'" type="text/css" media="screen">';
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
