<?php
	header('Content-Type: application/json');
	include 'DB_Access.php';
	$sql = "select typeName from types";
	$db = new DB_Access();
	echo $db->query($sql);
?>