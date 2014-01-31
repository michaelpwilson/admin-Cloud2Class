  $(document).ready(function(){
showRestForm();
showMeTheLesson();

  jQuery.fn.existsWithValue = function() { 
    return this.length && this.val().length; 
  }

  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
    });

  $(".change_password").click(function() {
	$("#password-modal").modal();  
    });


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
   databaseRestart();
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
$(".gobacktopools b").click( function (){
location.reload();
});
}

function showMeTheLesson() {
  $(".btn-success a").click(function(){
    var pool=$(this).text();
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
	giveMe30();
	databaseRestart();
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
 startLesson();
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
     showComment();
 	startLesson();
     alert(data);
        }
     });
    });
}

function databaseRestart(){
   $( "#database_restart" ).click(function() {
    var pool_ref = $("#pool_ref").val();
    var give = "restart";
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
var times = 20;
var loop = setInterval(showComment, 15000);

  function showComment(){
times--;
    if(times === 0){clearInterval(loop);} 
 $.ajax({
    type:"post",
    url:"process.php",
    data:"action=showcomment",
    success:function(data){
     $("#comment").fadeIn().html(data);
     $("#comment li a").click(function() {
        $(this).popover('show');
     });   
 }
  });
 }
 });
