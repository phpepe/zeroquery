<?php 


function fire($event){
	global $CONF ;
	if (!empty($CONF['plugins'])){
		foreach ($CONF['plugins'] as $plgname) {
			include_once ROOT."/plugins/".$plgname.".php"; 
			$functionName = $plgname."_".$event;
			if ( function_exists($functionName) )  {
				return call_user_func($functionName);
			}
		}
	}
}