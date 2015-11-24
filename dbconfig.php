<?php
ob_start();
session_start();
error_reporting(0);

$host = 'localhost';
$username = 'root';
$password = '';
	
$conn = mysql_connect($host, $username, $password);
mysql_select_db('nextbook', $conn);
 