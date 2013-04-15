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
	 * Pointer to corresponding Page object 
	 * @var Page
	 */
	var $page;
	
	/**
	 * Pointer to parent menu 
	 */
	var $menu ;
	
	/**
	 * Pointer to parent menu item if existes
	 * Null if is a root menu item
	 * @var MenuItem
	 */
	var $parent;
	
	/**
	 * 
	 * @var array
	 */
	var $children ;

	function getPage() {
		return $this->page;
	}
	
	function __construct($file , $title, $link, $alias ,  $active = false, $order = null, $parent = null ) {
		global $CONF ;
		
		$this->file = $file ;
		$this->title = $title;
		$this->link = $link;
		$this->alias = $alias; 
		$this->active = $active;
		$this->order = $order ;
		$this->parent = null ;
		$this->children = array();
		
		/**
		 * 
		 * Pointer to corresponding Page object 
		 * @var Page
		 */
		$this->page = new Page ( $file, $alias  );
		$this->page->setMenuItem($this);
	
	}
	
	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * @return the $active
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @return the $order
	 */
	public function getOrder() {
		return $this->order;
	}

	/**
	 * @return the $menu
	 */
	public function getMenu() {
		return $this->menu;
	}

	/**
	 * @return the $parent
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * @return the $children
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * @param unknown_type $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @param unknown_type $order
	 */
	public function setOrder($order) {
		$this->order = $order;
	}

	/**
	 * @param Page $page
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * @param field_type $menu
	 */
	public function setMenu($menu) {
		$this->menu = $menu;
	}

	/**
	 * @param MenuItem $parent
	 */
	public function setParent($parent) {
		$this->parent = $parent;
	}

	/**
	 * @param multitype: $children
	 */
	public function setChildren($children) {
		$this->children = $children;
	}

	/**
	 * @param MenuItem $item
	 */
	function addChild(MenuItem $item) {
		$item->parent = $this ;
		array_push($this->children, $item);
	}
	
	function buildOutput() {
		// @TODO check if exists and add a default implementation if not found
		include TEMPLATE_PATH . "menu-item.php";
	}
}