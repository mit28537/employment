<?php
require_once('config.php');
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
案件情報更新チェック画面
</div>

<div class="boxA">

<?php
 require_once('common.php');
 
 // menu表示
 print_menu();
?>

<div class="boxMain">

<?php

//前画面からの入力データを受け取る
if ( isset($_POST['project_id'] )){
  $project_id=$_POST['project_id'];
  $project_id=htmlspecialchars($project_id);
}
$project_subject=$_POST['project_subject'];
$project_skill=$_POST['project_skill'];
$project_price=$_POST['project_price'];
$project_location=$_POST['project_location'];
$project_business_partner=$_POST['project_business_partner'];
$project_detail=$_POST['project_detail'];
$project_remarks=$_POST['project_remarks'];
$project_kind_id=$_POST['project_kind_id'];
$project_industry_id=$_POST['project_industry_id'];
$project_phase_id=$_POST['project_phase_id'];

//サニタイジング
$project_subject=htmlspecialchars($project_subject);
$project_skill=htmlspecialchars($project_skill);
$project_price=htmlspecialchars($project_price);
$project_location=htmlspecialchars($project_location);
$project_business_partner=htmlspecialchars($project_business_partner);
$project_detail=htmlspecialchars($project_detail);
$project_remarks=htmlspecialchars($project_remarks);
$project_kind_id=htmlspecialchars($project_kind_id);
$project_industry_id=htmlspecialchars($project_industry_id);
$project_phase_id=htmlspecialchars($project_phase_id);

//案件種別取得
$projectKindDetail = get_mstProjectKindDetails($project_kind_id);

//業種取得
$projectIndustryDetail = get_mstProjectIndustryDetails($project_industry_id);

//業務取得
$projectPhaseDetail = get_mstProjectPhaseDetails($project_phase_id);

//チェックフラグ
$check_flg=true;

//エラーメッセージ
$message = '';

//未入力チェック（案件名）
if($project_subject=='')
{
	$message .= '案件名が入力されていません。<br />';
	$check_flg=false;
}

//文字数チェック（案件名）
if(mb_strlen($project_subject) > 50)
{
	$message .= '案件名が５０文字を超えています。<br />';
	$check_flg=false;
}

//文字数チェック（スキル）
if(mb_strlen($project_skill) > 30)
{
	$message .= 'スキルが３０文字を超えています。<br />';
	$check_flg=false;
}

//半角数字チェック（金額）
//if(mb_strlen($project_price) > 0){
//	if(!preg_match('/^[0-9]+$/',$project_price))
//	{
//		$message .= '金額が半角数字ではありません。<br />';
//		$check_flg=false;
//	}
//}

//文字数チェック（勤務地）
if(mb_strlen($project_location) > 20)
{
	$message .= '勤務地が２０文字を超えています。<br />';
	$check_flg=false;
}

if($check_flg==true)
{
//全てのチェックがOKの場合

	print '<div class="page">';
	print '下記の内容で更新します';
	print '</div>';
	print '<br />';

	print '<table class="pj_table">';
	print ' <tr>';
	print '  <td class="front_print"></td>';
	print '  <td>フロントページへ表示される項目</td>';
	print ' </tr>';
	print ' <tr>';
	print '  <td class="back_print"></td>';
	print '  <td>メンテナンスページのみに表示される項目</td>';
	print ' </tr>';
	print '</table>';
	print '<br />';

	print '<table class="pj_table">';

	print '<tr>';
	print '<td class="front_end">案件名：</td>';
	print '<td class="inputCheck">'.$project_subject.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">案件種別</td>';
	print '<td class="inputCheck">'.$projectKindDetail['mst_name'].'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">業種</td>';
	print '<td class="inputCheck">'.$projectIndustryDetail['mst_name'].'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">業務（フェーズ）</td>';
	print '<td class="inputCheck">'.$projectPhaseDetail['mst_name'].'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">スキル</td>';
	print '<td class="inputCheck">'.$project_skill.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">金額</td>';
	print '<td class="inputCheck">'.$project_price.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">勤務地</td>';
	print '<td class="inputCheck">'.$project_location.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="front_end">案件内容</td>';
	print '<td class="inputCheck">'.$project_detail.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">案件提供会社</td>';
	print '<td class="inputCheck">'.$project_business_partner.'</td>';
	print '</tr>';

	print '<tr>';
	print '<td class="pj_item">備考</td>';
	print '<td class="inputCheck">'.$project_remarks.'</td>';
	print '</tr>';

	print '</table>';
	print '<br />';

	//更新処理
	print '<form method="post" action="employment_edit_done.php">';

	//隠し領域設定
	if ( isset($_POST['project_id'] )){
		print '<input type="hidden" name="project_id" value="'.$project_id.'">';
	}
	print '<input type="hidden" name="project_subject" value="'.$project_subject.'">';
	print '<input type="hidden" name="project_kind_id" value="'.$project_kind_id.'">';
	print '<input type="hidden" name="project_industry_id" value="'.$project_industry_id.'">';
	print '<input type="hidden" name="project_phase_id" value="'.$project_phase_id.'">';
	print '<input type="hidden" name="project_skill" value="'.$project_skill.'">';
	print '<input type="hidden" name="project_price" value="'.$project_price.'">';
	print '<input type="hidden" name="project_location" value="'.$project_location.'">';
	print '<input type="hidden" name="project_business_partner" value="'.$project_business_partner.'">';
	print '<input type="hidden" name="project_detail" value="'.$project_detail.'">';
	print '<input type="hidden" name="project_remarks" value="'.$project_remarks.'">';

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

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
