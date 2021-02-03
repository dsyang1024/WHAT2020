<?php
$ip_address = $_SERVER["REMOTE_ADDR"];
$a_par = $_POST["a_par"];
$bfi_max = $_POST["bfi_max"];

exec("python3 original_separation.py $ip_address $a_par $bfi_max");
?>

<!DOCTYPE html>
<html>

    <head></head>
    <body>
        <h3>a Parameter is set as:
            <h3 id="a_par"/></h3>
        <h3>BFI<sub>max</sub>
            is set as:
            <h3 id="bfi_max"/></h3>
        <p>Normally, a Parameter referred from recession trend.<br/>
            and BFI<sub>max</sub>
            means "Maximum probable baseflow portion".<br/><br/>
            If you don't input parameters, these will be set as default values.<br/>
            a Parameter :: 0.95 BFI<sub>max</sub>
            :: 0.8
        </p>
    </body>

    <script>
        var a_par = '<? echo $_POST["a_par"]?>';
        var bfi_max = '<? echo $_POST["bfi_max"]?>';

        if (a_par == "") {
            a_par = 0.95;
        };
        if (bfi_max == "") {
            bfi_max = 0.8;
        };

        parseFloat(a_par);
        parseFloat(bfi_max);

        console.log(a_par);
        console.log(bfi_max);

        document
            .getElementById("a_par")
            .innerHTML = a_par.toString();
        document
            .getElementById("bfi_max")
            .innerHTML = bfi_max.toString();
    </script>

</html>