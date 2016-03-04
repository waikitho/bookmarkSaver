<?php
	header('Content-Type: application/json');
	if (isset($_REQUEST['userID'])){
		include 'DB_Access.php';
		$sql = "select b.bookmarkID, b.url, b.label, t.typeName from bookmarks b, types t where t.typeID = b.typeID and b.userID = " . $_REQUEST['userID'];
		$db = new DB_Access();
		echo $db->query($sql);
	}
?>