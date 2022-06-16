<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/grids.css">
    <link rel="stylesheet" href="../css/formulario.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <div class="espaco-v"></div>
    
    <!--abre um espaço entre os containers-->
    <div style="height: 85px; margin-left:47%; margin-bottom: 7px" class="centralizar-h">
        <a href="/"><img class="centralizar-v" style="width: 10%;" src="/img/logo.png" alt="alt" /></a>
    </div>
    <div style="height: 85px;" class="centralizar-h">

        <h1>ProjetoProdutos</h1>

    </div>
    <div style="float: right; background-color: red;" class="centralizar-h">
        <?php
        session_start();
        if (isset($_SESSION["nome"]) == true) {
            echo "<p>Usuario: {$_SESSION["nome"]} </p>";
        } else {
            echo "<a href='../login.php'>Logar</a>/<a href='url'>Registrar</a>";
        }
        ?>
    </div>
</body>

</html>