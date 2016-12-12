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
		// Calls the function createCoords($address, $city). Returns an associative array.
		$coords = $this->createCoords("20084 Catalina Drive", "Castro Valley");
		$coords = $this->obfuscate($coords);
		//Searches through the associative array to get the longitude and latitude. Will probably move into createCoords($address, $city).
		$latitude = $coords[":latitude"];
		$longitude = $coords[":longitude"];
		// load views.
		require APP . 'view/_templates/header.php';
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
	
        
}