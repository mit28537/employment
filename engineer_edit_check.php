<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。
require_once('config.php');
require_once('common.php');

//セッションチェック
if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

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
 エンジニア情報更新チェック画面
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">

<div class="pj_table">
下記の内容で更新します
</div>

<?php

//前画面からの入力データを受け取る
$engineer_id=$_POST['engineer_id'];
$engineer_name=$_POST['engineer_name'];
$engineer_kana=$_POST['engineer_kana'];
$engineer_gender=$_POST['engineer_gender'];
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$engineer_mail_address=$_POST['engineer_mail_address'];
$engineer_phone_number=$_POST['engineer_phone_number'];
$engineer_status=$_POST['engineer_status'];
$engineer_other=$_POST['engineer_other'];

//サニタイジング
$engineer_id=htmlspecialchars($engineer_id);
$engineer_name=htmlspecialchars($engineer_name);
$engineer_kana=htmlspecialchars($engineer_kana);
$engineer_gender=htmlspecialchars($engineer_gender);
$year=htmlspecialchars($year);
$month=htmlspecialchars($month);
$day=htmlspecialchars($day);
$engineer_mail_address=htmlspecialchars($engineer_mail_address);
$engineer_phone_number=htmlspecialchars($engineer_phone_number);
$engineer_status=htmlspecialchars($engineer_status);
$engineer_other=htmlspecialchars($engineer_other);

//生年月日設定
$engineer_birthday=$year.$month.$day;


//チェックフラグ
$check_flg=true;

//エラーメッセージ
$message='';

//文字数チェック（氏名）
if(mb_strlen($engineer_name) > 10)
{
	$message .= '氏名が１０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（氏名（かな））
if(mb_strlen($engineer_kana) > 20)
{
	$message .= '氏名（かな）が２０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（メールアドレス）
if(mb_strlen($engineer_mail_address) > 30)
{
	$message .= 'メールアドレスが３０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（電話番号）
if(mb_strlen($engineer_phone_number) > 15)
{
	$message .= '電話番号が１５文字を超えています。<br />';
	$check_flg=false;
}

//メールアドレスチェック
if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$engineer_mail_address) == 0) {
	$message .= 'メールアドレスチェックが正しくありません。<br />';
	$check_flg=false;
}

if($check_flg==true)
{
//全てのチェックがOKの場合

	print '<table class="pj_table">';
	
	print '<tr>';
	print '<td class="pj_item">氏名：</td>';
	print '<td class="inputCheck">'.$engineer_name.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">氏名（かな）：</td>';
	print '<td class="inputCheck">'.$engineer_kana.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">性別：</td>';
	print '<td class="inputCheck">';
	if ($engineer_gender == '男性') {
		print '男性';
	} elseif($engineer_gender == '女性') {
		print '女性';
	} else {
		print '未入力';
	}
	print '</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">生年月日：</td>';
	print '<td class="inputCheck">'.$engineer_birthday.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">メールアドレス：</td>';
	print '<td class="inputCheck">'.$engineer_mail_address.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">電話番号：</td>';
	print '<td class="inputCheck">'.$engineer_phone_number.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">ステータス：</td>';
	print '<td class="inputCheck">'.$engineer_status.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">備考：</td>';
	print '<td class="inputCheck">'.nl2br($engineer_other).'</td>';
	print '</tr>';

	print '</table>';

	print '<form method="post" action="engineer_edit_done.php">';

	//次画面へ連携するデータ
	print '<input type="hidden" name="engineer_id" value="'.$engineer_id.'">';
	print '<input type="hidden" name="engineer_name" value="'.$engineer_name.'">';
	print '<input type="hidden" name="engineer_kana" value="'.$engineer_kana.'">';
	print '<input type="hidden" name="engineer_gender" value="'.$engineer_gender.'">';
	print '<input type="hidden" name="engineer_birthday" value="'.$engineer_birthday.'">';
	print '<input type="hidden" name="engineer_mail_address" value="'.$engineer_mail_address.'">';
	print '<input type="hidden" name="engineer_phone_number" value="'.$engineer_phone_number.'">';
	print '<input type="hidden" name="engineer_status" value="'.$engineer_status.'">';
	print '<input type="hidden" name="engineer_other" value="'.$engineer_other.'">';

	print '<br />';
	print '<div class="pj_table">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</div>';
	print '</form>';

} else {
	//１つでもチェックNGがあった場合
	print '<form>';
	print '<div class="pj_table">';
	print $message;
	print '</div>';
	
	print '<div class="pj_table">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</div>';
	print '</form>';
}

?>

</div>
</div>
</body>
</html>
