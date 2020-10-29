<?php
session_start();

$_SESSION = array();
if(ini_set('session.use_cookies')){
  $params = session_get_cookie_parms();
  setcookie(session_name() . '', time() - 42000,
    $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();

setcookie('email','',time()-3600);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Logout</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/logout.css">
  <link rel="stylesheet" href="css/phone/logout.css">
</head>
<body>
  <div class="text-contents">
    <div class="text">
      <p>ログアウトしました</p>
      <a href="https://github.com/kaya725/bbs/blob/master/README.md">Top</a>
    </div>
  </div>
</body>
</html>