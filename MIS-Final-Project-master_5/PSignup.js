$(document).ready(function() {
    $("#photo1").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $("#show1").show();
            reader.onload = function(e) {
                $('#show1').attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        };
    });
});

