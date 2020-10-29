# 1保険料控除計算サイト
毎年払っている保険料金額から、控除される所得税・住民税の計算ができるサイトです。<br>
URL:[https://mezasenokng.xyz](https://mezasenokng.xyz)<br>

## 機能一覧
・入力機能<br>
・計算機能<br>

## 使用言語・開発環境
-- HTML/CSS<br>
-- PHP7.3.11<br>
-- MAMP<br>
-- Xserver<br>

## サイト画像
![screencapture-mezasenokng-xyz-2020-10-22-05_09_20](https://user-images.githubusercontent.com/68857104/96783793-8eaecd80-1428-11eb-81c9-f7d38c4821d0.png)


# 2掲示板サイト
某アニメのチャットサイトを使っている気分になれる掲示板です。<br>
URL:[https://mezasenokng.xsrv.jp](https://mezasenokng.xsrv.jp)<br>

## 機能一覧
・ログイン/ログアウト<br>
・アカウント認証/登録時のアカウント重複チェック<br>
・文章の投稿/投稿文章の削除<br>
・レスポンシブ対応<br>

## 使用言語・開発環境
-- HTML/CSS<br>
-- PHP7.3.11<br>
-- MAMP<br>
-- Xserver<br>
-- FileZilla（Xserverへの画像アップロード）<br>

## DB
・members
|Name    |Type|Null|Default|Extra|
|--------|-------|------|--|---|
|id      |int(11)|No|None|AUTO_INCRMENT|
|name    |varchar(10)|No|None|
|email   |varchar(255)|No|None|
|password|varchar(100)|No|None|
|icon    |varchar(255)|No|None|
|created |datetime|No|None|
|modified|timestamp|No|CURRENT_TIMESTAMP|ON UPDATE CURRENT_TIMESTAMP|


・posts
|Name    |Type          |Null|Default|Extra|
|--------|-------|------|--|---|
|id       |int(11)      |No  |None|AUTO_INCRMENT|
|message  |text         |No   
|member_id|int(11)     |No    |None|
|icon     |varchar(255)|No    |None|
|created  |datetime    |No    |None|
|modified |timestamp   |No|   CURRENT_TIMESTAMP|ON UPDATE CURRENT_TIMESTAMP|

## サイト画像
トップ画面
![top](https://user-images.githubusercontent.com/68857104/94697033-abe50480-0372-11eb-9248-4bfbc40ac44f.png)
<br><br>
ログイン画面
![login](https://user-images.githubusercontent.com/68857104/94697090-bef7d480-0372-11eb-91cc-6c2b19923a22.png)

<br><br>
アカウント登録画面
![signup](https://user-images.githubusercontent.com/68857104/94697146-ccad5a00-0372-11eb-9b25-05a6e021915d.png)

<br><br>
掲示板画面
![chat](https://user-images.githubusercontent.com/68857104/94697283-fd8d8f00-0372-11eb-9089-661a0c5c687d.png)

<br><br>
ログアウト後の画面
![logout](https://user-images.githubusercontent.com/68857104/94697447-2e6dc400-0373-11eb-9903-3d967a341e13.png)
