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
//listPosts.php
//return a simple list of all posts on db no auth required!
include_once("../include/class.Post.php");
include_once("../include/class.Dblister.php");

	$post_on_db=new Dblister("../db/posts");
	$i=0;
//  echo "PostList :\n<br />*************\n<br />\n<br />";
	foreach($post_on_db->toArray() as $id){
		$post= new Post($id,"","","../db/posts");
		echo "Position num#: $i || title: ".$post->getTitle(true)."  || id: ".$id."  || author:  ".$post->getAuthor()."\n<br />";
		$i+=1;
	}

?>
