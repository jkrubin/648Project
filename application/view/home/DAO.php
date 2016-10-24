<?php
class DAO{
	function searchListings($terms){
		$db_hostname = 'sfsuswe.com';
		$db_username = 'f16g11';
		$db_password = 'headset showdown overjoyed';
		$db_database = 'f16g11';
		$connection = mysqli_connect($db_hostname, $db_username, $db_password);

		if(!$connection){
		die('could not connect: ') . mysql_error();
		}
		$connection -> select_db($db_database);
		$sql = "SELECT * FROM Listings WHERE Description LIKE '%".$terms."%'";
		$result = $connection -> query($sql);
		return json_encode($result);
	}
}
?>
