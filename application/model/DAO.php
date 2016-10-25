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
	    $sql0 = "SELECT * FROM IMFORMATION_SCHEMA.columns";
	    $query0 = $this->db->prepare($sql0);
	    $sql = NULL;
	    foreach($query0->fetchALL as &$value){
		    $temp = "SELECT * FROM Listings WHERE " . $value . " LIKE '%".$terms."'%";
		    if($sql == NULL){
		        $sql = temp
		    }else{
		        $sql = $sql . " UNION " . $temp;
		    }
		    $query = $this->db->prepare($sql);
		}
		return json_encode($query->fetchAll());
	}
}












?>
