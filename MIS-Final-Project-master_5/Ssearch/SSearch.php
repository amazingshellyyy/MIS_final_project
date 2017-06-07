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
    <script type="text/javascript" src="assets/js/SSearch.js"></script>
    <link rel="stylesheet" href="assets/css/SSearch.css">
</head>

<body>
    <div class="top">
        <img class="logo" src="assets/images/logoorg-04.png" width="150" right="15">
         <hr>
        <div class="result">搜尋結果:會計學報告共123筆資料
        </div>

        <div class="srchbox">會計學報告</div>
        <img class="goicon" src="http://cdn.onlinewebfonts.com/svg/download_80698.png">
    </div>
        <!-- 進階搜尋 -->
        <div class="col-sm-3">

                <form class="form-find">
                    <h5>搜尋:</h5>
                    <input type="text" placeholder="請輸入專案名稱......">
                    <br>
                    <br>
                    <input type="text" placeholder="請輸入提供者名稱......">
                    <br>
                    <br>
                    <button type="submit" class="btn btn-default btn-xs">搜尋</button>

                    <h5>結果排序:</h5>
                    <select>
                        <option>依照上傳時間</option>
                        <option>依照評價</option>
                        <option>依照購買人數</option>
                        <option>依照點數</option>
                    </select>
                </form>

        </div>
        <div>
            <!-- 產品大框 -->
            <div class="pr" id="result">
            <!-- 產品小框 -->
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                        <div id="productnm">會計學報告</div>
                        <div id="productown">鄭俊彥</div>
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    <!-- <div >2017-10-10</div> -->
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    <!-- <div >2017-10-10</div> -->
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    <!-- <div >2017-10-10</div> -->
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    <!-- <div >2017-10-10</div> -->
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
                <div class="probox">
                    <img id="productpicture" src="assets/images/exl.png">
                    </img>
                    <div id="maininfo">
                    <div id="productnm">會計學報告</div>
                    <div id="productown">鄭俊彥</div>
                    <!-- <div >2017-10-10</div> -->
                    </div>
                    <div class="infobox">
                        <div id="star">
                            <img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star1" class="star" src="assets/images/star1.png"><img id="star2" class="star" src="assets/images/star2.png"><img id="star3" class="star" src="assets/images/star3.png">
                        </div>
                        <div id="views">瀏覽次數：000000次</div>
                        <div id="dltimes">購買次數：000000次</div>
                    </div>
                    <div id="price">$000</div>
                </div>
            </div>
            <div class="pagebtn"></div>
        </div>
    </div>
</body>

</html>
