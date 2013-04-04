<nav id="breadcrumb">
	<ul>
		<li><a href="<?=base_url()?>">首頁</a></li>
		<li>看故事</li>
		<li>愛閱讀</li>
		<li><a href="<?=base_url()?>editor">動手做</a></li>
		<li>粉絲團</li>
		<li>
				
<?php
	if( strlen($url) == 0 )
	{
		echo $username." ";
		echo "<a href='/login/logout'>登出</a>";
	}
	else
	{
		echo "<a href=".$url.">登入</a>";
	}
?>
		</li>
	</ul>
</nav>

