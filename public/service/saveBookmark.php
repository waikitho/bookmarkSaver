<?php
	//header('Content-Type: application/json');
	if (isset($_REQUEST['userID']) && isset($_REQUEST['url']) && isset($_REQUEST['type']) && isset($_REQUEST['label'])){
		include 'DB_Access.php';
		// 1) does this type exist?
		$db = new DB_Access();
		$rs = $db->queryRaw("select typeID from types where typeName ='" .$_REQUEST['type']."'");
		
		if ($rs->num_rows == 0){
			$rs->close();
			echo "INSERT INTO types(`typeName`) VALUES ('".$_REQUEST['type']."')";
			
			$rs = $db->queryRaw("INSERT INTO types(`typeName`) VALUES (".$_REQUEST['type'].")");
			$rs = $db->queryRaw("select typeID from types where typeName ='" .$_REQUEST['type'])."'";
		}
		$typeID = $rs->fetch_assoc()['typeID'];
		echo $typeID;
		$rs->close();
		
		// 2) insert or update? 
		if (isset($_REQUEST['bookmarkID'])) {
			$sql = "update bookmarks set url='".$_REQUEST['url']."', label='".$_REQUEST['label']."', typeID='".$typeID."' where bookmarkID = '" . $_REQUEST['bookmarkID']."'";
			echo $sql;
		} else {
			$sql = "insert into bookmarks(`userID`, `url`, `label`, `typeID`) values ('".$_REQUEST['userID']."', '".$_REQUEST['url']."', '".$_REQUEST['label']."', '".$typeID."')";
			echo $sql;
		}
		$db->query($sql);
	}
?>