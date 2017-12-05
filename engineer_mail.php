<?php
//session_cache_limiter('public');
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

require_once('common.php');

//セッションチェック
if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

//前画面から会員番号を取得
$engineer_id = (int)$_GET["engineer_id"];

//エンジニア詳細情報取得
$arrayData = get_engineerDetails($engineer_id);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>案件情報メンテナンス</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/module.js"></script>
</head>
<body>

<div class="boxhead">
 メール送信画面
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">

<div class="pj_table">
メール本文を入力してください
</div>
<br />
<form method="post" action="engineer_mail_check.php">

<table class="pj_table">

<tr>
<td id="number" class="pj_item">会員番号</td>
<td class="pj_value"><?php print $arrayData['engineer_id']; ?></td>
</tr>

<tr>
<td id="name" class="pj_item">氏名</td>
<td class="pj_value"><?php print $arrayData['engineer_name']; ?></td>
</tr>

<tr>
<td id="mail" class="pj_item">メールアドレス</td>
<td class="pj_value"><input type="text" name="engineer_mail_address" class="textBox" value="<?php print $arrayData['engineer_mail_address']; ?>"></td>
</tr>

<tr>
<td id="text" class="pj_item">メール本文を入力してください。</td>
<td class="pj_value"><textarea name="mail_text" class="textBox" rows="32"></textarea></td>
</tr>

</table>

<br />
<div class="pj_table">
<input type="hidden" name="engineer_id" value="<?php print $arrayData['engineer_id']; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="確認">
</div>
</form>

</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
