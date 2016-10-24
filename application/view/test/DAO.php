<?php
class DAO{
	$db_hostname = 'sfsuswe.com';
	$db_username = 'f16g11';
	$db_password = 'headset showdown overjoyed';
	$db_database = 'f16g11';

	//database variable
	$connection = mysql_connect($db_hostname, $db_username, $db_password);
	if(!$connection){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_database, $connection);

	function searchListings($terms){
		$sql = "SELECT * FROM Listings WHERE * LIKE '%".$terms."%'";
		return json_encode(mysql_query($sql));
	}
}
?>
