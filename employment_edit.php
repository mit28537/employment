<?php
//session_cache_limiter('public');
session_start();
//session_start()の前に「<?php」以外（htmlタグ等）があるとエラーになる。

require_once('common.php');

//セッションチェック
if(isset($_SESSION['login']) == false) {
	die('不正アクセスの疑い');
}

$arrayData = array();
//前画面から案件番号を取得
if ( isset($_GET["project_id"]) ){
 $project_id = (int)$_GET["project_id"];

 //案件詳細情報取得
 $arrayData = get_employmentDetails($project_id);
}

//案件種別取得
$projectKindArray = get_mstProjectKind();

//業種取得
$projectIndustryArray = get_mstProjectIndustry();

//業務取得
$projectPhaseArray = get_mstProjectPhase();

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
	<?php
		if ( isset($_GET["project_id"]) ){
			print '案件情報更新画面';
		}else{
			print '案件情報追加画面';
		}
	?>
</div>

<div class="boxA">

<?php
 // menu表示
 print_menu();
?>

<div class="boxMain">

<div class="page">
 案件情報を入力してください
</div>
<br />
<table class="page">
 <tr>
  <td class="front_print"></td>
  <td>フロントページへ表示される項目</td>
 </tr>
 <tr>
  <td class="back_print"></td>
  <td>メンテナンスページのみに表示される項目</td>
 </tr>
</table>
<br />
<form method="post" action="employment_edit_check.php">

<table class="pj_table">

<?php if(isset($_GET["project_id"])) { ?>
<tr>
 <td id="subject" class="front_end">案件番号</td>
 <td class="pj_value"><?php print $arrayData['project_id']; ?></td>
</tr>
<?php } ?>

<tr>
 <td id="subject" class="front_end">案件名（50文字以内）</td>
 <td class="pj_value"><input type="text" name="project_subject" class="textBox" value="<?php if(isset($_GET['project_id'])) print $arrayData['project_subject']; ?>"></td>
</tr>

<tr>
 <td id="kind" class="front_end">案件種別</td>
 <td class="pj_value">
  <select name="project_kind_id" class="textBox">
	<?php for( $i=0 ;$i < count($projectKindArray) ;$i++){ ?>
		<?php if ( $projectKindArray[$i]['mst_id'] != $arrayData['project_kind_id'] ){ ?>
			<option value="<?php print $projectKindArray[$i]['mst_id']; ?>"><?php print $projectKindArray[$i]['mst_name']; ?></option>
		<?php } else { ?>
			<option value="<?php print $projectKindArray[$i]['mst_id']; ?>" selected="selected"><?php print $projectKindArray[$i]['mst_name']; ?></option>
		<?php } ?>
	<?php } ?>
  </select>
 </td>
</tr>

<tr>
 <td id="industry" class="front_end">業種</td>
 <td class="pj_value">
  <select name="project_industry_id" class="textBox">
	<?php for( $i=0 ;$i < count($projectIndustryArray) ;$i++){ ?>
		<?php if ( $projectIndustryArray[$i]['mst_id'] != $arrayData['project_industry_id'] ){ ?>
			<option value="<?php print $projectIndustryArray[$i]['mst_id']; ?>"><?php print $projectIndustryArray[$i]['mst_name']; ?></option>
		<?php } else { ?>
			<option value="<?php print $projectIndustryArray[$i]['mst_id']; ?>" selected="selected"><?php print $projectIndustryArray[$i]['mst_name']; ?></option>
		<?php } ?>
	<?php } ?>
  </select>
 </td>
</tr>

<tr>
 <td id="phase" class="front_end">業務（フェーズ）</td>
 <td class="pj_value">
  <select name="project_phase_id" class="textBox">
	<?php for( $i=0 ;$i < count($projectPhaseArray) ;$i++){ ?>
		<?php if ( $projectPhaseArray[$i]['mst_id'] != $arrayData['project_phase_id'] ){ ?>
			<option value="<?php print $projectPhaseArray[$i]['mst_id']; ?>"><?php print $projectPhaseArray[$i]['mst_name']; ?></option>
		<?php } else { ?>
			<option value="<?php print $projectPhaseArray[$i]['mst_id']; ?>" selected="selected"><?php print $projectPhaseArray[$i]['mst_name']; ?></option>
		<?php } ?>
	<?php } ?>
  </select>
 </td>
</tr>

<tr>
 <td id="skill" class="front_end">スキル（30文字以内）
 カンマで複数入力（例：Java,PHP,MySQL）</td>
 <td class="pj_value"><input type="text" name="project_skill" class="textBox" value="<?php if(isset($_GET['project_id'])) print $arrayData['project_skill']; ?>"></td>
</tr>

<tr>
 <td id="price" class="front_end">金額（半角数字）</td>
 <td class="pj_value"><input type="text" name="project_price" class="textBox" value="<?php if(isset($_GET['project_id'])) print $arrayData['project_price']; ?>"></td>
</tr>

<tr>
 <td id="location" class="front_end">勤務地（20文字以内）</td>
 <td class="pj_value"><input type="text" name="project_location" class="textBox" value="<?php if(isset($_GET['project_id'])) print $arrayData['project_location']; ?>"></td>
</tr>

<tr>
 <td id="detail" class="front_end">案件内容</td>
 <td class="pj_value"><textarea name="project_detail" class="textBox" rows="15"><?php if(isset($_GET['project_id'])) print $arrayData['project_detail']; ?></textarea></td>
</tr>

<tr>
 <td id="bp" class="pj_item">案件提供会社</td>
 <td class="pj_value"><textarea name="project_business_partner" class="textBox" rows="3"><?php if(isset($_GET['project_id'])) print $arrayData['project_business_partner']; ?></textarea></td>
</tr>

<tr>
 <td id="remarks" class="pj_item">備考</td>
 <td class="pj_value"><textarea name="project_remarks" class="textBox" rows="5"><?php if(isset($_GET['project_id'])) print $arrayData['project_remarks']; ?></textarea></td>
</tr>
</table>
 
 <?php if(isset($_GET["project_id"])) { ?>
  <input type="hidden" name="project_id" value="<?php if(isset($_GET['project_id'])) print $arrayData['project_id']; ?>">
 <?php } ?>
 
 <br />
 
 <div class="pj_table">
 <input type="button" onclick="history.back()" value="戻る">
 <input type="submit" value="ＯＫ">
 </div>
</form>
</div>

</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
