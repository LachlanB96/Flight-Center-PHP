<?php
function db_conn($query){
	$connection = mysqli_connect('rerun', 'potiro', 'pcXZb(kL', 'poti');
	if (!$connection)
		die("Could not connect to Server");
	mysql_select_db("poti",$connection);
	$query_string = $query;
	return mysqli_query($connection, $query_string);
}
?>