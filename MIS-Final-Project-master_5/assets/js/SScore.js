// $(function() {
//     $("#photo1").change(function() {
//         if (this.files && this.files[0]) {
//             var reader = new FileReader();
//             $("#show1").show();
//             reader.onload = function(e) {
//                 $('#show1').attr('src', e.target.result);
//             }
//
//             reader.readAsDataURL(this.files[0]);
//         }
//     });
// });
//
// ★
// var spans= document.getElementsByTagName("span");
// alert(spans);
// var flag= 5;
// var Expand= function() {
// };
//
// onload = function() {
//
//     for (var i= 0; i< spans.length; i++) {
//         spans[i].onmouseover = function() {
//             var id = parseInt(this.id);
//             for (var i= 0; i<= id; i++) {
//                 spans[i].innerHTML = "★";
//             }
//             for (var j= id+ 1; j< 5; j++) {
//                 spans[j].innerHTML = "☆";
//             }
//         };
//     }
//
//     for (var i= 0; i< spans.length; i++) {
//         spans[i].onclick = function() {
//             var id= parseInt(this.id);
//             flag= id;
//             for (var i= 0; i<= id; i++) {
//                 spans[i].innerHTML = "★";
//             }
//             document.getElementById("score").value= flag+1;
//             Expand();
//         };
//     }
//
//
//
//     document.getElementById("div").onmouseout = function() {
//
//         if (flag>= 0&& flag<= 4) {
//             for (var i= 0; i<= flag; i++) {
//                 spans[i].innerHTML= "★";
//
//             }
//             for (var j= flag+ 1; j< 5; j++) {
//                 spans[j].innerHTML= "☆";
//             }
//         }
//
//         else {
//             for (var i= 0; i< spans.length; i++) {
//                 spans[i].innerHTML= "☆";
//             }
//         }
//     };
// };

$(function(){
    var a= 0;

    $(".span").click(function(){
        for(a=1; a< parseInt(this.id)+1; a++){
            $("#"+a).html("★");
            document.getElementById("score").value= a;
        };
    });

    $(".span").hover(function(){
        for(var i=1; i< parseInt(this.id)+1; i++){
            $("#"+i).html("★");
        };

    },function(){
        for(var i=1; i< 6; i++){
            $("#"+i).html("☆");
        };
        for(var i=1; i< a; i++){
            $("#"+i).html("★");
        };
    });


});



$(
    function() {
        $(".ratebtn").click(function() {
            $('body').append('<div id="Shade"></div>');
            $('#Shade').css('opacity', 0.7).fadeIn();
            $("#tabtab").show(
                );

        });
    }
);

$(
    function() {
        $("#btn03").click(function() {
            $("#tabtab").hide();
            $('#Shade').remove();
        });
    }
);

$(document).on("click", "#Shade", function() {

            $("#tabtab").hide();
            $('#Shade').remove();
});
