<?php 

/**
 * 
 * Enter description here ...
 * @author pepe
 *
 */
class Router {
	
	/**
	 * @var string
	 */
	var $current_page = null ;

	/**
	 * @var string
	 */
	var $parent_page = null ;
	
	/**
	 * Home page canonical name
	 * @var string
	 */
	var $home = null ;
	
	
	/**
	 * Reference to site main menu 
	 * @var Menu
	 */
	var $main_menu ;
	


	/**
	 * @return the $current_page
	 */
	public function getCurrentPageCanonical() {
		global $CONF ;
		if ($this->current_page) {
			return $this->current_page ;
		}elseif ($CONF['home']){
			return $CONF['home'];
		}else {
			return "home" ;
		}
	}
	
	/**
	 * @return the $current_page
	 */
	public function getParentPageCanonical() {
		if ($this->parent_page) {
			return $this->parent_page ;
		}
		return null;
	}

	/**
	 * @return string
	 */
	public function getHome() {
		return $this->home;
	}

	/**
	 * @return Menu
	 */
	public function getMainMenu() {
		return $this->main_menu;
	}

	/**
	 * @param Page $current_page
	 */
	public function setCurrentPage($current_page) {
		$this->current_page = $current_page;
	}

	/**
	 * @param string $home
	 */
	public function setHome($home) {
		$this->home = $home;
	}

	/**
	 * @param Menu $main_menu
	 */
	public function setMainMenu($main_menu) {
		$this->main_menu = $main_menu;
	}

	function __construct() {
		if(!isset($_GET['p'])) return ;
		$args = explode("/", $_GET['p'] ) ;				
		if ( count($args) ){
			$this->current_page = end($args) ;
		} 
		if (count($args) == 2) {
			$this->parent_page = $args[0] ;
		}
	}
	
}