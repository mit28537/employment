<?php
require_once('config.php');

$_SESSION = array();

if(isset($_COOKIE[session_name()]) == true) {
	setcookie(session_name(),'',time()-4200,'/');
}

@session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php print $config['app']['app_title']; ?></title>
</head>
<body>

ログオフしました。<br />
<br />

<a href="employment_login.php"> ログイン画面へ </a>

</form>
</body>
</html>
