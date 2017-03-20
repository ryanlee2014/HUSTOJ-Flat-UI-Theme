<?php 
    require_once("../../include/db_info.inc.php");
    $vcode="";
    $json_msg=$_POST['msg'];
	$json_msg=base64_decode($json_msg);
    $decode_json=json_decode($json_msg,true);
    if(isset($_POST['vcode']))	$vcode=trim($_POST['vcode']);
    if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
		echo "<script language='javascript'>\n";
		echo "alert('Verify Code Wrong!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
    }
	require_once("login-".$OJ_LOGIN_MOD.".php");
	
    //$user_id=$_POST['user_id'];
    $user_id=$decode_json['user_id'];
    $password=$decode_json['password'];
	//$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }
    $sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`='".mysqli_real_escape_string($mysqli,$user_id)."'";
    	$login=check_login($user_id,$password);
	
	if ($login)
    {
		$_SESSION['user_id']=$login;
		$result=mysqli_query($mysqli,$sql);

		while ($result&&$row=mysqli_fetch_assoc($result))
			$_SESSION[$row['rightstr']]=true;
			if(isset($_POST['msg']))
			{
			    echo "true";
			}
		else{
		echo "<script language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		}
	}else{
	    if(isset($_POST['msg']))
	    {
	        echo "false";
	    }
	    else{
		echo "<script language='javascript'>\n";
		echo "alert('UserName or Password Wrong!');\n";
		echo "alert('UserName:".$user_id.",Password:".$password."');\n";
		echo "history.go(-1);\n";
		echo "</script>";
	    }
	}
?>
