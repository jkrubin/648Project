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
         *              Parameter Properties
         * 
         *Mapping of HTML tags to all their properties
         ********************************************/

        $formProperties = array(
        'streetNo' => array(
            'sqlVal'=>'StreetNo','table'=>'Rentals','datatype'=>'integer','isCheckBox'=>FALSE),
        'streetName' => array(
            'sqlVal'=>'StreetName','table'=>'Rentals','datatype'=>'string','isCheckBox'=>FALSE),
        'city' => array(
            'sqlVal'=>'City','table'=>'Rentals','datatype'=>'string','isCheckBox'=>FALSE),
	'zipCode' => array(
            'sqlVal'=>'ZIP','table'=>'Rentals','datatype'=>'integer','isCheckBox'=>FALSE),
        'bedrooms' => array(
            'sqlVal'=>'Bedrooms','table'=>'Rentals','datatype'=>'integer','isCheckBox'=>FALSE),
        'baths' => array(
            'sqlVal'=>'Baths','table'=>'Rentals','datatype'=>'integer','isCheckBox'=>FALSE),
        'sqFt' => array(
            'sqlVal'=>'SqFt','table'=>'Rentals','datatype'=>'integer','isCheckBox'=>FALSE),
	'monthlyRent'=>array(
            'sqlVal'=>'MonthlyRent','table'=>'Listings','datatype'=>'integer','isCheckBox'=>FALSE),
	'description'=>array(
            'sqlVal'=>'Description','table'=>'Listings','datatype'=>'string','isCheckBox'=>FALSE),            
	'deposit'=>array(
            'sqlVal'=>'Deposit','table'=>'Listings','datatype'=>'integer','isCheckBox'=>FALSE),            
	'petDeposit'=>array(
            'sqlVal'=>'PetDeposit','table'=>'Listings','datatype'=>'integer','isCheckBox'=>FALSE),            
	'keyDeposit' => array(
            'sqlVal'=>'KeyDeposit','table'=>'Listings','datatype'=>'integer','isCheckBox'=>FALSE),            
	'electricity' => array(
            'sqlVal'=>'Electricity','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),        
        'internet' => array(
            'sqlVal'=>'Internet','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),  
        'water' => array(
            'sqlVal'=>'Water','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),  
        'gas' => array(
            'sqlVal'=>'Gas','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),  
        'television' => array(
            'sqlVal'=>'Television','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),  
        'pets' => array(
            'sqlVal'=>'Pets','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE),
        'smoking' => array(
            'sqlVal'=>'Smoking','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE), 
        'furnished' => array(
            'sqlVal'=>'Furnished','table'=>'Listings','datatype'=>'string','isCheckBox'=>TRUE), 
        'startDate' => array(
            'sqlVal'=>'StartDate','table'=>'Listings','datatype'=>'date','isCheckBox'=>FALSE), 
        'endDate' => array(
            'sqlVal'=>'EndDate','table'=>'Listings','datatype'=>'date','isCheckBox'=>FALSE)
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
                
                if(array_key_exists($postKey, $formProperties) and 
                        $formProperties[$postKey]['table'] == 'Rentals'){
                    //PostKey is a rental parameter

                    //Validate the type
                    if($this->model->validate($_POST[$postKey],$formProperties[$postKey]['datatype'])){
                        //Type is valid, add to Arr
                        $rentalSQLPairs[$formProperties[$postKey]['sqlVal']]=$_POST[$postKey];
                    }else{
                        echo "<br>"."WRONG TYPE FOR ".$postKey.", ".$_POST[$postKey]." was entered<br>";                    }
                }
                if(array_key_exists($postKey, $formProperties) and 
                        $formProperties[$postKey]['table'] == 'Listings'){
                    //Post key is a Listings Parameter
                    
                    //Validate the type
                    if($this->model->validate($_POST[$postKey],$formProperties[$postKey]['datatype'])){
                        if($formProperties[$postKey]['isCheckBox'] == TRUE){
                            //Input of check mark forms change to 1 in stead of 'on'
                            //Change input and put into array
                            $listingSQLPairs[$formProperties[$postKey]['sqlVal']]=1;                            
                        }else{
                            //No need to change iput, put right into array
                            $listingSQLPairs[$formProperties[$postKey]['sqlVal']]=$_POST[$postKey];
                        }
                    }else{
                        echo "<br>"."WRONG TYPE FOR ".$postKey.", ".$_POST[$postKey]." was entered<br>";
                        echo "Type was: " . gettype($_POST[$postKey])."<br>";
                    }

                }
            }
            
            /*
             * PRINTING FOR TEST PURPOSES ONLY
             */
            echo "<br>Listings array: <br>";
            var_dump($listingSQLPairs);
            echo "<br>Rentals array: <br>";
            var_dump($rentalSQLPairs);
            
            $this->model->addListing($rentalSQLPairs,$listingSQLPairs);

        }

    }
}
