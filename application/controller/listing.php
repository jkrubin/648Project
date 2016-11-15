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

    public function addListing(){

        /*********************************************
         *              RENTAL PARAMETERS
         * 
         *      HTML FROM TAGS --> SQL QUERY TAGS
         ********************************************/
        $rentalParameters = array(
            'streetNo'=>'StreetNo',
            'streetName'=>'StreetName',
            'city'=>'City',
            'zipCode'=>'ZIP',
            'bedrooms'=>'Bedrooms',
            'baths'=>'Baths',
            'sqFt'=>'SqFt'
        );

        /*********************************************
         *              LISTING PARAMETERS
         * 
         *      HTML FROM TAGS --> SQL QUERY TAGS
         ********************************************/
        $listingParameters = array(
            'monthlyRent'=>'MonthlyRent',
            'description'=>'Description',
            'deposit'=>'Deposit',
            'petDeposit'=>'PetDeposit',
            'keyDeposit'=>'KeyDeposit',
            'electricity'=>'Electricity',
            'internet'=>'Internet',
            'water'=>'Water',
            'gas'=>'Gas',
            'television'=>'Television',
            'pets'=>'Pets',
            'smoking'=>'Smoking',
            'furnished'=>'Furnished',
            'startDate'=>'StartDate',
            'endDate'=>'EndDate',
        );

        /*********************************************
         *    ARRAY OF KEYS THAT NEED INPUT CHANGED
         * 
         *      HTML FROM TAGS --> SQL QUERY TAGS
         ********************************************/
        $inputChange = array(
            'electricity'=>'Electricity',
            'internet'=>'Internet',
            'water'=>'Water',
            'gas'=>'Gas',
            'television'=>'Television',
            'pets'=>'Pets',
            'smoking'=>'Smoking',
            'furnished'=>'Furnished',
        );
                    
        /*********************************************
         *   EMPTY ARRAYS FOR RENTAL AND LISTING SQL
         * 
         *   SQL KEY WORD --> INPUT VALUE FROM FORM
         ********************************************/
        $rentalSQLPairs=array();
        $listingSQLPairs=array();

        //Create new listing if we have post data from submit_listing
        if (isset($_POST["submit_listing"])){

            //Get Array of $_POST keys
            $postKeys = array_keys($_POST);

            //Iterate through post keys
            foreach($postKeys as $postKey){
                
                //check if post key is for rental or listing
                if(array_key_exists($postKey, $rentalParameters)){
                    //If key is a rental Param, add key and value to Rental SQL
                    $rentalSQLPairs[$rentalParameters[$postKey]]=$_POST[$postKey];
                }
                if(array_key_exists($postKey, $listingParameters)){
                    //If key is a rental Param, add key and value to Rental SQL
                    if(array_key_exists($postKey,$inputChange)){
                        //Input of check mark forms change to 1 in stead of 'on'
                        $listingSQLPairs[$listingParameters[$postKey]]=1;                            
                    }else{
                        $listingSQLPairs[$listingParameters[$postKey]]=$_POST[$postKey];
                    }
                }
            }
            
            /*
             * PRINTING FOR TEST PURPOSES ONLY
             */
            var_dump($listingSQLPairs);
            var_dump($rentalSQLPairs);
            
            $this->model->addListing($rentalSQLPairs,$listingSQLPairs);

        }

    }
}
