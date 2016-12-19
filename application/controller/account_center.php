<?php

class Account_Center extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://sfsuswe.com/f16g11/Webby/search
     */
    public function index() {
        // if we have POST data to create a new song entry
        session_start();
        if (empty($_SESSION) || empty($_SESSION['UserId'])) {
            header("Location: view/problem");
            }
        else{
            $listings = $this->fetch_dashboard($_SESSION['UserId']);
            $messages = $this->get_all_messages();
            $newMessages = $this->get_new_messages();
            $oldMessages = $this->get_old_messages();
        }

            require APP . 'view/_templates/header.php';
            if (empty($_SESSION) || empty($_SESSION['UserId'])) {
                require APP . 'view/_templates/default_navbar.php';
                require APP . 'view/_templates/login_modal.php';
            } else {
                require APP . 'view/_templates/user_navbar.php';
            }
            require APP . 'view/account_center/index.php';
            require APP . 'view/_templates/footer.php';
   }

    public function fetch_dashboard($userId): array{
     
       return $this -> model -> get_dashboard($userId);
    }

    public function sendMessage() {
        try {
            $params = array(':body' => $_POST['body'], 'senderId' => $_POST['senderId'], ':recipientId' => $_POST['recipientId'],
                ':listingId' => $_POST['listingId'], ':true' => true);
            if (array_key_exists('title', $_POST)) {
                $params[':title'] = $_POST['title'];
            }
            $this->model->send_message($params);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function get_new_messages(): array {
        try {
            return $this->model->get_new_messages($_SESSION['UserId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function view_message($messageID): array {
        try {
            return $this->model->view_message($messageID);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function get_old_messages(): array {
        try {
            return $this->model->get_old_messages($_SESSION['UserId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function get_all_messages(): array {
        try {
            return $this->model->get_all_messages($_SESSION['UserId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function delete_message() {
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

    public function retrieveListing($listingId): array {
        return $this->model->retrieve_listing($listingId);
    }
    
    public function retrieveBlob($ListingId){
        $response = $this->model->retrieve_blob_by_listing($ListingId);
        return $response;	    
    }

}

?>
