<?php
try{
  $db= new PDO('mysql:dbname=mezasenokng_db; host=mysql7013.xserver.jp; charset=utf8', 'mezasenokng_wp1', 'rootpass');
}catch(PDOExeption $e){
  print('DB接続エラー：' .$e->getMessage());
}