<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['globalpass'])){
  header('Location:index.php');
}

// アイコン
$icon_rand = [
  "img/icon1.png",
  "img/icon2.png",
  "img/icon3.png",
  "img/icon4.png",
  "img/icon5.png",
  "img/icon6.png",
  "img/icon7.png",
  "img/icon8.png",
  "img/icon9.png",
];
$icon_rand = $icon_rand[mt_rand(0, 8)];


if(!empty($_POST)){
  if($_POST['name']===''){
    $error['name'] = 'blank';
  }
  if($_POST['email'] === ''){
    $error['email'] = 'blank';
  }
  if(strlen($_POST['password']) < 4){
    $error['password'] = 'length';
  }
  if($_POST['password'] === ''){
    $error['password'] = 'blank';
  }

  // アカウント重複チェック
  if(empty($error)){
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
    $member->execute(array($_POST['email']));
    $record = $member->fetch();
    if($record['cnt'] > 0){
      $error['email'] = 'duplication';
    }
  }

  if(empty($error)){
    $_SESSION['join'] = $_POST;
    $_SESSION['icon'] = $icon_rand;

    $statement =$db->prepare('INSERT INTO members SET name=?, email=?, password=?, icon=?, created=NOW()');
    echo $statement->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      sha1($_SESSION['join']['password']),
      $_SESSION['icon']
    ));
    header('Location:login.php');
    exit();  

    unset($_SESSION['join']);
    unset($_SESSION['icon']);
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>アカウント登録</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/join.css">
  <link rel="stylesheet" href="css/phone/join.css">
</head>
<body>
  <header>
    <div class="dollarsimg">
      <img src="img/dollars.png" alt="">
    </div>
  </header>
<!-- main -->
  <main>
   <div class="wrap">
  <!-- center -->
    <p><span class="title">アカウント登録</span><br>必要事項をご記入ください。</p>
    <div class="center-contents clearfix">
    <!-- form -->
      <form action="" method="post" enctype="muitipart/form-date">
        <div class="contents-box">
          <div class="contents">
            <!-- ハンドルネーム -->
            <div class="content">
              <p>ハンドルネーム</p>
              <input class="area" type="text" name="name" size="30" maxlenfth="10" value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES)); ?>">
              <?php if($error['name']==='blank'): ?>
                <p class="error">＊入力してください</p>
              <?php endif; ?>
            </div>
            <!-- メールアドレス -->
            <div class="content">
              <p>メールアドレス</p>
              <input class="area" type="text" name="email" size="30" maxlenfth="255" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES)); ?>">
                <?php if($error['email']==='blank'): ?>
                <p class="error">＊入力してください</p>
                <?php endif; ?>  

                <?php if($error['email']==='duplication'): ?>
                <p class="error">＊指定されたアドレスは登録されています</p>
                <?php endif; ?>      
            </div>
            <!-- パスワード -->
            <div class="content">
              <p>パスワード</p>
              <input class="area" type="password" name="password" size="30" maxlenfth="10" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES)); ?>">
                <?php if($error['password']==='length'): ?>
                <p class="error">＊4文字以上入力してください</p>
                <?php endif; ?>
                <?php if($error['password']==='blank'): ?>
                <p class="error">＊入力してください</p>
                <?php endif; ?>
            </div>  
          </div>
          <!-- icon -->
          <div class="icons">
            <p>アイコン<br>
            （ランダムで選択されます）</p>
            <div class="iconBox">
              <img src="img/icon1.png" alt="アイコン画像1">
              <img src="img/icon2.png" alt="アイコン画像2">
              <img src="img/icon3.png" alt="アイコン画像3">
            </div>
            <div class="iconBox">
              <img src="img/icon4.png" alt="アイコン画像4">
              <img src="img/icon5.png" alt="アイコン画像5">
              <img src="img/icon6.png" alt="アイコン画像6">
            </div>
            <div class="iconBox">
              <img src="img/icon7.png" alt="アイコン画像7">
              <img src="img/icon8.png" alt="アイコン画像8">
              <img src="img/icon9.png" alt="アイコン画像9">
            </div>
          </div>
          <!-- icons_end -->  

          <!-- contents_end -->
        </div>
        <!-- 登録ボタン -->
        <div><input class="btn" type="submit" value="登録する">
        </div>
      </form>
    </div>
    <!-- center-centents_end -->
  </div>

  <div class="login">
    <p>ログインはこちらから</p>
    <button><a href="login.php">Login</a></button>
  </div>
  </main>
  
</body>
</html>