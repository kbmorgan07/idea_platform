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

<!-- Head[Start] -->
<header>
<div class="test">
    <div class="header_box">
      <div class="header_left">
        <a class="test_text" href="persona_insert_view.php">Problem</a>
        <a class="test_text" href="vote_list_view.php">Problem List</a>
      </div>

      <div class="header_right">
      <a class="test_text" href="logout.php">logout</a>
      </div>
    </div>
</div>
</header>

<!-- Head[End] -->

<!-- Main[Start] -->
    <form method="post" action="persona_insert.php">
      <div class="jumbotron">
       <fieldset>
        <div class="body_wrapper">
        <h2>ペルソナ入力</h2>
          <h3>Demography</h3>
            <h4>年齢</h4>
            <div class="box_check">
              <input type="checkbox" name="age[]" value="10">10代まで
              <input type="checkbox" name="age[]" value="20">20代
              <input type="checkbox" name="age[]" value="30">30代
              <input type="checkbox" name="age[]" value="40">40代
              <input type="checkbox" name="age[]" value="50">50代
              <input type="checkbox" name="age[]" value="">60代以上
            </div>

            <h4>性別</h4>
            <div class="box_check">
              <input type="checkbox" name="sex[]" value="男性">男性
              <input type="checkbox" name="sex[]" value="女性">女性
              <input type="checkbox" name="sex[]" value="LGBT">LGBT
            </div>

          <h3>Geography</h3>
            <h4>対象エリア</h4>
            <div class="box_check">
              <input type="checkbox" name="location[]" value="北海道">北海道
              <input type="checkbox" name="location[]" value="東北">東北
              <input type="checkbox" name="location[]" value="関東">関東
              <input type="checkbox" name="location[]" value="関西">関西
              <input type="checkbox" name="location[]" value="中国・四国">中国・四国
              <input type="checkbox" name="location[]" value="九州・沖縄">九州・沖縄
            </div>

          <h3>Psychography</h3>
            <h4>対象エリア</h4>
            <div class="box_check">
              <input type="checkbox" name="psy[]" value="北海道">北海道
              <input type="checkbox" name="psy[]" value="東北">東北
              <input type="checkbox" name="psy[]" value="関東">関東
              <input type="checkbox" name="psy[]" value="関西">関西
              <input type="checkbox" name="psy[]" value="中国・四国">中国・四国
              <input type="checkbox" name="psy[]" value="九州・沖縄">九州・沖縄
            </div>

          </div>

          <div class="body_wrapper">
            <h2>Problem</h2><label><textArea name="problem" rows="4" cols="40"></textArea></label><br>
          </div>

          <div class="body_wrapper">
            <h2>Solution</h2><label><textArea name="solution" rows="4" cols="40"></textArea></label><br>
          </div>

         <input type="submit" value="送信">
        </fieldset>
      </div>
    </form>


<!-- Main[End] -->


</body>
</html>
