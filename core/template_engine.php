<?php
function get_header() {
	global $page ;
	if ( file_exists(TEMPLATE_PATH."header.php") ){
		include_once TEMPLATE_PATH."header.php";
	}
		
}

function get_footer() {
	global $page ;
	if ( file_exists(TEMPLATE_PATH."footer.php") ){
		include_once TEMPLATE_PATH."footer.php";
	}
	
}


function get_sidebar(){}

function get_search_form(){}

function get_page(){
	global $page ;
	$page->output() ;
}

function get_menu() {
	global $main_menu ;
	$main_menu->output() ;
}


function get_page_id() {
	global $page ;
	echo $page->id ;
}