<!DOCTYPE html>
<html>
<head>
	<title>Post</title>

	<link rel="stylesheet" type="text/css" href="../css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/post.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../js/main.js"></script>

</head>
<body>

	<?php
		if (!empty($_GET['p'])) {
			$title = file("../posts/title.txt", FILE_IGNORE_NEW_LINES);
			$subject = file("../posts/subject.txt", FILE_IGNORE_NEW_LINES);
			$user = file("../posts/user.txt", FILE_IGNORE_NEW_LINES);
			$desc = file("../posts/desc.txt", FILE_IGNORE_NEW_LINES);
			$points = file("../posts/points.txt", FILE_IGNORE_NEW_LINES);
			$images = file("../posts/images.txt", FILE_IGNORE_NEW_LINES);

			$post = $_GET['p'];
			$tempPost = 64;
			$tempLoc = 0;
			for($i = 0; $i < count($images); $i++) {
				$temp = $images[$i];
				$tempVal = levenshtein($temp, $post);
				if ($tempVal<$tempPost) {
					$tempPost = $tempVal;
					$tempLoc = $i;
				}
			}
			$post = $tempLoc;

			$current = array();
			array_push($current, $title[$post]);
			array_push($current, $subject[$post]);
			array_push($current, $user[$post]);
			array_push($current, $desc[$post]);
			array_push($current, "../postsImg/".$images[$post]);
			array_push($current, $points[$post]);
			array_push($current, $images[$post]);
		}
	?>

	<nav>
		<div>
			<form action="index.php" method="GET">
				<input type="text" name="q" required>
			</form>
		</div>
		<div onclick="window.location.replace('../')">
			<span>Home</span>
		</div>
		<div onclick="window.location.replace('../upload')">
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
			<form action="../search/index.php" method="GET">
				<input type="text" name="q" required>
			</form>
		</div>
		<div id="title">
			<h1><?php echo $current[0]; ?></h1>
			<div class="contPointCount">
				<span><?php echo $current[5]; ?></span>
				<form action="../voting/vote.php" method="post">
					<input type="hidden" name="upvote" value="<?php echo $post+1; ?>">
					<input type="hidden" name="downvote" value="0">
					<input type="submit" class="upv" value="">
				</form>
				<form action="../voting/vote.php" method="post">
					<input type="hidden" name="upvote" value="0">
					<input type="hidden" name="downvote" value="<?php echo $post+1; ?>">
					<input type="submit" class="downv" value="">
					</form>
			</div>
		</div>
		<div id="mainInfo">
			<span>Uploaded by <?php echo $current[2]; ?> on the "Date goes here when settup" for the <?php echo $current[1]; ?> class</span>
		</div>
		<div id="content">
			<div id="mainImg">
				<img src="<?php echo $current[4]; ?>">
			</div>
			<?php echo $current[3]; ?>
		</div>
	</div>

</body>
</html>