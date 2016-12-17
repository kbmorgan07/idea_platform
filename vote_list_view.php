<?php
session_start();
include("functions.php");

$user_name = $_SESSION["user_name"];

loginCheck();

//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM innovation_tool");
$status = $stmt->execute();

//$stmt2 = $pdo->prepare("SELECT count(*) as cnt from vote_table where vt_id =".$result["id"]);
//$status2 = $stmt2->execute();
//$stmt2 = $pdo->query("SELECT count(*) as cnt from vote_table where vt_id =".$result["id"]);

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{

  // personaデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $stmt2 = $pdo->query("SELECT count(*) as cnt from vote_table where vt_id =".$result["id"]);
    $result2 = $stmt2->fetchColumn();

    // $status2 = $stmt2->execute();
    // $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $view .="<div class='box'>";
    $view .="課題".":　".$result["problem"]."<br>";
    $view .="解決策".":　".$result["solution"];
    $view .="<ul>";
    if(isset($result["age"])){
      $ageAry = explode(',',$result["age"]);
      foreach ($ageAry as $value){
        if($value){
          $view .='<li style="display: inline-block; padding: 3px; background: #ccc; border-radius: 4px; margin-right: 4px;">' . $value . "</li>";
        }
      }
    }

    if(isset($result["sex"])){
      $sexAry = explode(',',$result["sex"]);
      foreach ($sexAry as $value){
        if($value){
          $view .='<li style="display: inline-block; padding: 3px; background: #ccc; border-radius: 4px; margin-right: 4px;">' . $value . "</li>";
        }
      }
    }

    if(isset($result["location"])){
      $locationAry = explode(',',$result["location"]);
      foreach ($locationAry as $value){
        if($value){
          $view .='<li style="display: inline-block; padding: 3px; background: #ccc; border-radius: 4px; margin-right: 4px;">' . $value . "</li>";
        }
      }
    }

    if(isset($result["psy"])){
      $psyAry = explode(',',$result["psy"]);
      foreach ($psyAry as $value  ){
        if($value){
          $view .='<li style="display: inline-block; padding: 5px; background: #ccc; border-radius: 4px; margin: 4px;">' . $value . "</li>";
        }
      }
    }

    $view .="</ul>";
    $view .='<div class="sub_box">';
    $view .='<a href="mypage.php?id='.$result["id"].'">';
    $view .='[コメントする]';
    $view .='</a>';
    $view .='　';
    $view .='<form class="" action="vote_act.php?id='.$result["id"].'" method="post">';
    $view .='<input type="hidden" name="vt_id" value="'.$result["id"].'">';
    $view .='<input type="hidden" name="vt_name" value="'.$user_name.'">';
    $view .='<input type="submit" value="投票する" >';
    $view .='</form>';
    $view .=$result2;
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
<title>ユーザー一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  div{
    padding: 10px;font-size:16px;
  }

  .box{
    width:100%;
    display: inline-block;
    word-wrap: break-word;
  }

  .sub_box{
      text-align:right;
      border-bottom:1px solid #000;
      margin-bottom:20px;
    }

  .serch_box{
    right:0;
  }


  </style>
</head>
<body id="main">
<!-- Head[Start] -->
<header class="test">
  <div class="test">
      <div class="header_box">
        <div class="header_left">
          <a class="test_text" href="persona_insert_view.php">Problem</a>
          <a class="test_text" href="vote_list_view.php">Problem List</a>
        </div>

        <div class="header_right">
        <a class="test_text" href="logout.php">logout</a>
        </div>
      </div>
  </div>
</header>

<div class="container">
  <div class="container_sub">
    <form action="serch.php" method="post">
      <div class="serch_box">
      <input type="text" name="keywd" id="keywd" placeholder="気になるキーワードを入力下さい" size="30">　<input type="submit" value="検索" >
      </div>

      <h2 style="text-decoration: underline">詳細検索</h2>
        <h4>年齢</h4>
        <div class="box_check">
          <input type="checkbox" name="age[]" value="10">10代まで
          <input type="checkbox" name="age[]" value="20">20代
          <input type="checkbox" name="age[]" value="30">30代
          <input type="checkbox" name="age[]" value="40">40代
          <input type="checkbox" name="age[]" value="50">50代
          <input type="checkbox" name="age[]" value="">60代以上
        </div>

        <h4>性別</h4>
        <div class="box_check">
          <input type="checkbox" name="sex[]" value="男性">男性
          <input type="checkbox" name="sex[]" value="女性">女性
          <input type="checkbox" name="sex[]" value="LGBT">LGBT
        </div>

        <h4>対象エリア</h4>
        <div class="box_check">
          <input type="checkbox" name="location[]" value="北海道">北海道
          <input type="checkbox" name="location[]" value="東北">東北
          <input type="checkbox" name="location[]" value="関東">関東
          <input type="checkbox" name="location[]" value="関西">関西
          <input type="checkbox" name="location[]" value="中国・四国">中国・四国
          <input type="checkbox" name="location[]" value="九州・沖縄">九州・沖縄
        </div>

        <h4>対象エリア</h4>
        <div class="box_check">
          <input type="checkbox" name="psy[]" value="北海道">北海道
          <input type="checkbox" name="psy[]" value="東北">東北
          <input type="checkbox" name="psy[]" value="関東">関東
          <input type="checkbox" name="psy[]" value="関西">関西
          <input type="checkbox" name="psy[]" value="中国・四国">中国・四国
          <input type="checkbox" name="psy[]" value="九州・沖縄">九州・沖縄
        </div>
    </form>
  </div>
  <input type="submit" value="検索" >
</div>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
