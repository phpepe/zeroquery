<?php 

/**
 * 
 * Enter description here ...
 * @author pepe
 *
 */
class Content {
	/**
	 * 
	 * Enter description here ...
	 * @var Page
	 */
	var $current_page = null ;
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $home = null ;
	
	
	/**
	 * 
	 * Enter description here ...
	 * @var Menu
	 */
	var $main_menu ;
	

	
	
	/**
	 * @return the $current_page
	 */
	public function getCurrentPage() {
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
	 * @return the $home
	 */
	public function getHome() {
		return $this->home;
	}

	/**
	 * @return the $main_menu
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
	 * @param unknown_type $home
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
			$this->current_page = $args[0] ;				
		} 
	}
	
}