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
</head>

<body>
    <div id="mySidenav" class="sidenav">
    <?php
        if (isset($_SESSION["nome"]) == true) {
            echo "<a>Usuario: {$_SESSION["nome"]} </a>";
        } else {
            echo "<a href='../login.php'>Logar</a>/<a href='url'>Registrar</a>";
        }
    ?>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        
        <a href="javascript:void(0)" onclick="Menu('1')">Inicio</a>
        <a href="javascript:void(0)" onclick="Menu('2')">Cadastro Clientes</a>
        <a href="javascript:void(0)" onclick="Menu('3')">Cadastro Cidades</a>
        <a href="javascript:void(0)" onclick="Menu('4')">Cadastro Produto</a>
        <a href="javascript:void(0)" onclick="Menu('5')">Venda</a>
        <a style="color:red;" href='../login.php'>Deslogar</a>
    </div>
    <span style="font-size: 60px; float: left;" onclick="openNav()">&#9776;</span>
    
    <div id="main">
    <?php require_once 'app/_topo.php'; ?>
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
        <div id="5" style="display: none;">
            <?php require_once("app/venda.php"); ?>
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