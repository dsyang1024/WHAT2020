<?php

$ip_address = $_SERVER["REMOTE_ADDR"];

if (isset($_POST['snl_sep_btn'])){
    exec("python3 seasonal_array.py $ip_address");
    exec("python3 regime_array.py $ip_address");
    exec("python3 graph.py $ip_address");
    exec("python3 seasonal_ML.py $ip_address");
    exec("python3 seasonal_bfi.py $ip_address");
    exec("python3 seasonal_separation.py $ip_address");
    echo("<script>location.replace('Analysis_SNL.php');</script>");
};

if (isset($_POST['fd_sep_btn'])){
    exec("python3 seasonal_array.py $ip_address");
    exec("python3 regime_array.py $ip_address");
    exec("python3 graph.py $ip_address");
    exec("python3 regime_ML.py $ip_address");
    exec("python3 regime_bfi.py $ip_address");
    exec("python3 regime_separation.py $ip_address");
    echo("<script>location.replace('Analysis_FD.php');</script>");
};

if (isset($_POST['org_sep_btn'])){
    echo("<script>location.replace('ORG_sep.php');</script>");
};

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Site Properties -->
        <title>WHAT 2020</title>
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/reset.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/site.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/container.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/grid.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/header.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/image.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/label.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/divider.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/segment.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/button.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/list.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/icon.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/transition.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/step.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/table.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/input.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/checkbox.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/message.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/dimmer.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/loader.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/progress.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/popup.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/form.css">

        <style type="text/css">

            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }

            .ui.action.input input[type="file"] {
                display: none;
            }

            #overlay {
                background: #ffffff;
                color: #666666;
                position: fixed;
                height: 100%;
                width: 100%;
                z-index: 5000;
                top: 0;
                left: 0;
                float: left;
                text-align: center;
                padding-top: 25%;
                opacity: 0.80;
            }

            .spinner {
                margin: 0 auto;
                height: 64px;
                width: 64px;
                animation: rotate 0.8s infinite linear;
                border: 5px solid firebrick;
                border-right-color: transparent;
                border-radius: 50%;
            }
            @keyframes rotate {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>

        <!--<script src="./imports/jquery.min.js"></script>-->
        <script src="./imports/jquery-2.0.2.js"></script>

        <script>

            $(window).load(function () {
                $("input:text").click(function () {
                    $(this)
                        .parent()
                        .find("input:file")
                        .click();
                });

                $('input:file', '.ui.action.input').on('change', function (e) {
                    var name = e
                        .target
                        .files[0]
                        .name;
                    $('input:text', $(e.target).parent()).val(name);
                });
            });

            function show_load() {
                $('#overlay').fadeIn()
                // .delay(900000) .fadeOut();
            }
        </script>

    </head>

    <body>

        <!--페이지-->
        <div class="ui very padded segment">

            <!--본문 내용-->
            <div class="ui container center aligned stackable">

                <!--분석 단계 표시하기-->
                <div class="ui mini unstackable steps">
                    <div class="active step">
                        <i class="upload icon"></i>
                        <div class="content">
                            <div class="title">Upload</div>
                        </div>
                    </div>
                    <div class="disabled step">
                        <i class="search icon"></i>
                        <div class="content">
                            <div class="title">Analyze</div>
                        </div>
                    </div>
                    <div class="disabled step">
                        <i class="download icon"></i>
                        <div class="content">
                            <div class="title">Result</div>
                        </div>
                    </div>
                </div>
                <!-- 분석 단계 표시 완료-->




                <!--유량자료 csv 업로드 공간-->
                <form
                    class="ui form center aligned grid segment"
                    method="post"
                    enctype="multipart/form-data"
                    action="./file_upload.php">
                    <!-- 예제 파일 다운로드 -->
                    <a
                        class="ui medium green center floated button"
                        data-tooltip="Sample data-set for run Y-Sep"
                        data-position="bottom center"
                        href="./example.csv"
                        id="example_button">
                        <i class="ui download icon"></i>
                        Example
                    </a>
                    <div class="ui action input">
                        <input type="text" placeholder="Click here to select file" readonly="readonly">
                        <input type="file" name='upload_file'>
                        <button
                            class="ui icon button"
                            type="submit"
                            data-tooltip="Upload streamflow data to server"
                            data-position="top right">
                            <i class="upload icon"></i>
                            Upload
                        </button>
                    </div>
                </form>
            </div>
            <!--파일 업로드 부분 완료-->
        </div>
        <!--유량자료 csv 업로드 공간 완료-->

        <!--분리방법 선택하기-->
        <div class="ui centered grid">
            <!--분리 방법 선택 및 페이지 이동 버튼-->
            <div>
                <div class="ui divider"></div>
                <div class="ui blue center aligned icon message">
                    <i class="check circle icon"></i>
                    <div class="content">
                        <div class="header">
                            Select Estimation Method :
                        </div>
                        <p>You can select Estimation method you would like to try.</p>
                    </div>
                </div>

                <form name="sep method" method="post" onsubmit="show_load()">
                    <input
                        name="fd_sep_btn"
                        type='submit'
                        class="ui large inverted blue button"
                        value='Flow Duration Estimation'
                        onclick="alert('Flow Duration Separation\nThis Will Take About A Minute\nClick Okay to Preceed')"></input>
                    <input
                        name="snl_sep_btn"
                        type='submit'
                        class="ui large inverted blue button"
                        value='Seasonal Estimation'
                        onclick="alert('Seasonal Separation\nThis Will Take About A Minute\nClick Okay to Preceed')"></input>
                    <input
                        name="org_sep_btn"
                        type='submit'
                        class="ui large inverted blue button"
                        value='Original Estimation'></input>
                </form>

                <!--분리방법 선택 및 페이지 이동 버튼 완료-->
            </div>
        </div>
        <!--본문 완료-->

        <div id="overlay" style="display:none;">
            <div class="spinner"></div>
            <br>
            Loading...
        </div>
        <!--페이지 완료-->

    </body>

</html>