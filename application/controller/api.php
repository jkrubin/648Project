<?php


Class Api extends Controller {
	/*
	 * Class for listings page (not yet created)
	 *
	 */
	public function index() {
		// load views
		require APP . 'view/_templates/header.php';
		require APP . 'view/problem/index.php';
        require APP . 'view/_templates/login_modal.php';
		require APP . 'view/_templates/footer.php';
	}
        public function getCoords($listingId){
		    return $this->model->getCoords($listingId);
        }

    public function logout(){
        try{
            $this->model->logout();
            header("Location: ../");
        }catch(Exception $e){
            echo 'Error', $e->getMessage();
        }
    }

    public function login(){
        $response = $this->model->authenticate_user($_POST['email'], $_POST['password'], '');
        if($response['status'] == 'success'){
            header("Location: ../account_center");
        }else{
            header("Location: ../");
        }
    }

    public function signup(){
        try{           
            $this->model->add_user($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
            $response = $this->model->authenticate_user($_POST['email'], $_POST['password'], '');
            if($response['status'] == 'success'){
                header("Location: ../");
            }
            
        }catch(Exception $e){
            echo 'Error', $e->getMessage();        
        }
    }

    public function sendMessage(){
        session_start();
        try{
           $params = array(':body' => $_POST['message'], 'senderId' => $_SESSION['UserId'], ':recipientId' => $_POST['landlordId'], 
                           ':listingId' => $_POST['listingId'], ':true' => true);
           if(array_key_exists('subject', $_POST)){
                $params[':title'] = $_POST['subject'];
           }
           $this->model->send_message($params);
           header("Location: ../account_center#messages");            
        }catch(Exception $e){
           echo 'Error', $e->getMessage();
        }
    }
    
    public function get_new_messages():array{
        try{
            return $this->model->get_new_messages($_POST['userId']);
        }catch(Exception $e){
            echo 'Error', $e->getMessage();
        }
    }

    public function view_message():array{
        try{
            return $this->model->view_message($_POST['messageId']);
        }catch(Exception $e){
            echo 'Error', $e->getMessage();
        }
    }

    public function get_old_messages():array{
        try{
            return $this->model->view_message($_POST['userId']);
        }catch(Exception $e){
            echo 'Error', $e->getMessage();        
        }
    }

    public function delete_message(){
        if(isset($_POST['deleteMessage'])){
            try{
                $this->model->delete_message($_POST['messageId']);
                header("Location: ../account_center#messages");
            }catch(Exception $e){
                echo 'Error', $e->getMessage();        
            }
        }
        else{
            header("Location: ../account_center?".$_POST['idPass']."#contact");
        }
    }

	public function addListing() {

		//Create new listing if we have post data from submit_listing
		if (isset($_POST["submit_listing"])) {
			$parameters = array(':streetNo' => $_POST["streetNo"],
					':streetName' => $_POST["streetName"],
					':city' => $_POST["city"],
					':zipCode' => $_POST["zipCode"],
					':bedrooms' => $_POST["bedrooms"],
					':baths' => $_POST["baths"],
					':sqFt' => $_POST["sqFt"],
					':monthlyRent' => $_POST["monthlyRent"],
					':description' => $_POST["description"],
					':deposit' => $_POST["deposit"],
					':petDeposit' => $_POST["petDeposit"],
					':keyDeposit' => $_POST["keyDeposit"],
					':electricity' => $_POST["electricity"],
					':internet' => $_POST["internet"],
					':water' => $_POST["water"],
					':gas' => $_POST["gas"],
					':television' => $_POST["television"],
					':pets' => $_POST["pets"],
					':smoking' => $_POST["smoking"],
					':furnished' => $_POST["furnished"],
					':startDate' => $_POST["startDate"],
					':endDate' => $_POST["endDate"]);


			$this->model->addListing($parameters);

		}

	}

	public function retrieveListing(): array {
		if (array_key_exists('listingId', $_POST)) {
			$response = $this->model->retrieve_listing($_POST['listingId']);
                } else {
			$response['status'] = 'error';
			$response['message'] = 'cannot find listing';
		}
		return $response;
	}

	public function editListing() {
          
    }

	public function deleteListing() {
        $this->model->delete_listing($_POST['listingId']);
	}

    public function changeListing(){
        if(isset($_POST['delete'])){
            echo "delete found";
            $this->model->delete_listing($_POST['ListingId']);
        }

        if(isset($_POST['save'])){
            echo "save found";

            if(empty($_POST['Deposit'])){
                $deposit = 0;
            }else{
                $deposit = $_POST['Deposit'];            
            }

            if(empty($_POST['KeyDeposit'])){
                $keyDeposit = 0;
            }else{
                $keyDeposit = $_POST['KeyDeposit'];
            }

            if(empty($_POST['PetDeposit'])){
                $petDeposit = 0;
            }else{
                $petDeposit = $_POST['petDeposit'];
            }

            if(empty($_POST['Electricity'])){
                $electricity = 0;
            }else{
                $electricity = $_POST['Electricity'];
            }

            if(empty($_POST['Furnished'])){
                $furnished = 0;
            }else{
                $furnished = $_POST['Furnished'];
            }

            if(empty($_POST['Gas'])){
                $gas = 0;
            }else{
                $gas = $_POST['Gas'];
            }

            if(empty($_POST['Internet'])){
                $internet = 0;
            }else{
                $internet = $_POST['Internet'];
            }
            
            if(empty($_POST['Pets'])){
                $pets = 0;
            }else{
                $pets = $_POST['Pets'];
            }
            
            if(empty($_POST['Smoking'])){
                $smoking = 0;
            }else{
                $smoking = $_POST['Smoking'];
            }

            if(empty($_POST['Television'])){
                $television = 0;
            }else{
                $television = $_POST['Television'];
            }
            
            if(empty($_POST['Water'])){
                $water = 0;
            }else{
                $water = $_POST['Water'];
            }

            $this->model->edit_listing($_POST['StreetNo'], $_POST['StreetName'], $_POST['City'], $_POST['ZIP'], $_POST['MonthlyRent'], $_POST['Description'], 
                                       $_POST['Bedrooms'], $_POST['Baths'], $deposit, $keyDeposit, $petDeposit, $_POST['StartDate'], 
                                       $_POST['EndDate'], $electricity, $furnished, $gas, $internet, $pets, 
                                       $smoking, $television, $water, $_POST['ListingId']);
        }
        
        header("Location: ../account_center#listings");
    }

	public function authenticateUser(): array {
		if (isset($_POST["email"]) && isset($_POST["password"])) {
			$email = $_POST["email"];
			$password = $_POST["password"];
			$response = $this->model->authenticate_user($email, $password);
		} else {
			$response['status'] = 'error';
			$response['message'] = 'The database encountered an error.';
		}
		return $response;
	}

	public function fetchListings(): array {
		$assoc_array = $this->model->getCities();
		$unsplit_cities = "";
		$temp_array = array();

		foreach ($assoc_array as $i => $row) {
			if (!(in_array($row["City"], $temp_array))) {
				$unsplit_cities .= $unsplit_cities . " " . strtolower($row["City"]);
				array_push($temp_array, $row["City"]);
			}
		}

		$cities = preg_split("/ /", $unsplit_cities);

		$streets = array("way", "street", "road", "court", "boulevard", "blvd", "place", "avenue", "ave", "beach", "bch", "causeway", "circle", "drive", "dr",
				"expressway", "heights", "ht", "junction", "jct", "lane", "ln", "plaza", "rd", "st", "ct", "square", "sq");
		$streetabb = array("street" => "st", "heights" => "ht", "road" => "rd", "lane" => "ln", "boulevard" => "blvd", "court" => "ct");
		$splitQuery = array();
		$sortedQuery = array();


		/*
		 *If statement takes the query string from _GET["q"] and splits it up using " "(space) as a delimiter and puts it into $temp.
		 *The for loop then finds all cities and streets and pushes them into $splitQuery as one string. Other parameters are pushed into $splitQuery
		 */
		if (!empty($_GET)) {
			$temp = preg_split("/ /", $_GET["q"]);
			for ($i = 0; $i < count($temp); $i++) {
				if (in_array(strtolower($temp[$i]), $cities)) {
					array_push($splitQuery, strtolower($temp[$i]));
				} else if (in_array(strtolower($temp[$i]), $cities) && (count($temp) >= 2)) {
					array_push($splitQuery, strtolower($temp[$i]) . " " . (strtolower($temp[$i + 1])));
					$i++;
				} elseif (in_array(strtolower($temp[$i]), $streets) && (count($temp) >= 2)) {
					$tempvar = strtolower($temp[$i]);
					$tempvar = $streetabb[$tempvar];
					array_push($splitQuery, strtolower($temp[$i - 1]) . " " . $tempvar);
					$i++;
				} elseif (in_array(strtolower($temp[$i]), $streets)) {
					$tempvar = strtolower($temp[$i]);
					$tempvar = $streetabb[$tempvar];
					array_push($splitQuery, strtolower($tempvar));
				} else {
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
			$i = 0;
			foreach ($splitQuery as $key) {
				if (is_numeric($key)) {
					if (preg_match("/[0-9]{5}/", $key) && preg_match("/^9/", $key) && (($i + 1) == count($splitQuery))) {
						$sortedQuery['zip'] = $key;
					} else {
						$sortedQuery['stno'] = $key;
					}
				} else {
					if (in_array($key, $cities)) {
						$sortedQuery['city'] = $key;
					} else {
						$sortedQuery['stadd'] = $key;
					}
				}
				$i++;
			}
			foreach ($_GET as $key => $value) {
				if ($key != "q") {
					$sortedQuery[$key] = $value;
				}
			}
			return $this->model->getListings($sortedQuery);
		}
	}
}

?>  
