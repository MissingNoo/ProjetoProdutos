<?php
require_once("../conexao/conexao.php");
try {

    $comandoSQL = $conexao->prepare("INSERT INTO `Pedidos` 
            (`id`, `Cliente`, `Items`) 
            VALUES 
            (:codigo, :cliente, :items)
        ");
    
    $comandoSQL->execute(array(
        ':codigo'           => $_GET['CodigoPedido'],
        ':cliente'            => $_GET['CodigoCliente'],
        ':items'            => $_GET['item']
    ));

    
    if ($comandoSQL->rowCount() > 0) {
        echo "Sucesso!";
        header("location:../../index.php?page=5" . "&CodigoPedido=" . $_GET['CodigoPedido']);        
    } else {
        echo "Erro ao inserir dados no banco";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
