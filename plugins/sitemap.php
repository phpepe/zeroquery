<?php
function sitemap_after_process() {
	if (isset ( $_GET ['p'] ) && $_GET ['p'] == 'sitemap.xml') {
		global $main_menu;
		$out = '<?xml version="1.0" encoding="UTF-8"?>';
		$out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ( $main_menu->items as $item ) {
			$out.="<url>";
			$out.="<loc>".$item->link."</loc>";
			$out.="<changefreq>weekly</changefreq>";
			$out.='<priority>1</priority>';
			$out.="</url>";
		}
		$out .= '</urlset>';
		header ( "Content-Type: application/xml" );
		echo $out;
		exit ();
	}
}