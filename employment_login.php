<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php print $config['app']['app_title']; ?></title>
</head>
<body>

ログイン画面<br />
<br />

<form method="post" action="employment_login_check.php">

ユーザーIDを入力してください。<br />
<input type="text" name="user_id" style="width:200px"><br />
<br />

パスワードを入力してください。<br />
<input type="password" name="user_pass" style="width:200px"><br />
<br />

<br />
<input type="submit" value="ログイン">
</form>

</body>
</html>

