<?php
//入力チェック(受信確認処理追加)
session_start();

include("functions.php");

if(
  !isset($_POST["user_id"]) || $_POST["user_id"]=="" ||
  !isset($_POST["user_name"]) || $_POST["user_name"]=="" ||
  !isset($_POST["user_password"]) || $_POST["user_password"]=="" ||
  !isset($_POST["age"]) || $_POST["age"]=="" ||
  !isset($_POST["sex"]) || $_POST["sex"]=="" ||
  !isset($_POST["location"]) || $_POST["location"]==""
){
  exit('ParamError');
}


//1. POSTデータ取得
$user_id = $_POST["user_id"];
$user_name = $_POST["user_name"];
$user_password = $_POST["user_password"];
$age = $_POST["age"];
$sex = $_POST["sex"];
$location = $_POST["location"];

//2. DB接続します(エラー処理追加)
$pdo = db_connect();

//SQL作成
$sql = "SELECT * FROM gs_user_table WHERE user_id=:user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
  if($row["user_id"] == $user_id){
    $_SESSION["er"]=1;
    $_SESSION["user_id"] = $user_id;
    $_SESSION["user_name"] = $user_name;
    $_SESSION["user_password"] = $user_password;
    $_SESSION["age"] = $age;
    $_SESSION["sex"] = $sex;
    $_SESSION["location"] = $location;
    header("Location: user_insert_view.php");
    exit;
  }
}



//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(id, user_id, user_name, user_password, age, sex, location,
user_resistered_time )VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, sysdate())";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':a2', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':a3', $user_password, PDO::PARAM_STR);
$stmt->bindValue(':a4', $age, PDO::PARAM_STR);
$stmt->bindValue(':a5', $sex, PDO::PARAM_STR);
$stmt->bindValue(':a6', $location, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．リダイレクト
  header("Location: login.php");
  exit;

}
?>
