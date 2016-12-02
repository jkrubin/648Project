<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class BlobTest extends Controller{
        /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {
            // load views
            //require APP . 'view/_templates/header.php';
            require APP . 'view/blobtest/index.php';
            //require APP . 'view/_templates/footer.php';

    }
    
    public function handle_blob(){
        
        if(isset($_POST['submit'])) {

            $img_info = getimagesize($_FILES['image']['tmp_name']);
            
            $img_temp = $_FILES['image']['tmp_name'];

            $this->model->submit_blob($img_info,$img_temp);

        } 
        
    }
}