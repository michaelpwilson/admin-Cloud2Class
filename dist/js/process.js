               $(document).ready(function(){
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });

if ($('#wrapper').hasClass("active")) {
alert();
}
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
                    $(".launch_lesson").click(function(){

                          var name=$("#name").val();
                          var message=$("#message").val();

                          $.ajax({
                              type:"post",
                              url:"process.php",
                                data:"name="+name+"&message="+message+"&action=addcomment",
                              success:function(data){
                                showComment();

                              }
                          });

                    });
       });

