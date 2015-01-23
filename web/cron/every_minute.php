<?php

require_once('../config.php');
require_once('../lib/classes/McMyAdmin.class.php');

$sql = new mysqli($cfg['sql_stats_server'], $cfg['sql_stats_user'], $cfg['sql_stats_password'], $cfg['sql_stats_database']);
if(!$sql){
	die();
}

$McMyAdmin = new McMyAdmin('status', 'gpUzgWMeFbuKEvE2xJcj', '144.76.76.163', '8998');
$McMyAdminServerStatus = $McMyAdmin->getStatus();

$users = $McMyAdminServerStatus->users; 
$maxusers = $McMyAdminServerStatus->maxusers;
$ram = $McMyAdminServerStatus->ram;
$maxram = $McMyAdminServerStatus->maxram;
$cpuusage = $McMyAdminServerStatus->cpuusage;


$sql->query("INSERT INTO history (players, maxplayers, ram, maxram, cpuusage) VALUES ($users, $maxusers, $ram, $maxram, $cpuusage)");

?>