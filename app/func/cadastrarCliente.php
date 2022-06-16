<?php
require_once("../conexao/conexao.php");
try {

    $comandoSQL = $conexao->prepare("INSERT INTO `Clientes` 
            (`id`, `Nome`, `Endereço`, `Cidade`) 
            VALUES 
            (:codigo, :nome, :endereco, :cidade) 
            ON DUPLICATE KEY UPDATE
            Nome=:nome, Endereço=:endereco, Cidade=:cidade
        ");
    
    $comandoSQL->execute(array(
        ':codigo'           => $_GET['codigo'],
        ':nome'            => $_GET['nome'],
        ':endereco'      => $_GET['endereco'],
        ':cidade'        => $_GET['cidade']
    ));

    
    if ($comandoSQL->rowCount() > 0) {
        echo "Sucesso!";
        header("location:../../index.php?page=2" . "&id=" . $_GET['codigo']);        
    } else {
        echo "Erro ao inserir dados no banco";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
