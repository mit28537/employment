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
 エンジニア情報&nbsp;更新完了
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

$result = '';

//エンジニア情報更新
$result = update_engineerData();

if($result) {
	print '会員情報を更新しました。';
} else {
	print '会員情報の更新に失敗しました。';
}

?>

</div>
</div>
</div>
</body>
</html>
