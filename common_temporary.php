<?php

//エンジニア情報一覧
function get_engineerList($search_name,$search_kana,$search_status,$iFirstSubscript)
{
try
{
$dsn = 'mysql:dbname=employment;host=localhost';
//$dsn = $config['database']['dsn'];
$user = 'root';
//$user = $config['database']['user'];
$password = '';
//$password = $config['database']['password'];
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql_count = 'SELECT t_engineer_id 
		FROM t_engineer WHERE 
		t_engineer_name LIKE "%'.$search_name.'%" AND 
		t_engineer_kana LIKE "%'.$search_kana.'%" AND 
		t_engineer_status LIKE "%'.$search_status.'%"';
$stmt_count = $dbh->prepare($sql_count);
$stmt_count->execute();

$sql = 'SELECT t_engineer_id,
		t_engineer_name,
		t_engineer_kana,
		t_engineer_mail_address,
		t_engineer_status 
		FROM t_engineer WHERE 
		t_engineer_name LIKE "%'.$search_name.'%" AND 
		t_engineer_kana LIKE "%'.$search_kana.'%" AND 
		t_engineer_status LIKE "%'.$search_status.'%"
		ORDER BY t_engineer_id desc
		LIMIT '.$iFirstSubscript.','.DISPLAY_COUNT;


$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;

//配列クリア（検索結果０件対応）
$arrayData = array();

	while(true)
	{
		$rec=$stmt->fetch(PDO::FETCH_ASSOC);
		if($rec==false)
		{
			break;
		}
		$arrayData[] = array('engineer_id' => $rec['t_engineer_id'],
							'engineer_name' => $rec['t_engineer_name'],
							'engineer_kana' => $rec['t_engineer_kana'],
							'engineer_mail_address' => $rec['t_engineer_mail_address'],
							'engineer_status' => $rec['t_engineer_status']);
	}

	//全データ件数
	$iTotalCount=$stmt_count->rowCount();
	
	//全ページ数
	if($iTotalCount == 0) {
		//検索結果０件の場合は１を設定
		$iTotalPage = 1;
	} else {
		$iTotalPage = ceil($iTotalCount/DISPLAY_COUNT);
	}

	$return_data = array('iTotalCount' => $iTotalCount,
						'iTotalPage' => $iTotalPage,
						'arrayData' => $arrayData);

	return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_engineerList）</br></br>';
	print $sql;
	print'</br></br>';
	return(false);
}

}//END-FUNCTION

//エンジニア情報詳細取得
function get_engineerDetails($engineer_id)
{

try
{
$dsn = 'mysql:dbname=employment;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT  t_engineer_id,
				t_engineer_name,
				t_engineer_kana,
				t_engineer_gender,
				t_engineer_birthday,
				t_engineer_mail_address,
				t_engineer_phone_number,
				t_engineer_status,
				t_engineer_other
		 FROM t_engineer WHERE t_engineer_id = ?';

$stmt = $dbh->prepare($sql);
$data[] = $engineer_id;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;

if($rec==false)
{
	print 'データなし（get_engineertDetails）</br></br>';
	print $sql;
	print '</br></br>';
	return(false);
}


$arrayData = array('engineer_id' => $rec['t_engineer_id'],
					'engineer_name' => $rec['t_engineer_name'],
					'engineer_kana' => $rec['t_engineer_kana'],
					'engineer_gender' => $rec['t_engineer_gender'],
					'engineer_birthday' => $rec['t_engineer_birthday'],
					'engineer_mail_address' => $rec['t_engineer_mail_address'],
					'engineer_phone_number' => $rec['t_engineer_phone_number'],
					'engineer_status' => $rec['t_engineer_status'],
					'engineer_other' => $rec['t_engineer_other']);

$return_data = $arrayData;

return($return_data);
}
catch (Exception $e)
{
	print 'エラー（get_engineerDetails）</br></br>';
	print $sql;
	print '</br></br>';

	return(false);
}

}//END-FUNCTION


//エンジニア情報更新
function update_engineerData()
{

try
{
	//前画面からの入力データを受け取る
	$engineer_id=$_POST['engineer_id'];
	$engineer_name=$_POST['engineer_name'];
	$engineer_kana=$_POST['engineer_kana'];
	$engineer_gender=$_POST['engineer_gender'];
	$engineer_birthday=$_POST['engineer_birthday'];
	$engineer_mail_address=$_POST['engineer_mail_address'];
	$engineer_phone_number=$_POST['engineer_phone_number'];
	$engineer_status=$_POST['engineer_status'];
	$engineer_other=$_POST['engineer_other'];

	//サニタイジング
	$engineer_id=htmlspecialchars($engineer_id);
	$engineer_name=htmlspecialchars($engineer_name);
	$engineer_kana=htmlspecialchars($engineer_kana);
	$engineer_gender=htmlspecialchars($engineer_gender);
	$engineer_birthday=htmlspecialchars($engineer_birthday);
	$engineer_mail_address=htmlspecialchars($engineer_mail_address);
	$engineer_phone_number=htmlspecialchars($engineer_phone_number);
	$engineer_status=htmlspecialchars($engineer_status);
	$engineer_other=htmlspecialchars($engineer_other);


	$dsn = 'mysql:dbname=employment;host=localhost';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'UPDATE t_engineer SET 
				t_engineer_name=?,
				t_engineer_kana=?,
				t_engineer_gender=?,
				t_engineer_birthday=?,
				t_engineer_mail_address=?,
				t_engineer_phone_number=?,
				t_engineer_status=?,
				t_engineer_other=? 
				WHERE t_engineer_id=?';

	$stmt = $dbh->prepare($sql);

	$data[] = $engineer_name;
	$data[] = $engineer_kana;
	$data[] = $engineer_gender;
	$data[] = $engineer_birthday;
	$data[] = $engineer_mail_address;
	$data[] = $engineer_phone_number;
	$data[] = $engineer_status;
	$data[] = $engineer_other;
	$data[] = $engineer_id;

	$stmt->execute($data);
	$dbh = null;

	return(true);

}
catch (Exception $e)
{
	print 'DBエラー</br></br>';
	print $sql;
	return(false);
}

}//END-FUNCTION

//ステータス更新
function update_engineerStatus($engineer_id,$engineer_status)
{

try
{
	$dsn = 'mysql:dbname=employment;host=localhost';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql = 'UPDATE t_engineer SET 
				t_engineer_status=?
				WHERE t_engineer_id=?';

	$stmt = $dbh->prepare($sql);

	$data[] = $engineer_status;
	$data[] = $engineer_id;

	$stmt->execute($data);
	$dbh = null;

	return(true);

}
catch (Exception $e)
{
	print 'DBエラー</br></br>';
	print $sql;
	return(false);
}

}//END-FUNCTION


//プルダウンメニュー（年）
function pulldown_year($year)
{
	print '<select name="year">';
	for($i=1960;$i<2000;$i++) {
		if($year == $i) {
			print '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		} else {
			print '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	print '</select>';
	print '年';
}//END-FUNCTION

//プルダウンメニュー（月）
function pulldown_month($month)
{
	print '<select name="month">';
	for($i=1;$i<10;$i++) {
		if($month == $i) {
			print '<option value="0'.$i.'" selected="selected">0'.$i.'</option>';
		} else {
			print '<option value="0'.$i.'">0'.$i.'</option>';
		}
	}

	if($month == '10') {
		print '<option value="10" selected="selected">10</option>';
	} else {
		print '<option value="10">10</option>';
	}

	if($month == '11') {
		print '<option value="11" selected="selected">11</option>';
	} else {
		print '<option value="11">11</option>';
	}

	if($month == '12') {
		print '<option value="12" selected="selected">12</option>';
	} else {
		print '<option value="12">12</option>';
	}

	print '</select>';
	print '月';
}//END-FUNCTION

//プルダウンメニュー（日）
function pulldown_day($day)
{
	print '<select name="day">';
	for($i=1;$i<10;$i++) {
		if($day == $i) {
			print '<option value="0'.$i.'" selected="selected">0'.$i.'</option>';
		} else {
			print '<option value="0'.$i.'">0'.$i.'</option>';		
		}
	}

	for($i=10;$i<32;$i++) {
		if($day == $i) {
			print '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		} else {
			print '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	print '</select>';
	print '日';
}//END-FUNCTION

//プルダウンメニュー（ステータス）
function pulldown_status($status)
{
	print '<select name="engineer_status">';

	if($status == '仮登録') {
		print '<option value="仮登録" selected="selected">仮登録</option>';
	} else {
		print '<option value="仮登録">仮登録</option>';
	}

	if($status == 'メール受信') {
		print '<option value="メール受信" selected="selected">メール受信</option>';
	} else {
		print '<option value="メール受信">メール受信</option>';
	}

	if($status == 'メール送信済') {
		print '<option value="メール送信済" selected="selected">メール送信済</option>';
	} else {
		print '<option value="メール送信済">メール送信済</option>';
	}

	if($status == '本登録') {
		print '<option value="本登録" selected="selected">本登録</option>';
	} else {
		print '<option value="本登録">本登録</option>';
	}

	print '</select>';
}//END-FUNCTION

?>
