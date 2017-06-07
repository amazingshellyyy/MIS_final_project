function ShowContent(n, total, idstr) {
    for (var i = 1; i <= total; i++) {
        var e = document.getElementById(idstr + i);
        e.style.display = "none";
    }
    document.getElementById(idstr + n).style.display = "";
}


/**function ShowWindow(){
    var e= document.getElementById(idstr+ i);
    e.style.display= "none";


}
**/    
$(document).ready(function(){
    $("#memberbutton1").click(function(){
        
        $("#name1").hide();
        $("#name2").show();
        $("#department1").hide();
        $("#department2").show();
        $("#number1").hide();
        $("#number2").show();
        $("#password1").hide();
        $("#password2").show();
        $("#phone1").hide();
        $("#phone2").show();
        $("#introduction1").hide();
        $("#introduction2").show();
        $("#interests1").hide();
        $("#interests2").show();
        
        $("#memberbutton2").show();
     	$("#memberbutton3").show();
    });
    $("#memberbutton2").click(function(){
        $("#name2").hide();
        $("#name1").show();
         $("#department2").hide();
        $("#department1").show();
        $("#number2").hide();
        $("#number1").show();
        $("#password2").hide();
        $("#password1").show();
        $("#phone2").hide();
        $("#phone1").show();
        $("#introduction2").hide();
        $("#introduction1").show();
        $("#interests2").hide();
        $("#interests1").show();
        $("#memberbutton1").show();
       
    });
   
});

$(document).ready(function(){
    $("#safebutton1").click(function(){
        
        $("#alert1").hide();
        $("#alert2").show();
        $("#verify1").hide();
        $("#verify2").show();
        
        $("#forget1").hide();
        $("#forget2").show();
        $("#safebutton2").show();
     	$("#safebutton3").show();
    });
    $("#safebutton2").click(function(){
        $("#alert2").hide();
        $("#alert1").show();

        $("#verify2").hide();
        $("#verify1").show();
        $("#forget2").hide();
        $("#forget1").show();
        $("#safebutton1").show();
       
    });
   
});

$(document).ready(function(){
    $("#preferbutton1").click(function(){
        
        $("#language1").hide();
        $("#language2").show();
        $("#sound1").hide();
        $("#sound2").show();
        
        $("#notice1").hide();
        $("#notice2").show();
        $("#preferbutton2").show();
     	$("#preferbutton3").show();
    });
    $("#preferbutton2").click(function(){
        $("#language2").hide();
        $("#language1").show();

        $("#sound2").hide();
        $("#sound1").show();
        $("#notice2").hide();
        $("#notice1").show();
        $("#preferbutton1").show();
       
    });
   
});


/**
$(document).ready(function(){
    $("#passwordbutton1").click(function(){
        $("#passwordbutton1").hide();
        $("#passwordbutton2").show();
        $("#password1").hide();
        $("#password2").show();
        
    });
    $("#namebutton2").click(function(){
        $("#namebutton2").hide();
        $("#namebutton1").show();
        $("#name2").hide();
        $("#name1").show();
    });
   
});
$(document).ready(function(){
    $("#mailbutton1").click(function(){
        $("#mailbutton1").hide();
        $("#mailbutton2").show();
        $("#mail1").hide();
        $("#mail2").show();
    });
    $("#mailbutton2").click(function(){
        $("#mailbutton2").hide();
        $("#mailbutton1").show();
        $("#mail2").hide();
        $("#mail1").show();
    });
   
});
$(document).ready(function(){
    $("#phonebutton1").click(function(){
        $("#phonebutton1").hide();
        $("#phonebutton2").show();
        $("#phone1").hide();
        $("#phone2").show();
    });
    $("#phonebutton2").click(function(){
        $("#phonebutton2").hide();
        $("#phonebutton1").show();
        $("#phone2").hide();
        $("#phone1").show();
    });
   
});
$(document).ready(function(){
    $("#alertbutton1").click(function(){
        $("#alertbutton1").hide();
        $("#alertbutton2").show();
        $("#alert1").hide();
        $("#alert2").show();
    });
    $("#alertbutton2").click(function(){
        $("#alertbutton2").hide();
        $("#alertbutton1").show();
        $("#alert2").hide();
        $("#alert1").show();
    });
   
});
$(document).ready(function(){
    $("#verifybutton1").click(function(){
        $("#verifybutton1").hide();
        $("#verifybutton2").show();
        $("#verify1").hide();
        $("#verify2").show();
    });
    $("#verifybutton2").click(function(){
        $("#verifybutton2").hide();
        $("#verifybutton1").show();
        $("#verify2").hide();
        $("#verify1").show();
    });
   
});
$(document).ready(function(){
    $("#forgetbutton1").click(function(){
        $("#forgetbutton1").hide();
        $("#forgetbutton2").show();
        $("#forget1").hide();
        $("#forget2").show();
    });
    $("#forgetbutton2").click(function(){
        $("#forgetbutton2").hide();
        $("#forgetbutton1").show();
        $("#forget2").hide();
        $("#forget1").show();
    });
   
});
$(document).ready(function(){
    $("#languagebutton1").click(function(){
        $("#languagebutton1").hide();
        $("#languagebutton2").show();
        $("#language1").hide();
        $("#language2").show();
    });
    $("#languagebutton2").click(function(){
        $("#languagebutton2").hide();
        $("#languagebutton1").show();
        $("#language2").hide();
        $("#language1").show();
    });
   
});
$(document).ready(function(){
    $("#soundbutton1").click(function(){
        $("#soundbutton1").hide();
        $("#soundbutton2").show();
        $("#sound1").hide();
        $("#sound2").show();
    });
    $("#soundbutton2").click(function(){
        $("#soundbutton2").hide();
        $("#soundbutton1").show();
        $("#sound2").hide();
        $("#sound1").show();
    });
   
});
$(document).ready(function(){
    $("#namebutton1").click(function(){
        $("#namebutton1").hide();
        $("#namebutton2").show();
        $("#name1").hide();
        $("#name2").show();
    });
    $("#noticebutton2").click(function(){
        $("#noticebutton2").hide();
        $("#noticebutton1").show();
        $("#notice2").hide();
        $("#notice1").show();
    });
   
});



$(
    function name() {
        $("#namebutton").click(function() {
            $("#name").dialog();
        })
    }
)
$(
    function password() {
        $("#passwordbutton").click(function() {
            $("#password").dialog();
        })
    }
)
$(
    function mail() {
        $("#mailbutton").click(function() {
            $("#mail").dialog();
        })
    }
)
$(
    function phone() {
        $("#phonebutton").click(function() {
            $("#phone").dialog();
        })
    }
)
$(
    function alert() {
        $("#alertbutton").click(function() {
            $("#alert").dialog();
        })
    }
)
$(
    function verify() {
        $("#verifybutton").click(function() {
            $("#verify").dialog();
        })
    }
)
$(
    function forget() {
        $("#forgetbutton").click(function() {
            $("#forget").dialog();
        })
    }
)
$(
    function language() {
        $("#languagebutton").click(function() {
            $("#language").dialog();
        })
    }
)
$(
    function sound() {
        $("#soundbutton").click(function() {
            $("#sound").dialog();
        })
    }
)
$(
    function notice() {
        $("#noticebutton").click(function() {
            $("#notice").dialog();
        })
    }
)
$
**/
