<!DOCTYPE html>
<html>
<body>
	<?php
		$title = file("../posts/title.txt", FILE_IGNORE_NEW_LINES);
		$subject = file("../posts/subject.txt", FILE_IGNORE_NEW_LINES);
		$user = file("../posts/user.txt", FILE_IGNORE_NEW_LINES);
		$desc = file("../posts/desc.txt", FILE_IGNORE_NEW_LINES);
		$points = file("../posts/points.txt", FILE_IGNORE_NEW_LINES);
		$value = file("../posts/value.txt", FILE_IGNORE_NEW_LINES);
		$tags = file("../posts/tags.txt", FILE_IGNORE_NEW_LINES);
		$images = file("../posts/images.txt", FILE_IGNORE_NEW_LINES);
		$time = file("../posts/time.txt", FILE_IGNORE_NEW_LINES);

		$newTitle = $_POST["title"];
		$newSubject= $_POST["subject"];
		$newUser = $_POST["user"];
		$newDesc = trim(preg_replace('/\s\s+/', '<br /><br />', $_POST["desc"]));
		$newTags = $_POST["tags"].",".$newTitle.",".$newSubject;
		$newTags = str_replace(" ", ",", $newTags);
		$newTime = time();

		$target_dir = "../postsImg/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$newImage = md5(count($images)).".".$imageFileType;
		    	rename($target_file,"../postsImg/".$newImage);

		    	array_push($title, $newTitle);
				array_push($subject, $newSubject);
				array_push($user, $newUser);
				array_push($desc, $newDesc);
				array_push($points, 0);
				array_push($value, 0);
				array_push($tags, $newTags);
				array_push($images, $newImage);
				array_push($time, $newTime);

				$title = implode("\n", $title);
				$subject = implode("\n", $subject);
				$user = implode("\n", $user);
				$desc = implode("\n", $desc);
				$points = implode("\n", $points);
				$value = implode("\n", $value);
				$tags = implode("\n", $tags);
				$images = implode("\n", $images);
				$time = implode("\n", $time);

				fwrite(fopen("../posts/title.txt","w"), $title);
				fwrite(fopen("../posts/subject.txt","w"), $subject);
				fwrite(fopen("../posts/user.txt","w"), $user);
				fwrite(fopen("../posts/desc.txt","w"), $desc);
				fwrite(fopen("../posts/points.txt","w"), $points);
				fwrite(fopen("../posts/value.txt","w"), $value);
				fwrite(fopen("../posts/tags.txt","w"), $tags);
				fwrite(fopen("../posts/images.txt","w"), $images);
				fwrite(fopen("../posts/time.txt","w"), $time);
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	?>
</body>
</html>