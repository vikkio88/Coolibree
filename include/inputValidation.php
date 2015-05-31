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
//inputValidation.php
//this module contain a group of utility for text validation

function input_validation($nick,$message,$email){
	//this function return true only if nickname and mwssage will be valid input!
	if(((stristr($nick,"&lt;")) != FALSE) or ((stristr($message,"&lt;"))!= FALSE)){
		return false;
	}
	
	if((preg_match('/^([_a-zA-Z0-9+_+~+@!?-]{2,10})+$/',$nick))!=1){
		return false;
	}
	
	if((preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/',$email))!=1){
		return false;
	}
	
	if (strlen($message)<3){
		return false;
	}
	
	return true;
}

function is_site($site=""){
	if ((preg_match('/http:\/\/[a-zA-Z0-9._%+-]+\.[a-zA-Z]{2,4}/',$site))==1){
		return true;
	}else
		return false;

}

function is_keyword($keyword="",$returningbool=true){
		//this function return a boolean or a string that explain if a keyword
		// is valid or not for internal search engine
		
		$boolval=true;
		$error="";
		
		//Controls
		if (strlen($keyword)<=3){
			$error="searched too little value";
			$boolval=false;
		}
		if ((stristr($keyword,"&lt;"))) 
		{
			$error="Xss try here!maybe you stupid lamer! lol";
			$boolval=false;
		}
	
		if(is_numeric($keyword)){
			$error="searched numeric value";
			$boolval=false;
		}
		
		
		if($returningbool){
			return $boolval;
		}else{
			return $error;
		}
}

?>
