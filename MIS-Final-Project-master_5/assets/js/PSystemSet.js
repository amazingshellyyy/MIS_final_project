function ShowContent(n, total, idstr) {
    for (var i = 1; i <= total; i++) {
        var e = document.getElementById(idstr + i);
        e.style.display = "none";
    }
    document.getElementById(idstr + n).style.display = "";
}
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


