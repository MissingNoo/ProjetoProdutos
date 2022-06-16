<?php

	if($_SERVER["REQUEST_METHOD"] == "POST"){	
		
		require_once("./app/conexao/conexao.php");

		// filtrando a entrada do formulário de login
		$email   = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
		$senha   = filter_input(INPUT_POST, "senha", 
			FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		try{
			
			$comandoSQL = $conexao->prepare(
				"SELECT * FROM login WHERE emailLogin=:email");
			
			
			$comandoSQL->bindParam(":email", $email);
			
			//executando o comando SELECT
			$comandoSQL->execute();

			
			if($comandoSQL->rowCount() > 0){

				$linha = $comandoSQL->fetch();
				// verifica se o usuário já está ativo ou seja status=2
				if($linha["statusLogin"]==2){

					$hash = $linha["senhaLogin"];
					// verifica se a senha é correspondente a cadastrada
					if(password_verify($senha, $hash)){
						// email e senha OK cria uma sessão para o trabalho e redireciona para a 
						// página de visualização
						session_start();

						$_SESSION["nome"] = $linha["nomeLogin"];
						$_SESSION["nivel"] = $linha["nivelLogin"];
						header("location:./index.php");
					}
					else
					{
						header("location:./login.php?status=erro"); 
					}
				}
				else
				{
					header("location:./login.php?status=erro-adm");
				}
			}
			else{
				header("location:./login.php?status=erro"); 
			}
		}catch(PDOException $e){
			echo $e->getMessage(); 
		}

		// Fechando a conexão com MYSQL
		$conexao = null;
	}// Fechando o IF que valida o POST