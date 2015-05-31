<?php
//modify.php
//this script make you able to modify css template and other stuff!

include_once("../include/class.ErrorLogger.php");
include("../include/config.php");

$style=stripslashes($_POST['style']);
$header=stripslashes($_POST['header']);
$bar=stripslashes($_POST['bar']);
$footer=stripslashes($_POST['footer']);

if($control){
		
	$f=fopen("./style.css","w");
	fwrite($f,$style);
	fclose($f);
	
	$f1=fopen("./bar.txt","w");
	fwrite($f1,$bar);
	fclose($f1);
	
	$f2=fopen("./footer.txt","w");
	fwrite($f2,$footer);
	fclose($f2);
	
	$f3=fopen("./header.txt","w");
	fwrite($f3,$header);
	fclose($f3);
	
	echo "Template successfull modified!\n";
}else{
		$error=new ErrorLogger("Try to modify style","../db/logs");
		$error->writeToLog();
		echo "Autherror! this incident will be reported!\n";
}

?>
