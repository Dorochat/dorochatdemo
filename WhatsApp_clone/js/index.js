
/* Message */

var form = document.querySelector('.conversation-compose');
var conversation = document.querySelector('.conversation-container');

form.addEventListener('submit', newMessage);

function newMessage(e) {
	var input = e.target.input;

	if (input.value) {
		var message = buildMessage(input.value);

}
var msg=$(".input-msg").val();

var ID=$(".Chat_id").attr('id');

var DataString=" msg="+ msg +"&conVID="+ ID;

$.ajax({
  type:'POST',
  url:'sendReply.php',
  data: DataString,
  cache: false,
  beforeSend: function(){
    $("#doro_chat_displayer").html('<ul class="drops"><li></li><li></li><li></li><li></li><li></li></ul>');  
},
success: function(html){
  $("#doro_chat_displayer").html('');
  $('.conversation-container').append(html);

  }        
}); 


	input.value = '';
	conversation.scrollTop = conversation.scrollHeight;

	e.preventDefault();
}

function buildMessage(text) {
	
  var element = document.createElement('div');

	element.classList.add('message', 'sent');

	element.innerHTML = emojione.shortnameToImage(text +
		'<span class="metadata">' +
			'<span class="time">' + moment().format('h:mm A') + '</span>' +
			'<span class="tick tick-animation">' +
				'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck" x="2047" y="2061"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#92a58c"/></svg>' +
				'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg>' +
			'</span>' +
		'</span>');

	return element;
}

//When you a user clicks on a chat
function chat(convId){

var datstring=' id=' +convId;

$.ajax({
    type: "POST",
    url: "loads_chats.php",
    data: datstring, 
    cache: false,
    beforeSend: function() 
    {
       $("#doro_chat_displayer").html('<center><div align="center"><svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg></div></center>');  
},
    success: function(response) 
    {
      $(".conversation-container").html($(response));
          var wtf = $('.conversation-container');
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
    $("#doro_chat_displayer").html("");
    
     
    }
  }).done(function(){

    CheckUserDetail();

  }).done(function(){

    blockStatus();

  }); 

}

//ChecKUSErSTatus

function blockStatus(){

  var Cid=$(".Chat_id").attr('id');

var datstring=' id=' +Cid;
  $.ajax({
    type: "POST",
    url: "checkStatus.php",
    data: datstring, 
    cache: false,
    success: function(response) 
    {
      $("#blockingStatus").html(response);
  
    }
  });


}

//check Firstname,Lastname and Profile of a user involved in That chat...
function CheckUserDetail(){

  var Cid=$(".Chat_id").attr('id');

var datstring=' id=' +Cid;
  $.ajax({
    type: "POST",
    url: "checkUserDetail.php",
    data: datstring, 
    cache: false,
    success: function(response) 
    {
      $(".loadUserInfo").html(response);
  
    }
  });
}


//Unblock a User

function unblockUser(conVid){


var datsa=' id=' +conVid;

$.ajax({
    type: "POST",
    url: "unblockUser.php",
    data: datsa, 
    cache: false,
    beforeSend: function() 
    {
       $("#doro_chat_displayer").html('<center><div align="center"><svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg></div></center>');  
},
    success: function(response) 
    {
     
    }
  }); 



}
//Pagination, load old messages in modern way
$(".conversation-container").scrollTop($(".conversation-container")[0].scrollHeight);

// Assign scroll function to .conversation-container DIV
$('.conversation-container').scroll(function(){

    if ($('.conversation-container').scrollTop() == 0){

      var Pgae=$("#CurrentResult").val();

         if (Pgae === undefined || Pgae === null) {
     // we return false because this User is Not trying to get Chat History because No conversation selected,.

     return false;
}


        // Display AJAX loader animation
         $("#doro_chat_displayer").html('<center><div align="center"><svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg></div></center>');



        $.get("loadOldMessages.php","pageNo="+ Pgae, function(data){

            Pgae++;

            $('.conversation-container').prepend(data);

            $("#CurrentResult").val(Pgae);

            $("#doro_chat_displayer").html("");
            // Reset scroll

            $('.conversation-container').scrollTop(10);

        });

    }
});


//Search function

function Search(){

  $(".user-bar").toggle();

    $("#searchfield").focus();


}

$(function(){
    
    $("#Emoji").click(function(){

        $("#smiley_input").toggle();


    });//show emoji Pop up Box


    //Search chat When a user start typing in Search Box-> we will Only Send Data to the server only if User is done Typing.
    //setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 2000;  //time in ms, 2 seconds, you can set your Own
var $input = $('#searchfield');

//on keyup, start the countdown
$input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
  //do something
 var searchQuery=$input .val();

 var SearchStr=" search="+ searchQuery;

$.ajax({
    type: "POST",
    url: "searchUser.php",
    data: SearchStr, 
    cache: false,
    beforeSend: function() 
    {
       $("#conversation_manager").html('<center><div align="center"><svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg></div></center>');  
},
    success: function(response) 
    {

       $("#conversation_manager").html(response);
     
    }
  }); 

}




    //add emoji String to Input box once clicked.

$(".smile_insert").click(function(){

           
var smiley= $(this).attr('data-tab');

var message= $(".input-msg").val();

$(".input-msg").focus().val(message + ' '+ smiley + '');
           
});// smiley Tab1 insert smile 




$(".Animal_insert").click(function(){

           
var Animal_smiley= $(this).attr('data-tab');

var TextInput= $(".input-msg").val();

$(".input-msg").focus().val(TextInput + ' '+ Animal_smiley + '');
           
});// Animal Tab2 insert Emoji 


$(".Food_insert").click(function(){

           
var Food_smiley= $(this).attr('data-tab');

var Food_TextInput= $(".input-msg").val();

$(".input-msg").focus().val(Food_TextInput + ' '+ Food_smiley + '');
           
});// Food_smiley Tab3 insert Emoji 


$(".Activity_insert").click(function(){

           
var Activity_smiley= $(this).attr('data-tab');

var Activity_TextInput= $(".input-msg").val();

$(".input-msg").focus().val(Activity_TextInput + ' '+ Activity_smiley + '');
           
});// Food_smiley Tab3 insert Emoji 

    });




