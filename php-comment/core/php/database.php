<?php
$config['db'] = array(
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'dbname' => 'comments'
);

try{
	$db = new PDO("mysql:host=". $config['db']['host'] . ";dbname=" . $config['db']['dbname'], $config['db']['username'], $config['db']['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
	die("[-] Failed to Connect to database: " . $config['db']['dbname']);
} 

function createTable($db,$table){
	//Create Main Table
	$query = $db->prepare("CREATE TABLE " . $table . "(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,timestamp int(11), name varchar(225), email varchar(255), message varchar(255), ip varchar(255));");
	$query->execute();
}

function addComment($db,$name,$email,$comment,$ip){
	$time = time();
	//Sanitize input for html tags to prevetn xss cross site scripting
	$name = htmlentities($name, ENT_COMPAT, 'UTF-8');
	$email = htmlentities($email, ENT_COMPAT, 'UTF-8');
	$comment = htmlentities($comment, ENT_COMPAT, 'UTF-8');
	//Insert $comment as a comment
	$query = $db->prepare("Insert into comments values (NULL, {$time}, '{$name}', '{$email}', '{$comment}','{$ip}');");
	$query->execute();
}

function deleteComment($db,$comment){
	$query = $db->prepare("Delete from comments where id='" . $comment . "';");
	$query->execute();
}

function getComments($db){
	$query = $db->prepare("select * from comments");
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}


//Check if table comments exists
$query = $db->prepare("SHOW TABLES LIKE 'comments'");
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)){
	createTable($db,"comments");
}

?>
