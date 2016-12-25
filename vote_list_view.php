<?php
session_start();
include("functions.php");
$user_name = $_SESSION["user_name"];
$user_id = $_SESSION["user_id"];
$user_password = $_SESSION["user_password"];
$age = $_SESSION["age"];
$sex = $_SESSION["sex"];



loginCheck();

//1.  DB接続します
$pdo = db_connect();

//２．SQL作成

  $stmt = $pdo->prepare("SELECT * FROM innovation_tool WHERE sex LIKE '%$sex%' AND age LIKE '%$age%'");
  $status = $stmt->execute();


  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    // personaデータの数だけ自動でループ
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .="<div class='box'>";
      $view .="課題".":　".$result["problem"]."<br>";
      $view .="解決策".":　".$result["solution"];
      $view .="<ul>";
      if(isset($result["age"])){
        $ageAry = explode(',',$result["age"]);
        foreach ($ageAry as $value){
          if($value){
            $view .='<li>' . $value . "</li>";
          }
        }
      }

      if(isset($result["sex"])){
        $sexAry = explode(',',$result["sex"]);
        foreach ($sexAry as $value){
          if($value){
            $view .='<li>' . $value . "</li>";
          }
        }
      }

      if(isset($result["location"])){
        $locationAry = explode(',',$result["location"]);
        foreach ($locationAry as $value){
          if($value){
            $view .='<li>' . $value . "</li>";
          }
        }
      }

      $view .="</ul>";
      $view .='<div class="sub_box">';
      $view .='<a href="mypage.php?id='.$result["id"].'">';
      $view .='[アンケートに応える]';
      $view .='</a>';
      $view .='　';
      $view .='<form class="" action="vote_act.php?id='.$result["id"].'" method="post">';
      $view .='<input type="hidden" name="vt_id" value="'.$result["id"].'">';
      $view .='<input type="hidden" name="vt_name" value="'.$user_name.'">';
      $view .='<input type="submit" value="イイね！" >';
      $view .='</form>';
      $view .="</div>";
      }
  }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>アイデア一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body id="main">
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

<div class="container">
  <div class="container_sub">
    <form action="serch.php" method="post">
      <div class="serch_box">
      <input type="text" name="keywd" id="keywd" placeholder="気になるキーワードを入力下さい" size="30">　<input type="submit" value="検索" >
      </div>

    </form>
  </div>
</div>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
