<?php
class DB_Access
{
	private $db;
	
	function __construct() {
		$this->db = new mysqli('localhost', 'root', 'root', 'scotchbox');
	}
	
	public function query($sql) {
		$result = $this->queryRaw($sql);
		if ($result !== true) {
			$rows = array();
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			$result->close();
			return json_encode($rows);
		}
	}
	
	public function queryRaw($sql) {
		if(!$result = $this->db->query($sql)){
			die('There was an error running the query [' . $this->db->error . ']');
		}
		return $result;
	}
	
	public function close() {
		$this->db->close();
	}
}
?>