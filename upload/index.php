<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>

	<link rel="stylesheet" type="text/css" href="../css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/upload.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>

	<nav>
		<div>
			<form action="../search/index.php" method="GET">
				<input type="text" name="q" required>
			</form>
		</div>
		<div onclick="window.location.replace('../')">
			<span>Home</span>
		</div>
		<div onclick="window.location.replace('#')">
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

	<div id="uploadForm">
		<span>Upload File</span>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<span>Name: </span><input type="text" name="title" required>
			<span>Subject: </span><input type="text" name="subject" required>
			<span>User: </span><input type="text" name="user" required>
			<span>Description: </span><textarea name="desc" required></textarea>
			<span>Tags: </span><input type="text" name="tags" required>
			<span>Image:</span><input type="file" name="fileToUpload" id="fileToUpload">
			<input class="formSubmit" type="submit" value="Upload" required>
		</form>
	</div>

</body>
</html>