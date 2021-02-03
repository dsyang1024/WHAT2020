

<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Site Properties -->
        <title>WHAT 2020 :: KNU</title>




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
            href="./imports/Semantic/components/menu.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/divider.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/dropdown.css">
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
            href="./imports/Semantic/components/sidebar.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/transition.css">

        <style type="text/css">

            .hidden.menu {
                display: none;
            }

            .masthead.segment {
                min-height: 700px;
                padding: 1em 0;
            }
            .masthead .logo.item img {
                margin-right: 1em;
            }
            .masthead .ui.menu .ui.button {
                margin-left: 0.5em;
            }
            .masthead h1.ui.header {
                margin-top: 3em;
                margin-bottom: 0;
                font-size: 4em;
                font-weight: normal;
            }
            .masthead h2 {
                font-size: 1.7em;
                font-weight: normal;
            }

            .ui.vertical.stripe {
                padding: 8em 0;
            }
            .ui.vertical.stripe h3 {
                font-size: 2em;
            }
            .ui.vertical.stripe .button + h3,
            .ui.vertical.stripe p + h3 {
                margin-top: 3em;
            }
            .ui.vertical.stripe .floated.image {
                clear: both;
            }
            .ui.vertical.stripe p {
                font-size: 1.33em;
            }
            .ui.vertical.stripe .horizontal.divider {
                margin: 3em 0;
            }

            .quote.stripe.segment {
                padding: 0;
            }
            .quote.stripe.segment .grid .column {
                padding-top: 5em;
                padding-bottom: 5em;
            }

            .footer.segment {
                padding: 1em 0;
            }

            .secondary.pointing.menu .toc.item {
                display: none;
            }

            @media only screen and (max-width: 700px) {
                .ui.fixed.menu {
                    display: none !important;
                }
                .secondary.pointing.menu .item,
                .secondary.pointing.menu .menu {
                    display: none;
                }
                .secondary.pointing.menu .toc.item {
                    display: block;
                }
                .masthead.segment {
                    min-height: 350px;
                }
                .masthead h1.ui.header {
                    font-size: 2em;
                    margin-top: 1.5em;
                }
                .masthead h2 {
                    margin-top: 0.5em;
                    font-size: 1.5em;
                }
            }
        </style>

        <script src="./imports/jquery.min.js"></script>
        <script src="./imports/Semantic/components/visibility.js"></script>
        <script src="./imports/Semantic/components/sidebar.js"></script>
        <script src="./imports/Semantic/components/transition.js"></script>
        <script>
            $(document).ready(function () {

                // fix menu when passed
                $('.masthead').visibility({
                    once: false,
                    onBottomPassed: function () {
                        $('.fixed.menu').transition('fade in');
                    },
                    onBottomPassedReverse: function () {
                        $('.fixed.menu').transition('fade out');
                    }
                });

                // create sidebar and attach to menu open
                $('.ui.sidebar').sidebar('attach events', '.toc.item');

            });
        </script>
    </head>
    <body class="pushable">

        <!-- Sidebar Menu -->
        <div class="ui vertical inverted sidebar menu left" style="">
            <a class="active item" href="./index.php">Home</a>
            <a class="item" href="separation_page.php">Baseflow Estimation</a>
            <a class="item" href="manual.php" target="_blank">Manual</a>
            <a href="http://me.go.kr/hg/web/main.do" target="_balnk" class="item">About Us</a>
        </div>

        <!-- Page Contents -->
        <div class="pusher">

            <div class="ui inverted masthead vertical center aligned segment">

                <div class="ui container">
                    <div class="ui large secondary inverted pointing menu">
                        <a class="toc item">
                            <i class="sidebar icon"></i>
                        </a>
                        <a class="active item" href="./index.php">Home</a>
                        <a class="item" href="./separation_page.php">Baseflow Estimation</a>
                        <a class="item" href="manual.php" target="_blank">Manual</a>
                        <a href="http://www.envsys.co.kr" target="_balnk" class="item">About Us</a>
                        <div class="right item">
                            <a
                                href="mailto:dsyang1024@gmail.com?subject=Question%20about%20WHAT2020%20system"
                                class="ui inverted button">Contact Us</a>
                        </div>
                    </div>
                </div>

                <div class="ui container">
                    <h1 class="ui center aligned big image">
                        <img
                            class="ui centered image"
                            src="./assets/what_logo_white.png"
                            id="ysep_ui_white"
                            alt="">
                    </h1>
                    <h2><br/>Web-based Hydrograph Analysis Tool<br/><br/>
                        By Dongseok Yang, *Kyoungjae Lim</h2>
                        <h3><br/>Kangwon National University<br/>Konkuk University<br/>Han River Basin Environmental Office</h3>
                    <br/>
                    <!--분리페이지로 이동하는 버튼-->
                    <button
                        class="ui huge primary button"
                        onclick="location.href='./separation_page.php'">Get Estimation
                        <i class="right arrow icon"></i>
                    </button>
                </div>
            </div>

            <div class="ui vertical stripe segment">
                <div class="ui middle aligned stackable grid container">
                    <div class="row">
                        <div class="eight wide column">
                            <h3 class="ui header">[WHAT 2020] Helps You To Consider Subjective Watershed Streamflow Characteristic</h3>
                            <p>We let you recession chraceristic of streamflow when considering both season
                                and flow regime using MRC.</p>
                            <h3 class="ui header">[WHAT 2020] Suggests You The most Intuitive But Complex
                                Baseflow Estimation Results Automatically
                            </h3>
                            <p>We imported Tensorflow and Python for effective estimation. See how much
                                reasonable estimation results made.</p>
                        </div>
                        <div class="six wide right floated column">
                            <img src="assets/separation_graph.png" class="ui large bordered rounded image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="center aligned column">
                            <a class="ui huge button" href="manual.php" target="_blank">See The Manual</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui vertical stripe quote segment">
                <div class="ui equal width stackable internally celled grid">
                    <div class="center aligned row">
                        <div class="column">
                            <h3>"Seasonal Estimation"</h3>
                            <p>Streamflow recess depending on the seasonal precipitation.</p>
                        </div>
                        <div class="column">
                            <h3>"Flow Duration Estimation"</h3>
                            <p>In each section of flow regime, streamflow recess differently.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui inverted vertical footer segment">
                <div class="ui container">
                    <div class="ui stackable inverted divided equal height stackable grid">
                        <div class="three wide column">
                            <h4 class="ui inverted header">About</h4>
                            <div class="ui inverted link list">
                                <a href="http://www.envsys.co.kr" target="_balnk" class="item">Kangwon National University</a>
                                <a href="http://www.konkuk.ac.kr" target="_balnk" class="item">Konkuk University</a>
                                <a href="http://me.go.kr/hg/web/main.do" target="_balnk" class="item">Han River Basin Environmental Office</a>
                                <a href="#" target="_balnk" class="item">Dongseok Yang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>