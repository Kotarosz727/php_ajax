<?php

include('database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
 header('location:login.php');
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
      <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
      <br />
      <div class="table-responsive">
        <h4 align="center">Online User</h4>
        <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="logout.php">Logout</a></p>
        <div id="user_details"></div>
      </div>
    </div>
  </body>  
</html>

<script>
  $(document).ready(function(){

    fetch_user();

    setInterval(function(){
      update_last_activity();
      fetch_user();
    }, 5000);

    //同ブラウザ内でログインしていないユーザーを取得、テーブルに表示
    function fetch_user(){
      $.ajax({
        url:"fetch_user.php",
        method:"POST",
        success:function(data){
          $('#user_details').html(data);
        }
      })
    }

    //5000秒おきに、ログインユーザーをチェック
    function update_last_activity(){
      $.ajax({
        url:"update_last_activity.php",
        success:function(){
          
        }
      })
    }

  });
</script>