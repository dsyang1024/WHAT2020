<?php

$ip_address = $_SERVER["REMOTE_ADDR"];
exec("cp -pf ./regime_result.csv ./input/$ip_address/regime_result.csv");

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
            href="./imports/Semantic/components/label.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="./imports/Semantic/components/popup.css">

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
                padding: 5em 0;
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

            .ui.action.input input[type="file"] {
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

        <script src="./imports/d3.min.js?v=3.2.8"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body class="ui center aligned container">

        <div class="ui center aligned vertiacal stackable segment" style="width: 1000px" id="result_area">
            <!-- 스텝 보여주기 -->
            <div class="ui mini unstackable steps">
                <div class="disabled step">
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
                <div class="Active step">
                    <i class="download icon"></i>
                    <div class="content">
                        <div class="title">Result</div>
                    </div>
                </div>
            </div>



            <br/><br/>
            <!-- 기저유량 산정 매개변수 테이블 제시 -->
            <table class="ui blue table">
                <thead>
                    <tr class="center aligned">
                        <th>Index</th>
                        <th>a Parameter</th>
                        <th>BFI<sub>max</sub>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="center aligned">
                        <td id="flood_name"/>
                        <td id="flood_a"/>
                        <td class="bottom aligned" rowspan="3">
                            <br/><h3 id="bfimax"></h3>
                            <sup>*</sup>BFI<sub>max</sub>
                            means maximum<br/>probable baseflow occupancy<br/>from streamflow.
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td id="high_name"/>
                        <td id="high_a"/>
                    </tr>
                    <tr class="center aligned">
                        <td id="moderate_name"/>
                        <td id="moderate_a"/>
                    </tr>
                    <tr class="center aligned">
                        <td id="dry_name"/>
                        <td id="dry_a"/>
                    </tr>
                    <tr class="center aligned">
                        <td id="low_name"/>
                        <td id="low_a"/>
                    </tr>
                </tbody>

            </table>
            <!-- 결과 테이블 종료 -->



            <div class="ui center alingned segment">
                <!-- 기저유량 분리 그래프 보여주기 -->
                <button class="ui button" id="change-chart">Change to Classic or Refresh</button>
                <div id="chart_div" style="width: 100%; height: 500px;"></div>
            </div>
            
            
            
            
            <!-- FDC와 계절별 유황분석 그래프 추가하기 -->
            <div class="ui center alingned segment">
                <div class="ui two column padded grid">
                    <div class="column">
                        <div class="ui fluid image">
                            <div class="ui black ribbon label">
                                <i class="spoon icon"></i> Flow Duration Curve
                            </div>
                            <img src="FDC_graph.png">
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui fluid image">
                            <div class="ui blue ribbon label">
                                <i class="spoon icon"></i> Seasonal Flow Box-Plot
                            </div>
                            <img src="SNL_FDC_graph.png">
                        </div>
                    </div>
                </div>
             
                <div class="ui one column padded grid">
                    <div class='column'>
                        <div class="ui fluid image">
                            <div class="ui blue ribbon label">
                                <i class="spoon icon"></i> Seasonal Flow Duration Curve
                            </div>
                            <img src="SNLB_graph.png">
                        </div>
                    </div>
                </div>
            </div>




            <!-- 초기화면으로 넘어가기 -->
            <div class="ui center aligned segment">
                <button class="ui huge primary button" onclick="parent.location.href='./index.php'">Go Home
                    <i class="right arrow icon"></i>
                </button>

                <!-- 분리결과 csv 다운로드 하기 -->
                <a
                    class="ui huge green center floated button"
                    data-tooltip="a parameter result download"
                    data-position="top center"
                    href="./regime_result.csv"
                    id="example_button">
                    <i class="ui download icon"></i>
                    Separation Result
                </a>

                <a
                    class="ui huge yellow center floated button"
                    data-tooltip="system log download"
                    data-position="top center"
                    href="./input/<?php echo $ip_address;?>/<?php echo $ip_address;?>_sys_log.txt"
                    download="<?php echo $ip_address;?>_sys_log.txt"
                    id="system_log_button">
                    <i class="ui download icon"></i>
                    System Log
                </a>

                <!-- <button
                    class="ui huge yellow center floated button"
                    data-tooltip="Report to PDF"
                    data-position="top center"
                    id="create_pdf">
                    <i class="ui file icon"></i>
                    Analysis to PDF
                </button> -->
            <div>

        </div>




        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script
            type="text/javascript"
            src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="./imports/d3.min.js?v=3.2.8"></script>
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script type = "text/javascript" src = "https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script type = "text/javascript" src = "http://code.jquery.com/jquery-latest.min.js"></script>


        <!-- 구글 그래프 관련 스크립트 -->
        <script type="text/javascript">

            google
                .charts
                .load('current', {
                    'packages': ['line', 'corechart']
                });
            google
                .charts
                .setOnLoadCallback(drawChart);

            function drawChart() {

                var button = document.getElementById('change-chart');
                var chartDiv = document.getElementById('chart_div');

                var data = new google
                    .visualization
                    .DataTable();
                data.addColumn('number', 'Day');
                data.addColumn('number', 'Streamflow');
                data.addColumn('number', 'Baseflow');

                d3.text("regime_result.csv", function (csvdata) {
                    var parsedCSV = d3
                        .csv
                        .parseRows(csvdata);

                    var i;
                    for (i = 1; i < parsedCSV.length; i++) {
                        data.addRows([
                            [
                                i,
                                Number(parsedCSV[i][1]),
                                Number(parsedCSV[i][2])
                            ]
                        ]);
                    }
                });
                console.log("DATA FROM CSV")
                console.log(data);

                var materialOptions = {
                    height: 500,
                    chart: {
                        title: 'Baseflow Separation Result',
                        subtitle: 'in CMS unit'
                    },
                    hAxis: {
                        title: "Flow(CMS)",
                    },
                    legend: {
                        position: 'top',
                        alignment: 'center'
                    },
                };

            var classicOptions = {
                title: 'Baseflow Separation Result',
                subtitle: 'in CMS unit, (For further more detail, change to Classic Graph.',
                height: 500,
                vAxis: {
                    title: 'FLOW(CMS)'
                },
                hAxis: {
                    title: 'Time(days)'
                },
                crosshair: {
                    trigger: 'both'
                },
                explorer: {
                    actions: [
                        'dragToZoom', 'rightClickToReset'
                    ],
                    axis: 'horzontal',
                    maxZoomIn: 0.05,

                },
                'chartArea': {
                    'width': '90%',
                    'height': '70%'
                },
                'legend': {
                    'position': 'bottom'
                }
                // Gives each series an axis that matches the vAxes number below.
            };

            // Wait for the chart to finish drawing before calling the getIm geURI() method.
            

            function drawMaterialChart() {
                var materialChart = new google
                    .charts
                    .Line(chartDiv);
                materialChart.draw(data, materialOptions);
                button.innerText = 'Change to Classic or Refresh';
                button.onclick = drawClassicChart;
            }

            function drawClassicChart() {
                var classicChart = new google
                    .visualization
                    .LineChart(chartDiv);

                classicChart.draw(data, classicOptions);
                button.innerText = 'Change to Material or Refresh';
                button.onclick = drawMaterialChart;
            }

            drawMaterialChart();

        }
        </script>


        <!-- 테이블 관련 스크립트 -->
        <script type="text/javascript" charset="utf-8">

            $('#create_pdf').click(function() {
            //pdf_wrap을 canvas객체로 변환
            html2canvas($('#result_area')[0]).then(function(canvas) {
                var doc = new jsPDF('p', 'mm', 'a4'); //jspdf객체 생성
                var imgData = canvas.toDataURL('image/png'); //캔버스를 이미지로 변환
                doc.addImage(imgData, 'PNG', 0, 0); //이미지를 기반으로 pdf생성
                doc.save('sample-file.pdf'); //pdf저장
            });
            });



            // CSV 파일에서 a 변수 bfimax 가져오기
            d3.text("regime_a.csv", function (data) {
                var parsedCSV = d3
                    .csv
                    .parseRows(data);
                console.log(parsedCSV);
                var flood_name = parsedCSV[2][0];
                var flood_a = parsedCSV[2][3];
                var high_name = parsedCSV[3][0];
                var high_a = parsedCSV[3][3];
                var moderate_name = parsedCSV[4][0];
                var moderate_a = parsedCSV[4][3];
                var low_name = parsedCSV[5][0];
                var low_a = parsedCSV[5][3];
                var dry_name = parsedCSV[6][0];
                var dry_a = parsedCSV[6][3];
                var bfimax = parsedCSV[8][1];


                document
                    .getElementById("flood_a")
                    .innerHTML = flood_a.toString();
                document
                    .getElementById("flood_name")
                    .innerHTML = flood_name.toString();
                document
                    .getElementById("high_a")
                    .innerHTML = high_a.toString();
                document
                    .getElementById("high_name")
                    .innerHTML = high_name.toString();
                document
                    .getElementById("moderate_a")
                    .innerHTML = moderate_a.toString();
                document
                    .getElementById("moderate_name")
                    .innerHTML = moderate_name.toString();
                document
                    .getElementById("low_a")
                    .innerHTML = low_a.toString();
                document
                    .getElementById("low_name")
                    .innerHTML = low_name.toString();
                document
                    .getElementById("dry_a")
                    .innerHTML = dry_a.toString();
                document
                    .getElementById("dry_name")
                    .innerHTML = dry_name.toString();
                document
                    .getElementById("bfimax")
                    .innerHTML = bfimax.toString();
            });
        </script>

    </body>

</html>