<?php

include('database_connection.php');

session_start();

$query="
  DELETE FROM login_details
  WHERE user_id = '".$_SESSION['user_id']."'
  ";

$statement = $connect->prepare($query);
$statement->execute();



session_destroy();

header('location:login.php');

?>