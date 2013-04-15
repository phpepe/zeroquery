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
	
	/**
	 * @return the $items
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param unknown_type $items
	 */
	public function setItems($items) {
		$this->items = $items;
	}

	/**
	 * @param NULL $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	function output($render_subpages = true) {
 
		if ($this->output) return $this->output;
		usort($this->items, "MenuItem::compare") ;
		foreach ( $this->items as $item ) {
			if ($item->order !== false ){
				$this->output .= $item->buildOutput ();
			}
			/*
			if ($render_subpages  && count($item->children)) {
				$this->output .= '<li class="subpages"><ul>';
				foreach ($item->children as $subitem) {
					$this->output .= $subitem->buildOutput ();
				}
				$this->output .= '</li></ul>';
			}
			*/
		}
		return $this->output;
	}
	
	/**
	 * 
	 * Finds the item with name $i in the menu tree
	 * @param $i
	 * @return MenuItem
	 */
	function getItem($i, $parent=null) {
		if ($parent ===  null) {
			if (isset($this->items[$i])){
				return $this->items[$i];		
			}else{
				throw new Exception("Item '$i' Not found");
			}
		}else{
			//var_dump($parent);
			//var_dump($this->items);
			if (isset($this->items[$parent]) && isset($this->items[$parent]->children) ){
				
				foreach ( $this->items[$parent]->children as $child ) {
					if ($child->getPage()->alias == $i) {
						return $child ;
					}
				}
			}
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