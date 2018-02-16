<?php
$config['db'] = array(
	'host' => 'localhost',
	'username' => 'root',
	'password' => 'password',
	'dbname' => 'localhost'
);

try{
	$db = new PDO("mysql:host=". $config['db']['host'] . ";dbname=" . $config['db']['dbname'], $config['db']['username'], $config['db']['password']);
}catch (PDOException $e){
	die("[-] Failed to Connect to database: " . $config['db']['dbname']);
} 

function createTable($db,$table){
	//Create Main Table
	$query = $db->prepare("CREATE TABLE " . $table . "(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,item varchar(120) NOT NULL);");
	$query->execute();
}

function addItem($db,$item){
	//Insert $username as a user
	$query = $db->prepare("Insert into items values (NULL, '" . $item . "');");
	$query->execute();
}

function deleteItem($db,$item){
	$query = $db->prepare("Delete from items where id='" . $item . "';");
	$query->execute();
}

function getItems($db){
	$query = $db->prepare("select * from items");
	$query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}


//Check if table users exists
$query = $db->prepare("SHOW TABLES LIKE 'items'");
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)){
	createTable($db,"items");
}

?>
