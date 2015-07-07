<?php
error_reporting(E_ALL);
/*
** Run this script every minute!
id
timestamp
players
ram
cpu

*/
include('../lib/classes/McMyAdmin.class.php');



$sql = new mysqli('localhost','statistics','Gzrf9JMPqesNQQnA','statistics');
$McMyAdmin = new McMyAdmin('status', 'gpUzgWMeFbuKEvE2xJcj', '144.76.76.163', '8998');

$McMyAdminServerStatus = $McMyAdmin->GetStatus();

$players = $McMyAdminServerStatus->players;
$ram = $McMyAdminServerStatus->ram;
$cpu = $McMyAdminServerStatus->cpu;

var_dump('test');

if(!$sql){
	die('MySQL - Error!');
}

?>