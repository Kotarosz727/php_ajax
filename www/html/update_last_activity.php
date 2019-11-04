<?php

include('database_connection.php');

session_start();

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE user_id = '".$_SESSION["user_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

echo $query;

?>