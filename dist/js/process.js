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

  addSubtract();
  showComment();

  $( ".start_lesson" ).submit(function( event ) {
    // Stop form from submitting normally
    event.preventDefault();
    // Get some values from elements on the page:
    var pool= $("input:radio[name ='pool']:checked").val();
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
    showComment();
  $.ajax({
    type:"post",
    url:"includes/end_lesson.php",
    data:{pool_ref: pool},
    success:function(lesson){
    $(".start_lesson").hide();
    $(".end_lesson").show();
    $(".holder").html(lesson);
   timeCircles();
   endLesson();
   goBackToPools();
  }
   });
  }
 });

 });

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
  if (!$("input[name='pool']:checked").val()) {
   return false;
  } else {
   $(".pool-buttons").fadeOut();
   $(".bottom-half").fadeIn();
  }
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
  $.ajax({
    type:"post",
    url:"includes/end_lesson.php",
    data:{pool_ref: pool}, 
    success:function(data){
    showComment();
    $(".holder").html(data);
        timeCircles();
        endLesson();
	goBackToPools();  

   }
  });
  });
}

function timeCircles(){
$("#CountDownTimerHourly").TimeCircles({ time: { Days: { show: false }, Hours: { show: false }, count_past_zero: false }});
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
    }
  });
 }
 });
