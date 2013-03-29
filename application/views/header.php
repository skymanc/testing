<nav id="breadcrumb">
	<ul>
		<li>首頁</li>
		<li>熱門點閱</li>
		<li>達人分享</li>
		<li>立馬創作</li>
		<li>文字故事</li>
		<li>著色區 </li>
		<li>登入</li>
				
<?php
	if( strlen($url) == 0 )
	{
		echo $username." ";
		echo "<a href='/login/logout'>log out</a>";
	}
	else
	{
		echo "<a href=".$url.">log in</a>";
	}
?>
	</ul>
</nav>

