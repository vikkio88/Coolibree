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
include_once("class.Dblister.php");
include_once("class.ErrorLogger.php");

include("inputValidation.php");
//this class abstract the concept of comment for each post
// the directory db is ../db/comments
class Comment{
	
	var $id;
	var $pathdb;
	
	function __construct($id=0,$pathdb="./db"){
		$this->id=$id;
		$this->pathdb=$pathdb;
	}
	
	function getPath(){
			return $this->pathdb;
	}
	
	function exists($both=false){
		$commlist= new Dblister($this->pathdb."/comments");
		$postlist= new Dblister($this->pathdb."/posts");
		if($both){//if you want only that post exist
			if((in_array($this->id,$postlist->toArray()))){
				return true;
			}else{
				return false;
			}
		}else{//If you want that both post and comment exists
			if((in_array($this->id,$commlist->toArray()))and(in_array($this->id,$postlist->toArray()))){
			
				return true;
			}else{
				return false;
			}
		}
	}
	
	function dropcontent(){
		if($this->exists()){
			require($this->pathdb."/comments/".$this->id);
		}else{
			echo "No comment for this post :'( !";
		}
		
	}
	
	function del(){
			if($this->exists()){
				return unlink($this->pathdb."/comments/".$this->id);
			}else
				return "no comment to del!".$this->pathdb;
	}
	
	function add($userinput=array("","","","")){
		//This method adding comments to comment tail if comment is valid
		//otherwise it will return a false value.
		//Add comment function must get an array with this configuration
		
		$nick=htmlspecialchars($userinput[0]);
		$email=htmlspecialchars($userinput[1]);
		$site=htmlspecialchars($userinput[2]);
		$msg=htmlspecialchars($userinput[3]);
		//$emailshow=$userinput[4]; //boolean that express if user want show his email
			
			//Simple text optimization
				$msg=str_replace('\\',"",$msg);
			    $msg=str_replace('&amp;',"&",$msg);
				$nick=str_replace('\\',"",$nick);
			//
		
		
		//input validation is a simple function that check if all user input is valid
		if(input_validation($nick,$msg,$email)){
			//comment will add to comments tail
			$file=fopen($this->pathdb."/comments/".$this->id,"a");
				
				//calculating real time
				$dataora=time();
				$datareale=date('d/m/Y',$dataora);
				$datareale=$datareale." ".(date("G:i",$dataora));
				
			//if site var is correct it will added as a href to nickname, otherwise nick 'll be simple plain text
			if(is_site($site)){
				$nick="<a href=\"".$site."\" alt=\"".$nick."-HomePage\">".$nick."</a>";
			}
			
			$commentbody="<div class=\"comment\"><div class=\"commenttop\">".$nick."<div class=\"commentdata\">".$datareale."</div></div>".$msg."</div>";
			fwrite($file,$commentbody);
			fclose($file);
			
			//If you want to log correct comments, just uncomment this piece of code
			//put a /slash
		// here =) 
		//   | 
			 /*
			$validcomment=new ErrorLogger("!Valid com. $nick | $email","./db/logs");
			$validcomment->writeToLog();
			//*/
			
			
			return true;
			
		}else{
			$error=new ErrorLogger("Invalid comment","./db/logs");
			$error->writeToLog();
			return false;
		}
	}

function getLastcomment(){
		//this method return a string html that contains a stupid links to post
		//recently commented
		$path=$this->pathdb."/logs/comments.txt";	
		
			$returnval="<div class=\"menu_title\">Last Comments</div><ul class=\"navigator\">";
	
			if (file_exists($path)){
	
			$f=fopen($path,"r");
			$test=array();
				
			while ((!feof ($f)))
			{
				array_push($test,fgets($f));
			}
			
			fclose($f);
			$ltest=(count($test))-1;
			$end=($ltest-6);
			
			if ($end>=0){
				for ($i=$ltest;$i>$end;--$i){
					$returnval.= $test[$i];
				}
			}else {
				foreach ($test as $riga){
						$returnval.= $riga;
				}
			}
	
		}else{
			$returnval.="<li>No recent comment</li>";
		}
		$returnval.="</ul>";
		return $returnval;
}

function logNew($userinfo){
	
		$path=$this->pathdb."/logs/comments.txt";
	
		$nick=htmlspecialchars($userinfo[0]);
	
		$post=new Post($this->id,"","",$this->pathdb."/posts");
		$ptitle=$post->getTitle(true);
		$flast=fopen($path,"a");
		$title=substr($ptitle, 0, 8)."..";
		$string="$nick in $title";
		if ((strlen($string))>38) {
			$title=substr($title,0,(strlen($title)-((strlen($string))-38)));
		}
		fwrite($flast,"<li>$nick in <a href=\"./view.php?id=".$post->getId()."#comment\" >$title</a></li>\n");
		fclose($flast);
}

}

?>
