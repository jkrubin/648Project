<?php

/**
 * 
 * 
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Search extends Controller {
	/**
	 * PAGE: index
	 * This method handles what happens when you move to http://sfsuswe.com/f16g11/Webby/search.php
	 */
	$allowed_keys = array("br", "bath", "sqft", "zip", "city", "dep", "pdep", "kdep", "electric", "internet", "water", "gas", "tv", "pet", "smoke", "furnished", "startdate", "enddate");
	public function index() {
		// if we have POST data to create a new song entry

	}

	private function fetchListings():array {
		$sql = "SELECT StreetNo, StreetName, City, ZIP, RT.Description, " .
		              "Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
					  "Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate" .
		       "FROM Listings L, Rentals R, RentalType RT " .
		       "WHERE R.RentalId=L.RentalId AND RT.RentalTypeId=R.RentalTypeId";		
		if (!empty($_GET)) {
			// do addSong() in model/model.php
			foreach ($_GET as $key => $value) {
				$key = strtolower($key)
				if(in_array($key, $allowed_keys)){

						switch($key){
							case "br":
							if(validate($value, "integer")){
								$sql = $sql . " AND Bedrooms=$value";
							}	
							break;

							case "bath":
							if(validate($value, "integer")){
								$sql = $sql . " AND Bathrooms=$value";
							}
							break;

							case "sqft":
							if(validate($value, "integer")){
								$sql = $sql . " AND SqFt=$value";
							}
							break;

							case "zip":
							if(validate($value, "integer")){
								$sql = $sql . " AND ZIP=$value";
							}
							break;

							case "city":
							if(validate($value, "string")){
								$sql = $sql . " AND city=$value";
							}
							break;

							case "dep":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Deposit=$value";
							}
							break;

							case "pdep":
							if(validate($value, "boolean")){
								$sql = $sql . " AND PetDeposit=$value";
							}
							break;

							case "kdep":
							if(validate($value, "boolean")){
								$sql = $sql . " AND KeyDeposit=$value";
							}
							break;
							
							case "electric":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Electricity=$value";
							}
							break;

							case "internet":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Internet=$value";
							}
							break;
							case "water":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Water=$value";
							}
							break;

							case "gas":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Gas=$value";
							}
							break;
							case "tv":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Television=$value";
							}
							break;

							case "pet":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Pet=$value";
							}
							break;
	
							case "smoke":
							if(validate($value, "boolean")){
							$sql = $sql . " AND Smoking=$value";
							}
							break;

							case "furnished":
							if(validate($value, "boolean")){
								$sql = $sql . " AND Furnished=$value";
							}
							case "startdate":
							if(validate($value, "date")){
								$sql = $sql . " AND StartDate=$value";
							}
							break;
							
							case "enddate":
							if(validate($value, "date")){
								$sql = $sql . " AND EndDate=$value";
							}
							break;
							
																																																	
						}			
				}
 				
			}	
		}
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();

	}
	private function validate($data, $type){
		if(is_numeric($data)){
			if(is_int(intval($data)){
				return ($type == "int")
			}
		}
		if($data == 'true' || $data == 'false'){
			return ($type == "boolean");
		}
		$temp = DateTime::createFromFormat('Y-m-d', $data);
		if($temp && $temp->format('Y-m-d') === $data){
			return ($type == "date");
		}
		return ($type == "string");
	}
	

}
