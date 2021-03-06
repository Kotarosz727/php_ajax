<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
 header('location:index.php');
}

if(isset($_POST["login"])){
  $query = "
  SELECT * FROM login
  WHERE username= :username
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
    array(':username' => $_POST["username"])
  );
  $count = $statement->rowcount();
  if($count>0){
    $result=$statement->fetchAll();
    foreach($result as $row){
      if($_POST["password"] == $row["password"]){
        //ログインパスワードが正しければ、セッションにuser_idとuser_nameを格納
        $_SESSION["user_id"]=$row["user_id"];
        $_SESSION["username"]=$row["username"];
        //ログインしたら,login_detailsテーブルにuser_idを格納➡︎login_detaild_idにそのIDを格納
        $sub_query="
        INSERT INTO login_details
        (user_id)
        VALUES ('".$row['user_id']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertID();
        header("location:index.php");
      }else{
        $message = "<label>パスワードが違います</label>";
      }
    }
  }else{
    $message = "<label>usernameが違います</label>";
  }
}

?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 style="text_align:center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Chat Application Login</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>名前</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>パスワード</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>