<?php
// session_start();
// require('dbconnect.php');

if(isset($_POST['income'])){
    if($_POST['income']===''){
        $error['income'] = 'blank';
    }
}
$income = (int)$_POST['income'];

// 旧制度:生命保険料
if(isset($_POST['oldTax_life'])){
    $oldTax_life = (int)$_POST['oldTax_life'];
}
// 個人年金保険料
if(isset($_POST['oldTax_pension'])){
    $oldTax_pen = (int)$_POST['oldTax_pension'];
}

// 新制度:生命保険料
if(isset($_POST['newTax_life'])){
    $newTax_life= (int)$_POST['newTax_life'];
}
// 介護保険料
if(isset($_POST['newTax_medical'])){
    $newTax_med= (int)$_POST['newTax_medical'];
}
// 個人年金保険料
if(isset($_POST['newTax_pension'])){
    $newTax_pen= (int)$_POST['newTax_pension'];
}


// 所得税
    // 生命保険料
    if($oldTax_life >= 50000){
        $life_InTax=50000;
    }elseif($oldTax_life >= 40000){
        $life_InTax = $oldTax_life;
    }elseif($newTax_life + $oldTax_life >= 40000){
        $life_InTax = 40000;
    }else{
        $life_InTax = $newTax_life + $oldTax_life;
    }
    // 介護保険料
    if($newTax_med >= 40000){
        $med_InTax = 40000;
    }else{
        $med_InTax = $newTax_med;
    }
    // 個人年金保険料
    if($oldTax_pen >= 50000){
        $pen_InTax=50000;    
    }elseif($oldTax_pen >= 40000){
        $pen_InTax = $oldTax_pen;
    }elseif($newTax_pen + $oldTax_pen >= 40000){
        $pen_InTax = 40000;
    }else{
        $pen_InTax = $newTax_pen + $oldTax_pen;
    }

// 住民税
    // 生命保険料
    if($oldTax_life >= 35000){
        $life_ResTax=35000;
    }
    if($oldTax_life >= 28000){
        $life_ResTax = $oldTax_life;
    }elseif($newTax_life + $oldTax_life >= 28000){
        $life_ResTax = 28000;
    }else{
        $life_ResTax = $newTax_life + $oldTax_life;
    }
    // 介護保険料
    if($newTax_med >= 35000){
        $med_ResTax = 35000;
    }else{
        $med_ResTax = $newTax_med;
    }
    // 個人年金保険料
    if($oldTax_pen >= 35000){
        $pen_ResTax=35000;    
    }
    if($oldTax_pen >= 28000){
        $pen_ResTax = $oldTax_pen;
    }elseif($newTax_pen + $oldTax_pen >= 28000){
        $pen_ResTax = 28000;
    }else{
        $pen_ResTax = $newTax_pen + $oldTax_pen;
    }

// 枠合計:所得税
$In_sum = $life_InTax + $med_InTax + $pen_InTax;
if($In_sum >= 120000){
    $In_sum = 120000;
}
// 枠合計:住民税
$Res_sum = $life_ResTax + $med_ResTax + $pen_ResTax;
if($Res_sum >= 70000){
    $Res_sum = 70000;
}

// 実際の控除額:所得税
    // 旧制度
    // 生命保険料
    if($oldTax_life > 100000){
        $In_ded_oldlife = 50000;
    }
    if($oldTax_life > 50000){
        $In_ded_oldlife = $oldTax_life * 0.25 +25000;
    }
    if($oldTax_life > 25000){
        $In_ded_oldlife = $oldTax_life * 0.5 +12500;
    }else{
        $In_ded_oldlife = $oldTax_life;
    }
    // 個人保険料
    if($oldTax_pen > 100000){
        $In_ded_oldpen = 50000;
    }
    if($oldTax_pen > 50000){
        $In_ded_oldpen = $oldTax_pen * 0.25 +25000;
    }
    if($oldTax_pen > 25000){
        $In_ded_oldpen = $oldTax_pen * 0.5 +12500;
    }else{
        $In_ded_oldpen = $oldTax_pen;
    }
    // 上限合計
    $In_ded_oldsum = $In_ded_oldlife + $In_ded_oldpen;
    if($In_ded_oldsum >= 100000){
        $In_ded_oldsum = 100000;
    }

    // 新制度
    // 生命保険料
    if($newTax_life > 80000){
        $In_ded_newlife = 40000;
    }
    if($newTax_life > 40000){
        $In_ded_newlife = $newTax_life * 0.25 +20000;
    }
    if($newTax_life > 20000){
        $In_ded_newlife = $newTax_life * 0.5 +10000;
    }else{
        $In_ded_newlife = $newTax_life;
    }
    // 介護保険料
    if($newTax_med > 80000){
        $In_ded_newmed = 40000;
    }
    if($newTax_med > 50000){
        $In_ded_newmed = $newTax_med * 0.25 +20000;
    }
    if($newTax_med > 25000){
        $In_ded_newmed = $newTax_med * 0.5 +10000;
    }else{
        $In_ded_newmed = $newTax_med;
    }
    // 個人保険料
    if($newTax_pen > 80000){
        $In_ded_newpen = 40000;
    }
    if($newTax_pen > 50000){
        $In_ded_newpen = $newTax_pen * 0.25 +20000;
    }
    if($newTax_pen > 25000){
        $In_ded_newpen = $newTax_pen * 0.5 +10000;
    }else{
        $In_ded_newpen = $newTax_pen;
    }
    // 上限合計
    $In_ded_newsum = $In_ded_newlife + $In_ded_newmed + $In_ded_newpen;
    if($In_ded_newsum >= 120000){
        $In_ded_newsum = 120000;
    }
    // 大きい方適用
    if($In_ded_newsum > $In_ded_oldsum){
        $In_ded_sum = $In_ded_newsum;
    }else{
        $In_ded_sum = $In_ded_oldsum;
    }

// 実際の控除額:住民税
// 新制度
    // 生命保険料
    if($oldTax_life > 700000){
        $Res_ded_oldlife = 35000;
    }
    if($oldTax_life > 40000){
        $Res_ded_oldlife = $oldTax_life * 0.25 +17500;
    }
    if($oldTax_life > 15000){
        $Res_ded_oldlife = $oldTax_life * 0.5 +7500;
    }else{
        $Res_ded_oldlife = $oldTax_life;
    }
    // 個人保険料
    if($oldTax_pen > 70000){
        $Res_ded_oldpen = 35000;
    }
    if($oldTax_pen > 40000){
        $Res_ded_oldpen = $oldTax_pen * 0.25 +17500;
    }
    if($oldTax_pen > 15000){
        $Res_ded_oldpen = $oldTax_pen * 0.5 +7500;
    }else{
        $Res_ded_oldpen = $oldTax_pen;
    }
    // 上限合計
    $Res_ded_oldsum = $Res_ded_oldlife + $Res_ded_oldpen;
    if($Res_ded_oldsum >= 70000){
        $Res_ded_oldsum = 70000;
    }
// 新制度
    // 生命保険料
    if($newTax_life > 56000){
        $Res_ded_newlife = 28000;
    }
    if($newTax_life > 32000){
        $Res_ded_newlife = $newTax_life * 0.25 +14000;
    }
    if($newTax_life > 12000){
        $Res_ded_newlife = $newTax_life * 0.5 +6000;
    }else{
        $Res_ded_newlife = $newTax_life;
    }
    // 介護保険料
    if($newTax_med > 56000){
        $Res_ded_newmed = 28000;
    }
    if($newTax_med > 32000){
        $Res_ded_newmed = $newTax_med * 0.25 +14000;
    }
    if($newTax_med > 12000){
        $Res_ded_newmed = $newTax_med * 0.5 +6000;
    }else{
        $Res_ded_newmed = $newTax_med;
    }
    // 個人保険料
    if($newTax_pen > 56000){
        $Res_ded_newpen = 28000;
    }
    if($newTax_pen > 32000){
        $Res_ded_newpen = $newTax_pen * 0.25 +14000;
    }
    if($newTax_pen > 12000){
        $Res_ded_newpen = $newTax_pen * 0.5 +6000;
    }else{
        $Res_ded_newpen = $newTax_pen;
    }
    // 上限合計
    $Res_ded_newsum = $Res_ded_newlife + $Res_ded_newmed + $Res_ded_newpen;
    if($Res_ded_newsum >= 70000){
        $Res_ded_newsum = 70000;
    }
    // 大きい方適用
    if($Res_ded_newsum > $Res_ded_oldsum){
        $Res_ded_sum = $Res_ded_newsum;
    }else{
        $Res_ded_sum = $Res_ded_oldsum;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>保険控除計算</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header class="header">
        <p>控除額計算</p>
    </header>

    <main>            
        <form action="" method="post">
            <div class="income">
                <p>あなたの年収を入れてください</p>
                <p><input class="incomeText" type="tel"  name="income" value="<?php print(htmlspecialchars($_POST['income'],ENT_QUOTES)); ?>">万円</p>
                <?php if($error['income'] === 'blank'): ?>
                    <p class="error">＊入力してください</p>
                <?php endif; ?>
            </div>

            <p>あなたが年間で払っている保険料を入れてください</p>
            <table class="old">
                <caption>旧制度<br>（2011年（平成23年）12月31日以前の契約）</caption>
                <tr>
                    <th>生命保険料</th>
                    <th>個人年金保険料</th>
                </tr>
                <tr>
                    <td><input class="edit" type="tel" name="oldTax_life" value="<?php print(htmlspecialchars($_POST['oldTax_life'],ENT_QUOTES)); ?>">円</td>

                    <td><input class="edit" type="tel" name="oldTax_pension" value="<?php print(htmlspecialchars($_POST['oldTax_pension'],ENT_QUOTES)); ?>">円</td>
                </tr>
            </table>

            <table class="new">
                <caption>新制度<br>（2012年（平成24年）1月1日以降の契約の場合）</caption>
                <tr>
                    <th>生命保険料(円)</th>
                    <th>介護医療保険料</th>
                    <th>個人年金保険料</th>
                </tr>
                <tr>
                    <td><input type="text" class="edit" name="newTax_life" value="<?php print(htmlspecialchars($_POST['newTax_life'],ENT_QUOTES)); ?>">円</td>
                    <td><input type="text" class="edit"  name="newTax_medical" value="<?php print(htmlspecialchars($_POST['newTax_medical'],ENT_QUOTES)); ?>">円</td>
                    <td><input type="text" class="edit" name="newTax_pension" value="<?php print(htmlspecialchars($_POST['newTax_pension'],ENT_QUOTES)); ?>">円</td>
                </tr>
            </table>
    <!-- 計算ボタン -->
            <div>
                <input class="btn" type="submit" value="計算する">
            </div>
        </form>
    <!-- endform -->
        <div class="mark">↓結果は・・・</div>

        <table class="use">
            <tr>
                <th>使用している<br>所得税の控除額</th>
                <th>使用している<br>住民税の控除額</th>
            </tr>
            <tr>
                <td class="box"><?php print(htmlspecialchars($In_sum,ENT_QUOTES)); ?>/120000円</td>
                <td class="box"><?php print(htmlspecialchars($Res_sum,ENT_QUOTES)); ?>/70000円</td>
            </tr>
        </table>

        <table class="sum">
            <tr>
                <th>実際に控除される<br>所得税</th>
                <th>実際に控除される<br>住民税</th>
            </tr>
            <tr>
                <td class="box"><?php print(htmlspecialchars($In_ded_sum,ENT_QUOTES)); ?>円</td>
                <td class="box"><?php print(htmlspecialchars($Res_ded_sum,ENT_QUOTES)); ?>円</td>
            </tr>
        </table>
        <p>※実際に控除される所得税は年収によって変わるため、めやすとなります。</p>
    </main>
</body>
</html>
