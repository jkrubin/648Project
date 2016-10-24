<?php
class DAO extends Controller{
	public function searchListings(){
		//code executes if "submit_search" has been entered
		if(isset($_POST["submit_search"])){
			//do searchListings() in model/DAO.php
			$this->model->searchListings(_POST["terms"]);
		}
		//Page that is shown after search has been executed
		header('location: ' . URL . http_build_query($_POST["terms"]) . '/home/index');
	}

}

?>
