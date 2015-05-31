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
	//dropPost.php
	//this script will drop the html of the post fished on db,
	// is not necessary login as admin
	include_once("../include/class.Post.php");
	include_once("../include/class.Dblister.php");
	
	$posttodrop=-1;
	$pos=false;
	//id or postposition getted also with GET or POST
	//priority to id!
	if(isset($_GET['pos'])){
		$posttodrop=(int)$_GET['pos'];
		$pos=true;
	}
	if(isset($_POST['pos'])){
		$posttodrop=(int)$_POST['pos'];
		$pos=true;
	}
	if(isset($_GET['id'])){
		$posttodrop=(int)$_GET['id'];
		$pos=false;
	}
	if(isset($_POST['id'])){
		$posttodrop=(int)$_GET['id'];
		$pos=false;
	}
	
	if($pos){
			$posts_on_db=new Dblister("../db/posts");
			$howmany=((int)count($posts_on_db->toArray()))-1;
			
			if ($posttodrop>$howmany){
				echo "Error, index out of bound, posts with this position doesnt exits!\n";
			}else{
				$posts_on_db=$posts_on_db->toArray();
				$post=new Post($posts_on_db[$posttodrop],"","","../db/posts");
				echo $post->getBody();
			}
				
		}else
		{
			$post=new Post($posttodrop,"","","../db/posts");
			echo $post->getBody();
		}
	
	
	/*if(isset($_GET['id'])){
		$id=(int)$_GET['id'];
	}else if(isset($_POST['id'])){
		$id=(int)$_POST['id'];
	}else
		$id=-1;
		
	//if($id==0) $id=-1;
		
	$post=new Post($id,"","","../db/posts");
	if($post->exists()){
		echo $post->getBody();
	}else{
		//log it if you want i dont log idiot things :D
		echo "No post with this id =(!\n";
	}*/
?>
