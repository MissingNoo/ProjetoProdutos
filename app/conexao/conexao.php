<?php
    /* Definição da variáveis de conexão com o banco */
    $_dns = "mysql:host=localhost;dbname=ProjetoProdutos";
    $_usuario = "root";
    $_senha = "";

    try{
        $conexao = new PDO($_dns, $_usuario, $_senha);

        /*$stmt = $conexao->query("SELECT * FROM login");
        while ($row = $stmt->fetch()) {
            echo $row['nomeLogin']."<br />";
        }
        exit();
        */
    }catch(PDOException $erro){

        /*
        echo "<pre>";
            print_r($erro);
        echo "</pre>";
        exit();
        */

        echo "ERRO: ".$erro->getCode();
        echo "Mensagem: ".$erro->getMessage();
        
    }