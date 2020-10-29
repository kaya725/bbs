<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['globalpass'])){
  header('Location:index.php');
}

if(!empty($_POST)){
  if($_POST['email'] !== '' && $_POST['password'] !== ''){
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));

    $member = $login->fetch();

    if($member){
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      header('Location:chat.php');
      exit();
    }else{ 
      $error['login'] ='false';
    }
  }else{ 
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/phone/login.css">
</head>
<body>
<!-- header -->
  <header>
    <div class="dollarsimg">
      <img src="img/dollars.png" alt="">
    </div>
  </header>
<!-- header_end -->
<!-- main -->
  <main>
   <div class="wrap">
  <!-- center -->
    <p><span class="title">ログイン</span><br>必要事項をご記入ください。</p>
    <div class="center-contents clearfix">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="contents-box">
          <div class="contents">
            <!-- メールアドレス -->
            <div class="content">
              <p>メールアドレス</p>
              <input class="area" type="text" name="email" size="30" maxlenfth="255" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>">
              <?php if($error['login']==='blank'): ?>
                <p class="error">＊入力してください</p>
              <?php endif; ?>  
            </div>
            <!-- パスワード -->
            <div class="content">
              <p>パスワード</p>
              <input class="area" type="password" name="password" size="30" maxlenfth="10" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES)); ?>">
              <?php if($error['login']==='blank'): ?>
                <p class="error">＊入力してください</p>
              <?php endif; ?>
              <?php if($error['login']==='false'): ?>
                <p class="error">＊ログインに失敗しました<br>正しく入力してください</p>
              <?php endif; ?>   
              <p>(メールアドレス:a、パスワード:dollars<br>でログイン可能)</p>
            </div>  
          </div>
          <!-- contents_end -->
        </div>
        <!-- Loginボタン -->
        <div><input class="btn" type="submit" value="Login">
        </div>
      </form>
    </div>
    <!-- center-centents_end -->
  </div>
  <div class="account">
    <p>アカウント登録がまだの方はこちらから</p>
    <button><a href="join.php">アカウント登録</a></button>
  </div>

  </main>
  
</body>
</html>