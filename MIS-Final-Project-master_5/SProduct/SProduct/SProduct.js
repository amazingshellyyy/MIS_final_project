$(document).ready(function(){
    $("#detailbutton1").click(function(){
        
        $("#detail1").hide();
        $("#detail2").show();
        $("#detailbutton1").hide();
        $("#detailbutton2").show();
     	$("#detailbutton3").show();
    });
    $("#detailbutton2").click(function(){
        $("#detail2").hide();
        $("#detail1").show();
        $("#detailbutton2").hide();
     	$("#detailbutton3").hide();
        $("#detailbutton1").show();
       
    });
   
});

$(function(){
    
    var $showImage = $('#productpicture0');
 
    $('.item active a').mouseover(function(){
        
        $showImage.attr('src', $(this).attr('href'));
    }).click(function(){
        
        return false;
    }); 
    
    $('.item a').mouseover(function(){
        
        $showImage.attr('src', $(this).attr('href'));
    }).click(function(){
        
        return false;
    });
});

$(function(){ 
        var star=3.2;
        $('#over').attr('style', 'width:' + 30*star + 'px;');
        
    });

$(function(){ 
        var star=1.5;
        $('#over0').attr('style', 'width:' + 15*star + 'px;');
        
    });  
// $(function() {
//     $("#photo1").change(function() {
//         if (this.files && this.files[0]) {
//             var reader = new FileReader();
//             $("#show1").show();
//             reader.onload = function(e) {
//                 $('#show1').attr('src', e.target.result);
//             }

//             reader.readAsDataURL(this.files[0]);
//         }
//     });
// });

// var spans=document.getElementsByTagName("span");
//               var flag=5;//这个值随便取，只要不是01234就行
//               var Expand=function(){
//                   //扩展代码，暂无
//               };
              
//               onload=function(){
//                  //循环载入鼠标移入事件
//                  for(var i=0;i<spans.length;i++){
//                      spans[i].onmouseover=function(){
//                          var id=parseInt(this.id);
//                             for(var i=0;i<=id;i++){
//                                  spans[i].innerHTML="★";
//                              }
//                              for(var j=id+1;j<5;j++){
//                                  spans[j].innerHTML="☆";
//                              }
//                      };
//                  }
//                  //循环载入鼠标点击星星事件
//                  for(var i=0;i<spans.length;i++){
//                      spans[i].onclick=function(){
//                          var id=parseInt(this.id);
//                          flag=id;
//                          for(var i=0;i<=id;i++){
//                              spans[i].innerHTML="★";
//                          }
//                          Expand();//这里是鼠标点击星星的扩展，例如出现分值之类的，总之要扩展什么随你的大小便啦~
//                      };
//                  }
//                  //载入鼠标离开div事件
//                  document.getElementById("div").onmouseout=function(){
//                      //如果tag是3，则循环给把0 1 2 3几个星星整黄
//                      if(flag>=0 && flag<=4){
//                          for(var i=0;i<=flag;i++){
//                              spans[i].innerHTML="★";
                             
//                          }
//                          for(var j=flag+1;j<5;j++){
//                              spans[j].innerHTML="☆";
//                          }
//                      }
//                      //如果tag没有值或者是初值5，则把所有的星星还原成空星星
//                      else{
//                          for(var i=0;i<spans.length;i++)
//                          {
//                              spans[i].innerHTML="☆";
//                          }
//                      }
//                  };
//              };
// </script>