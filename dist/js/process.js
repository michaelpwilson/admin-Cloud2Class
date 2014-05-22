$.fn.pageMe = function(opts){
   var $this = this,
        defaults = {
            perPage: 9,
            showPrevNext: false,
            hidePageNumbers: false
        },
       settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" style="border:0" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" style="border:0" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
  	pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};
  $(document).ready(function(){
   adminButton();
   var val = parseFloat($(".time_remaining").val());
   var parsedVal = 0;
   if (!isNaN(val)){
   parsedVal = val;
   $(".paid_time_remaining").css("color", "#d9534f");
   }

showRestForm();
showMeTheLesson();

$(".update_pwd").click(function() {
var user =$("#password-modal .user").val();
var first_pass =$("#password-modal input[name=user_password_new]").val();
var second_pass =$("#password-modal input[name=user_password_repeat]").val();
var changing = "changing";
if(first_pass === second_pass){
$.ajax({
     type:"post",
     url:"ending.php",
     data:{action:changing, first_pass: first_pass, user: user},
     success:function(data){
	$("#password-modal").modal('hide');
        }
     });
} else {
$("#password-modal input[name=user_password_new]").attr('id', 'inputError2');
$("#password-modal input[name=user_password_repeat]").attr('id', 'inputError2');
$("#password-modal .form-group").addClass("has-feedback").addClass("has-error");
$("#password-modal span").show();
$("#pwd-message").text("Your passwords do not match").fadeIn();
}
});

  jQuery.fn.existsWithValue = function() { 
    return this.length && this.val().length; 
  }

function menuToggle(){
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
    });
}

  $(".reset-p").click(function() {
	var usr =$(this).val();
	$("#password-modal").modal();
        $("#password-modal h4").text("change password for " + usr);
	$("#password-modal .user").val(usr);
    });
function adminButton(){
    $(".admin_button .btn-danger").click(function() {
	$(".admin_screen").fadeIn();
	$(".start_lesson").fadeOut();
	$('#lessons').pageMe({pagerSelector:'#lessonPagin',showPrevNext:true,hidePageNumbers:false});
	$("#sidebar-wrapper").fadeOut();
	$("html").css("overflow-y", "auto");
	$(".bottom-navy").fadeIn().css("width", "100%");
	$("#wrapper").fadeIn().css("padding-right", 0);
        $(".my_time").fadeIn();
   $(".paid_time_remaining").TimeCircles({start: true,
refresh_interval: 0.1,
count_past_zero: true,
circle_bg_color: "#60686F", 
use_background: true, 
fg_width: 0.1, 
bg_width: 1.2, 
time: {
Days: {
show: true,
text: "Days",
color: "#FC6"
},
Hours: {
show: true,
text: "Hours",
color: "#9CF"
},
Minutes: {
show: true,
text: "Minutes",
color: "#BFB"
},
Seconds: {
show: false,
}
}
});
setTimeout(function() {
$(".paid_time_remaining").TimeCircles().stop();
}, 1000);

 });
}
function adminButton2(){
    $(".admin_button .btn-danger").click(function() {
        $(".admin_screen").fadeIn();
        $(".end_lesson").fadeOut();
        $("#sidebar-wrapper").fadeOut();
        $("html").css("overflow-y", "auto");
        $("#wrapper").fadeIn().css("padding-right", 0);
        $(".my_time").fadeIn();
   $(".paid_time_remaining").TimeCircles({start: true,
refresh_interval: 0.1,
count_past_zero: true,
circle_bg_color: "#60686F",
use_background: true,
fg_width: 0.1,
bg_width: 1.2,
time: {
Days: {
show: true,
text: "Days",
color: "#FC6"
},
Hours: {
show: true,
text: "Hours",
color: "#9CF"
},
Minutes: {
show: true,
text: "Minutes",
color: "#BFB"
},
Seconds: {
show: false,
}
}
});
setTimeout(function() {
$(".paid_time_remaining").TimeCircles().stop();
}, 1000);
 });
}
  addSubtract();
  showComment();
 function startLesson(){  
    $(".start_lesson").submit(function(e) {
    e.preventDefault();
    // Get some values from elements on the page:
    var pool= $(this).attr("id");
    var type=$("#lesson_type").val();
    var instances=$("#example").val();
    var duration=$("#lesson_duration").val();
    var sudo=$(".bottom-half input[type=radio]:checked").val();
    var action="addcomment";
    var user_login=$(".session_name").val();
    var user_id = $(".user_id").val();
 $(':submit', this).click(function() {
        return false;
    });
 $.ajax({
    type:"post",
    url:"process.php",
    data:{user_id:user_id, action:action, pool:pool, lesson_type:type, instances:instances, lesson_duration:duration, sudo:sudo},
    success:function(data){
    var lesson_id = data;
    $.ajax({
    type:"post",
    url:"includes/end_lesson.php",
    data:{lesson_id: lesson_id, pool_ref: pool, user_id: user_id},
    success:function(lesson){
    $(".start_lesson").hide();
    $(".end_lesson").show();
    $(".holder").html(lesson);
   timeCircles();
   endLesson();
   goBackToPools();
   giveMe30();
   adminButton2();
   }
   });
  }
 });
 });
}

function addSubtract(){
$('#example').keyup(function(e){
    if(e.keyCode == 8){
    $('#example').val("7");
    $("#subtract").css("display", "none");
    }
    });
  $("#example").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(".start_lesson .bs-callout").show().delay(5000).fadeOut("slow");
	$("#example").addClass("danger-border");
	$(".computers").css("color", "#D9534F");
	$("#example").val("7");        
       return false;
    }
    });
    var input = document.getElementById('example');
    document.getElementById('add').onclick = function(){
    input.value = parseInt(input.value, 10) +1
     }
    document.getElementById('subtract').onclick = function(){
    input.value = parseInt(input.value, 10) -1
    if($("#example").val() <= 1){
    $("#subtract").css("display", "none");
    }
    }
}

function showRestForm(){
  $('.btn-primary').click(function() {
   $( "#pool" ).prop( "checked", true );
   $(".pool-buttons").fadeOut();
   $(".bottom-half").delay(650).fadeIn();
   $(".gobacktopools").fadeIn();
   $(".bottom-navy").css("margin-top", "-37px");
   $('.start_lesson').attr('id', $(this).find("input").val());
  goBackToPools();
  startLesson(); 
 });
}

function goBackToPools(){
$(".gobacktopools").click( function (){
location.reload();
});
}

function showMeTheLesson() {
  $(".lesson_on").click(function(){
  $(".amount_instances").css("display","block");
    var pool=$(this).find("a").text();
    var user_id = $(".user_id").val();
    var lesson_id =$(this).find("#lesson_id").val();
  $.ajax({
    type:"post",
    url:"includes/end_lesson.php",
    data:{lesson_id: lesson_id, pool_ref: pool, user_id: user_id}, 
    success:function(data){
    showComment();
    $(".holder").html(data);
        timeCircles();
        endLesson();
	goBackToPools();
	menuToggle();
	giveMe30();
	adminButton2();
	giveFive();
   }
  });
  });
}
function timeCircles(){
$("#CountDownTimerHourly").TimeCircles({ time: { Days: { show: false }, Hours: { show: true }, count_past_zero: false }}).addListener(function(unit, amount, total){
if(total == 0) {
location.reload();
}
});
$("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false }, count_past_zero: false }}).addListener(function(unit, amount, total){
if(total == 0) {
location.reload();
}
});
}

function endLesson(){
   $( "#end_lesson" ).click(function() {
    var lesson_id = $("#lesson_id").val();
    var end = "end";
   $.ajax({
     type:"post",
     url:"ending.php",
     data:{action:end, lesson_id: lesson_id},
     success:function(data){
     showComment();
        location.reload();
        }
     });
    }); 
}

function giveMe30(){
   $( "#giveme" ).click(function() {
    var lesson_id = $("#lesson_id").val();
    var give = "give";
   $.ajax({
     type:"post",
     url:"ending.php",
     data:{action:give, lesson_id: lesson_id},
     success:function(data){
	location.reload();
        }
     });
    });
}

function giveFive(){
   $( "#fiveMore" ).click(function() {
    var lesson_id = $("#lesson_id").val();
    var lesson_type = $("#lesson_type").val();
    var ttl = $("#ttl").val();
    var gFive = "gfive";
    var pool_ref = $("#pool_ref").val();
   $.ajax({
     type:"post",
     url:"ending.php",
     data:{action:gFive, lesson_id: lesson_id, ttl: ttl, lesson_type: lesson_type, pool_ref: pool_ref},
     success:function(data){
	alert("5 more instances have been added to your lesson, please wait for them to appear in the right hand sidebar.");
        }
     });
    });
}


var speed = 700;
var times = 40;
var loop = setInterval(showComment, 8000);

  function showComment(){
times--;
    if(times === 0){clearInterval(loop);} 
 var lesson_pool = $(".end_lesson #pool_ref").val();
var showcomment = "showcomment"; 
$.ajax({
    type:"post",
    url:"process.php",
    data: {action:showcomment, lesson_pool: lesson_pool},
    success:function(data){
     $("#comment").fadeIn().html(data);
 }
  });
 }
 });
