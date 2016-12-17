<?php
session_start();
include("functions.php");

loginCheck();

//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM innovation_tool");
$status = $stmt->execute();

//３．データ表示
$view="";
$test="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{

  //arrayの数だけ表示したい
  // $result = $stmt;
  // $test = .=$result["element_text[1]"];

  //personaデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo("$stmt");
    $view .="<div class='box'>";
    $view .="<p>";
    $view .=$result["age"].":".$result["element"].":".$result["problem"].":".$result["solution"];
    $view .='　';
    $view .='<a href="user_update_view.php?id='.$result["id"].'">';
    $view .="</div>";
    $view .='[コメントする]';
    $view .='</a>';
    $view .='　';
    $view .='<a href="user_delete.php?id='.$result["id"].'">';
    $view .='[得票する]';
    $view .="</a>";
    $view .="</p>";
  }
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  div{
    padding: 10px;font-size:16px;
  }

  .box{
    width:20%;
    display: inline-block;
    word-wrap: break-word;
  }

  </style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="persona_insert_view.php">課題登録</a>
      <a class="navbar-brand" href="persona_list_view.php">課題一覧</a>
      <!-- <a class="navbar-brand" href="user_insert_view.php">USER登録</a>
      <a class="navbar-brand" href="user_list_view.php">USER一覧</a> -->
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>

<form action="list.php" method="post">
  <div class="container">
    <label for="keyword">名前:</label>
    <input type="text" name="keywd" id="keywd"/>
  </div>
  <input type="submit" value="検索" />
</form>
<!-- Head[End] -->

<!-- Main[Start] -->
<p><?=$test?></p>
<div>

    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
