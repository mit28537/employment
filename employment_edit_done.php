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
 案件情報&nbsp;更新完了
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

try
{

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

$dbh = get_dbh();

if ( isset($_POST['project_id'] )){
	$sql = 'UPDATE t_project SET 
							t_project_subject=?,
							t_project_kind_id=?,
							t_project_industry_id=?,
							t_project_phase_id=?,
							t_project_skill=?,
							t_project_price=?,
							t_project_location=?,
							t_project_business_partner=?,
							t_project_detail=?,
							t_project_remarks=?,
							t_project_update_date=cast(now() as datetime)
							WHERE t_project_id=?';
} else {
	$sql = 'INSERT INTO t_project(
							t_project_subject,
							t_project_kind_id,
							t_project_industry_id,
							t_project_phase_id,
							t_project_skill,
							t_project_price,
							t_project_location,
							t_project_business_partner,
							t_project_detail,
							t_project_remarks,
							t_project_update_date,
							delete_flg)
						VALUES (
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							cast(now() as datetime),
							false)';
}

$stmt = $dbh->prepare($sql);

$data[] = $project_subject;
$data[] = $project_kind_id;
$data[] = $project_industry_id;
$data[] = $project_phase_id;
$data[] = $project_skill;
$data[] = $project_price;
$data[] = $project_location;
$data[] = $project_business_partner;
$data[] = $project_detail;
$data[] = $project_remarks;

if ( isset($_POST['project_id'] )){
	$data[] = $project_id;
}

$stmt->execute($data);
$dbh = null;

print '案件情報を更新しました。';

}
catch (Exception $e)
{
	print 'DBエラー</br></br>';
	exit();
}

?>

</div>
</div>
</div>

<div class="box4"></div>
<div class="box5"></div>

</body>
</html>
