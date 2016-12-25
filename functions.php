<?php
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//DB接続関数（PDO）

function db_connect(){
  try {
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
