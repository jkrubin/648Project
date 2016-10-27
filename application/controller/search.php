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
	 * This method handles what happens when you move to http://sfsuswe.com/f16g11/Webby/search
	 */
	public function index() {
		// if we have POST data to create a new song entry


		$listings = $this->fetchListings();

		require APP . 'view/_templates/header.php';
		require APP . 'view/search/index.php';
		require APP . 'view/_templates/footer.php';
	}

	private function fetchListings():array {
		$allowedKeys = array("br", "bath", "sqft", "zip", "city",
				"dep", "pdep", "kdep", "electric", "internet", "water",
				"gas", "tv", "pet", "smoke", "furnished", "startdate", "enddate", "stno", "stadd");
		$cities = array("oakland", "san francisco", "daly city", "san", "francisco", "daly", "city");
		$streets = array("way", "street", "road");
		$sql =  "SELECT StreetNo, StreetName, City, ZIP, " .
				"Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
				"Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate " .
				"FROM Listings L, Rentals R " .
				"WHERE R.RentalId=L.RentalId";
		$splitQuery = array();
		$sortedQuery = array();


		/*
		 *If statement takes the query string from _GET["q"] and splits it up using " "(space) as a delimiter and puts it into $temp.
		 *The for loop then finds all cities and streets and pushes them into $splitQuery as one string. Other parameters are pushed into $splitQuery
		 */
		if (!empty($_GET)) {
			$temp = preg_split("/ /", $_GET["q"]);
			for($i = 0; $i < count($temp); $i++){
				if(in_array(strtolower($temp[$i]), $cities)){
					array_push($splitQuery, strtolower($temp[$i]));
				}else if(in_array((strtolower($temp[$i])." ".(strtolower($temp[$i + 1]))), $cities) || in_array(strtolower($temp[$i + 1]), $streets)){
					array_push($splitQuery, strtolower($temp[$i])." ".(strtolower($temp[$i + 1])));
					$i++;
				}else{
					array_push($splitQuery, strtolower($temp[$i]));
				}
			}


		/*
		 *foreach look takes each item in $splitQuery and catagorizes it
		 *If $key is a 5 digit number starting with a 9 then it will get added into 'zip'
		 *If $key is a number, but not a zip code, then it will push added to 'stno'
		 *if $key is a string that is in the array $cities, it will be added to 'cities'
		 *otherwise it will be added 'stadd'
		 */
			foreach($splitQuery as $key){
				if(is_numeric($key)){
					if(preg_match("/[0-9]{5}/", $key) && preg_match("/^9/", $key)){
						$sortedQuery['zip'] = $key;
					}else{
						$sortedQuery['stno'] = $key;
					}
				}else{
					if(in_array($key, $cities)){
						$sortedQuery['city'] = $key;
					}else{
						$sortedQuery['stadd'] = $key;
					}
				}
			}
			/*
			 *Each key in the array is compared to the keys allowed in an SQL query, and only adds it to the string if $key is in $allowedKeys
			 *Each key is then validated for the appropriate data type and then added to the SQL query.
			 */
			foreach ($sortedQuery as $key => $value) {
				if (in_array($key, $allowedKeys)) {
					switch ($key) {
						case "br":
							if ($this->validate($value, "integer")) {
								$sql .= " AND Bedrooms=$value";
							}
							break;

						case "bath":
							if ($this->validate($value, "integer")) {
								$sql .= " AND Bathrooms=$value";
							}
							break;

						case "sqft":
							if ($this->validate($value, "integer")) {
								$sql .= " AND SqFt=$value";
							}
							break;

						case "zip":
							if ($this->validate($value, "integer")) {
								$sql .= " AND R.ZIP=$value";
							}
							break;

						case "city":
							if ($this->validate($value, "string")) {
								$sql .= " AND R.city LIKE '%$value%'";
							}
							break;

						case "dep":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Deposit=$value";
							}
							break;

						case "pdep":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND PetDeposit=$value";
							}
							break;

						case "kdep":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND KeyDeposit=$value";
							}
							break;

						case "electric":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Electricity=$value";
							}
							break;

						case "internet":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Internet=$value";
							}
							break;

						case "water":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Water=$value";
							}
							break;

						case "gas":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Gas=$value";
							}
							break;
						case "tv":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Television=$value";
							}
							break;

						case "pet":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Pet=$value";
							}
							break;

						case "smoke":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Smoking=$value";
							}
							break;

						case "furnished":
							if ($this->validate($value, "boolean")) {
								$sql .= " AND Furnished=$value";
							}
						case "startdate":
							if ($this->validate($value, "date")) {
								$sql .= " AND StartDate=$value";
							}
							break;

						case "enddate":
							if ($this->validate($value, "date")) {
								$sql .= " AND EndDate=$value";
							}
							break;

						case "stadd":
							if ($this->validate($value, "string")){
								$sql .= " AND R.StreetName LIKE '%$value%'";
							}
							break;

						case "stno":
							if ($this->validate($value, "integer")){
								$sql .= " AND R.StreetNo LIKE '%$value%'";
							}
							break;
						default:
							break;
					}
				}
			}
		}
		$sql .= " LIMIT 10";
		//return $this->model->getListings($sql);
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	private function validate($data, $type) {
		if (is_numeric($data)) {
			if (is_int(intval($data))) {
				return ($type == "integer");
			}
		}
		if ($data == 'true' || $data == 'false') {
			return ($type == "boolean");
		}
		$temp = DateTime::createFromFormat('Y-m-d', $data);
		if ($temp && $temp->format('Y-m-d') == $data) {
			return ($type == "date");
		}
		return ($type == "string");
	}
}
