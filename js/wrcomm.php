<?php
	$id=$_GET['id'];
?>

<form action="./comment.php" method="post">
	<fieldset style="background: white;">
	<p style="float: leftt;font-size:0.8em"><a href="#" onclick="closecommbar()">[X]</a></p>
	<label>username</label><br />
	<input type="text" name="nick" /><br />
	<label>email (never show but necessary)</label><br />
	<input type="text" name="email" /><br />
	<label>site (ad an href to your nick)</label><br />
	<input type="text" name="site" /><br />
	<label>message</label><br />
	<textarea name="msg" cols="40" rows="6"></textarea><br /><br />
	<label>antibot system:</label><br />
	<img src="./img/image.php" alt="captcha" /> <br />
	<input type="text" name="antibot" /><br />
	<input type="hidden" name="id" value="<?php echo $id;?>"/>
	<input type="submit" name="Invia" value="Send comment" /><br />
	</fieldset>
</form>
