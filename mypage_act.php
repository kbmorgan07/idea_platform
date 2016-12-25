<?php
//入力チェック(受信確認処理追加)
session_start();
include("functions.php");
loginCheck();



if(
  !isset($_POST["cm_text"]) || $_POST["cm_text"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$cm_text = $_POST["cm_text"];
$cm_name = $_POST["cm_name"];
$list_id = $_POST["list_id"];

//2.  DB接続します
$pdo = db_connect();

//３．データ登録SQL作成
$sql = "INSERT INTO comment_table(id, list_id, cm_name, cm_text, cm_date
)VALUES(NULL, :a1, :a2, :a3, sysdate())";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $list_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $cm_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $cm_text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．リダイレクト
  header("Location: mypage.php?id=$list_id");
  exit;

}
?>
