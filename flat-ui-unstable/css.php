<?php 

	$dir=basename(getcwd());
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
?>

<!-- 新 Bootstrap 核心 CSS 文件 -->

<link href="template/<?php echo $OJ_TEMPLATE ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="template/<?php echo $OJ_TEMPLATE ?>/css/flat-ui.css" rel="stylesheet">
<link href="template/<?php echo $OJ_TEMPLATE ?>/css/demo.css" rel="stylesheet">
<?php if(!isset($OJ_FLAT)||!$OJ_FLAT){?>
<!-- 可选的Bootstrap主题文件（一般不用引入） -->

<?php }?>




