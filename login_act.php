<?php
ini_set('display_errors', '1');
session_start();
echo "0";
include("functions.php");

$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
echo "1";
//1. 接続します
$pdo = db_connect();

echo "2";
//２．データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE user_id=:lid AND user_password=:lpw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["user_id"] = $val['user_id'];
  $_SESSION["user_name"] = $val['user_name'];
  $_SESSION["user_password"] = $val['user_password'];
  $_SESSION["age"] = $val['age'];
  $_SESSION["sex"] = $val['sex'];
  $_SESSION["location"] = $val['location'];

  //Login処理OKの場合select.phpへ遷移
  header("Location: vote_list_view.php");
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: login.php");
}
//処理終了
exit();
?>
