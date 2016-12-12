<?php

class Dashboard extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://sfsuswe.com/f16g11/Webby/search
     */
    public function index() {
        // if we have POST data to create a new song entry
        
        $userId = 42;
        $listings = $this->fetch_dashboard($userId);

            require APP . 'view/_templates/header.php';
            if (empty($_SESSION) || empty($_SESSION['UserId'])) {
                require APP . 'view/_templates/default_navbar.php';
                require APP . 'view/_templates/login_modal.php';
            } else {
                require APP . 'view/_templates/user_navbar.php';
            }
            require APP . 'view/dashboard/index.php';
            require APP . 'view/_templates/footer.php';
    }
    
    public function fetch_dashboard($userId): array{
        return $this -> model -> get_dashboard($userId);
    }
    
	public function fetchListings(): array {

		$cities = array("oakland", "san francisco", "daly city", "san", "francisco", "daly", "city");
		$streets = array("way", "street", "road");
		$splitQuery = array();
		$sortedQuery = array();


		/*
		 * If statement takes the query string from _GET["q"] and splits it up using " "(space) as a delimiter and puts it into $temp.
		 * The for loop then finds all cities and streets and pushes them into $splitQuery as one string. Other parameters are pushed into $splitQuery
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
					array_push($splitQuery, strtolower($temp[$i - 1]) . " " . strtolower($temp[$i]));
					$i++;
				} else {
					array_push($splitQuery, strtolower($temp[$i]));
				}
			}


			/*
			 * foreach look takes each item in $splitQuery and catagorizes it
			 * If $key is a 5 digit number starting with a 9 then it will get added into 'zip'
			 * If $key is a number, but not a zip code, then it will push added to 'stno'
			 * if $key is a string that is in the array $cities, it will be added to 'cities'
			 * otherwise it will be added 'stadd'
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

			return $this->model->get_listings($sortedQuery);
		}
	}

}

?>
