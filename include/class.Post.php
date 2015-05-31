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
include_once("class.Comment.php");
include("textElaboration.php");

class Post {
	var $id;
	var $corpo;
	var $titolo;
	var $pathdb;
	var $author;
	
	function __construct($id=0,$titolo="",$corpo="",$pathdb="./db/posts",$author="admin")
	{
		
		//ID_ASSIGNMENT
		if ($id==0){
			$this->id=time();
		}else{
			$this->id=$id;
		}
		
		$this->corpo=$corpo;
		$this->titolo=$titolo;
		$this->pathdb=$pathdb;
		$this->author=$author;			
	}
	
	function exists(){
		//check if a post with this id already exist on db dir and return a boolean
		
		$tmp = new Dblister($this->pathdb);

		if (in_array($this->id,$tmp->toArray())){
			return true;
		}else{
			return false;
		}
			
	}
	
	public function getId() {
		//simple return post id
			return $this->id;
	}
	
	function chompBody($text,$editor="admin"){
		if(($editor=="admin")or($editor==$this->getAuthor())){
			$fp=fopen($this->pathdb."/".$this->id,"w");
			fwrite($fp,$text);
			fclose($fp);
			return "Post successfull modified! :D \n";
		}else{
			return "Is Forbidden to edit other author's posts! \n";	
		}
		
	}
	
	function getBody($notag=false){
		//this method get the complete body of a post very usefull for 
		//**edit post after pubblish
		//you can do it similar with file_get_contents() function
		//if $notag var is true the returned string doesnt containg html tag
		if($this->exists()){
			$alltext="";
			$f1=fopen($this->pathdb."/".$this->id,"r");
			while (! feof ($f1)) {
				$alltext.= fgets ($f1);
			}
			fclose ($f1);
			
			if ($notag){
				$alltext=preg_replace('/<(.+?)>/',"",$alltext);
			}
			
			return $alltext;
				
			
		}else{
			return "NoBody: maybe incorrect post!";
		}
	}
	
	function getTitle($nohref=false) {
		//this method get the title of an existing post on our db, you can call it
		//***only after saving post.
		//if nohref==true this methd clean the <a> tag round the title
		if ($this->exists()){
		
			$f1=fopen($this->pathdb."/".$this->id,"r");
			$stringa=fgets($f1, 4096);
			fclose ($f1);
			
			if (preg_match("/<div class=\"title\">([^`]*?)<\/div>/", $stringa, $out)){
				$stringa = $out[1];
			}
			
			if ($nohref){
				$stringa=preg_replace("/<a href='.\/view.php\?id=.+'>/","",$stringa);
				$stringa=preg_replace("/<\/a>/","",$stringa);
			}
			
			//cleaning <strong> tag in title
				$stringa=preg_replace("/<strong>/","",$stringa);
				$stringa=preg_replace("/<\/strong>/","",$stringa);
			///////////
			
			$this->titolo=$stringa;
			return $this->titolo;
		
		} else {
			$this->titolo="NoTitle!: maybe incorrect post!";
			return $this->titolo;
		}
	}

	function getAuthor(){
		
		$auth="NoAuthor: maybe incorrect post!";
		
		if ($this->exists()){
			$alltext="";
			
			$f1=fopen($this->pathdb."/".$this->id,"r");
			while (! feof ($f1)) {
				$alltext.= fgets ($f1);
			}
			fclose ($f1);
			
			if (preg_match("/<div class=\"sign\">([^`]*?)<\/div>/", $alltext, $out)){
				$auth = $out[1];
			}
		}
		$this->author=$auth;
		return $this->author;
	}

	function save(){
		//this method save a post object in a simple plain text file on db dir
			if((!($this->exists()))&&($this->corpo!="")&&($this->titolo!="")){
				$dataora=time();
				$datareale=date('d/m/Y',$dataora);
				$datareale=$datareale." ".(date("G:i",$dataora));
				$fp=fopen($this->pathdb."/".$this->id,"w");
				
				//TextElaboration function is in a separated script in this directory
				$this->corpo=text_elaboration($this->corpo);
				//strip slashes for title (in title will not apply bbcode)
				$this->titolo=str_replace('\\',"",$this->titolo);
				//*
				
				fwrite($fp,"<div class=\"post\"><div class=\"posttop\"><div class=\"title\"><a href='./view.php?id=".$this->id."'><strong>".$this->titolo."</strong></a></div><div class=\"date\">data:".$datareale."</div></div>".$this->corpo."<div class=\"sign\">".$this->author."</div></div>");
				fclose($fp);
				return "Post successfull written! =) bye\n";
		}else
			return "Error while saving post, maybe no text on post! =(\n";

	}

	function dropcontent($comment=true,$utfcorr=false){
		//this method drop the html store on posts file on db dir
			if ($this->exists()){
				/*  new type of expression*/
				if($utfcorr){
					$text=(htmlspecialchars(utf8_decode(file_get_contents($this->pathdb.'/'.$this->id))));
					$text=str_replace('&lt;','<',$text);
					$text=str_replace('&gt;','>',$text);//*/
					$text=str_replace('&quot;','"',$text);
				}else
					$text=file_get_contents($this->pathdb.'/'.$this->id);
					
				echo $text;
				//*/
				
				//old type, inclusion
				/*
				include($this->pathdb."/".$this->id);
				//*/
				//adding comment bar under each post
				if ($comment){
					echo "<div class=\"actioncomment\"><a href='./view.php?id=".$this->id."#newcomment'>Add Comment</a>/<a href='./view.php?id=".$this->id."#comment'>Read Comments</a></div>";
				}
				
			}else{
				$nop="";
				if($this->id==-2){
					$nop="Maybe there are not posts on db!<br />";
				}
				
				echo "error while requiring post! n.o: ".$this->id."\n<br />$nop";
			}
	}

	

	function del($deleter="admin"){
		//this method deleting current object post from db and comments if comment file exist
			if($this->exists()){
				//$comment=new Comment($this->id,(str_replace("/posts","",$this->pathdb)));
				$path=str_replace("/posts","",$this->pathdb);
				$commentpath=$path."/comments/".$this->id;
				$newcommpath=$path."/logs/comments.txt";
				
				
					//echo $comment->del(); //is deleted if exists Read Comment class for details
					//simple unlinking a comment file if exists..not necessary to create a comment object!
					if(($deleter=="admin")or($deleter==$this->getAuthor())){
						
						if (!unlink($this->pathdb."/".$this->id)) {
							return "$PHP_SELF: Error while deleting post n.o: ".$this->id."\n";
						}else{
							unlink($commentpath);
							unlink($newcommpath);
							return "post with id: ".$this->id." successful deleted!\n";
						}
						
					}else{
						return "Forbidden to delete other author's posts!\n";
					}
				
			}else
				return "post with id: ".$this->id." does not exists...so is alredy deleted :D";
	}

}
?>
