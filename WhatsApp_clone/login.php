<?php
session_start();
require_once("classes/User.php");
$login = new User();

if($login->is_loggedin()!="")
{
    $login->redirect('home.php');
}

if(isset($_POST['login_btn']))
{
    $useremail = strip_tags($_POST['user-email']);
    $userPass = strip_tags($_POST['user-password']);
        
    if($login->doLogin($useremail,$userPass))
    {
        $login->redirect('home.php');
    }
    else
    {
        $error = "Email or Password is wrong please try again!";
    }   
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dorochat</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

<script type="text/javascript" src="http://ff.kis.scr.kaspersky-labs.com/1B74BD89-2A22-4B93-B451-1C9E1052A0EC/main.js" charset="UTF-8"></script>
<link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">

</head>
<body> 

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.html">Dorochat V1</a>
        </div>
        <div class="collapse navbar-collapse">       
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="register.php">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="img/1.jpg">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form method="post" action="">
                            
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <div class="header text-center"><img src="img/ChatLove.png" style="width: 60px; height: 60px;"></div>
                                 <div class="text-center">Login</div>

  <div id="error">
        <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                         <i class="pe-7s-attention"></i> &nbsp; <?php echo $error; ?>
                     </div>
                <?php
            }
        ?>
        </div>

                                <div class="content">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" placeholder="Enter email" name="user-email" value="<?php if(isset($error)){echo $useremail;}?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" placeholder="Password"  name="user-password" class="form-control">
                                    </div>                                    
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" name="login_btn" class="btn btn-fill btn-warning btn-wd">Login</button>
                                </div>
                            </div>
                                
                        </form>
                        
 <p style="color:#fff; font-size:11px;">Please Use the following credentials to try our Demo:
 Username/Password<br/>
 
 1.rilly@gmail.com->123456@rilly <br/>
 2.smith@gmail.com->123456Johnunc
 <br/>
 
 Remeber you have to wait till both browser windows are fully loaded. and status "Online Now will be displayed immediately" Enjoy</P>
                                
                    </div>                    
                </div>
            </div>
        </div>
    	
    	<footer class="footer footer-transparent">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>

                        <li><a href="register.php">
                        Register
                    </a></li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2016 <a href="http://www.dorocode.com">Dorocode</a>, made with love for a better communication 
                </p>
            </div>
        </footer>

    </div>                             
       
</div>

</body>
    
    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script> 
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	
 <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
	    
    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();
            
            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>

    
</html>