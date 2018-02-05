<?php
require_once("session.php");//start Session
    
    require_once("classes/User.php");// include User class

    $auth_user = new User();// create new class Object
    
    
    $user_id = $_SESSION['user_session'];//logged injn User
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE uID=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);// check wether this user is Logged in using a form or is hacker

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
     <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

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

    <script type="text/javascript">
  
$(document).ready(function(){

    $('.showNotice').hide();

  //user attaching files and documents

$('#photoimg').live('change', function()      { 

                 $("#file_preview").html('');


       $(".photo_upload").hide();

          $("#file_preview").html('<img src="img/ajax-loader.gif" alt="Uploading...."/>');
      $("#imageform").ajaxForm({
            target: '#file_preview'   
            
    }).submit();
    
      });;

$('.showNotice').show();

});

</script>

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

    <div class="user-bar">
              <div class="back">
                <a href="" style="color: #fff;"><i class="zmdi zmdi-arrow-left"></i></a>
              </div>
              <div class="avatar">
                <img src="img/avatar.png" alt="Avatar">
              </div>
              <div class="name">
                <span><?php print($userRow['firstname']); ?> <?php print($userRow['Lastname']); ?></span>
                <span class="status">online</span>
              </div>

              <div class="actions more">

              <a href="" style="color: #fff; font-size: 12px;"><i class="pe-7s-close-circle"></i> Log out</a>
              </div>
                  <div class="actions">
                <div class="status-bar">
          <div class="time"></div>
        </div>
        </div>
            </div>



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
                    <a class="navbar-brand" href="#">Recent Joined Users</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
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
                                    <a href="#">
                                        <i class="pe-7s-user"></i> Account
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php print($userRow['firstname']); ?> <?php print($userRow['Lastname']); ?> Edit your Profile</h4>
                            </div>
                            <div class="content">

                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control"  placeholder="Company" value="<?php print($userRow['firstname']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Username" value="<?php print($userRow['Lastname']); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Company" value="<?php print($userRow['email']); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Dear <?php print($userRow['firstname']); ?> We wanted to inform you that the button --update profile-- is not working in this demo you can configure it for your own or reach our Customer support on support@dorochat.com,. Thank you.</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
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


 <div class="fileUpload">

 <?php 


if($userRow['profile']==""){
    ?>

 <form id="imageform" method="post" enctype="multipart/form-data" action='profile_update.php'>
 <div class="photo_upload">
 <span class="custom-span">+</span>
<p class="custom-para">Add Images</p>
<input type="file" name="photoimg" id="photoimg" class="upload" />
</div>
</div><div id="file_preview"  style="  height: 50px;
  width: 50px;
  float: left;
  position: relative;">
</form>

    <?php

}
else{
    ?>

<img src="profiles/<?php echo $userRow['profile']; ?>">
    <?php

}


 ?>


</div>



                                     <a href="#">
                                                              

                                      <h4 class="title"><?php print($userRow['firstname']); ?> &nbsp; <?php print($userRow['Lastname']); ?><br />
                                         <small><?php print($userRow['email']); ?></small>
                                      </h4>
                                    </a>
                                </div>
                            
<div class="showNotice">Notice:You can Refresh this Page to see your image preview in a bove frame or go direct on chatting Using this Link <a href="messages.php">Chat</a></div>
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
</body>
</html>
<!--This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away-->