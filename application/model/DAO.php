<?php
class DAO{
	function _construct($db){
		try{
			$this->db = $db;
		}catch(PDOException $e){
			exit('Database connection could not be established');
		}
	}

	/**
	 *searches the database for $terms
	**/
	public function searchListings($terms){
		$sql = "SELECT * FROM Listings WHERE Description LIKE '%".$terms."'%";
		$query = $this->db->prepare($sql);
		return json_encode($query-fetchAll());
	}
}












?>
