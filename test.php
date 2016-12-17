
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
<form class="post" action="result.php" method="post">
  <input type="checkbox" name="age[]" value="10">10代まで
  <input type="checkbox" name="age[]" value="20">10代まで

  <input type="submit" value="送信">


</form>


</body>
</html>
