<?php
/**# CoolibreeCMS
	#
	# copyleft by vikkio88 <vikkio88@yahoo.it>
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	# visit: http://vikkio88.altervista.org
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *  # This file is part of CoolibreeCMS
 *  #
	#   This program is free software: you can redistribute it and/or modify
	#   it under the terms of the GNU General Public License as published by
	#   the Free Software Foundation, either version 3 of the License, or
	#   (at your option) any later version.
	#   This program is distributed in the hope that it will be useful,
	#   but WITHOUT ANY WARRANTY; without even the implied warranty of
	#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	#   GNU General Public License for more details.
	#
	#   You should have received a copy of the GNU General Public License
	#   along with this program.  If not, see <http://www.gnu.org/licenses/>.
* 
* */
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
