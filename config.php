<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$config = [
		"app"       => [
						"app_title"		=> "MIT案件情報メンテナンス",
						"session_key"	=> "mit",
						],
		"database"  => [
						"dsn" 			=> 'mysql:dbname=employment;host=localhost',
						"user"			=> 'root',
						"password"		=> '',
						],
		"mail"       => [
						"mail_from"		=> "k-tamaki@k-mit.jp",
						"mail_subject"	=> "てすとメール",
						],

];
