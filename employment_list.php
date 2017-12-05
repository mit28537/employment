<?php
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。
require_once('config.php');
require_once('common.php');

const DISPLAY_COUNT = 15;		//一覧表示件数
const PAGE_RANGE = 15;			//ページング幅

if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

if (
	isset($_GET["page"]) &&
	$_GET["page"] > 0 )
{
	//URLパラメータにpageが存在する場合
	//pageが1以上で全ページを超えていない場合
	//悪意ある値を受け付けないようにキャストする
	$page = (int)$_GET["page"];
} else {
	//上記条件以外はpageに1を設定
	$page = 1;
}

$search_id = '';
$search_kind = '';
$search_industry = '';
$search_phase = '';
$search_detail = '';

if (isset($_POST['search']))
{
	//検索ボタン押下
	//前画面からの入力データを受け取る
	if ( isset($_POST['search_id'] )) { 		$search_id = $_POST['search_id']; }
	if ( isset($_POST['search_kind'] )) { 		$search_kind = implode(",", $_POST['search_kind']); }
	if ( isset($_POST['search_industry'] )) {	$search_industry = implode(",", $_POST['search_industry']); }
	if ( isset($_POST['search_phase'] )) {		$search_phase = implode(",", $_POST['search_phase']); }
	if ( isset($_POST['search_detail'] )) {		$search_detail = $_POST['search_detail']; }
	
	//サニタイジング
	$search_id=htmlspecialchars($search_id);
	$search_kind=htmlspecialchars($search_kind);
	$search_industry=htmlspecialchars($search_industry);
	$search_phase=htmlspecialchars($search_phase);
	$search_detail=htmlspecialchars($search_detail);
}

//ページ先頭データ添字 = (現在のページ - 1) * 一覧表示件数
$iFirstSubscript = ($page - 1) * DISPLAY_COUNT;

//案件一覧取得
$get_data = get_employmentList($search_id,$search_kind,$search_industry,$search_phase,$search_detail,$iFirstSubscript);

//案件種別取得
$projectKindArray = get_mstProjectKind();

//業種取得
$projectIndustryArray = get_mstProjectIndustry();

//業務取得
$projectPhaseArray = get_mstProjectPhase();

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
 案件情報一覧
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">
<br />
<form method="post" action="employment_list.php">
<table class="pj_table">
 <tr>
  <td class="find_menu">案件番号</td>
  <td><input type="text" name="search_id" style="width:200px"></td>
 </tr>
 
 <tr>
  <td class="find_menu">案件種別</td>
  <td>
   <?php
    for ( $i=0 ; $i < count($projectKindArray) ; $i++){
    	print '<input type="checkbox" name="search_kind[]" value="'.$projectKindArray[$i]['mst_id'].'">'.$projectKindArray[$i]['mst_name'];
    }
   ?>
  </td>
 </tr>
 
 <tr>
  <td class="find_menu">業種</td>
  <td>
   <?php
    for ( $i=0 ; $i < count($projectIndustryArray) ; $i++){
    	print '<input type="checkbox" name="search_industry[]" value="'.$projectIndustryArray[$i]['mst_id'].'">'.$projectIndustryArray[$i]['mst_name'];
    }
   ?>
  </td>
 </tr>
 
 <tr>
  <td class="find_menu">業務</td>
  <td>
   <?php
    for ( $i=0 ; $i < count($projectPhaseArray) ; $i++){
    	print '<input type="checkbox" name="search_phase[]" value="'.$projectPhaseArray[$i]['mst_id'].'">'.$projectPhaseArray[$i]['mst_name'];
    }
   ?>
  </td>
 </tr>
 
 <tr>
  <td class="find_menu">案件内容</td>
  <td><input type="text" name="search_detail" style="width:200px"></td>
 </tr>
</table>
<br />
<div class="pj_table">
 <input type="submit" name="search" value="検索">
</div>
</form>

<?php
print '<div class="pj_total">案件数'.$iTotalCount.'件</div>';

print '<form method="post" action="employment_delete_done.php">';

print '<table class="pj_table">';
print '<tr>';
print '<th class="pj_id">案件番号</th>';
print '<th class="pj_name">案件名</th>';
print '<th class="pj_delete">更新</th>';
print '</tr>';

//０件
if( $iTotalCount == 0 ){
	print '<tr><td colspan="3" style="text-align: center;"><br />該当する案件が見つかりません<br /></td></tr>';
}
else{
//一覧表示件数だけ表示
//初期値カウンター（ページ先頭データ添字）
//条件（カウンター ＜ ページ先頭データ添字 ＋ 一覧表示件数）
for( $i=0 ; $i< count($arrayData) ; $i++)
{

	if ( $arrayData[$i]['delete_flg'] != 0 ){
    	print '<tr style="background-color: #585858; color: #FFFFFF;">';
    	print '<td>' . $arrayData[$i]['project_id'] . '</td>';
    	print '<td>'.$arrayData[$i]['project_subject'].'</td>';
    	print '<td><div align="center"><input type="checkbox" name="project_id[]" value="'.$arrayData[$i]['project_id'].'"></div></td>';
		print '</tr>';
    }else{
    	if( $i % 2 != 0 ){
    		print '<tr class="gusu" id="pj_' . $i .'" onMouseOver="changeBgColor( \'pj_' . $i .'\', \'#CCFFFF\' )" onMouseOut="changeBgColor( \'pj_' . $i .'\', \'#E7E7E7\' )">';
			print '<td>' . $arrayData[$i]['project_id'] . '</td>';
			print '<td><a href="employment_edit.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a></td>';
			print '<td><div align="center"><input type="checkbox" name="project_id[]" value="'.$arrayData[$i]['project_id'].'"></div></td>';
			print '</tr>';
		}
		else {
			print '<tr class="kisu" id="pj_' . $i .'" onMouseOver="changeBgColor( \'pj_' . $i .'\', \'#CCFFFF\' )" onMouseOut="changeBgColor( \'pj_' . $i .'\', \'#FFFFFF\' )">';
			print '<td>' . $arrayData[$i]['project_id'] . '</td>';
			print '<td><a href="employment_edit.php?project_id= '.$arrayData[$i]['project_id'].'">'.$arrayData[$i]['project_subject'].'</a></td>';
			print '<td><div align="center"><input type="checkbox" name="project_id[]" value="'.$arrayData[$i]['project_id'].'"></div></td>';
			print '</tr>';
		}
	}
}

?>

<tr>
 <td></td>
 <td></td>
 <td>
  <div align="center">
   <input type="submit" name="delete_exec" value="削除">
   <input type="submit" name="alive_exec" value="登録">
  </div>
 </td>
</tr>

<?php
}
?>
</table>
</form>

<?php //ページング ?>
<?php if ($iTotalPage > 1) : ?>
 <div class="page">
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
