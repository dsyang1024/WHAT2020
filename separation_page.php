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
                min-height: 500px;
                padding: 1em 0;
            }
            .masthead .logo.item img {
                margin-right: 1em;
            }
            .masthead .ui.menu .ui.button {
                margin-left: 0.5em;
            }
            .masthead h1.ui.header {
                margin-top: 2em;
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

            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
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
                    min-height: 200px;
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
            <a class="item" href="index.php">Home</a>
            <a class="active item" href="separation_page.php">Baseflow Estimation</a>
            <a class="item" href="manual.php" target="_blank">Manual</a>
            <a href="http://envsys.co.kr" target="_balnk" class="item">About Us</a>
        </div>

        <!-- Page Contents -->
        <div class="pusher">

            <div class="ui inverted vertical center aligned massive segment">

                <div class="ui container">
                    <div class="ui large secondary inverted pointing menu">
                        <a class="toc item">
                            <i class="sidebar icon"></i>
                        </a>
                        <a class="item" href="./index.php">Home</a>
                        <a class="active item" href="separation_page.php">Baseflow Estimation</a>
                        <a class="item" href="manual.php" target="_blank">Manual</a>
                        <a href="http://www.envsys.co.kr" target="_balnk" class="item">About Us</a>
                        <div class="right item">
                            <a
                                href="mailto:ysep2019@kakao.com?subject=Question%20about%20Ysep%20system"
                                class="ui inverted button">Contact Us</a>
                        </div>
                    </div>
                </div>

                <div class="ui container">
                    <h1 class="ui center aligned inverted large icon header">
                        <br/>
                        Baseflow Estimation
                    </h1>
                </div>

            </div>

            <iframe src="upload.php" width="100%" height="60%" align="middle"></iframe>

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

        </body>
    </html>