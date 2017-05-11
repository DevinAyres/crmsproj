<?php
    $conn = new PDO("sqlite:login/LoginInfo.db");

    session_start();
    $user_check= $_SESSION['login_user'];

    $result = $conn->prepare("SELECT email FROM Login WHERE email = :user_check");
    $result->execute(array(":usercheck"=>$user_check));

    $row = $result->fetch(PDO::FETCH_ASSOC);

    $login_session = $row['email'];

    if(!isset($_SESSION['login_user']))
    {
      $conn = null; 
      header('Location: LogIn.html');
    }
?>