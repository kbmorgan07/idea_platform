<?php
//GETでid値を取得
session_start();

$id = $_GET["id"];
$user_name = $_SESSION["user_name"];

include("functions.php");
loginCheck();

//1.  DB接続します
$pdo = db_connect();

//3.SELECT * FROM vote_list WHERE id=:id;
$sql = "SELECT * FROM innovation_tool WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//3.SELECT * FROM comment_list WHERE id=:id;
$sql2 = "SELECT * FROM comment_table WHERE list_id=:id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$status2 = $stmt2->execute();



//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
  $row2 = $stmt2->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>コメント</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css" media="screen" title="no title">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class="test">
  <div class="header_box">
      <a class="test_text" href="persona_insert_view.php">アイデア入力</a>
      <a class="test_text" href="vote_list_view.php">案件一覧</a>
      <a class="test_text" href="dashboard_view.php">Dashbord</a>
  </div>

  <div class="header_right">
    <?=$user_name?>さんログイン中
    <br>
    <a href="logout.php">Logout</a>
  </div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div class="jumbotron">
    <p>対象年齢：<?=$row["age"]?></p><br>
    <p>対象性別：<?=$row["sex"]?></p><br>
    <p>対象地域：<?=$row["location"]?></p><br>
    <p>対象属性：<?=$row["psy"]?></p><br>
    <p>Problem：<?=$row["problem"]?></p><br>
    <p>Solution：<?=$row["solution"]?></p><br>

  </div>

 <!-- <?=$view?> -->

  <form class="" action="mypage_act.php?id=<?=$id ?>" method="post">
    <div>名前：<?=$user_name?></div>
    <div class="" style="float:left;">
      <p>こういう機能が欲しい！：</p>
    </div>
    <div>
      <textarea name="cm_text" rows="8" cols="40"></textarea>
      <input type="hidden" name="cm_name" value="<?=$user_name?>">
      <input type="hidden" name="list_id" value="<?=$row["id"]?>">
      <input type="submit" name="name" value="送信">
    </div>

  </form>
<!-- Main[End] -->

</body>
</html>
