<?php
session_start();
require('dbconnect.php');

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
}else{
  header('Location:index.php');
  exit();  
}

if(!empty($_POST)){
  if($_POST['message'] !== ''){
    $message = $db ->prepare('INSERT INTO posts SET member_id=?,message=?, icon=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $member['icon']
    ));
    header('Location:chat.php');
    exit();
  }
}

$posts = $db->query('SELECT m.name, m.icon, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>チャットルーム</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/chat.css">
  <link rel="stylesheet" href="css/phone/chat.css">
</head>
<body>
  <header>
    <div class="dollarsimg">
      <img src="img/dollars.png" alt="">
    </div>
  </header>

  <!-- main -->
  <main class="main">
    <div class="center">
      <div class="wrap">
    <!-- center-centents -->
        <div class="center-contents">
          <!-- <span class="title">チャットルーム</span> -->
        <!-- form -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="post-zentai">
              <div class="postBox">
                <img src="<?php print(htmlspecialchars($member['icon'],ENT_QUOTES)); ?>" alt="アイコン画像">
                <p><?php print(htmlspecialchars($member['name'],ENT_QUOTES)); ?>さん</p>  
              </div>
              <textarea name="message" cols="80" rows="5" placeholder="投稿内容"></textarea> 
            </div>

            <input type="submit" class="btn2" value="Post!">  
          </form>
        <!-- form_end -->
        </div>
        <!-- center-content_end -->
        <!-- メッセージ欄 -->
          <!-- $postsを$postに代入 -->
        <div class="msg">
    <?php foreach($posts as $post): ?>
            <div class="msgBox">
              <div class="user">
                <p class="userProf"><img src="<?php print(htmlspecialchars($post['icon'],ENT_QUOTES)); ?>" alt="アイコン画像"><br>
                <span class="name"><?php print(htmlspecialchars($post['name'],ENT_QUOTES)); ?></span></p>    
              </div>
              <div class="msgBoxText">
                <p><?php print(htmlspecialchars($post['message'],ENT_QUOTES)); ?></p>
                <p class="day"><?php print(htmlspecialchars($post['created'],ENT_QUOTES)); ?></p>
                
                <?php if($_SESSION['id']==$post['member_id']): ?>
                  <a style="color:red; font-size:11px;" class="delete" href="delete.php?id=<?php print(htmlspecialchars($post['id']));?>">[投稿削除]</a>
                <?php endif; ?>
              </div>
            </div>
    <?php endforeach; ?>
        </div>
        <!-- メッセージ欄_end -->  
      </div>
    </div>

  <!-- right -->
    <div class="right">
      <nav>
        <ul>
          <a href="logout.php"><li class="logout">Logout</li></a>
        </ul>
      </nav>
    </div>
  <!-- rigth_end -->

</main>
</body>
</html>
