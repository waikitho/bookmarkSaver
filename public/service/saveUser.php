<?php
	header('Content-Type: application/json');
	if (isset($_REQUEST['userLogin'])){
		include 'DB_Access.php';
		$sql = "INSERT INTO users(`userLogin`) VALUES (" .$_REQUEST['userLogin']. ")";
		$db = new DB_Access();
		echo $db->query($sql);
	}
?>