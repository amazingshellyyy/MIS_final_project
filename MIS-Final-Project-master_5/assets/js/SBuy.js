function ShowBuy(n, total, idstr) {
    for (var i = 1; i <= total; i++) {
        var e = document.getElementById(idstr + i);
        e.style.display = "none";
    }
    document.getElementById(idstr + n).style.display = "";
}

function checkalla(obj, aName) {
    var checkboxs = document.getElementsByName(aName);
    for (var i = 0; i < checkboxs.length; i++) { checkboxs[i].checked = obj.checked; }
}

function checkallb(obj, bName) {
    var checkboxs = document.getElementsByName(bName);
    for (var i = 0; i < checkboxs.length; i++) { checkboxs[i].checked = obj.checked; }
}



$(document).ready(function() {
    $("#buy12button").click(function() {

        $("#buy11").hide();
        $("#buy12").show();
    });
    $("#buy11button").click(function() {

        $("#buy12").hide();
        $("#buy11").show();
    });

});
