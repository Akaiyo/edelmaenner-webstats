<?php
if(!isset($_GET['type']) && !isset($_GET['user']) && !isset($_GET['size'])){
	die("please define a username and a type");
}

require ('lib/class_uuid.php');
require ('lib/class_skin.php');

if(!isset($_GET['user']) && !ctype_print($_GET['user'])){
	die("wrong username");
}

if ($_GET['type'] == 'head')
{
	$skin = new Skin($_GET['user']);
	header("Content-Type: image/png");
	$image = $skin->getHeadHelm($_GET['size']);
	imagepng($image);
} 
elseif ($type = 'body')
{
	
}
