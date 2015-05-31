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
	include_once("../include/class.Post.php");
	include_once("../include/class.ErrorLogger.php");
	//Reading users/password and userchecking
	// return a var ($control) false, if checking is not passed!
	include("../include/config.php");

	
	//Acquiring Data only from POST method
	$title=$_POST['title'];
	$msg=$_POST['message'];
	//the $control var assigned by config.php script!
	if($control){
		$post= new Post(0,$title,$msg,"../db/posts",$username/*assigned in config.php*/);
		echo $post->save();
	}else{
			//Uncomment to log 
			//*
			$error=new ErrorLogger("Poster auth failure","../db/logs");
			$error->writeToLog();
			//*/
			
			echo "Authentication error! This incident will be reported!\n";
	}

?>
