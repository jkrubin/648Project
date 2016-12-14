<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Listing_detail extends Controller {
	/**
	 * PAGE: index
	 * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
	 */
		public function index() {
		// Calls the function cr

		// load views.
		require APP . 'view/_templates/header.php';
        if (empty($_SESSION) || empty($_SESSION['UserId'])) {
			require APP . 'view/_templates/default_navbar.php';
		} else {
			require APP . 'view/_templates/user_navbar.php';
		}
        require APP . 'view/_templates/login_modal.php';
		require APP . 'view/listing-detail/index.php';
		require APP . 'view/_templates/footer.php';
	}
	//Retrieves the latitude and longitude of a Listing using it's listingId. Returns an associative array["Latitude" => $value, "Longitude" => $value]
	public function getCoords($listingId){
		return $this->model->getCoords($listingId);
	}

	//returns an associative array["Latitude" => $value, "Longitude" => $value] based on the address and city given.
	public function createCoords($address, $city){
		return $this->model->createCoords($address,$city);
	}

	//takes an associative array["Latitude" => $value, "Longitude" => $value] 
	public function obfuscate($coords){
		return $this->model->obfuscate($coords);
	}
	
	public function retrieveListing($listingId): array{
            if(true){
                $response = $this->model->retrieve_listing($listingId);
            }else{
                $response['status'] = 'error';
                $response['message'] = 'cannot find listing';
            }
            return $response;
        }
	
	public function retrieveBlob($ListingId){

            $response = $this->model->retrieve_blob_by_listing($ListingId);

            return $response;	    
	}
	
        
}
