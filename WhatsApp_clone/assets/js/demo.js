type = ['','info','success','warning','danger'];

function sendChat(userId){

  $userID=$("#userId").val(userId);

}

function clearChat(){

	$(".conversation-container").html("");
}
// get New messages immediately

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

//Refresh User Details immediatel
   function refreshUserDetail() {
  $.ajax({
    url: 'checkUserDetail.php',
    type: 'GET',
    dataType: 'html',
    success: function(data) {
       $("#blockingStatus").html(data); // Refresh conversation Immediately
    },
    error: function() {
       $("#blockingStatus").html('Connection problem try again..');
    }
  });
}
$().ready(function(){
    $sidebar = $('.sidebar');
    $sidebar_img_container = $sidebar.find('.sidebar-background');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    window_width = $(window).width();

    if(window_width > 767){
        if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
            $('.fixed-plugin .dropdown').addClass('open');
        }

    }

    $('.fixed-plugin a').click(function(event){
      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if($(this).hasClass('switch-trigger')){
            if(event.stopPropagation){
                event.stopPropagation();
            }
            else if(window.event){
               window.event.cancelBubble = true;
            }
        }
    });

    $('.fixed-plugin .badge').click(function(){
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if($sidebar.length != 0){
            $sidebar.attr('data-color',new_color);
        }

        if($full_page.length != 0){
            $full_page.attr('data-color',new_color);
        }

        if($sidebar_responsive.length != 0){
            $sidebar_responsive.attr('data-color',new_color);
        }
    });

    $('.fixed-plugin .img-holder').click(function(){
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if($sidebar_img_container.length !=0 ){
            $sidebar_img_container.fadeOut('fast', function(){
               $sidebar_img_container.css('background-image','url("' + new_image + '")');
               $sidebar_img_container.fadeIn('fast');
            });
        }

        if($full_page_background.length != 0){

            $full_page_background.fadeOut('fast', function(){
               $full_page_background.css('background-image','url("' + new_image + '")');
               $full_page_background.fadeIn('fast');
            });
        }

        if($sidebar_responsive.length != 0){
            $sidebar_responsive.css('background-image','url("' + new_image + '")');
        }
    });

    $('.switch-sidebar-image input').change(function(){
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if($input.is(':checked')){
            if($sidebar_img_container.length != 0){
                $sidebar_img_container.fadeIn('fast');
                $sidebar.attr('data-image','#');
            }

            if($full_page_background.length != 0){
                $full_page_background.fadeIn('fast');
                $full_page.attr('data-image','#');
            }

            background_image = true;
        } else {
            if($sidebar_img_container.length != 0){
                $sidebar.removeAttr('data-image');
                $sidebar_img_container.fadeOut('fast');
            }

            if($full_page_background.length != 0){
                $full_page.removeAttr('data-image','#');
                $full_page_background.fadeOut('fast');
            }

            background_image = false;
        }
    });

    $('.switch-sidebar-mini input').change(function(){
        $body = $('body');

        $input = $(this);

        if(lbd.misc.sidebar_mini_active == true){
            $('body').removeClass('sidebar-mini');
            lbd.misc.sidebar_mini_active = false;

            if(isWindows){
                $('.sidebar .sidebar-wrapper').perfectScrollbar();
            }

        }else{

            $('.sidebar .collapse').collapse('hide').on('hidden.bs.collapse',function(){
                $(this).css('height','auto');
            });

            if(isWindows){
                $('.sidebar .sidebar-wrapper').perfectScrollbar('destroy');
            }

            setTimeout(function(){
                $('body').addClass('sidebar-mini');

                $('.sidebar .collapse').css('height','auto');
                lbd.misc.sidebar_mini_active = true;
            },300);
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function(){
            window.dispatchEvent(new Event('resize'));
        },180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function(){
            clearInterval(simulateWindowResize);
        },1000);

    });

    $('.switch-navbar-fixed input').change(function(){
        $nav = $('nav.navbar').first();

        if($nav.hasClass('navbar-fixed')){
            $nav.removeClass('navbar-fixed').prependTo('.main-panel');
        } else {
            $nav.prependTo('.wrapper').addClass('navbar-fixed');
        }

    });


    $('#twitter').sharrre({
      share: {
        twitter: true
      },
      enableHover: false,
      enableTracking: true,
      buttons: { twitter: {via: 'CreativeTim'}},
      click: function(api, options){
        api.simulateClick();
        api.openPopup('twitter');
      },
      template: '<i class="fa fa-twitter"></i> &middot; 182',
      url: 'http://demos.creative-tim.com/light-bootstrap-dashboard-pro/examples/dashboard.html'
    });

    $('#facebook').sharrre({
      share: {
        facebook: true
      },
      enableHover: false,
      enableTracking: true,
      click: function(api, options){
        api.simulateClick();
        api.openPopup('facebook');
      },
      template: '<i class="fa fa-facebook-square"></i> &middot; 270',
      url: 'http://demos.creative-tim.com/light-bootstrap-dashboard-pro/examples/dashboard.html'
    });


});

demo = {

	initAnimationsArea: function(){
    	$('.animationsArea .btn').click(function(){
        	animation_class = $(this).data('animation-class');

        	$parent = $(this).closest('.animationsArea');

        	$parent.find('.btn').removeClass('btn-fill');

        	$(this).addClass('btn-fill');

        	$parent.find('.animated')
        	       .removeAttr('class')
        	       .addClass('animated')
        	       .addClass(animation_class);

        	$parent.siblings('.header').find('.title small').html('class: <code>animated ' + animation_class + '</code>');
    	});
	},

	showSwal: function(type){
    	if(type == 'basic'){
        	swal("Here's a message!");

    	}else if(type == 'title-and-text'){
        	swal("Here's a message!", "It's pretty, isn't it?")

    	}else if(type == 'success-message'){
        	swal("Good job!", "You clicked the button!", "success")

    	}else if(type == 'warning-message-and-confirmation'){
        	swal({  title: "Are you sure?",
            	    text: "This conversation will be completely deleted, you won't be able to undo it!",
            	    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn btn-info btn-fill",
                    confirmButtonText: "Yes, delete!",
                    cancelButtonClass: "btn btn-danger btn-fill",
                    closeOnConfirm: false,
                },function(){


var ID=$(".Chat_id").attr('id');//conversationID

                  //delete conversation
                  var DataString="Convid="+ID;


                  $.ajax({
  type:'POST',
  url:'deleteConversation.php',
  data: DataString,
  cache: false,
  beforeSend: function(){
    $("#doro_general_displayer").html('<svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg>');  
},
success: function(html){
 refreshMessages();//Refresh Chat list once chat has been successfully Deleted.
 refreshUserDetail();// refresh User Details immediately
}        
}); 
  swal("Deleted!", "Your conversation has been deleted.", "success");

  clearChat();
                });

    	}else if(type == 'warning-message-and-cancel'){
        	swal({  title: "Are you sure?",
            	    text: "This user will not be able to send you a message again!",
            	    type: "warning",
            	    showCancelButton: true,
            	    confirmButtonText: "Yes, block!",
            	    cancelButtonText: "No, cancel!",
            	    closeOnConfirm: false,
            	    closeOnCancel: false
                },function(isConfirm){
                    if (isConfirm){

var ID=$(".Chat_id").attr('id');//conversationID

 //Block user from This conversation
 var DataString="Convid="+ID;

$.ajax({
  type:'POST',
  url:'blockUser.php',
  data: DataString,
  cache: false,
  beforeSend: function(){
    $("#doro_general_displayer").html('<svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg>');  
},
success: function(html){

 refreshMessages();//Refresh Chat list once a user has been successfully Blocked
 refreshUserDetail(); // Refresh UserDetail immediately
}        
}); 


                  swal("Blocked!", "Blocked Successfully.", "success");
                    }else{
                        swal("Cancelled", "Thank you for your second thought :)", "error");
                    }
                });


    	}else if(type == 'unblock-user'){
swal({  title: "Waw Congratulations !",
            	    text: "This user will now be able to send you a message again!",
            	    type: "warning",
            	    showCancelButton: true,
            	    confirmButtonText: "Yes, Unblock!",
            	    cancelButtonText: "No, cancel!",
            	    closeOnConfirm: false,
            	    closeOnCancel: false
                },function(isConfirm){
                    if (isConfirm){

var ID=$(".Chat_id").attr('id');//conversationID

 //Block user from This conversation
 var DataString="Convid="+ID;

$.ajax({
  type:'POST',
  url:'unblockUser.php',
  data: DataString,
  cache: false,
success: function(html){

 refreshMessages();//Refresh Chat after unblocking
 refreshUserDetail(); //Refresh Userdetails to show Current status.
}        
}); 


                  swal("Unblocked!", "Unblocked Successfully.", "success");
                    }else{
                        swal("Cancelled", "We're very sorry that you're having bad time :)", "error");
                    }
                });


    	}else if(type == 'custom-html'){
        	swal({  title: 'Dorochat future updates',
                    html:
                        '<i class="pe-7s-check"></i>Dorochat updates using<b>Comet,Websocket or Node.js </b> technology. <br/>' +
                        '<i class="pe-7s-check"></i>Group chats <br/>' +
                        '<i class="pe-7s-check"></i>Hangouts <br/>' +
                        'And Many others'
                });

    	}else if(type == 'auto-close'){
        	swal({ title: "Auto close alert!",
            	   text: "I will close in 2 seconds.",
            	   timer: 2000,
            	   showConfirmButton: false
                });
    	} else if(type == 'input-field'){
            swal({
                  title: 'Write your message',
                  html: '<p><form class="conversation-compose"><div class="emoji"><a href="javascript:void(0)" id="Emoji"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg></a></div> <input class="input-msg" name="input" placeholder="Type a message" autocomplete="off" autofocus></input><div class="photo" style="cursor: pointer;"><i class="zmdi zmdi-camera"></i> </div><a href="javascript:void(0);" class="send" onclick="createChat();"><div class="circle"><i class="zmdi zmdi-mail-send"></i></div> </a> </form><br/><div id="doro_general_displayer"></div> <p>',
                  showCancelButton: true,
                  closeOnConfirm: false,
                  allowOutsideClick: false,
                  //showConfirmButton: false
                },
                function() {

                  var msg=$('.input-msg').val();
                   var ID=$("#userId").val();

                   var DataString="msg="+ msg +"&userID="+ ID;

                   if(msg==""){
                    return false;

                   }
                   else if(ID=="" || ID==0){
                    alert("This user isn't verified, don't send them a message!");
                   }
                   else{
                       
                       $.ajax({
  type:'POST',
  url:'createChat.php',
  data: DataString,
  cache: false,
  beforeSend: function(){
    $("#doro_general_displayer").html('<svg class="spinner-container" viewBox="0 0 44 44"><circle class="path" cx="22" cy="22" r="20" fill="none" stroke-width="4"></circle></svg>');  
},
success: function(html){
  $("#doro_general_displayer").html('');
$('.input-msg').val('');
$("#userId").val('');
  }        
}); 

                   }

                  swal({

                    html:
                      'Successfully Sent: <strong>' + msg
                       +
                      '</strong>'
                  });


                })
        }
	},



	initFormExtendedSliders: function(){

        // Sliders for demo purpose in refine cards section
        if($('#slider-range').length != 0){
            $( "#slider-range" ).slider({
        		range: true,
        		min: 0,
        		max: 500,
        		values: [ 75, 300 ],
        	});
        }
        if($('#refine-price-range').length != 0){
        	 $( "#refine-price-range" ).slider({
        		range: true,
        		min: 0,
        		max: 999,
        		values: [ 100, 850 ],
        		slide: function( event, ui ) {
        		    min_price = ui.values[0];
        		    max_price = ui.values[1];
            		$(this).siblings('.price-left').html('&euro; ' + min_price);
            		$(this).siblings('.price-right').html('&euro; ' + max_price)
        		}
        	});
        }

        if($('#slider-default').length != 0 || $('#slider-default2').length != 0){
        	$( "#slider-default, #slider-default2" ).slider({
        			value: 70,
        			orientation: "horizontal",
        			range: "min",
        			animate: true
        	});
        }
    },

    initFormExtendedDatetimepickers: function(){
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });

         $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });

         $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });
    },

    initFullCalendar: function(){
        $calendar = $('#fullCalendar');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
			header: {
				left: 'title',
				center: 'month,agendaWeek,agendaDay',
				right: 'prev,next today'
			},
			defaultDate: today,
			selectable: true,
			selectHelper: true,
			titleFormat: {
                month: 'MMMM YYYY', // September 2015
                week: "MMMM D YYYY", // September 2015
                day: 'D MMM, YYYY'  // Tuesday, Sep 8, 2015
            },
			select: function(start, end) {

                // on select we show the Sweet Alert modal with an input
				swal({
    				title: 'Create an Event',
    				html: '<br><input class="form-control" placeholder="Event Title" id="input-field">',
    				showCancelButton: true,
    				closeOnConfirm: true
                }, function() {

                    var eventData;
                    event_title = $('#input-field').val();

                    if (event_title) {
    					eventData = {
    						title: event_title,
    						start: start,
    						end: end
    					};
    					$calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
    				}

    				$calendar.fullCalendar('unselect');

                });
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events


            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-4, 6, 0),
					allDay: false,
					className: 'event-blue'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+3, 6, 0),
					allDay: false,
					className: 'event-blue'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d-1, 10, 30),
					allDay: false,
					className: 'event-green'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d+7, 12, 0),
					end: new Date(y, m, d+7, 14, 0),
					allDay: false,
					className: 'event-red'
				},
				{
					title: 'LBD Launch',
					start: new Date(y, m, d-2, 12, 0),
					allDay: true,
					className: 'event-azure'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
				},
				{
					title: 'Click for Creative Tim',
					start: new Date(y, m, 21),
					end: new Date(y, m, 22),
					url: 'http://www.creative-tim.com/',
					className: 'event-orange'
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 23),
					end: new Date(y, m, 23),
					url: 'http://www.creative-tim.com/',
					className: 'event-orange'
				}
			]
		});
    }
}
