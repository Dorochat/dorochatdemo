<?php
require_once("session.php");// check user Session
    
    require_once("classes/User.php");// include User class

    $auth_user = new User();// instantiate user class by creating New Object
    $user_id = $_SESSION['user_session'];//Logged in User Id
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE uID=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));// check wether this guy used a form to login or just a scam
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/flag/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>welcome - <?php print($userRow['email']); ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
  
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css'>
<link rel='stylesheet prefetch' href='https://cdn.rawgit.com/wedeploy/demo-wechat/gh-pages/styles/vendor/devices.min.css'>

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

        <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

<style type="text/css">
#boxscroll {
  padding: 40px;
  height: 220px;
  width: 300px;
  border: 2px solid #00F;
  overflow: auto;
  margin-bottom:20px;
}
</style>


<meta name="viewport" content="user-scalable=no" />

  <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">

</head>

<body>

<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="img/bg-1w.jpg">


<div class="sidebar-wrapper">
<div id="chatbox">
    <div id="friendslist">
        <div id="topmenu">
                       <div id="search">
                <input type="text" id="searchfield" placeholder="Search chat..." />
            </div>
        </div>
        
        <div id="friends">
            <div class="friend">

                <div class="Userprofile"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" /></div>
                <p>
                    <span class="username"><strong>Miro Badev james W</strong></span>
                    <span>mirobadev@gmail.com</span>
                </p>
                <div class="status available"></div>
            </div>
            
            <div class="friend">
 <div class="Userprofile"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Martin Joseph</strong></span>
                    <span>marjoseph@gmail.com</span>
                </p>
                <div class="status away"></div>
            </div>
            
            <div class="friend">
              <div class="Userprofile"> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Tomas Kennedy</strong></span>
                    <span>tomaskennedy@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            
            <div class="friend">
                <div class="Userprofile"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Enrique Sutton</strong></span>
                    <span>enriquesutton@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            
            <div class="friend">
               <div class="Userprofile"> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/5_copy.jpg" /></div>
                <p>
               <span class="username"><strong>    Darnell Strickland</strong></span>
                    <span>darnellstrickland@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            

  <div class="friend">
               <div class="Userprofile"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Martin Joseph</strong></span>
                    <span>marjoseph@gmail.com</span>
                </p>
                <div class="status away"></div>
            </div>
            
            <div class="friend">
              <div class="Userprofile"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Tomas Kennedy</strong></span>
                    <span>tomaskennedy@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            
            <div class="friend">
               <div class="Userprofile"> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4_copy.jpg" /></div>
                <p>
                   <span class="username"> <strong>Enrique Sutton</strong></span>
                    <span>enriquesutton@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            
            <div class="friend">
               <div class="Userprofile"> <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/5_copy.jpg" /></div>
                <p>
               <span class="username"><strong>Darnell Strickland</strong></span>
                    <span>darnellstrickland@gmail.com</span>
                </p>
                <div class="status inactive"></div>
            </div>
            
        </div>                
        
    </div>  
    </div>

    
     </div>


       
    </div>

    <!--Top bar start here-->

    <div class="user-bar">
              <div class="back">
                <a href="" style="color: #fff;"><i class="zmdi zmdi-arrow-left"></i></a>
              </div>
              <div class="avatar">
               
                <?php if($userRow['profile']==""){
                  ?>
                  <img src="img/avatar.png" alt="Avatar">

                  <?php

                  } 
                  else{
                    ?>
                    <img src="profiles/<?php echo $userRow['profile']; ?>">

                    <?php
                  } 
                  ?>
              </div>
              <div class="name">
                <span><?php print($userRow['firstname']); ?> <?php print($userRow['Lastname']); ?></span>
                <span class="status">online</span>
              </div>

              <div class="actions more">

              <a href="logout.php?logout=true" style="color: #fff; font-size: 12px;"><i class="pe-7s-close-circle"></i> Log out</a>
              </div>
                  <div class="actions">
                <div class="status-bar">
          <div class="time"></div>
        </div>
        </div>
            </div>

    <!--Top bar Ends here-->

    <div class="main-panel">
      <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="seach-conversation" class="btn btn-warning btn-fill btn-round btn-icon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Recent Joined Users (Online:<?php echo $auth_user->countOnlineUsers();?>)</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <p class="hidden-md hidden-lg">
                                    Notifications
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">

                             <h6>You Have no new notification</h6>
                            </ul>
                        </li>



                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-chat" style="font-size: 22px;"></i>
                                <span class="notification">5</span>
                                <p class="hidden-md hidden-lg">
                                    Messages
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                            <li style="margin-left: 4px;"><h6>Messages</h6></li>
                            <hr>
                                <li>
<h6>Click here to start   <a href="messages.php">Chatting</a></h6>
 
 please if you encounter any problem please send us an email : support@dorochat.com / dorocode@gmail.com

  Thank - you.

                                </li>
                               
                            </ul>
                        </li>


                           <li class="dropdown dropdown-with-icons">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-tools"></i>
                                <p class="hidden-md hidden-lg">
                                    More
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                <li>
                                    <a href="account.php">
                                        <i class="pe-7s-user"></i> Account
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="demo.showSwal('custom-html')">
                                        <i class="pe-7s-timer"></i>Future Updates
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="pe-7s-cart"></i> Buy this Script
                                    </a>
                                </li>
                            
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


 <div class="content">
            <div class="container-fluid">
                <div class="row">

                <div class="notice success"><p>Thank you for showing interest in our Realchat websocket Application, please click on the message Icon on user's profile to send new Message or Just click here to start <a href="messages.php">Dorochat V1 demo</a> Remember to Open two browsers to start realtime chat.</p></div>
                    <div class="col-md-8">



                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">



<?php    


$userstmt = $auth_user->runQuery("SELECT * FROM users WHERE uID !='$user_id' order by uID desc");

   $userstmt->execute();
    
    while($usersRow=$userstmt->fetch(PDO::FETCH_ASSOC)){

?>

<div class="col-md-6">


<div class="card card-user">
                            <div class="image">
                                <img src="img/2017.png" alt="..."/>
                            </div>

<div class="user_profile" style="position: relative;
  margin-top:-30px; float: left; width: 130px; padding-right: 2px;">
                            <a href="#" >
                            <?php if($usersRow['profile']!==''){?><img class="avatar border-gray" src="profiles/<?php print($usersRow['profile']); ?>" alt="..."/> <?php } 
                            else{
?><img class="avatar border-gray" src="img/avatar.png" alt="..."/><?php
                                }?>
                                    
                                    </a>
                                    </div>
                                    
                                     <div class="name">
                <span><h4><?php print($usersRow['firstname']); ?> <?php print($usersRow['Lastname']); ?></h4></span>
                <span><?php print($usersRow['email']); ?></span>
              </div>
              <br/>
                            <hr>
                            <div class="text-center">
                                <span onclick="sendChat('<?php print($usersRow['uID']); ?>')"><a href="javascript:void(0)"  onclick="demo.showSwal('input-field')" class="btn btn-simple"><i class="pe-7s-chat"></i></a></span>
                                

                                <button href="#" class="btn btn-simple"><i class="pe-7s-like2"></i></button>
                                <button href="#" class="btn btn-simple"><i class="pe-7s-info"></i></button>

                                <input type="hidden" id="userId" value="">

                            </div>
                        </div>


                                        </div>

<?php

    }

     ?>


                 </div>

                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="img/2017.png" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">


                  
                                     <a href="#">
                                                        <?php if($userRow['profile']==""){
                  ?>
                  <img src="img/avatar.png" alt="Avatar" class="avatar border-gray">

                  <?php

                  } 
                  else{
                    ?>
                    <img src="profiles/<?php echo $userRow['profile']; ?>" class="avatar border-gray">

                    <?php
                  } 
                  ?>

                                      <h4 class="title"><?php print($userRow['firstname']); ?> &nbsp; <?php print($userRow['Lastname']); ?><br />
                                         <small><?php print($userRow['email']); ?></small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "This Account was created: <br>
                                                    <?php print($userRow['joined']); ?> <br>
                                                    <label  style="color: red;">Hey <?php print($userRow['firstname']); ?> you can buy this script using happy new year coupon(2017) and get 55% of discount</label>"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

 </div>
 </div>
 </div>  

    </div>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js'></script>

    <script src="js/index.js"></script>


       <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


<!-- Sweet Alert 2 plugin -->
    <script src="assets/js/sweetalert2.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>


        <script type="text/javascript">
        

$(document).ready(function(){


    $("#seach-conversation").click(function(){


    $(".user-bar").toggle();

    $("#searchfield").focus();

    
});
    
    $("#Emoji").click(function(){

        $(".emoji").show();


    });

    

});

    </script>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script> <!--nice scroll-->

<script>
  $(document).ready(function() {
  
  var nice = $("html").niceScroll();  // The document page (body)

    $(".conversation-container").niceScroll({cursorborder:"",cursorcolor:"#005e54",boxzoom:false}); // First scrollable DIV
  });
</script>
</body>
</html>

<!--This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away-->

