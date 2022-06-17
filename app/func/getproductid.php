<?php
require_once("../conexao/conexao.php");
$q = $_GET['q'];
$CodigoPedido = $_GET['CodigoPedido'];
$CodigoCliente = $_GET['CodigoCliente'];
try {
    $comandoSQL = $conexao->prepare("SELECT id FROM Produtos WHERE Descricao = '" . $q . "'");
    $comandoSQL->execute();
    if ($comandoSQL->rowCount() > 0) {
        $idC= $comandoSQL->fetch()[0];
        header("location:../../../index.php?page=5" . "&idCliente=" . $CodigoCliente . "&CodigoPedido=" . $CodigoPedido . "&idProduto=" . $idC);  
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
