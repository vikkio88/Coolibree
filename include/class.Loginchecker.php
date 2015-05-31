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
include_once('class.Vargetter.php');

class Loginchecker{
	//this class will authenticate users that can post or moving 
	//other things in this CMS
	
	//Passwords and usernames, are in those arrays
	// is very advisable to left the admin user in users array
	// cause in some action got all right for changing things
	//otherwise last 2 users are completly deletable 
	var	$users= array("admin","user","betatester");
//		                  ^__      ^___       ^____
//		                     |         |           |
	var	$passwords=array("password","userpassword","iamtesting");
	//for add an user that can post on blog simply add username and pwd
	//the order is very important username: admin -> password: password
	
	var $control=FALSE;
	
	function __construct($user='',$passwd=''){
		$this->control = $this->usercheck($user,$passwd);
	}
	
	function isDone(){
		return $this->control;
	}
	
	function usercheck($us2,$pw2){
		//this function control the validity of a password for a user	
			if(in_array($us2,$this->users)){
				$index=array_search($us2,$this->users);
				if($this->passwords[$index]==$pw2){
					return TRUE;
				}else{
					//log fail-login
					return FALSE;
				}
			}else{
				//log fail-login
				return FALSE;
			}
	}	
}		
	

//the following rows make possible the simple user checking by checking the GET var
//in this script, this will be executed only if the script in execution by webserver
//is PHP_SELF.
// may be used for a simple cli client that userchecking before sending any request
//to the CMS
	if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
		$us=new Vargetter('u');
		$pw=new Vargetter('p');
		$login = new Loginchecker($us->val(),$pw->val());
		echo (int) $login->isDone();
	}
?>
