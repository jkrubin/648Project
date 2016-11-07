<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Login extends Controller {
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {

                if(isset($_POST['submit'])){
                        $check_login = $this->user_login();
                }

        // load views
        require APP . 'view/_templates/home_header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/footer.php';
    }

        public function user_login(): array {

            $user_mail = $_POST['email'];
            $user_pass = $_POST['password'];
            $array = $this->model->authenticate_user($user_mail,$user_pass);

            return $array;
        }
}
