<?php
require_once("session.php");// check user Session
    
    require_once("classes/User.php");// include User class

    $auth_user = new User();// instantiate user class by creating New Object

    require_once("emojione.php");//include Emoji plugin for smiley and Emiticons

    $user_id = $_SESSION['user_session'];//Logged in User Id
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE uID=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/flag/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Messages - <?php print($userRow['email']); ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
  
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css'>
<link rel='stylesheet prefetch' href='https://cdn.rawgit.com/wedeploy/demo-wechat/gh-pages/styles/vendor/devices.min.css'>

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

        <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Emoji One CSS: -->
  <link rel="stylesheet" href="assets/css/emojione.min.css" type="text/css" media="all" />

        <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

<link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">

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

        <div id="conversation_manager">
        

<?php

  $user_id = $_SESSION['user_session'];

$result_query= $auth_user->runQuery("select c.coID, c.blocked, c.blockedBy, u.uID, u.firstname, u.Lastname, u.profile, m.crReply, m.crTime, m.crConFK
        FROM users u, conversation c, conversation_reply m
        LEFT JOIN conversation_reply m2
        ON (m.crConFK = m2.crConFK AND m.crID < m2.crID) -- this is to select last message
        WHERE
            CASE
              WHEN c.coUserOne = $user_id
              THEN c.coUserTwo = u.uID
              WHEN c.coUserTwo = $user_id
              THEN c.coUserOne= u.uID
            END
        AND
        c.coID = m.crConFK
        AND
        (c.coUserOne = $user_id OR c.coUserTwo = $user_id)
        AND
        m2.crID IS NULL ORDER BY m.crID DESC");

$result_query->execute();

if($result_query->rowCount()){

while($conv_row=$result_query->fetch(PDO::FETCH_ASSOC)){

$c_id_fk=$conv_row['crConFK'];

  /****count new message in each conversation**********/
$sql_count=$auth_user->runQuery("SELECT count( * ) AS replies
FROM conversation_reply
WHERE crConFK ='$c_id_fk'
AND (
user_two_read = 'no'
AND crUserFK NOT
IN ( '$user_id' )
) ");

$sql_count->execute();

$replyiesnotification=$sql_count->fetch(PDO::FETCH_ASSOC);

$replyiesnotifi=$replyiesnotification['replies'];
/****count new message in each conversation end here**********/



?>

<div id="friends">
            <div class="friend" onclick="chat('<?php echo $conv_row['coID'];?>')">

            <?php if($replyiesnotifi==0){
}
else{
?>
<span class="message_notification" id="message_notification<?php echo $conv_row['coID'];?>"><?php echo $replyiesnotifi; ?></span>
<?php
}
?>
                
<div class="Userprofile">
                <?php if($conv_row['profile']==""){
                  ?>
                  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />

                  <?php

                  } 
                  else{
                    ?>
                    <img src="profiles/<?php echo $conv_row['profile']; ?>">

                    <?php
                  } 
                  ?>

                </div>


                <p>
                    <span class="username"><?php if($conv_row['blocked']==$conv_row['uID'] && $conv_row['blockedBy']==$user_id){//Show for those ID are Blocked

                      ?>

                     <strong style="color:#ff8000; font-size: 16px;"><?php echo $conv_row['firstname'];?> <?php echo $conv_row['Lastname'];?></strong>
                      <?php

                      }
                      else{?>

                      <strong><?php echo $conv_row['firstname'];?> <?php echo $conv_row['Lastname'];?></strong>

                        <?php }?></span><br><!--check wether this guy is blocked or Not-->
                    <span class="user_conversation_reply"><?php echo $client->shortnameToImage($conv_row['crReply']);?></span>
                </p>

                <?php if($conv_row['uID']==$auth_user->inActiveUsers()){

                  ?>

                  <div class="status away"></div>

                  <?php

                }
                else if($conv_row['uID']==$auth_user->onlineUsers($conv_row['uID'])){// supply UserId to OnlineUsers Function To check wether this Id exit in the table or Not
?>
<div class="status available"></div>
<?php

                }
                else if($conv_row['uID']!==$auth_user->onlineUsers($conv_row['uID'])){// supply UserId to OnlineUsers Function To check wether this Id exit in the table or Not-> here we're proving that the user has Logged out
?>
<div class="status inactive"></div>
<?php

                }
                ?>
            </div>

            </div>
<?php
}

}
else{
  ?>

<img src="img/blured_chat.png" style="height: 100%; width: 100%">

  <?php


}
?>    
    </div>  
    </div>

    </div>
     </div>

    </div>



    <div class="user-bar">
              <div class="back">
                <a href="home.php" style="color: #fff;"><i class="zmdi zmdi-arrow-left"></i></a>
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



    <div class="main-panel">
      <nav class="navbar navbar-default">
      <div class="container-fluid">
            <!--user detail will be displayed after Ajax Call -->

            <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

              <div class="loadUserInfo"></div>
              </div>


<div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">


                     <li>
                            <a href="javascript:void(0)" onclick="Search()">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>

                        <li class="dropdown dropdown-with-icons">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i>
                                <p class="hidden-md hidden-lg">
                                    More
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                <li>
                                    <a href="home.php">
                                        <i class="pe-7s-note"></i> New Messages
                                    </a>
                                </li>
                                <li id="blockingStatus">
                                    
                                </li>
                                <li>
                                    <a href="#" onclick="demo.showSwal('warning-message-and-confirmation')">
                                        <i class="pe-7s-trash"></i> Delete chat
                                    </a>
                                </li>
                            
                            </ul>
                        </li>

                    </ul>
                </div>
               
            </div>
        </nav>

    <div class="content">
               
 <div class="row" style="margin-top: -30px;">
 <div class="col-md-12">
     

      <div class="page">

            <div class="conversation">
              <div class="conversation-container">

<div id="select_conversation" style="padding-left: 30%; padding-top: 10%;
  align-self: center;"><img src="img/mail.png"></div>

              </div>

              <div id="smiley_input">

<div id="WrapSmiles">
  

  <ul class="tabs">
    <li class="tab-link current" data-tab="tab-1" id="smile"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg></li>
    <li class="tab-link" data-tab="tab-2" id="animal"><img src="img/animal.svg" style="height: 23px; width: 23px; margin-top: -12px;"></li>
    <li class="tab-link" data-tab="tab-3" id="food"><img src="img/food.png" style="height: 23px; width: 23px; margin-top: -12px;"></li>
    <li class="tab-link" data-tab="tab-4" id="activity"><img src="img/activity.png" style="height: 23px; width: 23px; margin-top: -12px;"></li>
  </ul>

  <span id="tab-1" class="tab-content current">
<div class="smileys">
<div class="smileyLoader"> <?php include("loadSmiley.php"); ?></div><!--load Smiley-->
</div>


  </span>
  <span id="tab-2" class="tab-content">
<div class="animal"> <div class="animalLoader"><?php include("loadAnimal.php"); ?></div></div><!--load Smiley <animalTab>-->
  </span>
  <span id="tab-3" class="tab-content">
<div class="food"> <div class="foodEmoji"><?php include("loadFood.php"); ?></div></div><!--load Smiley <foodTab>-->
  </span>
  <span id="tab-4" class="tab-content">
<div class="activity"><div class="activityLoader"><?php include("loadActivity.php"); ?></div></div><!--load Smiley <activityTab>-->
  </span>

</div>
              </div>


              <div id="doro_chat_displayer"></div><!--loading indicator//chat will be displayed rihght here-->

              <form class="conversation-compose">
              <input type="hidden" name="loggedIn" id="loggedIn" value="<?php echo $user_id; ?>"></input>
                <div class="emoji">
                 <a href="javascript:void(0)" id="Emoji"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg></a>
                </div>
                <input class="input-msg" name="input" id="emojioneInput" placeholder="Type a message" autocomplete="off" autofocus></input>
                <div class="photo" style="cursor: pointer;">
               <i class="zmdi zmdi-camera"></i>
                </div>
                <button class="send">
                    <div class="circle">
                      <i class="zmdi zmdi-mail-send"></i>
                    </div>
                  </button>
              </form>
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

    </div>

</section>

  
  <!-- jQuery: -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Emoji One JS -->

  <script src="lib/js/emojione.js"></script>
<script type="text/javascript">
  
  /**emoji**/
    // #################################################
    // # Optional

    // default is PNG but you may also use SVG
    emojione.imageType = 'png';

    // default is ignore ASCII smileys like :) but you can easily turn them on
    emojione.ascii = true;

    // if you want to host the images somewhere else
    // you can easily change the default paths
    emojione.imagePathPNG = 'assets/png/';
    emojione.imagePathSVG = 'assets/svg/';

    // #################################################
</script>


  <script type="text/javascript" src="assets/js/jquery.min.js"></script>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js'></script>
  <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    
    <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

  <script src="js/index.js"></script><!--handles send/receive chat messages--><!--handles Websocket too-->


    <!-- Sweet Alert 2 plugin -->
    <script src="assets/js/sweetalert2.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script> <!--nice scroll-->



<script>
  $(document).ready(function() {
  


/* Time */

var deviceTime = document.querySelector('.status-bar .time');
var messageTime = document.querySelectorAll('.message .time');

deviceTime.innerHTML = moment().format('h:mm');

setInterval(function() {
  deviceTime.innerHTML = moment().format('h:mm');
}, 1000);

for (var i = 0; i < messageTime.length; i++) {
  messageTime[i].innerHTML = moment().format('h:mm A');
}







  var nice = $("html").niceScroll();  // The document page (body)

    $(".conversation-container").niceScroll({cursorborder:"",cursorcolor:"#005e54",boxzoom:false}); // First scrollable DIV


      $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');// switch smiley Tabs
  })


   function refreshMessages() {
  $.ajax({
    url: 'Refreshconversation.php',
    type: 'GET',
    dataType: 'html',
    success: function(data) {
      $('#conversation_manager').html(data); // Refresh conversation Immediately
    },
    error: function() {
      $('#conversation_manager').html('Error retrieving new messages..');
    }
  });
}


//web socket Configuration


  //create a new WebSocket object.
 var wsUri = "ws://localhost:9000";  

  websocket = new WebSocket(wsUri);
    
    websocket.onopen = function(ev) { // connection is open 
        $('.conversation-container').append("<div class=\"system_msg\">Online Now!</div>"); //notify user
    }



$('.send').click(function(){ //user clicks message send button   

var msg=$(".input-msg").val(); //get message text
        var ID=$(".Chat_id").attr('id'); //current Chat ID
        var loggedinId=$("#loggedIn").val();//Logged In user

if(msg !==""){

//prepare json data
        var chatmsg = {
        message: msg,
       chatId: ID,
       loggedIN: loggedinId
        };
        //convert and send data to server
  websocket.send(JSON.stringify(chatmsg));


}   
    });



//#### Message received from server?
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data
        var type = msg.type; //message type
        var umsg = msg.message; //message text  
        var ConvIDs = msg.Id; //user name
        var USessionId = msg.UserSessionId; //userId, This Id represent who send a message.

        if(type == 'usermsg') 
        {

          refreshMessages();//Refresh Chat list

          var idTocompare=$(".Chat_id").attr('id');
          var loggedinId=$("#loggedIn").val();

          if(ConvIDs !==idTocompare){

          }
          else{

            


            if(loggedinId==USessionId){//This is the sender of the Message

                     $('.conversation-container').append(" <div class='message sent'>"+ emojione.shortnameToImage(umsg) +"<span class='metadata'><span class='time'>" + moment().format('h:mm A') + "</span><span class='tick tick-animation'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='15' id='msg-dblcheck' x='2047' y='2061'><path d='M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z' fill='#92a58c'/></svg><svg xmlns='http://www.w3.org/2000/svg' width='16' height='15' id='msg-dblcheck-ack' x='2063' y='2076'><path d='M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z' fill='#4fc3f7'/></svg></span></span>");

          var wtf = $('.conversation-container');
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);

            }
            else{//Receiver of the message



             $('.conversation-container').append("<div class='message received'>"+ emojione.shortnameToImage(umsg) +"<span class='metadata'><span class='time'> " + moment().format('h:mm A') + "</span></span></div>");

               $('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.mp3" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
               $('#chatAudio')[0].play();
               $("#smiley_input").hide();//hide smileys if @ the other User is Active

          var wtf = $('.conversation-container');
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);

            }

          } 
        }
        if(type == 'system')
        {
            $('.conversation-container').append("<div class=\"system_msg\">"+umsg+"</div>");
        }
    };



    
    websocket.onerror   = function(ev){$('.conversation-container').append("<div class=\"system_error\">Error Occurred, Please refresh this page in both two browsers and try chatting again!. - "+ev.data+"</div>");}; 
    websocket.onclose   = function(ev){
//attempt to reconnect!
      $(function() {

 $.ajax({
    url: 'runCommand.php',
    type: 'GET',
    dataType: 'html',
    beforeSend: function() {

      $("#doro_chat_displayer").html('<center><div align="center"><svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg></div></center>');
    },
    success: function(data) {
     $("#doro_chat_displayer").html('');
    }
  });

  return false;
    });

      $('.conversation-container').append("<div class=\"system_msg\">WebSocket Connection has lost, you can Refresh This Page if  the problem persist, contact System administrator</div>");

    }; 

  });
</script>
</body>
</html>
<!--This script is Brought to you by Dorocode->dorocode@gmail.com/ you can Contact our chat support : support@dorochat.com/ please any issue  that you may encouter during installation or Running This script on your server  let us know right away-->