<?php

class Model {
	/**
	 * @param object $db A PDO database connection
	 */
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	/*
	 *Get all Listings from the database that match criteria $query
	 *
	 */
	public function getListings($query){
		$allowedKeys = array("br", "bath", "sqft", "zip", "city",
				"dep", "pdep", "kdep", "electric", "internet", "water",
				"gas", "tv", "pet", "smoke", "furnished", "startdate", "enddate", "stno", "stadd");
		$sql =  "SELECT StreetNo, StreetName, City, ZIP, " .
				"Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
				"Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate " .
				"FROM Listings L, Rentals R " .
				"WHERE R.RentalId=L.RentalId";
                
			/*
			 *Each key in the array is compared to the keys allowed in an SQL query, and only adds it to the string if $key is in $allowedKeys
			 *Each key is then validated for the appropriate data type and then added to the SQL query.
			 */
			foreach ($query as $key => $value) {
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
								$sql .= " AND R.ZIP='$value'";
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
		$sql .= " LIMIT 10;";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getCities(){
		$sql = "SELECT City FROM Rentals";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getCoords($listingId){
		//creates the sql statement to search the database with
		$sql = "SELECT Latitude, Longitude FROM Listings L WHERE L.ListingId=$listingId;";
		//executes statement
		$query = $this->db->prepare($sql);
		$query->execute();
		//returns the associative array
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createCoords($address, $city){
		//changes $address and $city into the format necessary to use google's API to return the JSON query.
		$address = preg_replace("/ /", "+", $address);
		$city = preg_replace("/ /", "+", $city);
		//create the google api url that will contain the JSON query
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address,+$city,+CA&key=AIzaSyB0tYK7LSPYSS2ol0WpKrdCzbfz6HcTNPQ";
		//json_decode changes the file from it's JSON representation to an associative array.
		$file = json_decode(file_get_contents($url), true);
		//searches through $file to get the latitude and longitude
		foreach($file["results"] as $results){
			foreach($results["geometry"] as $geometry => $location){
				$latitude = $location["lat"];
				$longitude = $location["lng"];
				break;
			}
		}
		//creates an associative array with keys "Latitude" and "Longitude"
		$coords = array("Latitude" => $latitude, "Longitude" => $longitude);

		return $coords;

	}

	public function obfuscate($coords){
		$rand_1 = (0.001 + (0.001 - 0.0018) * (mt_rand() / mt_getrandmax()));
		$rand_2 = (0.001 + (0.001 - 0.0018) * (mt_rand() / mt_getrandmax()));

		$coords["Latitude"] -= $rand_1;
		$coords["Longitude"] -= $rand_2;

		return $coords;
	}
        
        /**
         * Takes in an array of Listing parameters, prepares and executes SQL
         * Query to put it into DB
         *  
         */
        public function addListing($params) {
            
                $sql = "INSERT INTO listing (StreetNo, StreetName, City, ZIP, "
                        . "Bedrooms, Baths, SqFt, MonthlyRent, Description, "
                        . "Deposit, PetDeposit, KeyDeposit, "
                        . "Electricity, Internet, Water, Gas, Television, Pets, "
                        . "Smoking, Furnished, StartDate, EndDate "
                        . " VALUES (:streetNo, :streetName, :city, :zipCode"
                        . ",:bedrooms, :baths, :sqFt, :monthlyRent, :description"
                        . ",:deposit, :petDeposit, :keyDeposit, :electricity"
                        . ",:internet, :water, :gas, :television, :pets, :smoking"
                        . ", :furnished, :startDate, :endDate)";
		$query = $this->db->prepare($sql);
		$parameters = array($params);


		$query->execute($parameters);
	}
        
	/**
	 * Get all songs from database
	 */
	public function getAllSongs() {
		$sql = "SELECT id, artist, track, link FROM song";
		$query = $this->db->prepare($sql);
		$query->execute();

		// fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
		// core/controller.php! If you prefer to get an associative array as the result, then do
		// $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
		// $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
		return $query->fetchAll();
	}

	/**
	 * Add a song to database
	 * TODO put this explanation into readme and remove it from here
	 * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
	 * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
	 * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
	 * in the views (see the views for more info).
	 * @param string $artist Artist
	 * @param string $track Track
	 * @param string $link Link
	 */
	public function addSong($artist, $track, $link) {
		$sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
		$query = $this->db->prepare($sql);
		$parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$query->execute($parameters);
	}

	/**
	 * Delete a song in the database
	 * Please note: this is just an example! In a real application you would not simply let everybody
	 * add/update/delete stuff!
	 * @param int $song_id Id of song
	 */
	public function deleteSong($song_id) {
		$sql = "DELETE FROM song WHERE id = :song_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':song_id' => $song_id);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$query->execute($parameters);
	}

	/**
	 * Get a song from database
	 */
	public function getSong($song_id) {
		$sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
		$query = $this->db->prepare($sql);
		$parameters = array(':song_id' => $song_id);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$query->execute($parameters);

		// fetch() is the PDO method that get exactly one result
		return $query->fetch();
	}

	/**
	 * Update a song in database
	 * // TODO put this explaination into readme and remove it from here
	 * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
	 * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
	 * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
	 * in the views (see the views for more info).
	 * @param string $artist Artist
	 * @param string $track Track
	 * @param string $link Link
	 * @param int $song_id Id
	 */
	public function updateSong($artist, $track, $link, $song_id) {
		$sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$query->execute($parameters);
	}

	/**
	 * Get simple "stats". This is just a simple demo to show
	 * how to use more than one model in a controller (see application/controller/songs.php for more)
	 */
	public function getAmountOfSongs() {
		$sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
		$query = $this->db->prepare($sql);
		$query->execute();

		// fetch() is the PDO method that get exactly one result
		return $query->fetch()->amount_of_songs;
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
?>
