<?php
session_start();
require('dbconnect.php');
require_once('config/config.php');

if($_POST['password'] === TopPassClass::TOPPASS){
  $_SESSION['globalpass'] = $_POST;
  header('Location:login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dollars</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/dollars.css">
  <link rel="stylesheet" href="css/phone/dollars.css">
</head>
<!-- body -->
<body>
<div class="wrap">
    <form action="" method="post">
      <img class="dollarsTopImg" src="img/dollars.png" alt="DOLAARS画像">
      <div>
        <div class="passBox">
          <p>password：<input type="password" maxlength="10" name="password" class="pass" ></p>
          <p color="white">（パスワード:dollars）</p>
        </div>
        <input type="submit" class="button" value="Enter">
      </div>
    </form>
  </div>
</body>
</html>
