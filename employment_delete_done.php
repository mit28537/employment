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

$project_id = '';

if ( isset($_POST['project_id'] )) {
	$project_id = $_POST['project_id'];
}
if (isset($_POST['delete_exec']))
{
	$delete_flg = 1;
}
else{
	$delete_flg = 0;
}

$dbh = get_dbh();

$sql = "UPDATE t_project SET 
						delete_flg=$delete_flg,
						t_project_update_date=cast(now() as datetime)
						WHERE t_project_id in (";

for($i=0; $i < count($project_id); $i++){
	$sql .= '?,';
}
$sql = rtrim($sql, ',');
$sql .= ')';

$stmt = $dbh->prepare($sql);
$stmt->execute($project_id);
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
