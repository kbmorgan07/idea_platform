<?php
//1.GETでid値を取得
session_start();
$id = $_GET["id"];
include("functions.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー更新画面</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報</legend>
    <label>NAME：<input type="text" name="user_name" value="<?=$row["user_name"]?>"></label><br>
    <label>PASSWORD：<input type="text" name="user_password" value="<?=$row["user_password"]?>"></label><br>
    <label>LIFELAG：<input type="text" name="user_lifeflag" value="<?=$row["user_lifeflag"]?>"></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
