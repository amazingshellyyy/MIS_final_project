$(function() {
    $("#photo1").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
           
            reader.onload = function(e) {
                $('#show').append('<img src= "e.target.result" height="200px" width= "200px">');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});


$(
    function() {
        $("#btn1").click(function() {
            $('body').append('<div id="Shade"></div>');
            $('#Shade').css('opacity', 0.7).fadeIn();
            $("#tab").show(
            	);
            
        });
    }
);

$(
    function() {
        $("#btn3").click(function() {
            $("#tab").hide();
            $('#Shade').remove();
        });
    }
);

$(document).on("click", "#Shade", function() {
            
            $("#tab").hide();
            $('#Shade').remove();
});


$(function() {

            $( "#tab" ).draggable();
            $("#tab").mousedown(function(){
                $(this).css("cursor","pointer");
            }).mouseup(function(){
                $(this).css("cursor","default");
            });

        });

$(
    function() {
        $("#btn2").click(function() {
            $("#fatorange").append('<input class="key" type="text" name="" value="" placeholder="請輸入產品關鍵字......">');
            var a= $(".key").length;
            
        	if(a==5){
         		$("#btn2").css({'display':'none'});
            };
        });

    }
);

