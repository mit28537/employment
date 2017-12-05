<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

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
<title>案件情報メンテナンス</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/module.js"></script>
</head>
<body>

<div class="boxhead">
メール送信チェック画面
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">


<?php

//前画面からの入力データを受け取る
$engineer_id=$_POST['engineer_id'];
$engineer_mail_address=$_POST['engineer_mail_address'];
$mail_text=$_POST['mail_text'];

//サニタイジング
$engineer_id=htmlspecialchars($engineer_id);
$engineer_mail_address=htmlspecialchars($engineer_mail_address);
$mail_text=htmlspecialchars($mail_text);


//チェックフラグ
$check_flg=true;

$message = '';

if($mail_text=='')
{
	$message .= '本文が入力されていません。<br />';
	$check_flg=false;
}

if($check_flg==true)
{
//全てのチェックがOKの場合

	print '<div class="pj_table">';
	print '下記の内容で送信します';
	print '</div>';
	
	print '<table class="pj_table">';
	
	print '<tr>';
	print '<td class="pj_item">メールアドレス：</td>';
	print '<td class="inputCheck">'.$engineer_mail_address.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">メール本文：</td>';
	print '<td class="inputCheck">'.nl2br($mail_text).'</td>';
	print '</tr>';

	print '</table>';
	
	print '<form method="post" action="engineer_mail_done.php">';

	//次画面へ連携するデータ
	print '<input type="hidden" name="engineer_id" value="'.$engineer_id.'">';
	print '<input type="hidden" name="engineer_mail_address" value="'.$engineer_mail_address.'">';
	print '<input type="hidden" name="mail_text" value="'.$mail_text.'">';
	
	print '<br />';
	print '<div class="pj_table">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="送信">';
	print '</div>';
	print '</form>';

} else {
	//１つでもチェックNGがあった場合
	print '<form>';
	print '<div class="pj_table">';
	print $message;
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</div>';
	print '</form>';
}

?>

</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
