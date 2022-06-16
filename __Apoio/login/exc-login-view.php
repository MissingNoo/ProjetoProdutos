<?php
    require_once("../conexao/conexao.php");

	$idLogin = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

	try {

		$comandoSQL = $conexao->prepare("SELECT * FROM login WHERE idLogin = :idLogin");

        $comandoSQL->bindValue("idLogin", $idLogin, PDO::PARAM_INT);

		$comandoSQL->execute();

		$linha = $comandoSQL->fetch(PDO::FETCH_ASSOC);
		
		/*
		echo "<pre>";
		print_r($linha);
		echo "</pre>";
		exit();
		*/ 
		
	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}

	$conexao = null; //fechar a conexão