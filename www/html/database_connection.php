<?php

$connect = new PDO("mysql:host=db;dbname=chat", "root", "password");

//ユーザーのログイン時間を取得
function fetch_user_last_activity($user_id, $connect){
  $query="
  SELECT * FROM login_details
  WHERE user_id = '$user_id'
  ORDER BY last_activity DESC
  LIMIT 1
  ";

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row){
    return $row["last_activity"];
  }
}

?>