$(document).ready(function(){
$("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
$("#CountDownTimerHourly").TimeCircles({ time: { Days: { show: false } }});

$("#end_lesson").click(function(){
  var user_lesson=$(".user_lesson").val();
  $.ajax({
     type:"post",
     url:"ending.php",
     data:{user_lesson: user_lesson},
     success:function(data){
$(".end_lesson").hide();
$(".start_lesson").show();
showComment();
 }   
  });

});

jQuery.fn.existsWithValue = function() { 
    return this.length && this.val().length; 
}

if ($('.user_lesson').existsWithValue()) {
$('.end_lesson').show();
$('.start_lesson').hide();
} else {
$('.start_lesson').show();
$('.end_lesson').hide();
}

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });

var input = document.getElementById('example');

document.getElementById('add').onclick = function(){
    input.value = parseInt(input.value, 10) +1
}
document.getElementById('subtract').onclick = function(){
    input.value = parseInt(input.value, 10) -1
}
showComment();

$( ".start_lesson" ).submit(function( event ) {
  // Stop form from submitting normally
  event.preventDefault();
  // Get some values from elements on the page:
  var pool=$("#pool").val();
  var type=$("#lesson_type").val();
  var instances=$("#example").val();
  var duration=$("#lesson_duration").val();
  var action="addcomment";
  var user_login=$(".session_name").val();
  $.ajax({
type:"post",
url:"process.php",
data:{action:action, pool:pool, lesson_type:type, instances:instances, lesson_duration:duration, user_login:user_login},
success:function(data){
alert(data);
showComment();
  $.ajax({
     type:"post",
     url:"includes/end_lesson.php",
     data:{user_lesson: data},
     success:function(lesson){
     $(".start_lesson").hide();
     $(".end_lesson").show();
     $(".holder").html(lesson);
 }
  });
 }
});

 });
  function showComment(){
$.ajax({
     type:"post",
     url:"process.php",
     data:"action=showcomment",
     success:function(data){
         $("#comment").html(data);
     }
  });
  }
 });
