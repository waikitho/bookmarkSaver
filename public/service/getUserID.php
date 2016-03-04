<?php
	header('Content-Type: application/json');
	if (isset($_REQUEST['userLogin'])){
		include 'DB_Access.php';
		$sql = "select userID from users where userLogin = '" . $_REQUEST['userLogin'] ."'";		
		$db = new DB_Access();
		
		$rs  = $db->queryRaw($sql);
		if ($rs->num_rows == 0){
			$rs->close();
			$rs = $db->queryRaw("INSERT INTO users(`userLogin`) VALUES ('".$_REQUEST['userLogin']."')");
			$rs  = $db->queryRaw($sql);
		}
		
		echo json_encode($rs->fetch_assoc());
	}
?>