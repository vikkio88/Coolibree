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
//this class can do a listing of file presents on db dir and can return the result
class Dblister {
	var $location="../db/posts";
	function __construct($location="./db/posts"){
		if ((preg_match("/db\/posts/",$location))||(preg_match("/db\/comments/",$location))){
			$this->location=$location;
		}else {
			$this->location=FALSE;
		}
	}
	
	private function ls($pattern="*", $folder="", $recursivly=false) {
		//this is a private function that copy the UNIX 'ls' functionality
		//***thanks a lot to me cause the old ls function does not works on php5 with safemode on
	$list=array();
	
		if ($handle = opendir($folder)) {
	
			while (false !== ($file = readdir($handle))) {
	
				if ($file != "." && $file != "..") {
					array_push($list,$file);
				}
	
			}
		
			closedir($handle);
		}
	//readdr return list of file completly random order, maybe ordered by weight
	//with this simple function Dblister object order things ASC
	array_multisort($list,SORT_ASC,SORT_NUMERIC);
	
	return $list;
	
	}

	function toArray(){
		//this method return an array with name of file on db dir(posts or comments)
		//ASC order
		return $this->ls("*",$this->location,false);
	}
	function toArrayreverse(){
		//this method reverse the arra of the toArray method ->to DESC order
			return array_reverse($this->toArray());
	}
	
	function printls(){
		//this method is usefull for testing it will print a simple list of file 
		//returned after an ls and a toArray
		foreach(($this->toArray())as $a){
				echo $a."\n";
		}
	}
	
	function count(){
		//this method return the numer of elements on selected db dir
			return count($this->toArray());
	}
	
	
	
	function getPagegen($pass=6){
		//this method return the number of page generated by pass(number PostPerPage)
		//,passed as argoument (default = 6 post per page)
		
		//Old method from virublog1 =( saudade!
		$pagegen=(int)($this->count()/$pass);
		if (($this->count()%$pass)>0) $pagegen=($pagegen+1);
		
		//New Implementation with array_chunk function is on page function
		return $pagegen;
	}
	
	function howmany(){
			//this method return an integer that contains
			//number of item in db listed by this object
			return ((int)(count($this->toArray())));
	}
	
	function page($pageN=1,$pass=6){
		//this method divide the list of posts group by pass(howmany post per page)
		//and return the required one piece like paging
		if(($this->howmany())>0){
		$pagegen=$this->getPagegen($pass);
		if (($pageN>$pagegen)||($pageN<1)) $pageN=1;
		$chunked=(array_chunk($this->toArrayreverse(),$pass));
		return $chunked[($pageN-1)];
		}else
		{
			//if i cant find any file on the main list, i return -2 
			//usefull for post object
			$arr=array("-2");
			return $arr;
		}
	}
	
	function recent_item(){
		//This method is a useless but light method that return the most recent
		//post/item id in the db listed by this object
		$all=$this->toArrayreverse();
		return $all[0];
	}
	
	
}
?>
