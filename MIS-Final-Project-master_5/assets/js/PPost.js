function ShowContent(n, total, idstr) {
    for (var i = 1; i <= total; i++) {
        var e = document.getElementById(idstr + i);
        e.style.display = "none";
    }
    document.getElementById(idstr + n).style.display = "";
}
$(
    function vote() {
        $("#votebutton").click(function() {
            $("#vote").dialog();
        })
    }
)
$(document).ready(function() {
    $("#newvotebutton").click(function() {
        $("#newvote").append(
            $('<textarea/>')
            .attr('placeholder', '投票選項......')
            .attr('rows', '1')
            .attr('class', 'form-control')
        );
    });
});
$(function() {
    $("#photo1").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $("#show1").show();
            reader.onload = function(e) {
                $('#show1').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});

$(function() {
    $("#photo2").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $("#show2").show();
            reader.onload = function(e) {
                $('#show2').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});

$(document).ready(function() {
    $("#postsend").click(function() {
        $("#post").append('<div class="main2">                <div class="post-left">                    <div class="dropdown">                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">                            <span class="caret"></span></button>                        <ul class="dropdown-menu">                            <li><a href="#">編輯貼文</a></li>                            <li><a href="#">隱藏貼文</a></li>                            <li><a href="#">刪除貼文</a></li>                        </ul>                    </div>                    <img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar">                    <a href="#member001"> 黃晨浩</a>                    <div id="time" class="glyphicon glyphicon-time">2017年2月3日</div>                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>                    <div class="btn-group2">                        <button type="button" class="btn btn-warning btn-xs">收藏貼文</button>                        <button type="button" class="btn btn-success btn-xs">置頂貼文</button>                    </div>                </div>                <div class="post-right">                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member004"> Sean</a> 你很棒!!!</h5>                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member001"> 黃晨浩</a> 你更棒!!!</h5>                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member001"> 鄭俊彥</a> 我也很棒!!!</h5>                                        <a>...更多留言</a>                    <form class="form-find">                        <input type="text" class="form-findtext" placeholder="請輸入留言......">                        <a class="btn">撰寫貼文</a>                    </form>                                   </div>            </div>');

    });
});
