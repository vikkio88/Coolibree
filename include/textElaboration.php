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
//textElaboration.php
//this is a simple group of a textoperations usefull to operate with strings
//and for elaborate bbcode and other things


function text_elaboration($str){

	//SMILES
	$str = str_replace(":)","<img src=\"./img/smilies/smile.gif\" alt=\"smile_wink\"/>",$str);
	$str = str_replace(":(","<img src=\"./img/smilies/sad.gif\" alt=\"sad_wink\"/>",$str);
	$str = str_replace(":P","<img src=\"./img/smilies/bigrazz.gif\" alt=\"tounge_wink\"/>",$str);
	$str = str_replace(":D","<img src=\"./img/smilies/biggrin.gif\" alt=\"D_wink\"/>",$str);
	$str = str_replace("XD","<img src=\"./img/smilies/biggrin.gif\" alt=\"xd_wink\"/>",$str);
	$str = str_replace("8)","<img src=\"./img/smilies/cool.gif\" alt=\"cool_wink\"/>",$str);
	$str = str_replace(":@","<img src=\"./img/smilies/mad.gif\" alt=\"mad_wink\"/>",$str);
	$str = str_replace(";)","<img src=\"./img/smilies/wink.gif\" alt=\"wink_wink\"/>",$str);
	//End of Smiles

	//BBcode application
	$str = str_replace("\n", "<br />", $str);
	$str = str_replace("	", "&nbsp;&nbsp;&nbsp;&nbsp;", $str);
	
	//[img][/img] bbcode -> <img src...>
	$str = str_replace("[img]", "<img src=\"", $str);
	$str = str_replace("[/img]", "\" alt=\"image\"/>", $str);
	
	//[url][/url] bbcode -> <a href>
	$str= preg_replace("/\[url\](.*?)\[\/url\]/","<a href=\"".htmlspecialchars("$1")."\">".htmlspecialchars("$1")."</a>", $str);
	$str= preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/","<a href=\"".htmlspecialchars("$1")."\">".htmlspecialchars("$2")."</a>", $str);
	
	//make text bold [b][/b]
	$str = str_replace("[b]", "<strong>", $str);
	$str = str_replace("[/b]", "</strong>", $str);
	
	//make text italic style [o][/o]
	$str = str_replace("[i]", "<span style=\"font-style:italic;\">", $str);
	$str = str_replace("[/i]", "</span>", $str);
	
	//make text underline [u][/u]
	$str = str_replace("[u]", "<span style=\"text-decoration:underline;\">", $str);
	$str = str_replace("[/u]", "</span>", $str);
	
	//make text overline [o][/o]
	$str = str_replace("[o]", "<span style=\"text-decoration:overline;\">", $str);
	$str = str_replace("[/o]", "</span>", $str);
	
	//code bbcode
	$str = preg_replace ("/\[code\](.*?)\[\/code\]/", "<div class=\"code\">".htmlentities("$1")."</p>", $str);
	
	//LaTeX bbCode done reversing ->  http://www.codecogs.com/latex/
	$str = preg_replace ("/\[latex\](.*?)\[\/latex\]/", "<img src=\"http://latex.codecogs.com/gif.download?".htmlentities("$1")."\" alt=\"Latex-Formula\"/>", $str);
	
	//BBCODE youtube, add a youtube player with videoID recognizer
	$str= preg_replace("/\[youtube\](.*?)\[\/youtube\]/","<br /><object width=\"425\" height=\"344\"><param name=\"movie\" value=\"http://www.youtube.com/v/".("$1")."&hl=it_IT&fs=1&\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/".("$1")."&hl=it_IT&fs=1&\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed></object><br />",$str);
	
	//Strip slashes
	$str=str_replace('\\',"",$str);
	
	//at the end return the elaborated string!
	return $str;
	
}


?>
