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
//postEditor.php
//this is a simple post editor
	include_once('../include/class.Post.php');
	include_once('../include/class.ErrorLogger.php');
	
	//Reading users/password and userchecking
	include('../include/class.Loginchecker.php');
	$us=new Vargetter('u');
	$pw=new Vargetter('p');
	$login = new Loginchecker($us->val(),$pw->val());
	$control=$login->isDone();
	$username=$us->val();
	$password=$pw->val();
	$id_post=(int)$_GET['id'];
	if ($id_post==0) $id_post=-1;
	$post=new Post($id_post,'','','../db/posts');
	if(($control)and($post->exists())){
		echo '<body>
<div style="margin: auto; border: 2px solid #000; width: 650px; padding: 8px;">
<h4>You are modifing the post titled: '.$post->getTitle(true).'</h4>

<form action="./chompBody.php" method="post">
<label>Modify the post html</label>
<input type="hidden" name="id" value="'.$id_post.'" />
<input type="hidden" name="user" value="'.$username.'" />
<input type="hidden" name="pass" value="'.$password.'" />
<textarea name="body" id="post" cols="78" rows="20">'.$post->getBody().'</textarea><br />
<label>DO NOT USE BBCODE! Only html</label><br />
<input type="submit" name="Send" value="Send Modify" />
</form>
</div>
</body>';
}else{
 echo 'Auth failure! this incident will be reported!\n';
 		$error=new ErrorLogger('Trying to access post editor!','../db/logs');
		$error->writeToLog();
}

?>
