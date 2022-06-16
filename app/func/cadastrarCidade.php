<?php
require_once("../conexao/conexao.php");
try {

    $comandoSQL = $conexao->prepare("INSERT INTO `Cidades` 
            (`id`, `Nome`, `Estado`) 
            VALUES 
            (:codigo, :nome, :estado) 
            ON DUPLICATE KEY UPDATE
            Nome=:nome, Estado=:estado
        ");
    
    $comandoSQL->execute(array(
        ':codigo'           => $_GET['codigo'],
        ':nome'            => $_GET['nome'],
        ':estado'      => $_GET['estado']
    ));

    
    if ($comandoSQL->rowCount() > 0) {
        echo "Sucesso!";
        header("location:../../index.php?page=3" . "&id=" . $_GET['codigo']);        
    } else {
        echo "Erro ao inserir dados no banco";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
