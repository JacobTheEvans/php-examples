<?php
require_once 'core/php/database.php';

$errors = array();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		addComment($db,$_POST['name'],$_POST['email'],$_POST['message'],$_SERVER['REMOTE_ADDR']);
    } else {
    	array_push($errors, "This is not a valid email");
    }
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Comment Section</title>
</head>
<body>
<article>
	<h3>This is a test article</h3>
	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,</p>
</article>
<hr>
<h3>Comments</h3>
<?php
foreach(getComments($db) as $comment){
	echo "<p>";
	echo($comment['name']);
	echo(" (");
	echo($comment['email']);
	echo(") at ");
	echo gmdate("Y-m-d i:s", $comment['timestamp']);
	echo("<hr>");
	echo($comment['message']);
	echo("<hr>");
	echo "</p>";
} 
?>
<h3>Post Comment</h3>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
<input placeholder="Name" name="name" type="text">
<br>
<br>
<input placeholder="Email" name="email" type="text">
<br>
<br>
<textarea name="message" type="text"></textarea> 
<br>
<input value="Submit" name="submit" type="submit">
</form>
<p>
<?php
foreach($errors as $error){
	echo($error);
	echo("<br>");
}
?>
</p>

</body>
</html>