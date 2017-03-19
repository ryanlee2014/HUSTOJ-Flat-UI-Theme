<?php 

	$dir=basename(getcwd());
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
?>

<!-- 新 Bootstrap 核心 CSS 文件 -->

<link href="//<?php echo $_SERVER['HTTP_HOST'] ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="//<?php echo $_SERVER['HTTP_HOST'] ?>/css/flat-ui.css" rel="stylesheet">
<link href="//<?php echo $_SERVER['HTTP_HOST'] ?>/css/demo.css" rel="stylesheet">
<?php if(!isset($OJ_FLAT)||!$OJ_FLAT){?>
<!-- 可选的Bootstrap主题文件（一般不用引入） -->

<?php }?>




