<?php
include 'template.php';

$template = new template;

$template->assign('username','Jacob');
$template->assign('age','17');
$template->assign('privilege','root');

$template->render('myTemplate');
?>