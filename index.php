<?php
/**# CoolibreeCMS
	#
	# copyleft by vikkio88 <vikkio88@yahoo.it>
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	# visit: http://vikkio88.altervista.org
	#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
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
	include_once("./include/class.Comment.php");
	include_once("./include/class.Dblister.php");
	$pageN=(int)$_GET['p'];
	header('content-type: text/html; charset: utf-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	
	<head>
	<title>Coolibree blog</title>
	<link rel="stylesheet" href="./template/style.css" type="text/css" />
	<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="./js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
	<script src="./js/utilfunc.js" type="text/javascript"></script>
	<script type="text/javascript" src="./js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="./js/jquery.notifyBar.css" type="text/css" media="screen"  />
	
	</head>
<body>
	<div id="all">
	
	<div id="header">
	<?php
		include("./template/header.txt");
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
				//in this div i will print all page content
				$posts_on_db= new Dblister("./db/posts",$pageN);
				//Printing all post for page
					foreach ($posts_on_db->page($pageN) as $postid){
						$postmp= new Post($postid);
						$postmp->dropcontent();
					}
				
				
				if($pageN==0) $pageN=1;
				//checking page number for printing page navigation after post
				echo "<div id=\"pagenavigation\">";				
				if((!(($pageN==$posts_on_db->getPagegen())and($pageN==1)))and(($posts_on_db->getPagegen())!=0)){
					if (!($pageN==1)) echo "<a href='./index.php?p=".(((int)$pageN)-1)."'>&laquo;- Newest Posts</a>";
					echo "$pageN/".$posts_on_db->getPagegen();
					if($pageN!=$posts_on_db->getPagegen())echo "<a href='./index.php?p=".(((int)$pageN)+1)."'>Older Posts -&raquo;</a>";
				}
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
