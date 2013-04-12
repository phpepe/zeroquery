<?php
class MenuItem {
	
	/**
	 * 
	 * Enter description here ...
	 * @param MenuItem $a
	 * @param MenuItem $b
	 */
	static function compare($a, $b ) {
	    if ($a->order == $b->order) {
	        return 0;
	    }
	    return ($a->order < $b->order) ? -1 : 1;
	}
	
	/**
	 * Identifier like 'home' , 'about'
	 * @var string
	 */
	var $title;
	
	/**
	 * 
	 * Url to be linked. Can be absolute or relative.
	 * @var string 
	 */
	var $link;
	
	/**
	 * 
	 * If is the current page, active = true
	 * @var unknown_type
	 */
	var $active;
	
		 
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $order = null ; 
	
	/**
	 * 
	 * Pointer to corresponding Page object 
	 * @var Page
	 */
	var $page;
	
	/**
	 * Pointer to parent menu 
	 */
	var $menu ;
	
	
	var $target;
	


	function getPage() {
		return $this->page;
	}
	
	function __construct($file , $title, $link, $alias ,  $active = false, $order = null, $target = "_self" ) {
		global $CONF ;
		
		$this->file = $file ;
		$this->title = $title;
		$this->link = $link;
		$this->alias = $alias; 
		$this->active = $active;
		$this->order = $order ;
		
		/**
		 * 
		 * Pointer to corresponding Page object 
		 * @var Page
		 */
		$this->page = new Page ( $file, $alias  );
		
		$this->target = $target;
	
	}
	
	function buildOutput() {
		include TEMPLATE_PATH . "menu-item.php";
	}
}