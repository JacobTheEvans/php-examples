<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

echo "<h2>PHP/Python IP to location</h2><br>";

echo "<p> Your IP: $ip</p><br>";
$command = escapeshellcmd("/var/www/html/iptolocal.py $ip");
$output = shell_exec($command);
echo '<p>Location: ' . $output . '</p>';
?>