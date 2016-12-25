<?php
//入力チェック(受信確認処理追加)
session_start();
include("functions.php");
loginCheck();


if(
  !isset($_POST["vt_id"]) || $_POST["vt_id"]==""
){
  exit('ParamError');
}



//1. POSTデータ取得
$vt_id = $_POST["vt_id"];
$vt_name = $_POST["vt_name"];


//2.  DB接続します
$pdo = db_connect();

//３．データ登録SQL作成
$sql = "INSERT INTO vote_table(id, vt_id, vt_name, vt_date
)VALUES(NULL, :a1, :a2, sysdate())";


$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $vt_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $vt_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５.リダイレクト
  header("Location: vote_list_view.php");
  exit;

}
?>
