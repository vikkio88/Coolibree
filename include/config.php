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
	//this script will authenticate users that can post or moving 
	//other things in this CMS
	function usercheck($us2,$pw2,$users,$passwords){
		//this function control the validity of a password for a user	
			if(in_array($us2,$users)){
				$index=array_search($us2,$users);
				if($passwords[$index]==$pw2){
					return 1;
				}else{
					//log fail-login
					return 0;
				}
			}else{
				//log fail-login
				return 0;
			}
	}


	//Passwords and usernames, are in those arrays
	// is very advisable to left the admin user in users array
	// cause in some action got all right for changing things
	//otherwise last 2 users are completly deletable 
		$users= array("admin","user","betatester");
//		                  ^__      ^___       ^____
//		                     |         |           |
		$passwords=array("password","userpassword","iamtesting");
	//for add an user that can post on blog simply add username and pwd
	//the order is very important username: admin -> password: password
	
	//the following 6 row control user argument and set var to check login
	// The priority os assigned to var recieved by POST method
	if(isset($_GET['user'])and(isset($_GET['pass']))){
		//echo "gained with get";
		$username=$_GET['user'];
		$password=$_GET['pass'];
	}else if(isset($_POST['user'])and(isset($_POST['pass']))){
		//echo "gained with post";
		$username=$_POST['user'];
		$password=$_POST['pass'];
	}else{
			//echo "gained not";
			$username="";
			$password="";
	}
	
	//this var must be used in all scripts that include this file
	$control=FALSE;
	$control=usercheck($username,$password,$users,$passwords);
	
		
	

//the following rows make possible the simple user checking by checking the GET var
//in this script, this will be executed only if the script in execution by webserver
//is PHP_SELF.
// may be used for a simple cli client that userchecking before sending any request
//to the CMS
	if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)){
		if (usercheck($username,$password,$users,$passwords)){
			echo 1;
		}else{
			echo 0;
		}
	}
?>
