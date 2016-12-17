<?php
//1.POSTでid,name,email,naiyouを取得
$id     = $_POST["id"];
$user_name   = $_POST["user_name"];
$user_password  = $_POST["user_password"];
$user_lifeflag = $_POST["user_lifeflag"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE gs_user_table SET user_name=:user_name,user_password=:user_password,user_lifeflag=:user_lifeflag WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name',   $user_name,  PDO::PARAM_STR);
$stmt->bindValue(':user_password',  $user_password, PDO::PARAM_STR);
$stmt->bindValue(':user_lifeflag', $user_lifeflag,PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,    PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //bm_list_view.phpへリダイレクト
  header("Location: user_list_view.php");
  exit;

}



?>
