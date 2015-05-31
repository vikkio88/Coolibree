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
//simple script that search one key-word in all posts, single keyword
	include_once("./include/class.Post.php");
	include_once("./include/inputValidation.php");
	include_once("./include/class.ErrorLogger.php");
	include_once("./include/class.Dblister.php");
	
	
	$keyword="";
	
	if (isset($_GET['key'])){
		$keyword=htmlspecialchars($_GET['key']);
	}
	
	
	
	if(is_keyword($keyword)){
		$posts_on_db=new Dblister();
		$founded=array();
		
		foreach($posts_on_db->toArray() as $id){
				
				$post=new Post($id);
				
				//getting text of current post
				$text=$post->getBody();
				
				//cleaning text from html tags
				$text=preg_replace('/<(.+?)>/'," ",$text);
				
				//lowercasing text getted in post and keyword
				$keyword=strtolower($keyword);
				$text=strtolower($text);
				
				
				//searching keyword between posts
				if(strstr($text,$keyword)){
						array_push($founded,$id);
				}
				
				$text="";
		}
		
		if ((count($founded))>0){
			echo "Keyword: <strong>$keyword</strong> found on posts:\n<br />";
		}else{
			echo "No posts contains keyword: <strong>$keyword</strong>\n<br />";
		}
		
		foreach($founded as $id){
			$post=new Post($id);
			echo $post->getTitle()." <br />\n";
		}
		
	}else{
		$errortype=is_keyword($keyword,false);
		/* uncomment here to log search error! add a slash at the beginning of the row
			$error=new ErrorLogger("Invalid search $errortype","./db/logs");
			$error->writeToLog();
		//*/
		echo "Incorrect search!<br />\n Error type: ".$errortype."\n";
	}

?>
