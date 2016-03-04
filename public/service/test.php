<?php
	include 'DB_Access.php';
	
	//$sql = "INSERT INTO users(`userLogin`) VALUES ('waikit3')";
	$sql = 'select * from users';

	$db = new DB_Access();
	echo $db->query($sql);

?>