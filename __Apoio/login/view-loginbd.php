<?php	
	require_once("../conexao/conexao.php");

	try {
		$sql = "SELECT idLogin, nomeLogin, telefoneLogin, emailLogin, fotoLogin, nivelLogin, statusLogin FROM login";

		$select = $conexao->query($sql);
		
		$result = $select->fetchAll();
		
		$total = $select->rowCount();
		/*
		echo "<pre>";
		print_r($result);
		echo "</pre>";
		*/

	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}