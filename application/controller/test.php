<?php
class test extends Controller{
	function test(){
		require APP . 'view/_templates/header.php';
		require APP . 'view/home/test.php';
		require APP . 'view/_templates/footer.php';
	}
}
?>
