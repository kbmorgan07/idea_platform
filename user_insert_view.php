<?php
session_start();
if(isset($_SESSION["er"]) && $_SESSION["er"]=="1"){
  // $_SESSION["er"]=1;
  $user_id = $_SESSION["user_id"];
  $user_name = $_SESSION["user_name"] ;
  $user_password =$_SESSION["user_password"];
  $_SESSION["er"]=0;
  $_SESSION["user_id"]="";
  $_SESSION["user_name"]="";
  $_SESSION["user_password"]="";
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
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
    <label>LogIn ID：<input type="text" name="user_id" value="<?=$user_id?>"></label><?=$er?><br>
    <label>NAME：<input type="text" name="user_name" value="<?=$user_name?>"></label><br>
    <label>LogIn PASSWORD：<input type="text" name="user_password" value="<?=$user_password?>"></label><br>
     <!-- <p>本のコメント</p><label><textArea name="book_comment" rows="4" cols="40"></textArea></label><br> -->
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
