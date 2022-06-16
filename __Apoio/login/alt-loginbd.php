<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        // foto que está no cadastro atual do usuário
        $foto = filter_input(INPUT_POST, "fotoAnterior", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // diretório que será armazenado todas as imagens enviadas pelos usuários
        $dir_imagens = "./imagens/";

        // pegando o nome do arquivo e se houver espaço em branco substituir por underline
        $nome_original = str_replace(" ", "_", basename($_FILES["foto"]["name"]));

        if($nome_original != ""){
            
            // criar um token/chave exclusivo e para finalizar faz a criptografia usando o MD5
            // que gera uma sequência de 32 caracteres.
            $token = md5(uniqid(rand(), true));

            // nome_final é a junção das váriáveis de diretório+token+nome_original
            $nome_final = $dir_imagens.$token.$nome_original;

            // A variável Flag é usada para sinalizar que está tudo ok quando valer 1
            $flag = 1;

            // verifica se o arquivo foi enviado pelo submit
            if(isset($_POST["submit"])){
                //verifica o tamanho do arquivo temporário e se for maior que 0 está ok
                if(getimagesize($_FILES["foto"]["tmp_name"])){
                    $flag = 1;
                }
                else{
                    $flag = 0;
                }
            }

            if($_FILES["foto"]["size"] > 2000000){
                $flag = 0;
            }

            // strtolower converte todos os caracteres de um texto/variável para minúsculo
            // pathinfo retorna a extensão do arquivo
            $extensao = strtolower(pathinfo($nome_final, PATHINFO_EXTENSION)); 
        
            // teste para validar a extensão do arquivo.
            if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "jpeg") && ($extensao != "gif")){
                $flag = 0;
            }        

            if($flag == 1){            
                // apaga a foto antiga
                
                if($foto != "_sem-foto.gif") {
                    $arq = "$dir_imagens"."$foto";
                    unlink($arq);
                }            
                
                
                // a variável foto terá seu conteúdo gravado no BD com o token+nome_original
                $foto = $token.$nome_original;   
            }
        }
        /*
        else 
        {
            if($avatar != "_sem-foto.gif")
            {
                $arq = "$dir_imagens"."$avatar";
                unlink($arq);
            }
            $foto = "_sem-foto.gif";
        }
        */

        $id         = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $nome       = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $endereco   = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email      = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $telefone   = filter_input(INPUT_POST, "fone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $senha      = filter_input(INPUT_POST, "senha1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
        $nivel      = filter_input(INPUT_POST, "nivel", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $status     = filter_input(INPUT_POST, "status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);     

        
        
        require_once("../conexao/conexao.php");

        try {		
            

            if($senha == "********")
            {
                $comandoSQL = $conexao->prepare("UPDATE `login` SET `nomeLogin`=:nome, `enderecoLogin`=:endereco, 
                `emailLogin`=:email, `telefoneLogin`=:telefone, `nivelLogin`=:nivel, 
                `statusLogin`=:status1, `fotoLogin`=:foto WHERE `idLogin`=:id");

                $comandoSQL->execute(array(
                    ':id'       	=> $id,
                    ':nome'			=> $nome,
                    ':endereco'  	=> $endereco,
                    ':email'		=> $email,
                    ':telefone'		=> $telefone,
                    ':nivel'		=> $nivel,
                    ':status1'		=> $status,
                    ':foto'		    => $foto
                ));
            }
            else
            {
                $comandoSQL = $conexao->prepare(
                    "UPDATE `login` SET `nomeLogin`=:nome, `enderecoLogin`=:endereco, 
                    `emailLogin`=:email, `telefoneLogin`=:telefone, `senhaLogin`=:senha,
                    `nivelLogin`=:nivel, `statusLogin`=:status1, `fotoLogin`=:foto WHERE `idLogin`=:id");

                $comandoSQL->execute(array(
                    ':id'       	=> $id,
                    ':nome'			=> $nome,
                    ':endereco'  	=> $endereco,
                    ':email'		=> $email,
                    ':telefone'		=> $telefone,
                    ':senha'		=> password_hash($senha, PASSWORD_DEFAULT),
                    ':nivel'		=> $nivel,
                    ':status1'		=> $status,
                    ':foto'		    => $foto
                ));
            }

            if($comandoSQL->rowCount() > 0)
            {
                //o move_uploaded_file pega o nome do arquivo temporário e grava na pasta do servidor
                move_uploaded_file($_FILES["foto"]["tmp_name"], $nome_final);
                
                header("location:./view-login.php");
            }
            else
            {
                echo "Erro na atualização";
            }

        } catch (PDOException $e) {
            
            echo $e->getMessage();
        }

        $conexao=null;
    }
    else
    {
        echo("O enviou não foi pelo método POST!");
    }