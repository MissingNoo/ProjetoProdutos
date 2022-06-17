<?php
require_once("../conexao/conexao.php");
try {

    $comandoSQL = $conexao->prepare("DELETE FROM `Pedidos` WHERE `id`=" . $_GET['CodigoPedido']);
    
    $comandoSQL->execute();    
    if ($comandoSQL->rowCount() > 0) {
        echo "Sucesso!";
        header("location:../../index.php?page=5");
    } else {
        echo "Erro ao inserir dados no banco";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
