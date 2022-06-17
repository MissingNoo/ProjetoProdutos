<?php
session_start();

?>
<style>
    body::after {
        content: "";
        background: url('../img/logo.png');
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.4;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
    }
</style>

<body>
    <div class="espaco-v"></div>

    <!--abre um espaço entre os containers-->
    <div style="height: 85px; margin-left:47%; margin-bottom: 7px" class="centralizar-h">
        <a href="/"><img class="centralizar-v" style="width: 10%;" src="/img/logo.png" alt="alt" /></a>
    </div>
    <div style="float: right; background-color: red;" class="centralizar-h">
    </div>
</body>

</html>