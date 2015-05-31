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
//pos2id.php
//this script convert position on db to id for posts
include_once("../include/class.Post.php");
include_once("../include/class.Dblister.php");
$pos=(int)$_GET['pos'];

$posts_on_db=new Dblister("../db/posts");
$posts_on_db=$posts_on_db->toArray();
$how=count($posts_on_db);
if(($pos>=$how)or($pos<0)){
	echo "Error index out of bounds! no post with this position\n";
}else{
	//$post=new Post($posts_on_db[$pos],"","","../db/posts");
	echo $posts_on_db[$pos];
}

?>
