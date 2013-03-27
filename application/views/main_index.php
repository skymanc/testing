<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<title>首頁測試</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
	<?php
	if( strlen($url) == 0 )
	{
		echo $username."<br/>";
		echo $fbid."<br/>";
		echo "<a href='/login/logout'>log out</a>";
	}
	else
	{
		echo "<a href=".$url.">log in</a>";
	}
?>
</body>
</html>

