<?php
session_start();

include("functions.php");


if(isset($_SESSION["er"]) && $_SESSION["er"]=="1"){
  // $_SESSION["er"]=1;
  $user_id = $_SESSION["user_id"];
  $user_name = $_SESSION["user_name"] ;
  $user_password =$_SESSION["user_password"];
  $age = $_SESSION["age"] ;
  $sex = $_SESSION["sex"] ;
  $location = $_SESSION["location"] ;

  $_SESSION["er"]=0;
  $_SESSION["user_id"]="";
  $_SESSION["user_name"]="";
  $_SESSION["user_password"]="";
  $_SESSION["age"]="";
  $_SESSION["sex"]="";
  $_SESSION["location"]="";

  $er = '<span style="color:red">同じIDが存在します</span>';

}else{
  $user_id = "";
  $user_name = "";
  $user_password ="";
  $er = "";

}
 ?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->



<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <header class="test">
  </header>
  <fieldset>
    <legend>ユーザー登録</legend>
    <label>LogIn ID：<input type="text" name="user_id" value="<?=$user_id?>"></label><?=$er?><br>
    <label>NAME：<input type="text" name="user_name" value="<?=$user_name?>"></label><br>
    <label>LogIn PASSWORD：<input type="password" name="user_password" value="<?=$user_password?>"></label><br>
    <label>年齢：
      <input type="radio" name="age" value="10" checked="">10代
      <input type="radio" name="age" value="20" checked="">20代
      <input type="radio" name="age" value="30" checked="">30代
      <input type="radio" name="age" value="40" checked="">40代
      <input type="radio" name="age" value="50" checked="">50代
      <input type="radio" name="age" value="60" checked="">60代以上
    </label>
    <br>
    <label>性別：
      <input type="radio" name="sex" value="男性" checked="">男性
      <input type="radio" name="sex" value="女性" checked="">女性
      <input type="radio" name="sex" value="LGBT" checked="">LGBT
    </label>

    <br>
    <label>居住している地域：
      <input type="radio" name="location" value="北海道" checked="">北海道
      <input type="radio" name="location" value="東北" checked="">東北
      <input type="radio" name="location" value="関東" checked="">関東
      <input type="radio" name="location" value="関西" checked="">関西
      <input type="radio" name="location" value="中国・四国" checked="">中国・四国
      <input type="radio" name="location" value="九州・沖縄" checked="">九州・沖縄
    </label>
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
