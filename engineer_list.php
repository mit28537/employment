<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。
require_once('config.php');
require_once('common.php');

const DISPLAY_COUNT = 3;		//一覧表示件数
const PAGE_RANGE = 3;			//ページング幅

//セッションチェック
if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

if (
	isset($_GET["page"]) &&
	$_GET["page"] > 0 ) {
	//URLパラメータにpageが存在する場合
	//pageが1以上で全ページを超えていない場合

	//悪意ある値を受け付けないようにキャストする
	$page = (int)$_GET["page"];
} else {
	//上記条件以外はpageに1を設定
	$page = 1;
}

if (isset($_POST['search_name']))
{
	//検索ボタン押下
	//前画面からの入力データを受け取る
	$search_name = $_POST['search_name'];
	$search_kana = $_POST['search_kana'];
	$search_status = $_POST['search_status'];

	//サニタイジング
	$search_name=htmlspecialchars($search_name);
	$search_kana=htmlspecialchars($search_kana);
	$search_status=htmlspecialchars($search_status);
} else {
	//初画面の場合
	$search_name = '';
	$search_kana = '';
	$search_status = '';
}

//ページ先頭データ添字 = (現在のページ - 1) * 一覧表示件数
$iFirstSubscript = ($page - 1) * DISPLAY_COUNT;

//エンジニア一覧情報取得
$get_data = get_engineerList($search_name,$search_kana,$search_status,$iFirstSubscript);

//関数戻り値取得
$iTotalCount=$get_data['iTotalCount'];
$iTotalPage=$get_data['iTotalPage'];
$arrayData=$get_data['arrayData'];

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
 エンジニア情報一覧
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">
<br />
<form method="post" action="engineer_list.php">

<table class="pj_table">
 <tr>
  <td class="find_menu">氏名</td>
  <td><input type="text" name="search_name" style="width:200px"></td>
 </tr>

 <tr>
  <td class="find_menu">氏名（かな）</td>
  <td><input type="text" name="search_kana" style="width:200px"></td>
 </tr>

 <tr>
  <td class="find_menu">ステータス</td>
  <td>
   <select name="search_status">
	<option value=""></option>
	<option value="仮登録">仮登録</option>
	<option value="メール受信">メール受信</option>
	<option value="メール送信済">メール送信済</option>
	<option value="仮登">仮登</option>
   </select>
  </td>
 </tr>
</table>
<br />
<div class="pj_table">
<input type="submit" value="検索">
</div>
<br />
<?php
print '<div class="pj_table">';
print '該当件数：';
print $iTotalCount;
print '</div>';

print '<table class="pj_table">';
print '<tr class="gusu">';
print '<th>会員番号</th>';
print '<th>氏名</th>';
print '<th>メールアドレス</th>';
print '<th>ステータス</th>';
print '</tr>';

//一覧表示件数だけ表示
//初期値カウンター（ページ先頭データ添字）
//条件（カウンター ＜ ページ先頭データ添字＋一覧表示件数）
for( $i=0; $i<count($arrayData); $i++)
{
    if( $i % 2 != 0 ){
		print '<tr class="gusu" id="pj_' . $i .'" onMouseOver="changeBgColor( \'pj_' . $i .'\', \'#CCFFFF\' )" onMouseOut="changeBgColor( \'pj_' . $i .'\', \'#E7E7E7\' )">';
		print '<td>' . $arrayData[$i]['engineer_id'] . '</td>';
		print '<td><a href="engineer_edit.php?engineer_id= '.$arrayData[$i]['engineer_id'].'">'.$arrayData[$i]['engineer_name'].'</a></td>';
		print '<td><a href="engineer_mail.php?engineer_id= '.$arrayData[$i]['engineer_id'].'">'.$arrayData[$i]['engineer_mail_address'].'</a></td>';
		print '<td>' . $arrayData[$i]['engineer_status'] . '</td>';
		print '</tr>';
	}
	else {
		print '<tr class="kisu" id="pj_' . $i .'" onMouseOver="changeBgColor( \'pj_' . $i .'\', \'#CCFFFF\' )" onMouseOut="changeBgColor( \'pj_' . $i .'\', \'#FFFFFF\' )">';
		print '<td>' . $arrayData[$i]['engineer_id'] . '</td>';
		print '<td><a href="engineer_edit.php?engineer_id= '.$arrayData[$i]['engineer_id'].'">'.$arrayData[$i]['engineer_name'].'</a></td>';
		print '<td><a href="engineer_mail.php?engineer_id= '.$arrayData[$i]['engineer_id'].'">'.$arrayData[$i]['engineer_mail_address'].'</a></td>';
		print '<td>' . $arrayData[$i]['engineer_status'] . '</td>';
		print '</tr>';
	}
}

print '</table>';
print '</form>';

?>

<?php //ページング ?>
<?php if ($iTotalPage > 1) : ?>
	<div class="pj_table">

	<?php if ($page > 1) : ?>
		<a href="?page=<?php echo ($page - 1); ?>">prev</a>
	<?php endif; ?>

	<?php for ($i = PAGE_RANGE; $i > 0; $i--) : ?>
		<?php if ($page - $i < 1) continue; ?>
			<a href="?page=<?php echo ($page - $i); ?>"><?php echo ($page - $i); ?></a>
	<?php endfor; ?>

	<span><?php echo $page; ?></span>
	
	<?php for ($i = 1; $i <= PAGE_RANGE; $i++) : ?>
		<?php if ($page + $i > $iTotalPage) break; ?>
			<a href="?page=<?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
	<?php endfor; ?>

	<?php if ($page < $iTotalPage) : ?>
		<a href="?page=<?php echo ($page + 1); ?>">next</a>
	<?php endif; ?>

	</div>
<?php endif; ?>

</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
