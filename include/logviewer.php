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

include_once('./class.ErrorLogger.php');
	//Reading users/password and userchecking
	include('class.Loginchecker.php');
	$us=new Vargetter('u');
	$pw=new Vargetter('p');
	$login = new Loginchecker($us->val(),$pw->val());
	$control=$login->isDone();
	
if($control){
		$f=file_get_contents('../db/logs/logs.php');
		$f=str_replace('|*|','<br /><br />',$f);
		$f=str_repeat('<?php','',$f);
		$f=str_repeat('?>','',$f);
		echo $f;
}else{
	$error=new ErrorLogger('Try to access log','../db/logs');
	$error->writeToLog();
	echo 'Logs view is for admin only!Incident reported';
}
?>
