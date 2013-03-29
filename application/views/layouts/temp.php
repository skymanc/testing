<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<title><?PHP echo $template['title']; ?></title>

<meta name="robots" content="INDEX,FOLLOW">
<meta name="keywords" content="1組,2組,3組,4組,5組" />
<meta name="description" content="100個字以內" />
<meta name="viewport" content="width=device-width, initial-scale=1">


<?PHP echo $template['metadata']; ?>
</head>

<body>
	<div id="wrap">
		<div id="header">
			<?php echo $template['partials']['header'] ?>
		</div>
		<div class="container" id="container">
	            <?PHP echo $template['body']; ?>
	    </div>
	    <div id="footer">
	    	這是我家開的網站，真的超級好玩的，請大家都快來唷!!
	    </div>
	</div>
</body>
</html>
