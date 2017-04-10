<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	
<?php
if ($pr_flag){
echo "<title>$MSG_PROBLEM $row->problem_id. -- $row->title</title>";
echo "<center><h2>$id: $row->title</h2>";
}else{
$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$id=$row->problem_id;
echo "<title>$MSG_PROBLEM $PID[$pid]: $row->title </title>";
echo "<center><h2>$MSG_PROBLEM $PID[$pid]: $row->title</h2>";
}
echo "<span class=green>$MSG_Time_Limit: </span>$row->time_limit 秒&nbsp;&nbsp;";
echo "<span class=green>$MSG_Memory_Limit: </span>".$row->memory_limit." MB";
if ($row->spj) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
echo "<br><span class=green>$MSG_SUBMIT: </span>".$row->submit."&nbsp;&nbsp;";
echo "<span class=green>$MSG_SOVLED: </span>".$row->accepted."<br>";
if ($pr_flag){
echo "<a href='submitpage.php?id=$id' class='btn btn-lg btn-primary'>$MSG_SUBMIT</a>&nbsp;";
}else{
echo "<a class='btn btn-lg btn-primary' href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>&nbsp;";
}
echo "<a href='problemstatus.php?id=".$row->problem_id."' class='btn btn-lg btn-primary'>$MSG_STATUS</a>&nbsp;";
//echo "<a class='btn btn-lg btn-default' href='bbs.php?pid=".$row->problem_id."$ucid'>$MSG_BBS</a>&nbsp;";
if(isset($_SESSION['administrator'])){
require_once("include/set_get_key.php");
?>
<a class='btn btn-lg btn-primary' href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >Edit</a>
<a class='btn btn-lg btn-primary' href="admin/quixplorer/index.php?action=list&dir=<?php echo $row->problem_id?>&order=name&srt=yes" >TestData</a>
<?php
}
echo "</center>";
echo "<h4>$MSG_Description</h4><div class=content>".$row->description."</div>";
echo "<h4>$MSG_Input</h4><div class=content>".$row->input."</div>";
echo "<h4>$MSG_Output</h4><div class=content>".$row->output."</div>";
$sinput=str_replace("<","&lt;",$row->sample_input);
$sinput=str_replace(">","&gt;",$sinput);
$soutput=str_replace("<","&lt;",$row->sample_output);
$soutput=str_replace(">","&gt;",$soutput);
if(strlen($sinput)) {
echo "<h4>$MSG_Sample_Input</h4>
<pre class=content><span class=sampledata>".($sinput)."</span></pre>";
}
if(strlen($soutput)){
echo "<h4>$MSG_Sample_Output</h4>
<pre class=content><span class=sampledata>".($soutput)."</span></pre>";
}
if ($pr_flag||true)
echo "<h4>$MSG_HINT</h4>
<div class=content><p>".nl2br($row->hint)."</p></div>";
if ($pr_flag)
echo "<h4>$MSG_Source</h4>
<div class=content><p><a href='problemset.php?search=$row->source'>".nl2br($row->source)."</a></p></div>";
echo "<center>";
if ($pr_flag){
echo "<a class='btn btn-lg btn-primary' href='submitpage.php?id=$id'>$MSG_SUBMIT</a>";
}else{
echo "<a class='btn btn-lg btn-primary' href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>";
}
echo "&nbsp;";
echo "<a class='btn btn-lg btn-primary' href='problemstatus.php?id=".$row->problem_id."'>$MSG_STATUS</a>&nbsp;";
//echo "[<a href='bbs.php?pid=".$row->problem_id."$ucid'>$MSG_BBS</a>]";
if(isset($_SESSION['administrator'])){
require_once("include/set_get_key.php");
?>
<a class='btn btn-lg btn-primary' href="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >Edit</a>
<a class='btn btn-lg btn-primary' href="admin/quixplorer/index.php?action=list&dir=<?php echo $row->problem_id?>&order=name&srt=yes" >TestData</a>
<?php
}
echo "</center>";
?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
