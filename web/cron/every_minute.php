<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../lib/classes/McMyAdmin.class.php');

$sql = new mysqli($cfg['sql_stats_server'], $cfg['sql_stats_user'], $cfg['sql_stats_password'], $cfg['sql_stats_database']);
if(!$sql){
	die();
}

$McMyAdmin = new McMyAdmin('status', 'gpUzgWMeFbuKEvE2xJcj', '144.76.76.163', '8998');
$McMyAdminServerStatus = $McMyAdmin->getStatus();


$users = $McMyAdminServerStatus->users; 
$maxusers = $McMyAdminServerStatus->maxusers; 
$ram = ($McMyAdminServerStatus->ram) ? $McMyAdminServerStatus->ram : -1; 
$maxram = ($McMyAdminServerStatus->maxram) ? $McMyAdminServerStatus->maxram : -1; 
$cpuusage = ($McMyAdminServerStatus->cpuusage) ? $McMyAdminServerStatus->cpuusage : -1; 


$sql->query("INSERT INTO history (players, maxplayers, ram, maxram, cpuusage) VALUES ($users, $maxusers, $ram, $maxram, $cpuusage)");

?>