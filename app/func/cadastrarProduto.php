<?php
require_once("../conexao/conexao.php");
try {

    $comandoSQL = $conexao->prepare("INSERT INTO `Produtos` 
            (`id`, `Descricao`, `Valor`, `Estoque`) 
            VALUES 
            (:codigo, :descricao, :valor, :estoque) 
            ON DUPLICATE KEY UPDATE
            Descricao=:descricao, Valor=:valor, Estoque=:estoque
        ");
    
    $comandoSQL->execute(array(
        ':codigo'           => $_GET['codigo'],
        ':descricao'            => $_GET['Descricao'],
        ':valor'      => $_GET['Valor'],
        ':estoque'      => $_GET['Estoque']
    ));

    
    if ($comandoSQL->rowCount() > 0) {
        echo "Sucesso!";
        header("location:../../index.php?page=4" . "&id=" . $_GET['codigo']);        
    } else {
        echo "Erro ao inserir dados no banco";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
