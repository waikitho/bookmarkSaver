<?php
	header('Content-Type: application/json');
	if (isset($_REQUEST['bookmarkID'])){
		include 'DB_Access.php';
		$sql = "delete from bookmarks where bookmarkID = '".$_REQUEST['bookmarkID']."'";
		$db = new DB_Access();
		echo $db->query($sql);
	}
?>