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
	//delPost.php
	//this script will delete a post from db if you give him post id 
	//or position (obtained with ./listPosts.php)
	//auth required!
	include_once("../include/class.Post.php");
	include_once("../include/class.Dblister.php");
	include_once("../include/class.ErrorLogger.php");
	
	//Reading users/password and userchecking
	// return a var ($control) false, if checking is not passed!
	include("../include/config.php");
	
	//
	$posttodel=-1;
	$pos=false;
	//id or postposition getted also with GET or POST
	//priority to id!
	if(isset($_GET['pos'])){
		$posttodel=(int)$_GET['pos'];
		$pos=true;
	}
	if(isset($_POST['pos'])){
		$posttodel=(int)$_POST['pos'];
		$pos=true;
	}
	if(isset($_GET['id'])){
		$posttodel=(int)$_GET['id'];
		$pos=false;
	}
	if(isset($_POST['id'])){
		$posttodel=(int)$_GET['id'];
		$pos=false;
	}
	
	//		echo $posttodel."post to del<br />";

	if($control){
		
		if($pos){
			$posts_on_db=new Dblister("../db/posts");
			$howmany=((int)count($posts_on_db->toArray()))-1;
			
			if ($posttodel>$howmany){
				echo "Error, index out of bound, posts with this position doesnt exits!\n";
			}else{
				$posts_on_db=$posts_on_db->toArray();
				$post=new Post($posts_on_db[$posttodel],"","","../db/posts");
				echo $post->del($username)."\n";
			}
				
		}else
		{
			$post=new Post($posttodel,"","","../db/posts");
			echo $post->del($username)."\n";
		}
		
		
	}else
	{
		echo "AuthFailure! this incident will be reported!\n";
		$error=new ErrorLogger("Tryied to deletin post! auth fail","../db/logs");
		$error->writeToLog();
	}
?>
