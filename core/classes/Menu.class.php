<?php


class Menu  {
	
	var $output ;
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $items = array ();
	
	/**
	 * Identifier of the menu
	 */
	var $name =  null ;
	
	private $_items_index = array ();
	
	function output() {
 
		if ($this->output)
			return $this->output;
		usort($this->items, "MenuItem::compare") ;
		foreach ( $this->items as $item ) {
			if ($item->order !== false ){
				$this->output .= $item->buildOutput ();
			}
		}
		return $this->output;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $i
	 * @return MenuItem
	 */
	function getItem($i) {
		if (isset($this->items[$i])){
			return $this->items[$i];		
		}else{
			return null;
		}
	
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $item MenuItem
	 */
	function addItem(&$item) {
		global $CONF ; 
		$this->items [$item->alias] = $item;
		$item->menu = $this ;
	}

}