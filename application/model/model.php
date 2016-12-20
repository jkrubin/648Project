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
		$allowedKeys = array("br", "brmin", "brmax", "bath", "sqft", "zip", "city",
				"dep", "pdep", "kdep", "electric", "internet", "water",
				"gas", "tv", "pet", "smoke", "furnished", "startdate", "enddate", "stno", "stadd",
				"rentmax", "rentmin");

		$sql =  "SELECT ListingId,StreetNo, StreetName, City, ZIP, " .
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
                
                if(!empty($file["results"])){
                    $latitude = $file["results"][0]["geometry"]["location"]["lat"];
                    $longitude = $file["results"][0]["geometry"]["location"]["lng"];
                }else{
                    $latitude = 37.7749;
                    $longitude = -122.4194;
                }
                
                //var_dump($file["results"]);
                //echo '<br> lat: '. $latitude. 'long: ' . $longitude. '<br>';
                
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
	public function addListing($rentalSQLParams, $listingSQLParams, $userId) {

            $message = array();
            $message['id'] = 0;
            $message['error'] = FALSE;

            
            /*
             *  Create Aditional Values for DB
             */
            //RENTAL ID
            $rentalSQLParams["RentalTypeId"] = 1;

            /*
             *  Create long and lat for appartment
             */
            $addr = ''.$rentalSQLParams['StreetNo'].' '.$rentalSQLParams['StreetName'];
            $city = $rentalSQLParams['City'];
            
            try{
                $coordinates = $this -> createCoords($addr,$city);
                $rentalSQLParams['Latitude'] = $coordinates[":latitude"];
                $rentalSQLParams['Longitude'] = $coordinates[":longitude"];

                $coordinates = $this -> obfuscate($coordinates);
            }catch(Exception $e){
                echo "error";
            }


            $listingSQLParams['Latitude'] = $coordinates[":latitude"];
            $listingSQLParams['Longitude'] = $coordinates[":longitude"];
            
            /*
             * Calculate distance from SFSU
             * Distance API
             * Google URL for  rental distance
             */

            $baseURL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial";
            $rentalCoords = "&origins=" . $rentalSQLParams['Latitude'] . "," . $rentalSQLParams['Longitude'];
            $school = "&destinations=place_id:ChIJEaQJfqV9j4ARm8dWmX2G82s";
            $key = "&key=AIzaSyB7EOI6z0RYwDHp5JE7IDcqDhXeRXrcurk";
            $rentalDistanceURL = $baseURL . $rentalCoords . $school . $key;

            $rentalResponse = file_get_contents($rentalDistanceURL);
            $result = json_decode($rentalResponse,true);

            // Get distance value in Miles, form of a double            
            if(array_key_exists('rows', $result) and 
                    ($result['rows'][0]['elements'][0]['status'] == 'OK')){
                $distance= $result['rows'][0]['elements'][0]['distance']['text'];
                $distance= doubleval(explode(' ', $distance)[0]);
            }else{
                $distance = 0.0;
            }

            /*
             *      ADD RENTAL TO DB
             */
            //Start of Sql statment
            $rentalSQL = "INSERT INTO Rentals";

            //Implode all keys
            $rentalSQL .= " (" . implode(" , ", array_keys($rentalSQLParams)) . ")";
            //Implode all values
            $rentalSQL .= " VALUES('" . implode("' , '", $rentalSQLParams) . "')";
            
            try{
                //Insert into Rentals Table
                $this->db->query($rentalSQL);

                //Get the last inserted ID, which is the thing we just added
                $last_id = $this->db->lastInsertID();
            }catch(PDOException $e){
                $message['error']=TRUE;
                echo 'Database entry Failed:'. $e->getMessage();
                
            }

            /*
             *      ADD LISTING TO DB
             */

            //Add listing ID
            $listingSQLParams["RentalId"] = $last_id;
            //Dummy value for Landlord ID
            $listingSQLParams["LandlordId"] = $userId;
            //Previously calculated distance
            $listingSQLParams["Distance"] = $distance;

            //Prepate Listing SQL
            $listingSQL = "INSERT INTO Listings";
            //Implode all keys
            $listingSQL .= " (" . implode(" , ", array_keys($listingSQLParams)) . ")";
            //Implode all values
            $listingSQL .= " VALUES('" . implode("' , '", $listingSQLParams) . "')";

            try{
                //Insert into Listings Table
                $this->db->query($listingSQL);
                //Get listing ID 
                $last_id = $this->db->lastInsertID();

            }catch(PDOException $e){
                $message['error']=TRUE;
                echo 'Database entry Failed:'. $e->getMessage();
            }

            $message['id'] = $last_id;
            return $message;
	}

	public function retrieve_listing($listingId): array {
		$sql = "SELECT StreetNo, StreetName, City, ZIP, " .
				"Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, LandlordId, " .
				"Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate, L.Longitude, L.Latitude " .
				"FROM Listings L, Rentals R " .
				"WHERE L.ListingId=$listingId AND R.RentalId=L.RentalId;";
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
        
		if (!($this->validate_name($name) && $this->validate_email($email) && $this->validate_password($password))) {

            echo "failure at validate check.";
			return false;
		}
        echo "Passed Validation Check.";

		try {
			// Test to see if email already exists in database
			$sql = "SELECT Email FROM Emails WHERE Email=:email";
			$query = $this->db->prepare($sql);
			$params = [':email' => $email];
			$query->execute($params);
			$results = $query->fetchAll();
			if (count($results) > 0) {
                echo "failure";
				return false;
			}
            echo "Email check passed.";

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

	public function authenticate_user($email, $password, $url): array {

		$response = array();

		$email = strtolower(trim($email));

		if (!($this->validate_email($email) && $this->validate_password($password))) {
			$response['status'] = 'error';
			$response['message'] = 'Email and/or password cannot be found.';
			return $response;
		}

		try {
			$sql = "SELECT U.UserId, FirstName, LastName, Email, Password, Disabled 
			        FROM Users U, Emails E 
			        WHERE U.UserId=E.UserId AND Email=:email";
			$query = $this->db->prepare($sql);
			$params = [':email' => $email];
			$query->execute($params);

			while ($results = $query->fetch()) {
				if (strtolower($results['Email']) === $email) {
					$verified = password_verify($password, $results['Password']);
					if ($verified) {
						$response['status'] = 'success';
						$name = $results['FirstName'] . ' ' . substr($results['LastName'], 0, 1) . '.';
						$response['name'] = $name;
						$response['userId'] = $results['UserId'];
                        $response['disabled'] = $results['Disabled'];
						$this->init_session($results['UserId'], $name, $results['Disabled']);
						$this->generate_auth_cookie($results['UserId']);
					}else{
                        echo "incorrect password";
                    }
				}else{
                    echo "incorrect email";
                }
			}
			if (empty($_SESSION)) {
                
				$response['status'] = 'error';
				$response['message'] = 'Username and/or password do not match.';
			}
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), '\n';
			$response['status'] = 'error';
			$response['message'] = 'The database encountered an error.';
		}

		return $response;
	}

	private function init_session($userId, $name, $disabled): bool {
		if (session_start()) {
			$_SESSION['UserId'] = $userId;
			$_SESSION['Name'] = $name;
            $_SESSION['Disabled'] = $disabled;
			return true;
		} else {
            echo "Session init fail";
			return false;
		}
        }
	private function validate_email($email): bool {
		// Regex pulled through referral link from StackOverflow - http://thedailywtf.com/articles/Validating_Email_Addresses
		$emailPattern = '/^[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~](\.?[-!#$%&\'*+\/0-9=?A-Z^_a-z{|}~])*@[a-zA-Z](-?[a-zA-Z0-9])*(\.[a-zA-Z](-?[a-zA-Z0-9])*)+$/';
        echo "Email: ", preg_match($emailPattern, $email);
		return preg_match($emailPattern, $email);
	}

	private function validate_name($name): bool {
		// Regex pulled from StackOverflow - http://stackoverflow.com/a/2044909/845306
		$namePattern = '/^([ \x{00c0}-\x{01ff}a-zA-Z\'\-])+$/u';
        echo "Name: ", preg_match($namePattern, $name);
		return preg_match($namePattern, $name);
	}

	private function validate_password($password): bool {
		// Regex for all ANSI keyboard characters
		$passwordPattern = '/[A-Za-z0-9 ,\/*\-+`~!@#$%^&\(\)_=<.>\{\}\\\|\?\[\];:\'"]{1,70}/';
        echo "Password: ", preg_match($passwordPattern, $password);
		return preg_match($passwordPattern, $password);
	}

	private function generate_auth_cookie($userId): bool {
		try {
			$ONE_WEEK = 864000 * 7;

			$selector = base64_encode(random_bytes(16));

			$token = random_bytes(33);
			$tokenHash = hash('sha256', $token);

			$sql = "INSERT INTO `AuthTokens` (`UserId`, `Selector`, `TokenHash`, `Expiration`) 
			        VALUES (:userId, :selector, :tokenHash, :expiration)";
			$query = $this->db->prepare($sql);
			$params = [
					':userId' => $userId,
					':selector' => $selector,
					':tokenHash' => $tokenHash,
					':expiration' => date('Y-m-d\TH:i:s', time() + $ONE_WEEK)
			];

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

			$sql = "SELECT A.UserId, FirstName, LastName, Selector, TokenHash, Expiration 
			        FROM AuthTokens A, Users U WHERE Selector=:selector AND A.UserId=U.UserId";
			$query = $this->db->prepare($sql);
			$params = [':selector' => $selector];

			$query->execute($params);
			$row = $query->fetch();

			if (hash_equals($row['TokenHash'], hash('sha256', base64_decode($token))) && $row['Expiration'] >= time()) {
				$this->revoke_auth_cookie($userId, $selector);
				$name = $row['FirstName'] . ' ' . substr($row['LastName'], 0, 1) . '.';
				$this->init_session($userId, $name);
				$this->generate_auth_cookie($row['A.UserId']);
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
    
    public function send_message($params){
        $sql = "INSERT INTO Messages(SenderId, RecipientId, ListingId, Title, Body, IsUnread)
                    VALUES(:senderId, :recipientId, :listingId, :title, :body, :true);";
        $query = $this->db->prepare($sql);
        var_dump($query);
        var_dump($params);
        $query->execute($params);
    }

    public function get_new_messages($userId){
        $sql = "SELECT MessageId ,SenderId, RecipientId, ListingId, Title, Body 
                FROM Messages M WHERE M.RecipientId=$userId AND M.IsUnread=1;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function view_message($messageId){
        $sql = "UPDATE Messages M 
                SET IsUnread=0
                WHERE M.MessageId=$messageId;";
        $query = $this->db->prepare($sql);
        $query->execute();
        

        $sql_1 = "SELECT SenderId, RecipientId, ListingId, Title, Body 
                  FROM Messages M 
                  WHERE M.MessageId=$messageId;";
        $query_1 = $this->db->prepare($sql_1);
        $query_1->execute();
        return $query_1->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_old_messages($userId){
        $sql = "SELECT MessageId, SenderId, RecipientId, ListingId, Title, Body
                FROM Messages M WHERE M.RecipientId=$userId AND M.IsUnread=0;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    
    public function get_all_messages($userId){
        $sql = "SELECT MessageId, SenderId, RecipientId, ListingId, Title, Body
                FROM Messages M WHERE M.RecipientId=$userId;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    
    public function delete_message($messageId){
        $sql = "DELETE FROM Messages
                WHERE MessageId=$messageId";
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    public function get_dashboard($userId){
        
            $sql =  "SELECT ListingId,StreetNo, StreetName, City, ZIP, " .
				    "Bedrooms, Baths, SqFt, MonthlyRent, Description, Deposit, PetDeposit, KeyDeposit, " .
				    "Electricity, Internet, Water, Gas, Television, Pets, Smoking, Furnished, StartDate, EndDate " .
				    "FROM Listings L, Rentals R " .
				    "WHERE R.RentalId=L.RentalId AND L.LandlordId=$userId";

            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

    }


    public function edit_listing($streetNo, $streetName, $city, $ZIP, $monthlyRent, $description, $bedrooms, $baths, $deposit, $keyDeposit, $petDeposit, $startDate, 
                                 $endDate, $electricity, $furnished, $gas, $internet, $pets, $smoking, $television, $water, $listingId){

        $sql = 	"UPDATE Listings L, Rentals R " .
			    "SET R.StreetNo='$streetNo', R.StreetName='$streetName', R.City='$city', R.ZIP='$ZIP', R.Bedrooms='$bedrooms', ".
				"R.Baths='$baths', L.MonthlyRent='$monthlyRent', " .
				"L.Description='$description', L.Deposit='$deposit', L.PetDeposit='$petDeposit', L.KeyDeposit='$keyDeposit', " .
				"L.Electricity='$electricity', L.Internet='$internet', L.Water='$water', L.Gas='$gas', " . 
                "L.Television='$television', ".
			    "L.Pets='$pets', L.Smoking='$smoking', L.Furnished='$furnished', L.StartDate='$startDate', ".  
                "L.EndDate='$endDate' " .
				"WHERE R.RentalId=L.RentalId AND L.ListingId='$listingId'";
        $query = $this->db->prepare($sql);
        $query->execute();

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
        }
	public function logout() {
        session_start();
		if (empty($_SESSION) || empty($_SESSION['UserId'])) {
            return;
		}
		list($userId, $selector, $token) = explode(':', $_COOKIE['rememberRentSFSU']);

		unset($_SESSION['UserId']);
		unset($_SESSION['Name']);
		unset($_SESSION);
		session_destroy();
		$this->revoke_auth_cookie($userId, $selector);
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

        
        public function delete_listing($listingId){
            
            //VERIFY ADMIN PRIVILAGES;
                //INSERT CODE HERE
            
            //Execute sequence
            $sql_0 = "DELETE FROM Photos WHERE ListingId='$listingId';";
            $query_0 = $this->db->prepare($sql_0);
            $query_0->execute();

            $sql = "DELETE FROM Listings WHERE ListingId='$listingId';";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        
        public function disable_account($userId, $message = NULL){
            //VERIFY ADMIN PRIVILAGES;
                //INSERT CODE HERE
            
            //Execute sequence
            $sql = "UPDATE Users "
                    . "SET Disabled = 1, LoginMsg = $message "
                    . "WHERE UserId = $userId";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        
        public function enable_account($userId, $message = NULL){
            //VERIFY ADMIN PRIVILAGES;
                //INSERT CODE HERE
            
            //Execute sequence
            $sql = "UPDATE Users "
                    . "SET Disabled = 0, LoginMsg = $message "
                    . "WHERE UserId = $userId";
            $query = $this->db->prepare($sql);
            $query->execute();           
        }

        public function submit_blob($img_info, $img_temp,$id){
            
            $width = $img_info[0];
            $height = $img_info[1];
            $type = $img_info ['mime'];
            
            //echo "ID IS: ". $id;
            $listing_id = $id;

            if(strpos($type, 'image/')!==FALSE){
                $temp_type = explode('/', $type);
                $type = $temp_type[1];
            
                $primary = 0;
                $order = 1;

                $blob = fopen($img_temp, 'rb');

                $sql = "INSERT INTO Photos(`ListingId`,`Primary`, `Order`, `Height`, `Width`, `Data`, `Format`) "
                        . "VALUES(:id, :primary, :place, :height, :width, :blob, :mime)";

                $stmt = $this->db->prepare($sql);

                $stmt->bindParam(':id', $listing_id);
                $stmt->bindParam(':primary', $primary);
                $stmt->bindParam(':place', $order);
                $stmt->bindParam(':height', $height);
                $stmt->bindParam(':width', $width);
                $stmt->bindParam(':blob', $blob, PDO::PARAM_LOB);
                $stmt->bindParam(':mime', $type);

                $stmt->execute();
                            
                // EVERYTHING BELOW TO BE REMOVED AFTER TESTING
                //$last_id =$this->db->lastInsertID();
                
                //$this->print_blob_by_blob_id($last_id);
                    
            }else {
                echo 'File is not an image. bye';
                
            }

        }
        
        public function retrieve_blob_by_listing($listingId){
            
                $sql = "SELECT * FROM Photos WHERE ListingId = $listingId";
		//executes statement
		$query = $this->db->prepare($sql);
		$query->execute();
                return $query->fetchAll(PDO::FETCH_ASSOC);
                
                //DISPLAY IMAGE USING
                //$photo = retrieve_blob_by_listing($listingId);
                //echo '<img src="data:image/'.$photo[0]["Format"].';base64,'.base64_encode( $photo[0]["Data"] ).'"/>';      
        }
        
        public function print_blob_by_blob_id($blobId){
            
                $sql = "SELECT * FROM Photos WHERE PhotoId = $blobId";
		//executes statement
		$query = $this->db->prepare($sql);
		$query->execute();
                $photo = $query->fetchAll(PDO::FETCH_ASSOC);
                
                //DISPLAY IMAGE USING
                echo '<img src="data:image/'.$photo[0]["Format"].';base64,'.base64_encode( $photo[0]["Data"] ).'"/>';      
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
}

?>


