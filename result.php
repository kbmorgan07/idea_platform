
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
    width:20%;
    display: inline-block;
    word-wrap: break-word;
  }

  </style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php
$age = $_POST["age"];
$str ="";

foreach($age as $value){
  $str .= $value."";
}

echo $str;

 ?>

</form>


</body>
</html>
