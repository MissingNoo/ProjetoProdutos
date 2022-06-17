<?php
require_once("../conexao/conexao.php");
$q = $_GET['q'];
$CodigoPedido = $_GET['CodigoPedido'];
try {
    $comandoSQL = $conexao->prepare("SELECT id FROM Clientes WHERE Nome = '" . $q . "'");
    $comandoSQL->execute();
    if ($comandoSQL->rowCount() > 0) {
        $idC= $comandoSQL->fetch()[0];
        header("location:../../../index.php?page=5" . "&idCliente=" . $idC . "&CodigoPedido=" . $CodigoPedido);  
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
