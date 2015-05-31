<?php

class Pagerender{
		var $myattr;
		var $utf;
		
		function __construct($list=array('head'=>true,'content'=>true,'menu'=>true,'footer'=>true),$encodeutf=true){
			if((count($list))==4) $this->myattr=$list;
			$this->utf=$encodeutf;
		}
		
		function run($content=""){
			$blogtitle=file_get_contents('template/title.txt');
			$head=file_get_contents('template/header.txt');
			$footer=file_get_contents('template/footer.txt');
			$bar=file_get_contents('template/bar.txt');
			
			if($this->utf) header('content-type: text/html; charset: utf-8');
			echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	
<head>
	<title>$blogtitle</title>
	<link rel="stylesheet" href="./template/style.css" type="text/css" />
	<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="./js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
	<script src="./js/utilfunc.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="./js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="./js/jquery.notifyBar.css" type="text/css" media="screen"  />
	
</head>
<body>
	<div id="all">
EOF;
			
			if($myattr['head']) echo <<<EOF
			<div id="header">
				$head
			</div>
EOF;
			if($myattr['content']) echo $content;
		}

}
?>
