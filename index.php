<!DOCTYPE html>
<html>
<head>
	<title>Mind Field</title>

	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
<?php
	$title = file("posts/title.txt", FILE_IGNORE_NEW_LINES);
	$subject = file("posts/subject.txt", FILE_IGNORE_NEW_LINES);
	$user = file("posts/user.txt", FILE_IGNORE_NEW_LINES);
	$desc = file("posts/desc.txt", FILE_IGNORE_NEW_LINES);
	$points = file("posts/points.txt", FILE_IGNORE_NEW_LINES);
	$images = file("posts/images.txt", FILE_IGNORE_NEW_LINES);
	$time = file("posts/time.txt", FILE_IGNORE_NEW_LINES);

	for ($i=0; $i < count($images); $i++) { 
		if ($images[$i]=="#") {
			$images[$i] = "noImg.png";
		}
	}

	function newPost($postNum){
		global $title, $subject, $user, $desc, $points, $images, $time;
		echo "<div class = 'content'><div class = 'contImg' style='background-image: url(postsImg/";
		echo $images[$postNum];
		echo "); background-size: cover;'></div><span class = 'contTitle'><a href='post/?p=";
		echo substr($images[$postNum], 0, strpos($images[$postNum], "."));
		echo "''><span class='contExtraTitle'>...</span><b>";
		echo $title[$postNum];
		echo "</b></a></span><span class = 'contTime'>";
		echo date('H:i d-m-Y', $time[$postNum]);
		echo "</span><span class = 'contSub'>";
		echo $subject[$postNum];
		echo "-</span><span class = 'contUploder'>";
		echo $user[$postNum];
		echo "-</span><div class = 'contPointCount'><span>";
		echo $points[$postNum];
		echo "</span><div class = 'upv'><form action = 'voting/vote.php' method = 'post'><input type='hidden' name ='upvote' value='";
		echo $postNum + 1;
		echo"'><input type='hidden' name ='downvote' value='0'></form></div><div class = 'downv'><form action = 'voting/vote.php' method = 'post'><input type='hidden' name ='upvote' value='0'><input type='hidden' name ='downvote' value='";
		echo $postNum + 1;
		echo"'></form></div></div><br><span class = 'contDesc'>";
		echo substr($desc[$postNum],0,255)."...";
		echo "</span></div>";
	}
?>
	<nav>
		<div>
			<form action="search/index.php" method="GET">
				<input type="text" name="q" required>
			</form>
		</div>
		<div onclick="window.location.replace('#')">
			<span>Home</span>
		</div>
		<div onclick="window.location.replace('upload')">
			<span>Upload</span>
		</div>
		<div>
			<span>1</span>
		</div>
		<div>
			<span>2</span>
		</div>
		<div>
			<span>3</span>
		</div>
		<div>
			<span>4</span>
		</div>
		<div>
			<span>5</span>
		</div>
	</nav>

	<div id="main">
		<div id = 'search'>
			<form action="search/index.php" method="GET">
				<input type="text" name="q" required>
			</form>
		</div>

		<?php
			for ($i=0; $i < count($points); $i++) { 
				newPost($i);
			}
		?>

	</div>
</body>
</html>