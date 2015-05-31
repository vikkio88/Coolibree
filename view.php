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
	include_once("./include/class.Post.php");
	include_once("./include/class.Dblister.php");
	include_once("./include/class.Comment.php");
	
	$postid=(int)$_GET['id'];
	
	if ($postid==0) $postid=-1;
	
	$postreq=new Post($postid);
	
	if (!($postreq->exists())){
			$posts_on_db= new Dblister("./db/posts");
			$postreq= new Post($posts_on_db->recent_item());
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	<title><?php echo $postreq->getTitle(true); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content=<?php
		$body=$postreq->getBody(true);
		$body=substr($body,0,100); 
		echo "\"$body\"/>"; 
	?>  
	<link rel="stylesheet" href="./template/style.css" type="text/css" /></head>
	<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="./js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
	<script src="./js/utilfunc.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="./js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="./js/jquery.notifyBar.css" type="text/css" media="screen"  />
	
	</head>
	<body onload="checkargs('./js/wrcomm.php?id=<?php echo $postreq->getId();?>')">
	<div id="all">
	
	<div id="header">
	<?php
		include("./template/header.txt");
		echo "<h2>".$postreq->getTitle(true)."</h2>";
	?>
	</div>
	
	<div id="main">
		
		<div id="bar">
			<?php
				include("./template/bar.txt");
				$comments=new Comment();
				echo $comments->getLastcomment();
			?>
		</div>
		
		<div id="content">
				<?php
					$postreq->dropcontent(false);
					$comment=new Comment($postreq->getId());
					echo "<div id=\"commentsbox\"><h4 style=\"margin-left:5px;\">Comments</h4>";
					echo "<div id=\"commbox\"></div>";
					?>
					<a href="#newcomment" onclick="commentadd('./js/wrcomm.php?id=<?php echo $postreq->getId();?>')" >Add a Comment</a><br />
					<?php
					echo "<a name=\"comment\"/>";
					$comment->dropcontent();
					echo "</div>";
				
				?>
			</div>
	</div>
	
	<div id="footer">
		<?php
			include("./template/footer.txt");
		?>
	</div>	
	
</div>


</body>
</html>
