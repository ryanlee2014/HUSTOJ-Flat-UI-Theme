<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
<script src="template/<?php echo $OJ_TEMPLATE ?>/js/jquery.min.js"></script>
<script src="template/<?php echo $OJ_TEMPLATE ?>/js/flat-ui.min.js"></script>
<script src="template/<?php echo $OJ_TEMPLATE ?>/js/json2.js"></script>
<script src="template/<?php echo $OJ_TEMPLATE ?>/js/jquery.color.js"></script>
      <script src="template/<?php echo $OJ_TEMPLATE ?>/js/base64.js"></script>
<script>
function check() {
    let a = document.getElementById("user_id").value;
    let b = document.getElementById("password").value;
    let asypost;
    let arr = [];
    let response;
    //arr["user_id"] = a;
    arr.user_id=a;
    arr.password=b;
    //arr["password"] = b;
    let jsonstring = "{\"user_id\":\"" + a + "\",\"password\":\"" + b + "\"}";
    // alert(jsonstring);
    //console.log(jsonstring);
    if (window.XMLHttpRequest) {
        asypost = new XMLHttpRequest();
    } else {
        asypost = new ActiveXObject("Microsoft.XMLHTTP");
    }
    asypost.onreadystatechange = function() {
        if (asypost.readyState == 4 && asypost.status == 200) {
            response = asypost.responseText;
            console.log(response);
            if (response == "true") {
                document.getElementById('user_id_control').className = "form-group has-success";
                document.getElementById('password_control').className = "form-group has-success";
                document.getElementById('login-button').className = "btn btn-success btn-lg btn-block";
                document.getElementById('login-button').innerHTML = "登陆成功";
                document.getElementById('imgicon').src = "template/<?php echo $OJ_TEMPLATE?>/img/login/Clipboard.png";
                document.getElementById('imgicon').style.display = "none";
                $("#imgicon").fadeIn();
                jQuery("#login-screen-control").animate({
                    backgroundColor: "#1abc9c"
                }, 500);
                // $("#login-screen-control").animate({ backgroundColor: "#2C3E50" }, 'fast');
                //document.getElementById('login-screen-control').style.backgroundColor="#2C3E50";
                //$("#imgicon").fadeOut();
                //$("#imgsuicon").fadeIn();
                let timetick = setTimeout(function() {
                    location.href = "<?php echo $OJ_HOME?>";
                }, 700);
                // location.href="http://<?php// echo $_SERVER['HTTP_HOST'] ?>";

            } else {
                document.getElementById('user_id_control').className = "form-group has-error";
                document.getElementById('password_control').className = "form-group has-error";
                document.getElementById('login-button').className = "btn btn-danger btn-lg btn-block";
                document.getElementById('login-button').innerHTML = "账号密码错误！重新登录";
            }
        }
    };
    asypost.open("POST", "template/<?php echo $OJ_TEMPLATE ?>/login.php", true);
    asypost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    asypost.send("msg=" + Base64.encode(jsonstring));
}

function enterpress(e) {
    if (e.keyCode == 13) {
        check();
    }
}

function posttext() {
    let response;
    let xmlhttp;
    let user_id = document.getElementById('user_id').value;
    if (user_id.length == 0) {
        alert("请输入账号");
        return;
    }
    if (document.getElementById('question').style.visibility == "hidden") {
        
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                response = xmlhttp.responseText;
                let question = document.getElementById('question');
                question.style.visibility = "visible";
                if (response != "false") {
                    response = "找回问题:" + response;
                    document.getElementById('confirmanswer').style.visibility = "visible";
                    $("#confirmanswer").fadeIn();
                    question.style.visibility = "visible";
                    $("#question").fadeIn();
                    $("#confirm_control").fadeIn();
                    question.innerText = response;
                    document.getElementById('user_id').disabled = true;
                } else {
                    question.innerHTML = "您的账号不存在或者是没有设置找回问题。<br>如有疑问请联系<a href='mailto:gxlhybh@gmail.com'>管理员</a>";
                    $("#question").fadeIn(300);
                    return;
                }
            }
        };
        xmlhttp.open("POST", "resetdefault.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user_id=" + user_id);
    } else {
        let answer = document.getElementById('confirmanswer').value;
        if (answer.length != 0) {
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    response = xmlhttp.responseText;
                    if (response != "false") {
                        alert('成功！\n你的密码已恢复为默认设置:12345678\n请及时到账号页面修改你的账号密码!');
                        location.href = "http://" + location.hostname;
                    } else {
                        alert("答案不正确!");
                        return;
                    }
                }
            };
            xmlhttp.open("POST", "resetdefault.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user_id=" + user_id + "&confirmanswer=" + answer);
        } else {
            alert("找回密码答案不能为空!");
            return;
        }
    }
}

function find() {
    $("#lost").fadeOut(300);
    $("#password_control").fadeOut(300);
    $("#imgicon").fadeOut(300, function() {
        document.getElementById('imgicon').src = "template/<?php echo $OJ_TEMPLATE?>/img/login/Map.png";
        $("#imgicon").fadeIn(300);
    });
    $("#login-button").fadeOut(300, function() {
        $("#lostcontrol").fadeIn(300);
        $("#plaintext").fadeIn(300);
    });
    $("#password_control").type = "text";
}
</script>
    <title>Login CUP Online Judge</title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <style>
        
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container" style="z-index:-1">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div id="main-content">
<form id="login-f" action="login.php" method="post" role="form" class="form-horizontal">
 <div class="login" style="position: relative;">
        <div class="login-screen" id="login-screen-control">
          <div class="login-icon">
            <img src="template/<?php echo $OJ_TEMPLATE?>/img/login/icon.png" alt="Welcome to CUPOJ" id="imgicon" />
            <img src="template/<?php echo $OJ_TEMPLATE?>/img/login/Clipboard.png" alt="Look for your account" id="lookicon" style="display:none"/>
          <!--  <img src="template/<?php echo $OJ_TEMPLATE?>/img/login/Retina-Ready.png" alt="success" id="imgsuicon" style="visibility:hidden" />-->
            <h4>Welcome to <p>CUP Online Judge</p></h4>
          </div>

          <div class="login-form">
              <p id="plaintext" class="login-field" style="margin-left:-0.1em;width:97%;display:none;color:black">找回您的账号</p>
            <div class="form-group" id="user_id_control">
              <input type="text" class="form-control login-field" value="" placeholder="输入账号(通常为学号)" name="user_id" id="user_id" style="margin-left:0.4em;width:97%"/>
              <label class="login-field-icon fui-user" for="login-name"></label>
            </div>
<p id="question" class="login-field" style="margin-left:0em;width:97%;visibility:hidden;display:none;color:black"></p>
<div class="form-group" id="confirm_control" style="display:none">
<input type="text" class="form-control login-field" size="4" value="" placeholder="输入你的找回密码答案" name="user_id" id="confirmanswer" style="margin-left:0.4em;width:97%;visibility:hidden;display:none"/>
<label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <div class="form-group" id="password_control">
              <input type="password" class="form-control login-field" value="" placeholder="密码" name="password" id="password" onkeypress="return enterpress(event)" style="margin-left:0.4em;width:97%"/>
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <a class="btn btn-info btn-lg btn-block" href="javascript:void(0)" onclick="check()" id="login-button">登录</a><div id="lostcontrol" style="display:none">
            <a class="btn btn-info btn-lg" onclick="posttext()"  style="margin:auto;text-align:center">提交</a>&nbsp;<a class="btn btn-info btn-lg" name="reset" onclick="location.reload();"  style="margin:auto;text-align:center">重置</a></div>
            <a class="login-link" href="lostpassword.php"  id="lost">找回密码</a>
          </div>
        </div>
      </div>
      </form>	
<!--<form action="login.php" method="post" role="form" class="form-horizontal">
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php //echo $MSG_USER_ID?></label><div class="col-sm-8"><input name="user_id" class="form-control" placeholder="<?php //echo $MSG_USER_ID?>" type="text"></div>						</div>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php //echo $MSG_PASSWORD?></label><div class="col-sm-8"><input name="password" class="form-control" placeholder="<?php //echo $MSG_PASSWORD?>" type="password"></div>						</div>
<?php// if($OJ_VCODE){?>

	<div class="form-group">
	<label class="col-sm-4 control-label"><?php// echo $MSG_VCODE?></label><div class="col-sm-4"><input name="vcode" class="form-control" type="text"></div><div class="col-sm-4"><img alt="click to change" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()" height="30px">*</div>						</div>
<?php //}?>
	<div class="form-group">
	<div class="col-sm-offset-4 col-sm-4">
	<button name="submit" type="submit" class="btn btn-default btn-block"><?php //echo $MSG_LOGIN; ?></button>
	</div>
	<div class="col-sm-4">
	<a class="btn btn-default btn-block" href="lostpassword.php"><?php //echo $MSG_LOST_PASSWORD; ?></a>
	</div>
	</div>
</form>		-->			
      </div>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php //include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
