<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller {
	/**
	 * PAGE: index
	 * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
	 */
	public function index() {
		// load views
		$isHome = true;
		require APP . 'view/_templates/home_header.php';
		if (empty($_SESSION) || empty($_SESSION['UserId'])) {
			require APP . 'view/_templates/default_navbar.php';
			require APP . 'view/_templates/login_modal.php';
		} else {
			require APP . 'view/_templates/user_navbar.php';
		}
		require APP . 'view/home/index.php';
		require APP . 'view/_templates/footer.php';
	}
}

?>
