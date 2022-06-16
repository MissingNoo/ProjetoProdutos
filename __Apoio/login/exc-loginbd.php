<?php

	if(!filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT)){
		echo "ID inválido!";
	}
	else{
	             
		require_once("../conexao/conexao.php");
		

		$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
		$foto = filter_input(INPUT_POST, "imagem", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		try {
			$comandoSQL = $conexao->prepare("DELETE FROM `login` WHERE `idLogin`=:id");

			//$comandoSQL->bindParam(":id", $id);
            //$comandoSQL->execute();
			$comandoSQL->execute(array(
                ':id'     => $id
            ));

			if($comandoSQL->rowCount() > 0){
				// diretório que será armazenado todas as imagens enviadas pelos usuários
				$dir_imagens = "./imagens/";

				$arq = "$dir_imagens"."$foto";
                unlink($arq);
				header("location:./view-login.php");
			}
			else{
				echo("Erro na exclusão do registro.");
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}