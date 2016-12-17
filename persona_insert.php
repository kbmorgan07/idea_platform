<?php
//入力チェック(受信確認処理追加)
session_start();
include("functions.php");
loginCheck();



if(
  !isset($_POST["age"]) || $_POST["age"]=="" ||
  !isset($_POST["sex"]) || $_POST["sex"]=="" ||
  !isset($_POST["location"]) || $_POST["location"]=="" ||
  !isset($_POST["psy"]) || $_POST["psy"]=="" ||
  !isset($_POST["problem"]) || $_POST["problem"]=="" ||
  !isset($_POST["solution"]) || $_POST["solution"]==""

){
  exit('ParamError');
}


//1. POSTデータ取得
$age = $_POST["age"];
$str ="";
foreach($age as $value){
  $str .= $value.",";
}

$sex = $_POST["sex"];
$str2 ="";
foreach($sex as $value){
  $str2 .= $value.",";
}

$location = $_POST["location"];
$str3 ="";
foreach($location as $value){
  $str3 .= $value.",";
}

$psy = $_POST["psy"];
$str4 ="";
foreach($psy as $value){
  $str4 .= $value.",";
}


$problem = $_POST["problem"];
$solution = $_POST["solution"];

//2.  DB接続します
$pdo = db_connect();

//３．データ登録SQL作成
$sql = "INSERT INTO innovation_tool(id, age, sex, location, psy, problem, solution,
indate )VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, sysdate())";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $str, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $str2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $str3, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $str4, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $problem, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $solution, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．persona_insert_view.phpへリダイレクト
  header("Location: persona_insert_view.php");
  exit;

}
?>
