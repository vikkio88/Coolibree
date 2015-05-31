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
	//little var for counting login errors
	$failcount=(int)$_GET['t'];
?>

<div style="margin: auto; border: 2px solid #000; width: 350px; text-align: center;">
<img src="../img/banner.png" alt="coolibreelogo" />
<h3>online admin panel login</h3>
<?php 
	if($failcount>3){
		echo 'Who\'s got littest memory ever?...U! =D';
	//	echo "<form action=\"http://www.vikkio88.altervista.org/\" method=\"post\" >";
	}
		echo '<form action="./admpanel.php" method="post" >';

?>
<label>username</label><br />
<input type="text" name="u" /><br />
<label>password</label><br />
<input type="password" name="p" /><br /><br />
<input type="submit" name="Invia" value="Send" /><br />
<input type="checkbox" name="save" /><label>Save password on panel</label><br />
<input type="hidden" name="times" value="<?php echo $failcount; ?>" />
</form>

<?php
	if($failcount!=0){
		echo '<script>alert("Incorrect login retry! incident reported")</script>';
	}
?>
