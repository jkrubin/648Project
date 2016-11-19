<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Signup extends Controller {
	/**
	 * PAGE: index
	 * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
	 */
	public function index() {

		if (isset($_POST['signup'])) {
			$check = $this->register_user();
		}
		// load views
		require APP . 'view/_templates/home_header.php';
		require APP . 'view/signup/index.php';
		require APP . 'view/_templates/footer.php';
	}

	public function register_user(): bool {
		$firstn = $_POST['firstname'];
		$lastn = $_POST['lastname'];
		$email = $_POST['email'];
		$pass = $_POST['password'];

		if ($this->model->add_user($firstn, $lastn, $email, $pass)) {
			return true;
		} else {
			return false;
		}

	}
}