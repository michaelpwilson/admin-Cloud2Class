               $(document).ready(function(){
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
  $.ajax({
type:"post",
url:"process.php",
data:{action:action, pool:pool, lesson_type:type, instances:instances, lesson_duration:duration},
success:function(data){
showComment();
$(".start_lesson").hide();
$(".end_lesson").show();
 }
});

 });
 });
