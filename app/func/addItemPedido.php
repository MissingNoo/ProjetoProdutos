<?php
require_once("../conexao/conexao.php");
$CodigoPedido = $_GET['CodigoPedido'];
try {
    $comandoSQL = $conexao->prepare("SELECT Items FROM Pedidos WHERE id=" . $CodigoPedido);
    $comandoSQL->execute();
    if ($comandoSQL->rowCount() > 0) {
        $p = $comandoSQL->fetch();
        $items = $p[0];
    }
    
    $comandoSQL = $conexao->prepare("UPDATE Pedidos
    SET Items=:items
    WHERE id=:id
        ");
    
    $comandoSQL->execute(array(
        ':id'           => $CodigoPedido,
        ':items'            => $items . "|" . $_GET["item"]
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
