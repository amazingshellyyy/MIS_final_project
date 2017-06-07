<!DOCTYPE html>

<html lang="en">

<head>
    <!-- <title>Bootstrap Example</title> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <meta charset="utf-8">
    <!-- <title>jQuery UI Dialog - Default functionality</title> -->
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

    <script type="text/javascript" src="SCreate.js"></script>
    <link rel="stylesheet" href="SCreate.css">
</head>

<body>

    <!-- 產品 -->

    <div>
        <button type="button" id="btn1">編輯</button>
        <div id="tab" style="display: none">
            <div class="tab0">

                <span class="close" id="btn3"></span>

                <form>
                <div id="name">

                    <h4>產品名稱:</h4>
                    <br>
                    <input class="name" type="text" name="" value="" placeholder="請輸入產品名稱......">
                    <hr>
                </div>
                <div id="price">
                    <h4>產品價格:</h4>
                    <br>
                    <input class="price" type="text" name="" value="" placeholder="請輸入產品點數......">
                    <hr>
                </div>
                <div id="post">
                    <h4>產品介紹:</h4>
                    <br>
                    <textarea class="post" rows="3" placeholder="請輸入介紹內容......"></textarea>
                    <hr>
                </div>
                <div>
                    <h4>產品關鍵字:</h4>
                    <br>
                    <div id="fatorange">
                    <input class="key" type="text" name="" value="" placeholder="請輸入產品關鍵字......">

                    </div>
                    <div class="btn2">
                    <button type="button" id="btn2">+</button>
                    </div>
                </div>

                    <hr>
                    <br>
                    <button id="postsend" type="button">完成</button>
                </form>
            </div>

        </div>

    </div>
</body>

</html>
