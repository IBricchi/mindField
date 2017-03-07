<!DOCTYPE html>
<html>
<body>
	<?php
		$upvote = $_POST["upvote"];
		$downvote = $_POST["downvote"];

		$pointsFile = '../posts/points.txt';
		$valueFile = '../posts/value.txt';

		$pointsArray = file($pointsFile, FILE_IGNORE_NEW_LINES);
		$valueArray = file($valueFile, FILE_IGNORE_NEW_LINES);
		if ($upvote == 0) {
			$downvote--;
			$pointsArray[$downvote]--;
			$valueArray[$downvote]--;

		}elseif ($downvote == 0) {
			$upvote--;
			$pointsArray[$upvote]++;
			$valueArray[$upvote]++;
		}

		$pointsArray = implode("\n", $pointsArray);
		$valueArray = implode("\n", $valueArray);

		fwrite(fopen($pointsFile,"w"), $pointsArray);
		fwrite(fopen($valueFile,"w"), $valueArray);

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	?>
</body>
</html>