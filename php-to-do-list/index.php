<!DOCTYPE html>

<?php
require_once 'core/dbmanagement.php';
if ($_POST['item'] != NULL){
	addItem($db,$_POST['item']);
}

echo $_POST["delete"];
if ($_POST["delete"] != NULL){
	deleteItem($db,$_POST["delete"]);
}

?>

<html>

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="core/css/style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
	<link href="core/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  	<div class="navbar-header">
  		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  			<span class="sr-only">Toggle navigation</span>
  			<span class="icon-bar"></span>
  			<span class="icon-bar"></span>
  			<span class="icon-bar"></span>
  		</button>
  	</div>
  <!--This is what will be shown on the computer-->
  <div class="navbar-collapse collapse navbar-centered">
  	<ul class="nav navbar-nav">
  		<li class="head-link"><a href="index.php"><div class='icon-padding'><img class='icon' src="core/files/icon.png"></a></div></li>
  	</ul>
    <a href="index.php" class="pull-right bar-text"><div>Example To Do List</div></a>
  </div>
  </nav>
  <!--End of Navigation-->
  <div class="bor">
    <div class="container">
      <div class="row">
        <div class=" col-lg-offset-3 col-md-5 col-lg-5 col-sm-5 todo">
        <h2 class="logo">Things To Do</h2>
        <?php
        for ($i = 0; $i < 20; $i++){
          echo "<span class=\"glyphicon glyphicon-minus nospace\"></span>";
        }
        ?>
        <form action="" method="post">
        <div id="deleted"></div>
        <ul>
        <?php
        $items = getItems($db);
        for ($i = 0; $i < count($items);$i++){
          echo "<input class=\"check\" type=\"image\" src='core\\files\\check.png' alt=\"Submit Form\" onclick=\"del(this)\" id='". $items[$i]['id']  . "'> <li name=". $items[$i]['id'] ." class=\"item\">" . $items[$i]['item'] . "</li><hr>";
        }
        ?>
        </ul>
        </form>

        <form action="" method="post">
        <br>
        <br>
        <input type="text" class="form-control form-custom" name="item">
        <input class="btn btn-white" type="submit" value="Add">
        <br>
        <br>
        </form>
  </div>
  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="core/js/bootstrap.min.js"></script>
<script type="text/javascript">
function del(elem){
	document.getElementById('deleted').innerHTML = "<input type=\"hidden\" name=\"delete\" value=\"" + elem.id + "\">";
}
</script>

</body>
</html>