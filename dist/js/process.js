  $(document).ready(function(){
adminButton();
var val = parseFloat($(".time_remaining").val());
var parsedVal = 0;

if (!isNaN(val))
{
  parsedVal = val;
  $(".paid_time_remaining").css("color", "#d9534f");

}

if (parsedVal > 0)
{
alert("your not in debt");
}


showRestForm();
showMeTheLesson();

  jQuery.fn.existsWithValue = function() { 
    return this.length && this.val().length; 
  }

function menuToggle(){
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
    });
}

  $(".change_password").click(function() {
	$("#password-modal").modal();  
    });
function adminButton(){
    $(".admin_button .btn-danger").click(function() {
	$(".admin_screen").fadeIn();
	$(".start_lesson").fadeOut();
	$("#sidebar-wrapper").fadeOut();
	goBackToPools();
	$("#wrapper").fadeIn().css("padding-right", 0);
   $(".paid_time_remaining").TimeCircles({start: true, // determines whether or not TimeCircles should start immediately.
refresh_interval: 0.1, // determines how frequently TimeCircles is updated.
count_past_zero: true, // This option is only really useful for when counting down. What it does is either give you the option to stop the timer, or start counting up after you've hit the pred$
circle_bg_color: "#60686F", // determines the color of the background circle.
use_background: true, // sets whether any background circle should be drawn at all.
fg_width: 0.1, //  sets the width of the foreground circle.
bg_width: 1.2, // sets the width of the backgroundground circle.
time: { //  a group of options that allows you to control the options of each time unit independently.
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
$(".paid_time_remaining").stop();
 });
}
function adminButton2() {
    $(".admin_button .btn-danger").click(function() {
        $(".admin_screen").fadeIn();
        $(".end_lesson").fadeOut();
        $("#sidebar-wrapper").fadeOut();
        goBackToPools();
        $("#wrapper").fadeIn().css("padding-right", 0);
        $(".paid_time_remaining").TimeCircles({start: true, // determines whether or not TimeCircles should start immediately.
refresh_interval: 0.1, // determines how frequently TimeCircles is updated.
count_past_zero: true, // This option is only really useful for when counting down. What it does is either give you the option to stop the timer, or start counting up after you've hit the predefined date (or your stopwatch hits zero).
circle_bg_color: "#60686F", // determines the color of the background circle.
use_background: true, // sets whether any background circle should be drawn at all.
fg_width: 0.1, //  sets the width of the foreground circle.
bg_width: 1.2, // sets the width of the backgroundground circle.
time: { //  a group of options that allows you to control the options of each time unit independently.
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
 });
}

  addSubtract();
  showComment();

startLesson();

function startLesson(){  
$(".start_lesson").submit(function( event ) {
    // Stop form from submitting normally
    event.preventDefault();
    // Get some values from elements on the page:
    var pool= $("input:radio[name ='pool']:checked").val();
    var type=$("#lesson_type").val();
    var instances=$("#example").val();
    var duration=$("#lesson_duration").val();
    var action="addcomment";
    var user_login=$(".session_name").val();
    var user_id = $(".user_id").val();
   $.ajax({
    type:"post",
    url:"process.php",
    data:{user_id:user_id, action:action, pool:pool, lesson_type:type, instances:instances, lesson_duration:duration},
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

  var input = document.getElementById('example');

  document.getElementById('add').onclick = function(){
    input.value = parseInt(input.value, 10) +1
    }
  document.getElementById('subtract').onclick = function(){
    input.value = parseInt(input.value, 10) -1
    }

}

function showRestForm(){
  $('.btn-primary').click(function() {
   $( "#pool" ).prop( "checked", true );
   $(".pool-buttons").fadeOut();
   $(".bottom-half").fadeIn();
   $(".gobacktopools").fadeIn();
  goBackToPools();
  });
}

function goBackToPools(){
$(".gobacktopools").click( function (){
location.reload();
});
}

function showMeTheLesson() {
  $(".btn-success").click(function(){
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
   }
  });
  });
}
function timeCircles(){
$("#CountDownTimerHourly").TimeCircles({ time: { Days: { show: false }, Hours: { show: true }, count_past_zero: false }});
   $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false }, count_past_zero: false }});
}

function endLesson(){
   $( "#end_lesson" ).click(function() {
    var pool_ref = $("#pool_ref").val();
    var end = "end";
   $.ajax({
     type:"post",
     url:"ending.php",
     data:{action:end, pool_ref: pool_ref},
     success:function(data){
     showComment();
        location.reload();
        }
     });
    }); 
}

function giveMe30(){
   $( "#giveme" ).click(function() {
    var pool_ref = $("#pool_ref").val();
    var give = "give";
   $.ajax({
     type:"post",
     url:"ending.php",
     data:{action:give, pool_ref: pool_ref},
     success:function(data){
	location.reload();
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
