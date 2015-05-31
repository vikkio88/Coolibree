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
//chompBody.php
//simple suck everything passed as a full text for a post
	include_once('../include/class.Post.php');
	include_once('../include/class.ErrorLogger.php');
	
	//Reading users/password and userchecking
	include('../include/class.Loginchecker.php');
	$us=new Vargetter('u');
	$pw=new Vargetter('p');
	$login = new Loginchecker($us->val(),$pw->val());
	$control=$login->isDone();
	$username=$us->val();

$body=stripslashes($_POST['body']);
$id=$_POST['id'];


if($control){
		$post=new Post($id,'','','../db/posts');
		if($post->exists()){
			
			//Simple text elaboration
			//$body=htmlspecialchars($body);
//			$body=str_replace('&amp;',"&",$body);
//			$body=str_replace('\\',"",$body);
			///
			if($body!=''){
				echo $post->chompBody($body,$username);
				/*echo '<script>alert("Post successfull modified!");';
				echo 'setTimeout("location.href=\'../view.php?id='.$id.'\', 3*1000 ");</script>';*/
			}else{
				echo "Body content must contains something... :S! retry!\n";
			}
		}else{
			echo "The id doesnt exists! :( \n";
			
			/*echo '<script>alert("The post selected doesnt exists =(");';
			echo 'setTimeout("location.href=\'../index.php\', 3*1000 ");</script>';*/
		}
			
}else{
	echo "AuthFailure! this incident will be reported!\n";
		$error=new ErrorLogger("Tryied to access chompBody post! auth fail","../db/logs");
		$error->writeToLog();
	
}

?>
