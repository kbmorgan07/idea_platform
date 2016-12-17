<?php
//共通で使うものを別ファイルにしておきましょう。

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//DB接続関数（PDO）

function db_connect(){
  try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
  }
  return $pdo;
}

//SQL処理エラー

//ogin認証チェック関数
function loginCheck(){
  if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    echo "LOGIN ERROR";
    exit;
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}



?>
