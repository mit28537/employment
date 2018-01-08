<?php

require('config.php');

try
{
	//前画面からの入力データを受け取る
	$user_id=$_POST['user_id'];
	$user_pass=$_POST['user_pass'];

	//サニタイジング
	$user_id=htmlspecialchars($user_id);
	$user_pass=htmlspecialchars($user_pass);

	//データベース接続
	//$dsn = 'mysql:dbname=employment;host=localhost';
	$dsn = $config['database']['dsn'];
	//$user = 'root';
	$user = $config['database']['user'];
	//$password = '';
	$password = $config['database']['password'];

	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT mst_user_name FROM mst_user WHERE mst_user_id = ? AND mst_user_password = ?';
	$stmt = $dbh->prepare($sql);
	$data[] = $user_id;
	$data[] = $user_pass;

	$stmt->execute($data);
	$dbh = null;

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rec == false) {
		print 'ユーザーID='.$user_id.'</br>';
		print 'パスワード='.$user_pass.'</br>';

		print 'ユーザーID　or　パスワードが間違っています。';
		print '<a href="employment_login.php">戻る</a>';
	} else {
		//ログイン成功
		session_start();
		$_SESSION['login'] = 'ログイン中';
		$_SESSION['user_name'] = $rec['mst_user_name'];

		header('Location:employment_list.php');
	}
}
catch (Exception $e)
{
	print 'DBエラー</br></br>';
	exit();
}

?>
