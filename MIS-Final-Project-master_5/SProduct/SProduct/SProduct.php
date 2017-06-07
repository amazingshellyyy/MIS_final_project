<!DOCTYPE html>

<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>jQuery UI Dialog - Default functionality</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="titatoggle-dist.css" rel="stylesheet">
    <script type="text/javascript" src="SProduct.js"></script>
    <link rel="stylesheet" href="SProduct.css">
</head>

<body>
    <br>
    <br>
    <br>
    <!-- 產品 -->
    <div class="container-fluid">
        <div class="tab">
        <div class="tab0">
        <br>

            <div class="col-sm-6">
            <h4>微積分期中報告(15點)</h4>
                <img id="productpicture0" src="pdf.png"></img>
                <br>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a href="pdf.png"><img class="productpicture1" src="pdf.png" href="#"></a>
                            <a href="pdf.png"><img class="productpicture1" src="pdf.png"></a>
                            <a href="/assets/images/documents/image.png"><img class="productpicture1" src="pdf.png"></a>
                        </div>
                        <div class="item">
                            <a href="word.png"><img class="productpicture1" src="word.png"></a>
                            <a href="word.png"><img class="productpicture1" src="word.png"></a>
                            <a href="word.png"><img class="productpicture1" src="word.png"></a>
                        </div>
                        <div class="item">
                            <a href="ppt.png"><img class="productpicture1" src="ppt.png"></a>
                            <a href="ppt.png"><img class="productpicture1" src="ppt.png"></a>
                            <a href="ppt.png"><img class="productpicture1" src="ppt.png"></a>
                        </div>
                        <div class="item">
                            <a href="exl.png"><img class="productpicture1" src="exl.png"></a>
                            <a href="exl.png"><img class="productpicture1" src="exl.png"></a>
                            <a href="exl.png"><img class="productpicture1" src="exl.png"></a>
                        </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <br>
                <br>
                <div class="col-sm-6">
                    <div class="list">
                        <h5>瀏覽次數: 1234次
                        <h5>購買次數: 123次

                        <h5>上架時間: 2017/03/13 17:00</h5>
                    </div>
                </div>
                <div class="col-sm-6">
                    <br>

                <div id="stars">
                </div>
                <div id="over">
                </div>
                    <br>
                    <br>
                    <br>
                </div>
                <div class="col-sm-12">
                    <div id="product1">
                        <div class="mainpage">
                            <br>
                            <br>
                            <br>
                            <table class="table">
                                <h5>基本資料</h5>
                                <br>
                                <tbody>
                                    <tr>
                                        <td>專案類型</td>
                                        <td>
                                            報告
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>檔案類型</td>
                                        <td>
                                            PDF
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>提供者</td>
                                        <td>
                                            鄭俊彥
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>參與者</td>
                                        <td>
                                            鄭俊彥, 黃晨浩, 阿姨, Sean, 許斾旟
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>課程名稱</td>
                                        <td>
                                            微積分
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>授課老師</td>
                                        <td>
                                            很小的人
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                            <button id="productbutton" type="button" class="btn btn-danger btn-s">直接購買</button>
                            <button id="productbutton" type="button" class="btn btn-primary btn-s">加入購物車</button>
                            <button id="productbutton" type="button" class="btn btn-warning btn-s">加入個人收藏</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product2" class="col-sm-12">
                <div>
                    <br>
                    <h5>詳細介紹:</h5>
                    <button id="detailbutton1" type="button" class="btn btn-default btn-xs">修改</button>
                    <hr>
                    <p id="detail1">無</p>
                    <textarea style="display:none" id="detail2" class="form-control" rows="3" placeholder="請輸入內容......"></textarea>
                    <br>
                    <button id="detailbutton2" style="display:none" type="button" class="btn btn-danger btn-xs">取消</button>
                    <button id="detailbutton3" style="display:none" type="button" class="btn btn-primary btn-xs">確認</button>
                    <hr>
                </div>
            </div>

            <div class="main2">
                <div class="post-left">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">編輯貼文</a></li>
                            <li><a href="#">隱藏貼文</a></li>
                            <li><a href="#">刪除貼文</a></li>
                        </ul>
                    </div>
                    <img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar">
                    <a href="#member001"> 黃晨浩</a>
                    <div id="time" class="glyphicon glyphicon-time">2017年2月3日</div>
                    <br>

                    <div id="stars0">
                    </div>
                    <div id="over0">
                    </div>
                <br>

                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>

                </div>
                <div class="post-right">
                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member004"> Sean</a> 你很棒!!!</h5>
                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member001"> 黃晨浩</a> 你更棒!!!</h5>
                    <h5><img id="guest" src="https://unwire.hk/wp-content/uploads/2014/10/facebook-user.jpg" class="img-circle" alt="Avatar"><a href="#member001"><a href="#member001"> 鄭俊彥</a> 我也很棒!!!</h5>

                    <a>...更多留言</a>
                    <form class="form-find">
                        <input type="text" class="form-findtext" placeholder="請輸入留言......">
                        <a class="btn">撰寫貼文</a>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>

</html>
