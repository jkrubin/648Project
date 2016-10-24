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
		$data = http_build_query($terms);
		$sql = "SELECT * FROM Listings WHERE Description LIKE '%".$data."'%";
		$query = $this->db->prepare($sql);
		return $query-fetchAll();
	}
}












?>
