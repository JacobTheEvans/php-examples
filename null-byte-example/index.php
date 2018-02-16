<!DOCTYPE html>
<html>
<head>
	<title>Null Byte Example</title>
</head>
<body>
	<form action="" method="get">
	<h2>Please Input File</h2>
	<input type="text" name="file">
	<input type="submit" value="Submit">
	</form>

	<?php
	if(isset($_GET["input"])){
		$file = $_GET["input"]; // "../../etc/passwd\0"
		include($file . '.txt');
	}
	?>

</body>
</html>

