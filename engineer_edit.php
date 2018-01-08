<?php
//session_cache_limiter('public');
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。
require_once('config.php');
require_once('common.php');

//セッションチェック
if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

//前画面から会員番号を取得
$engineer_id = (int)$_GET["engineer_id"];

//エンジニア詳細情報取得
$arrayData = get_engineerDetails($engineer_id);

//生年月日分割取得
$year = mb_substr($arrayData['engineer_birthday'],0,4);
$month = mb_substr($arrayData['engineer_birthday'],4,2);
$day = mb_substr($arrayData['engineer_birthday'],6,2);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php print $config['app']['app_title']; ?></title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/module.js"></script>
</head>
<body>

<div class="boxhead">
 エンジニア情報更新画面
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">

<div class="pj_table">
エンジニア情報を入力してください
</div>
<br />
<form method="post" action="engineer_edit_check.php">

<table class="pj_table">

<tr>
 <td id="number" class="pj_item">会員番号</td>
 <td class="pj_value"><?php print $arrayData['engineer_id']; ?></td>
</tr>

<tr>
  <td id="name" class="pj_item">氏名を入力してください。（10文字以内）</td>
 <td class="pj_value"><input type="text" name="engineer_name" class="textBox" value="<?php print $arrayData['engineer_name']; ?>"></td>
</tr>

<tr>
  <td id="name_kana" class="pj_item">氏名（かな）を入力してください。（20文字以内）</td>
 <td class="pj_value"><input type="text" name="engineer_kana" class="textBox" value="<?php print $arrayData['engineer_kana']; ?>"></td>
</tr>

<tr>
  <td id="sex" class="pj_item">性別を選択してください。</td>
<td class="pj_value">
<?php if($arrayData['engineer_gender'] == "男性") { ?>
	<input type="radio" name="engineer_gender" value="男性" checked>男性
	<input type="radio" name="engineer_gender" value="女性">女性
<?php } elseif($arrayData['engineer_gender'] == "女性") { ?>
	<input type="radio" name="engineer_gender" value="男性">男性
	<input type="radio" name="engineer_gender" value="女性" checked>女性
<?php } else { ?>
	<input type="radio" name="engineer_gender" value="男性" checked>男性
	<input type="radio" name="engineer_gender" value="女性">女性
<?php } ?>
</td>
</tr>

<tr>
 <td id="birth" class="pj_item">生年月日を選択してください。★必須</td>
<td class="pj_value">
<?php
pulldown_year($year);
pulldown_month($month);
pulldown_day($day);
?>
</td>
</tr>

<tr>
 <td id="mail" class="pj_item">メールアドレスを入力してください。</td>
 <td class="pj_value"><input type="text" name="engineer_mail_address" class="textBox" value="<?php print $arrayData['engineer_mail_address']; ?>"></td>
</tr>

<tr>
 <td id="tel" class="pj_item">電話番号を入力してください。</td>
 <td class="pj_value"><input type="text" class="textBox" name="engineer_phone_number" value="<?php print $arrayData['engineer_phone_number']; ?>"></td>
</tr>

<tr>
 <td id="status" class="pj_item">ステータスを選択してください。</td>
 <td class="pj_value">
<?php
pulldown_status($arrayData['engineer_status']);
?>
</td>
</tr>

<tr>
 <td id="remarks" class="pj_item">備考を入力してください。
 <td class="pj_value"><textarea name="engineer_other" class="textBox"><?php print $arrayData['engineer_other']; ?></textarea></td>
</tr>
</table>

<br />

<input type="hidden" name="engineer_id" value="<?php print $arrayData['engineer_id']; ?>">
<div class="pj_table">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</div>
</form>

</div>
</div>
</body>
</html>
