
$(document).ready(function(){
    $("#setbutton1").click(function(){
        
        $("#setname1").hide();
        $("#setname2").show();
        $("#setclass1").hide();
        $("#setclass2").show();
        $("#setteacher1").hide();
        $("#setteacher2").show();
        $("#setmember1").hide();
        $("#setmember2").show();
        $("#settime1").hide();
        $("#settime2").show();
        $("#setmanage1").hide();
        $("#setmanage2").show();
        $("#setpower1").hide();
        $("#setpower2").show();
        
        $("#setbutton2").show();
     	$("#setbutton3").show();
    });
    $("#setbutton2").click(function(){
         $("#setname2").hide();
        $("#setname1").show();
        $("#setclass2").hide();
        $("#setclass1").show();
        $("#setteacher2").hide();
        $("#setteacher1").show();
        $("#setmember2").hide();
        $("#setmember1").show();
        $("#settime2").hide();
        $("#settime1").show();
        $("#setmanage2").hide();
        $("#setmanage1").show();
        $("#setpower2").hide();
        $("#setpower1").show();
        $("#setbutton1").show();
       
    });
   
});

