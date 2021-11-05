<?php
/*
Name: Harriet Chiu
Date: September 28, 2021
Course: Web Development 2
Topic: 
*/

date_default_timezone_set(UTC);

define('DB_DSN', 'mysql:host=localhost;dbname=login;charset=utf8');
define('DB_USER', 'project_admin');
//define('DB_USER', 'serveruser');
define('DB_PASS', 'gorgonzola7!');
//
$DSN='mysql:host = localhost; dbname=login';
$ConnectingDB = new PDO($DSN,'root','');
//

try
{
	$db = new PDO(DB_DSN, DB_USER, DB_PASS);
}
catch (PDOException $e)
{
	print "Error: " . $e->getMessage();
	die();
}
?>