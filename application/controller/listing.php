<?php

/**
 * Class Listing
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Listing extends Controller {
	/**
	 * PAGE: index
	 * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
	 */
	public function index() {
		// load views
                require APP . 'view/_templates/header.php';
		require APP . 'view/listing/index.php';
		require APP . 'view/_templates/footer.php';

	}
        
        public function fetchListing(){
            
            //Create new listing if we have post data from submit_listing
            if (isset($_POST["submit_listing"])){
                
                $parameters = array(':streetNo'=> $_POST["streetNo"], 
                    ':streetName'=> $_POST["streetName"],
                    ':city'=> $_POST["city"],
                    ':zipCode'=> $_POST["zipCode"],
                    ':bedrooms'=> $_POST["bedrooms"],
                    ':baths'=> $_POST["baths"],
                    ':sqFt'=> $_POST["sqFt"],
                    ':monthlyRent'=> $_POST["monthlyRent"],
                    ':description'=> $_POST["description"],
                    ':deposit'=> $_POST["deposit"],
                    ':petDeposit'=> $_POST["petDeposit"],
                    ':keyDeposit'=> $_POST["keyDeposit"],
                    ':electricity'=> $_POST["electricity"],
                    ':internet'=> $_POST["internet"],
                    ':water'=> $_POST["water"],
                    ':gas'=> $_POST["gas"],
                    ':television'=> $_POST["television"],
                    ':pets'=> $_POST["pets"],
                    ':smoking'=> $_POST["smoking"],
                    ':furnished'=> $_POST["furnished"],
                    ':startDate'=> $_POST["startDate"],
                    ':endDate'=> $_POST["endDate"]);
                
                $this->model->addListing($parameters);

            }
            
        }
}
