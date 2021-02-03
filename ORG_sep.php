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

        <script>
            function enablebtn() {
                document
                    .getElementById("Sep_btn")
                    .disabled = false;
            };

        </script>

    </head>

    <body>

        <div class="ui placeholder segment">
            <div class="ui two column grid">
                <div class="column center aligned">
                    <form
                        class="ui form"
                        method="POST"
                        action='org_sep_info.php'
                        target="graph_frame"
                        onsubmit="enablebtn()">

                        <div class="required field">
                            <label>a Parameter</label>
                            <div class="ui left icon input">
                                <input type="text" placeholder="0.0~1.0" id="a_par" name="a_par"/>
                                <i class="filter icon"></i>
                            </div>
                        </div>

                        <div class="required field">
                            <label>BFI<sub>max</sub>
                            </label>
                            <div class="ui left icon input">
                                <input type="text" placeholder="0.0~1.0" id="bfi_max" name="bfi_max"/>
                                <i class="lightbulb icon"></i>
                            </div>
                        </div>

                        <input
                            type="submit"
                            name="checkp"
                            id="checkp"
                            class="ui blue submit button"
                            value="Check Parameters"></input>

                    </form>
                </div>

                <div class="middle aligned column">

                    <!-- 이 버튼 클릭하면 Graph_frame 업데이트 하는거야!!!!!!!!! -->
                    <form
                        class="ui form"
                        method="POST"
                        action='org_graph.php'
                        target="graph_frame">
                        <input
                            type="submit"
                            class="ui big green button"
                            name="Sep_btn"
                            id="Sep_btn"
                            value="Go Separation"
                            disabled="disabled"></input>
                    </form>
                </div>

            </div>

            <div class="ui vertical divider">
                AND
            </div>

        </div>

        <!-- 여기서 부터 그래프가 등장한다. 처음엔 빈 공간 -->
        <iframe
            name="graph_frame"
            src="org_sep_info.php"
            height="100%"
            width="100%"
            frameborder="0"></iframe>
    </body>

</html>