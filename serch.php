<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <style>div{padding: 10px;font-size:16px;}</style>
  <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
</head>
<body>


	<?php


  session_start();
  include("functions.php");

  $user_name = $_SESSION["user_name"];

  loginCheck();

  //1.  DB接続します
  $pdo = db_connect();

  //２．データ登録SQL作成



	//POST送信されたデータを$text1へ
	$keywd =$_POST["keywd"];

	//SQL(テーブルから列を抽出する
	$sql ="SELECT solution FROM innovation_tool ";
	//キーワードが入力されているときはwhere以下を組み立てる
	if (strlen($keywd)>0){
		//受け取ったキーワードの全角スペースを半角スペースに変換する
		$keywd2 = str_replace("　", " ", $keywd);

		//キーワードを空白で分割する
		$array = explode(" ",$keywd2);

		//分割された個々のキーワードをSQLの条件where句に反映する
		$where = "WHERE ";

		for($i = 0; $i <count($array);$i++){
			$where .= "(problem LIKE '%$array[$i]%')";

			if ($i <count($array) -1){
				$where .= " AND ";
			}
		}
	}

  $stmt = $pdo->prepare("SELECT * FROM innovation_tool ".$where);
  $status = $stmt->execute();


  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }else{
    // personaデータの数だけ自動でループしてくれる
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

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
      $view .="</div>";
      }
  }

	?>

  <p>
    <?=$view?>
  </p>
</body>
</html>
