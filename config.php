<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/

//date_default_timezone_set(UTC);

define('DSN', 'mysql:host=localhost;dbname=login;charset=utf8');
define('DB_USER', 'project_admin');
//define('DB_USER', 'serveruser');
define('DB_PASS', 'gorgonzola7!');
// //
// $DSN='mysql:host=localhost; dbname=login;charset=utf8';
// $ConnectingDB = new PDO($DSN,'root','');
// //

try
{
	$ConnectingDB = new PDO(DSN, DB_USER, DB_PASS);
}
catch (PDOException $e)
{
	print "Error: " . $e->getMessage();
	die();
}
?>