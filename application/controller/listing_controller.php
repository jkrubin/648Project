<?php

/* 
 * Class listing_controller
 * 
 * 
 * 
 */
Class listing_controller extends Controller{
        /*
         * Class for listings page (not yet created) 
         * 
         */
    	public function index() {
		// load views
		$isHome = true;
		require APP . 'view/_templates/home_header.php';
		require APP . /*doesnt exist yet*/;
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
   
        
        /*
         *     public function addSong()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_song"])) {
            // do addSong() in model/model.php
            $this->model->addSong($_POST["artist"], $_POST["track"],  $_POST["link"]);
        }
        // where to go after song has been added
        header('location: ' . URL . 'songs/index');
         */
}
