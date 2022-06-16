<?php
session_start();
if (isset($_SESSION["nome"]) == false) {
    session_unset();
    session_destroy();
    header("location:./login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./css/grids.css">
    <link rel="stylesheet" href="./css/formulario.css">
    <link rel="stylesheet" href="./css/estilo.css">
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
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="javascript:void(0)" onclick="Menu('1')">Inicio</a>
        <a href="javascript:void(0)" onclick="Menu('2')">Cadastro Clientes</a>
        <a href="javascript:void(0)" onclick="Menu('3')">Cadastro Cidades</a>
        <a href="javascript:void(0)" onclick="Menu('4')">Cadastro Produto</a>
    </div>

    <!-- Use any element to open the sidenav -->
    <span style="font-size: 60px; float: left;" onclick="openNav()">&#9776;</span>
    <?php require_once 'app/_topo.php'; ?>
    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">


        <div id="1" style="display: none;">
            <?php require_once("app/inicio.php"); ?>
        </div>
        <div id="2" style="display: none;">
            <?php require_once("app/cadastroClientes.php"); ?>
        </div>
        <div id="3" style="display: none;">
            <?php require_once("app/cadastroCidades.php"); ?>
        </div>
        <div id="4" style="display: none;">
            <?php require_once("app/cadastroProdutos.php"); ?>
        </div>

    </div>
</body>

</html>
<script type="text/javascript" src="app/scripts.js"></script>
<script>
    <?php
    if (isset($_GET['page'])) {
        $a = $_GET['page'];
        echo "Menu($a);";
    }
    ?>
</script>