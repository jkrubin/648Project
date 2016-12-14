<?php

class Dashboard extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://sfsuswe.com/f16g11/Webby/search
     */
    public function index() {
        // if we have POST data to create a new song entry
        session_start();
        if(!empty($_SESSION) && !empty($_SESSION['UserId'])){
            $listings = $this->fetch_dashboard($_SESSION['UserId']);
        }

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

}

?>
