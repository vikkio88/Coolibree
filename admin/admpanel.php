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
//Coolibre admin panel
//simple panel usefull for posting editor and other stuff!
include_once('../include/class.ErrorLogger.php');
//Reading users/password and userchecking
include('../include/class.Loginchecker.php');


	$us=new Vargetter('u');
	$pw=new Vargetter('p');
	$save=new Vargetter('save');
	$save=$save->val();
	$login = new Loginchecker($us->val(),$pw->val());
	$control=$login->isDone();

$times=$_POST['times'];


if($control){
	
	$page=<<<EOP
<head><title>Coolibree Admin Panel</title>
<link rel="stylesheet" href="../js/jquery.notifyBar.css" type="text/css" media="screen" /></head>
<script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.notifyBar.js"></script>
<script src="./adminutils.js" type="text/javascript"></script>
<body onload="load()">
<div style="margin: auto; border: 2px solid #000; width: 850px;">
<div style="text-align:center;">
<img src="../img/banner.png" alt="coolibreelogo"/>
<h2 style="text-align:center">online admin panel</h2></div>
<div style="margin: 30px;">
EOP;
	
	$page.="You are logged as:<strong> <span id=\"user\">".$us->val()."</span></strong> <span style=\"font-size:0.8em\"><a href=\"#\" onclick=\"logout()\">logout[X]</a></span>";
	
	$page.=<<<EOP2
<div>
Things you can do:<br />
<input type="button" onclick="new_post()" value="New Post"> <input type="button" onclick="edit_post()" value="Edit Post"> <input type="button" onclick="del_post()" value="Delete Post"> <input type="button" onclick="view_logs('')" value="View Logs"> <input type="button" onclick="edit_template()" value="Edit Template">
</div><div id="notification"></div>
<div id="target"></div>
</div>
</div>
EOP2;

	if($save==NULL){
		$page.="</body>";
	}else{
		$page.="<span style=\"visibility:hidden\" id=\"savedpwd\">".$pw->val()."</span></body>";
	}
	echo $page;
	
}else{
	//*
	$error=new ErrorLogger("Trying to access admin panel","../db/logs");
	$error->writeToLog();
	//*/
	$times+=1;
	echo "<script>\n";
	echo "setTimeout(\"location.href=\'./index.php?t=".$times."\', 3*1000 \");\n</script>";
}

?>
