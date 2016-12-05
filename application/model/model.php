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

	/**
	 * Get all Listings from the database that match criteria $query
	 */
	public function get_listings($query): array {
		$allowedKeys = array("br", "bath", "sqft", "zip", "city",
				"dep", "pdep", "kdep", "electric", "internet", "water",
				"gas", "tv", "pet", "smoke", "furnished", "startdate", "enddate", "stno", "stadd",
				"rentmax", "rentmin");

		$sql = "SELECT ListingId,StreetNo, StreetName, City, ZIP, " .
				"Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
				"Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate " .
				"FROM Listings L, Rentals R " .
				"WHERE R.RentalId=L.RentalId";

		/* Each key in the array is compared to the keys allowed in an SQL query, and only adds it to the string if $key is in $allowedKeys
		 * Each key is then validated for the appropriate data type and then added to the SQL query.
		 */
		foreach ($query as $key => $value) {
			if (in_array($key, $allowedKeys)) {
				switch ($key) {
					case "br":
						if ($this->validate($value, "integer")) {
							$sql .= " AND R.Bedrooms=$value";
						}
						break;

					case "bath":
						if ($this->validate($value, "integer")) {
							$sql .= " AND R.Baths=$value";
						}
						break;

					case "sqft":
						if ($this->validate($value, "integer")) {
							$sql .= " AND R.SqFt=$value";
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
						if ($this->validate($value, "integer")) {
							$sql .= " AND L.Deposit=$value";
						}
						break;

					case "pdep":
						if ($this->validate($value, "integer")) {
							$sql .= " AND L.PetDeposit=$value";
						}
						break;

					case "kdep":
						if ($this->validate($value, "integer")) {
							$sql .= " AND L.KeyDeposit=$value";
						}
						break;

					case "electric":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Electricity=$value";
						}
						break;

					case "internet":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Internet=$value";
						}
						break;

					case "water":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Water=$value";
						}
						break;

					case "gas":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Gas=$value";
						}
						break;
					case "tv":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Television=$value";
						}
						break;

					case "pet":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Pets=$value";
						}
						break;

					case "smoke":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Smoking=$value";
						}
						break;

					case "furnished":
						if ($this->validate($value, "boolean")) {
							$sql .= " AND L.Furnished=$value";
						}
						break;

					case "startdate":
						if ($this->validate($value, "date")) {
							$sql .= " AND L.StartDate=$value";
						}
						break;

					case "enddate":
						if ($this->validate($value, "date")) {
							$sql .= " AND L.EndDate=$value";
						}
						break;

					case "stadd":
						if ($this->validate($value, "string")) {
							$sql .= " AND R.StreetName LIKE '%$value%'";
						}
						break;

					case "stno":
						if ($this->validate($value, "integer")) {
							$sql .= " AND R.StreetNo LIKE '%$value%'";
						}
						break;

					case "rentmax":
						if ($this->validate($value, "integer")) {
							$sql .= " AND L.MonthlyRent<$value";
						}
						break;
					case "rentmin":
						if ($this->validate($value, "integer")) {
							$sql .= " AND L.MonthlyRent>$value";
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


	public function get_cities(): array {
		$sql = "SELECT City FROM Rentals";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getCoords($listingId) {
		//creates the sql statement to search the database with
		$sql = "SELECT Latitude, Longitude FROM Listings L WHERE L.ListingId=$listingId;";
		//executes statement
		$query = $this->db->prepare($sql);
		$query->execute();
		//returns the associative array
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createCoords($address, $city) {
		//changes $address and $city into the format necessary to use google's API to return the JSON query.
		$address = preg_replace("/ /", "+", $address);
		$city = preg_replace("/ /", "+", $city);
		//create the google api url that will contain the JSON query
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address,+$city,+CA&key=AIzaSyB0tYK7LSPYSS2ol0WpKrdCzbfz6HcTNPQ";
		//json_decode changes the file from it's JSON representation to an associative array.
		$file = json_decode(file_get_contents($url), true);
		//searches through $file to get the latitude and longitude
		foreach ($file["results"] as $results) {
			foreach ($results["geometry"] as $geometry => $location) {
				$latitude = $location["lat"];
				$longitude = $location["lng"];
				break;
			}
		}
		//creates an associative array with keys "Latitude" and "Longitude"
		$coords = array(":latitude" => $latitude, ":longitude" => $longitude);

		return $coords;

	}

	public function obfuscate($coords) {
		$rand_1 = (0.001 + (0.001 - 0.0018) * (mt_rand() / mt_getrandmax()));
		$rand_2 = (0.001 + (0.001 - 0.0018) * (mt_rand() / mt_getrandmax()));

		$coords[":latitude"] -= $rand_1;
		$coords[":longitude"] -= $rand_2;

		return $coords;
	}
        
        

	/**
	 * Takes in an array of Listing parameters, prepares and executes SQL
	 * Query to put it into DB
	 *
	 */    
        public function addListing($rentalSQLParams, $listingSQLParams) {         
            /*
             *  Create Aditional Values for DB
             */
            //RENTAL ID
            $rentalSQLParams["RentalTypeId"] = 1;
            
            
            //Start of Sql statment
            $rentalSQL = "INSERT INTO Rentals";

            //Implode all keys
            $rentalSQL .= " (" . implode(" , ", array_keys($rentalSQLParams)) . ")";
            //Implode all values
            $rentalSQL .= " VALUES('" . implode("' , '", $rentalSQLParams) . "')";
            //Insert into Rentals Table
            $this->db->query($rentalSQL);

            //Get the last inserted ID, which is the thing we just added
            $last_id = $this->db->lastInsertID();

            /*
             *      ADD LISTING TO DB
             */
            //Add listing ID
            $listingSQLParams["RentalId"] = $last_id;
            //Dummy value for Landlord ID
            $listingSQLParams["LandlordId"] = 42;


            //Prepate Listing SQL
            $listingSQL = "INSERT INTO Listings";

            //Implode all keys
            $listingSQL .= " (" . implode(" , ", array_keys($listingSQLParams)) . ")";
            //Implode all values
            $listingSQL .= " VALUES('" . implode("' , '", $listingSQLParams) . "')";

            //Insert into Listings Table
            $this->db->query($listingSQL);

            //For testing only
            //echo $rentalSQL;
            echo "<br>" . $listingSQL;
            //header("Location: ../dashboard");
            //exit;
        }

	/**
	 * Add user to database
	 *
	 * @param $firstName String
	 * @param $lastName String
	 * @param $email String
	 * @param $password String
	 * @return boolean Indicates whether the query was successfully executed
	 */
	public function add_user($firstName, $lastName, $email, $password): bool {

		$firstName = trim($firstName);
		$lastName = trim($lastName);
		$email = strtolower(trim($email));

		$name = $firstName . ' ' . $lastName;

		// Exit if any of the variables passed in do not pass the regex validation
		if ($this->validate_name($name) && $this->validate_email($email) && $this->validate_password($password)) {
			return false;
		}

		try {
			// Test to see if email already exists in database
			$sql = "SELECT Email FROM Emails WHERE Email=:email";
			$query = $this->db->prepare($sql);
			$params = [':email' => $email];
			$query->execute($params);
			$results = $query->fetchAll();
			if (count($results) > 0) {
				return false;
			}

			// Hash password for insertion into database
			$options = ['cost' => 12];
			$hash = password_hash($password, PASSWORD_BCRYPT, $options);

			// Prep query for insertion of user info into Users table
			$sql = "INSERT INTO `Users` (`FirstName`, `LastName`, `Password`) VALUES (:firstName, :lastName, :password)";
			$query = $this->db->prepare($sql);
			$params = [':firstName' => $firstName, ':lastName' => $lastName, ':password' => $hash];

			// Insert user into Users table
			$query->execute($params);

			// Retrieve the UserId for the newly inserted data
			$sql = "SELECT UserId FROM Users WHERE FirstName=:firstName AND LastName=:lastName AND Password=:password";
			$query = $this->db->prepare($sql);
			$query->execute($params);

			$userId = $query->fetch()['UserId'];
			$userId = intval($userId);

			// Use the retrieved UserId to populate the Emails table
			$sql = "INSERT INTO `Emails` (`Email`, `UserId`, `IsPrimary`) VALUES (:email, :userId, 1)";
			$query = $this->db->prepare($sql);
			$params = [':email' => $email, ':userId' => $userId];

			$query->execute($params);

			$this->generate_auth_cookie($userId);

			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			return false;
		}
	}

	public function authenticate_user($email, $password): array {

		$response = array();

		$email = strtolower(trim($email));

		$emailPattern = '/^[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~](\.?[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~])*@[a-zA-Z](-?[a-zA-Z0-9])*(\.[a-zA-Z](-?[a-zA-Z0-9])*)+$/';
		$passwordPattern = '/[A-Za-z0-9 ,\/*\-+`~!@#$%^&\(\)_=<.>\{\}\\\|\?\[\];:\'"]{8,70}/';

		if (!(validate_email($email) && validate_password($password))) {
			$response['status'] = 'error';
			$response['message'] = 'Email and/or password cannot be found.';
			return $response;
		}

		try {
			$sql = "SELECT Address, Password FROM Users U, Emails E WHERE U.UserId=E.UserId AND Address=:email";
			$query = $this->db->prepare($sql);
			$params = [':email' => $email];
			$query->execute($params);

			while ($results = $query->fetch()) {
				if (strtolower($results['Address']) === $email) {
					$verified = password_verify($password, $results['Password']);
					if ($verified) {
						$response['status'] = 'success';
						// Will set login cookie later
					}
				}
			}
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			$response['status'] = 'error';
			$response['message'] = 'The database encountered an error.';
		}

		return $response;
	}

	public function retrieve_listing($listingId): array {
		$sql = "SELECT StreetNo, StreetName, City, ZIP, " .
				"Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
				"Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate " .
				"FROM Listings L, Rentals R " .
				"WHERE L.Listing=$listingId";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/*	public function save_listing($params): array{
			$sql = 	"UPDATE Listings L, Rentals R " .
					"SET R.StreetNo=$params['streetNo'], R.StreetName=$params['streetName'], R.City=$params['city'], R.ZIP=$params['zip'], L.Bedrooms=$params['bedrooms'], ".
					"L.Baths=$params['baths'], L.SqFt=$params['sqFt'], L.MonthlyRent=$params['monthlyRent'], ",
					"L.Description=$params['description'], L.Deposit=$params['deposit'], L.PetDeposit=$params['petDeposit'], L.KeyDeposit=$params['keyDeposit'], " .
					"L.Electricity=$params['electricity'], L.Internet=$params['internet'], L.Water=$params['water'], L.Gas=$params['gas'], L.Television=$params['television'], ".
					"L.Pets=$params['pets'], L.Smoking=$params['smoking'], L.Furnished=$params['furnished'], L.StartDate=$params['startDate'], L.EndDate=$params['endDate'] " .
					"WHERE R.RentalId=L.RentalId AND L.ListingId=$params['ListingId']";
		} */

	private function validate_email($email): bool {
		// Regex pulled through referral link from StackOverflow - http://thedailywtf.com/articles/Validating_Email_Addresses
		$emailPattern = '/^[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~](\.?[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~])*@[a-zA-Z](-?[a-zA-Z0-9])*(\.[a-zA-Z](-?[a-zA-Z0-9])*)+$/';
		return preg_match($emailPattern, $email);
	}

	private function validate_name($name): bool {
		// Regex pulled from StackOverflow - http://stackoverflow.com/a/2044909/845306
		$namePattern = '/^([ \x{00c0}-\x{01ff}a-zA-Z\'\-])+$/u';
		return preg_match($namePattern, $name);
	}

	private function validate_password($password): bool {
		// Regex for all ANSI keyboard characters
		$passwordPattern = '/[A-Za-z0-9 ,\/*\-+`~!@#$%^&\(\)_=<.>\{\}\\\|\?\[\];:\'"]{8,70}/';
		return preg_match($passwordPattern, $password);
	}

	private function generate_auth_cookie($userId): bool {
		try {
			$ONE_WEEK = 864000 * 7;

			$selector = base64_encode(random_bytes(16));

			$token = random_bytes(33);
			$tokenHash = hash('sha256', $token);

			$sql = "INSERT INTO `AuthTokens` (`UserId`, `TokenHash`, `Expiration`) VALUES (:userId, :tokenHash, :expiration)";
			$query = $this->db->prepare($sql);
			$params = [':userId' => $userId, ':tokenHash' => $tokenHash, ':expiration' => date('Y-m-d\TH:i:s', time() + $ONE_WEEK)];

			$query->execute($params);

			setcookie(
					'rememberRentSFSU', // cookie field
					$userId . ':' . $selector . ':' . base64_encode($token), time() + $ONE_WEEK, '/', // cookie value
					'sfsuswe.com', // domain
					false, // SSL only - currently false because site does not have SSL cert
					true // HttpOnly
			);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			return false;
		}
	}

	public function check_auth_cookie(): bool {
		try {
			list($userId, $selector, $token) = explode(':', $_COOKIE['rememberRentSFSU']);

			$sql = "SELECT * FROM AuthTokens WHERE Selector=:selector";
			$query = $this->db->prepare($sql);
			$params = [':selector' => $selector];

			$query->execute($params);
			$row = $query->fetch();

			if (hash_equals($row['TokenHash'], hash('sha256', base64_decode($token))) && $row['Expiration'] >= time()) {
				$this->revoke_auth_cookie($userId, $selector);
				$_SESSION['UserId'] = $row['UserId'];
				$this->generate_auth_cookie($row['UserId']);
				// Then regenerate login token as above
			}
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			return false;
		}
		return false;
	}

	public function revoke_auth_cookie($userId, $selector): bool {
		try {
			$sql = "DELETE FROM AuthTokens WHERE Selector=:selector AND UserId=:userId";
			$query = $this->db->prepare($sql);
			$params = [':selector' => $selector, ':userId' => $userId];

			$query->execute($params);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			return false;
		}
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


	public function validate($data, $type) {

		if (is_numeric($data)) {
			if (is_int(intval($data))) {
				return ($type == "integer");
			}
		}
		if ($data == 'true' || $data == 'false') {
			return ($type == "boolean");
		}
                if (preg_match("/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data)) {
			return ($type == "date");
		}
		$temp = DateTime::createFromFormat('Y-m-d', $data);

		if (preg_match("/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $temp)) {
			return ($type == "date");
		}
		return ($type == "string");
		$sql = "SELECT id, artist, track, link FROM song";
		$query = $this->db->prepare($sql);
		$query->execute();

		// fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
		// core/controller.php! If you prefer to get an associative array as the result, then do
		// $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
		// $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
		return $query->fetchAll();
	}
}
?>
