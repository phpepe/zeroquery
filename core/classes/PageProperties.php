<?php

	class PageProperties {
		
		private $pageDir;
		private $props;
		
		
		public function __construct($pageDir) {
			if ($pageDir != "") {
				$this->pageDir = $pageDir;
				$this->readProperties();		
			}			
		}
				
		
		private function readProperties() {
			if ($handle = opendir($this->pageDir)) {
				while (false !== ($file = readdir($handle))) {
	        		if (sizeof(explode('.', $file) > 0)) {
						$file_name = explode('.', $file);
						if (end($file_name) == "props") {
							$this->parseProperties($file);
						}
					}
	    		}
			}
		}
		
		
		private function parseProperties($propsFile) {
			$file_handle = fopen($this->pageDir . "/" . $propsFile, "r");
			while (!feof($file_handle)) {
				$line = fgets($file_handle);
   				$this->parseProperty($line);
			}
			fclose($file_handle);
		}
		
		
		private function parseProperty($propLine) {
			if (strpos($propLine, '#') === false) {
				$key = substr($propLine, 0, strrpos($propLine, '='));
				$val = substr($propLine, strrpos($propLine, '=') + 1);
				$this->props[$key] = $val;
			}
		} 
		
		
		public function prop($prop) {
			if (isset($this->props[$prop])) {
				return $this->props[$prop];
			}
			return null;
		}
		
		
		public function isExternalLink() {
			return (isset($this->props["source"]) && 
					$this->props["source"] != "native");
		}
	} 