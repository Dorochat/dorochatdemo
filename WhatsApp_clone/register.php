<?php

session_start();

require_once('classes/User.php');

$user = new User();

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['signUp']))
{
    $fname = strip_tags($_POST['fname']);
    $lname = strip_tags($_POST['lname']);
    $umail = strip_tags($_POST['email']);
    $upass = strip_tags($_POST['password']);  
    $pass_repeat= strip_tags($_POST['pass-repeat']);  
    
    if($fname=="")  {
        $error[] = "provide your firstname !";    
    }
    else if($lname=="") {
        $error[] = "provide your last name!";    
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
    }
    else if($upass=="") {
        $error[] = "provide password !";
    }
    else if(strlen($upass) < 6){
        $error[] = "Password must be atleast 6 characters"; 
    }
    else if($upass!==$pass_repeat){
$error[] = "Password doesn't match !"; 

    }
    else
    {
        try
        {
            $stmt = $user->runQuery("SELECT firstname,email FROM users WHERE firstname=:fname OR  email=:email");
            $stmt->execute(array(':fname'=>$fname, ':email'=>$umail));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
            if($row['firstname']==$fname) {
                $error[] = "Sorry try with another Firstname, this one is  already taken !";
            }
            else if($row['email']==$umail) {
                $error[] = "Sorry email id already taken !";
            }
            else
            {
                $time=date('Y/m/d H:i:s');
                if($user->register($fname,$lname,$umail,$upass,$time)){  
                    $user->redirect('home.php?Newjoined');
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
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
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="login.php">
                        Looking to login?
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" data-color="orange" data-image="../assets/img/full-screen-image-2.jpg">

    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="header-text">
                            <h2>Dorochat V1</h2>
                            <h4>Register for free and experience fast chatting service today</h4>

                             <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                     ?>
                     <div class="alert alert-danger">
                         <i class="pe-7s-attention"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
                }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">

                      <i class="pe-7s-check green"></i></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>


                            <hr />
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <div class="media">
                            <div class="media-left">
                                <div class="icon">
                                    <i class="pe-7s-user"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h4>Free Account</h4>
                                Unlimited account,
                                Unlimited Messages,
                                Amazing smileys & emitocons,
                                Upload pictures,
                                Sound Notification for new message,
                                Seen Notification and More
                            </div>
                        </div>

                        <div class="media">
                            <div class="media-left">
                                <div class="icon">
                                    <i class="pe-7s-graph1"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h4>Awesome Performances</h4>
                               Realtime instant messages, High speed deliver to connected clients,
                               supports over thousands of connections, simultanous messages in a sec,
                               easy to use, easy to integrate in existing website.

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 col-md-offset-s1">
                        <form method="post" action="">
                            <div class="card card-plain">
                                <div class="content">
                                    <div class="form-group">
                                        <input type="text" name="fname" placeholder="Your First Name"  value="<?php if(isset($error)){echo $fname;}?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lname" placeholder="Your Last Name" value="<?php if(isset($error)){echo $lname;}?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="email"  name="email" placeholder="Enter email"  value="<?php if(isset($error)){echo  $umail;}?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass-repeat" placeholder="Password Confirmation" class="form-control">
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" name="signUp" class="btn btn-fill btn-neutral btn-wd">Create Free Account</button>
                                </div>
                            </div>
                        </form>

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
</html>