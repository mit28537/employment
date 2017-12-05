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
 メール送信完了
</div>

<div class="boxA">

<?php
 require_once('common.php');

 // menu表示
 print_menu();
?>

<div class="boxMain">

<div class="pj_table">
<?php

//前画面からの入力データを受け取る
$engineer_id=$_POST['engineer_id'];
$engineer_mail_address=$_POST['engineer_mail_address'];
$mail_text=$_POST['mail_text'];

//サニタイジング
$engineer_id=htmlspecialchars($engineer_id);
$engineer_mail_address=htmlspecialchars($engineer_mail_address);
$mail_text=htmlspecialchars($mail_text);

//メール送信処理
$mailTo = $engineer_mail_address;									//送信先アドレス
$subject = '【フリーえんじにやー】ご登録ありがとうございます！';	//TODO メールタイトル
$comment = $mail_text;												//メール内容
$header = 'From:k-tamaki@k-mit.jp';									//TODO 送信元アドレス

$result_mail = '';
$result_db = '';
$message = '';

$result_mail = mb_send_mail($mailTo,$subject,$comment,$header);

if($result_mail) {
	$message .= 'メールを送信しました。<br />';

	//ステータス更新
	$result_db = update_engineerStatus($engineer_id,"メール送信済");

	if($result_db) {
		$message .= 'ステータスを更新しました。<br /><br />';
	} else {
		$message .= 'ステータスの更新に失敗しました。<br /><br />';
	}
} else {
	$message .= 'メールの送信に失敗しました。<br />';
}


//結果メッセージ出力
print $message;

?>

</div>
</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
