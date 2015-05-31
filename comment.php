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
//comment.php
//this script will get userinput for validate and lets comments posts
include_once('./include/class.ErrorLogger.php');
include_once('./include/class.Comment.php');
include_once('./include/class.Post.php');

//simple var for input checking
$checkingvar=TRUE;
//variable that show error to user
$error='';

//getting post's id to comment
$id_post=(int)$_POST['id'];


//getting userinputs
	$nick=  $_POST['nick'];
	$email= $_POST['email'];
	$site=  $_POST['site'];
	$msg=   $_POST['msg'];
//the input validation is a Comment class task don't warry :D

/*Testing var
$id_post=(int)"1284125468";
$nick=  "vikkio";
$email= "vikkio@ioso.it";
$site=  "";
$msg="ciao mi chiamo mario";
//*/



//AntibotChecking
$antibot=$_POST['antibot'];
//
$correct=$_COOKIE['capt'];


if($correct!=""){
	
	$salt="salt"; //must be the same that in ./img/image.php file
	$antibot=md5($salt.$antibot);
	
	//echo '<script>alert("'.((int)($correct==$antibot)).'");</script>';
		if($antibot==$correct){
			$checkingvar=true;
		}else{
			$checkingvar=false;
			$error=new ErrorLogger("Invalid captcha","./db/logs");
			$error->writeToLog();
			$error="invalid captcha!";
		}
}else{
	echo '<script>alert("2");</script>';
		$error=new ErrorLogger("Invalid captcha","./db/logs");
		$error->writeToLog();
		$checkingvar=false;
		$error="invalid captcha!";
}

//create a comment obj with high scope!
$comment= new Comment($id_post);
$userinput=array($nick,$email,$site,$msg);


if($checkingvar){
	$post= new Post($id_post);	
	if ($post->exists()){//if post selected exist		
		$checkingvar=$comment->add($userinput);
		$error='Invalid input nick or email!';
	}else{
		$checkingvar=false;
		$error='Not existing post!';
	}
}

if($checkingvar){
		$comment->logNew($userinput);
		echo '<script>setTimeout("location.href=\'./view.php?id='.$id_post.'#comment\', 3*1000 ");</script>';
}else{
			echo '<script type="text/javascript" src="./js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="./js/jquery.notifyBar.css" type="text/css" media="screen"  />';
		echo '<script>$.notifyBar({ html: '.$error.', cls: "error", delay:1000});';
		echo 'setTimeout("history.back()", 2500 );</script>';
}

?>
