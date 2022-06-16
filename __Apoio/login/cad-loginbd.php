<?php
    /*
    echo "<pre>";
        print_r($_POST);
        print_r($_SERVER['REQUEST_METHOD']);
    echo "</pre>";
    exit();
    */

    // verificando se o envio foi pelo método POST
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if (!empty($_FILES['foto']['name'])) {            

            // diretório que será armazenado todas as imagens enviadas pelos usuários
            $dir_imagens = "./imagens/"; 

            // pegando o nome do arquivo e se houver espaço em branco substituir por underline
            $nome_original = str_replace(" ", "_", basename($_FILES["foto"]["name"]));

            // criar um token/chave exclusivo e para finalizar faz a criptografia usando o MD5
            // que gera uma sequência de 32 caracteres.
            $token = md5(uniqid(rand(), true));

            // nome_final é a junção das váriáveis de diretório+token+nome_original
            $nome_final = $dir_imagens.$token.$nome_original;

            // A variável Flag é usada para sinalizar que está tudo ok quando valer 1
            $flag = 1;

            //verifica o tamanho do arquivo temporário e se for maior que 0 está ok
            if(!getimagesize($_FILES["foto"]["tmp_name"])){
                $flag = 0;
            }

            if($_FILES["foto"]["size"] > 2000000){
                $flag = 0;
            }

            // strtolower converte todos os caracteres de um texto/variável para minúsculo
            // pathinfo retorna a extensão do arquivo
            $extensao = strtolower(pathinfo($nome_final, PATHINFO_EXTENSION)); 
        
            // teste para validar a extensão do arquivo.
            if(($extensao != "jpg") && ($extensao != "png") && 
            ($extensao != "jpeg") && ($extensao != "gif")){
                $flag = 0;
            }

            if($flag == 1){        
                // a variável foto terá seu conteúdo gravado no BD com o token+nome_original
                $foto = $token.$nome_original;        
            }
        }
        else{
            $flag = 0;
            // a variável foto terá o conteúdo com sem-foto.jpg como padrão                
            $foto = "_sem-foto.gif";        
        }

    // FIM UPLOAD ************************************************************

    $nome       = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $endereco   = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email      = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone   = filter_input(INPUT_POST, "fone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $senha      = filter_input(INPUT_POST, "senha1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
    $nivel      = filter_input(INPUT_POST, "nivel", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status     = filter_input(INPUT_POST, "status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     

    /* 
    echo $nome."<br />";
    echo $endereco."<br />";
    echo $email."<br />";
    echo $telefone."<br />";
    echo $senha."<br />";
    echo $nivel."<br />";
    echo $status."<br />";
    echo $foto."<br />";
    echo "<pre>";
        print_r($_POST);
    echo "</pre>";

    exit();

    */

    
    require_once("../conexao/conexao.php");

    try{

        $comandoSQL = $conexao->prepare("INSERT INTO `login` 
            (`nomeLogin`, `enderecoLogin`, `emailLogin`, `telefoneLogin`, 
            `senhaLogin`, `nivelLogin`, `statusLogin`, `fotoLogin`) 
            VALUES 
            (:nome, :endereco, :email, :telefone, :senha, :nivel, :status, :foto)
        "); 


        // para mostrar todas as opções de criação de hash use o 
        //código abaixo, irá mostrar uma lista com 60 algoritmos hash suportados
        /*
            <?php
                print_r(hash_algos());
            ?>
        */
        $comandoSQL->execute(array(
           ':nome'     => $nome,
           ':endereco' => $endereco,
           ':email'    => $email,
           ':telefone' => $telefone,
           ':senha'    => password_hash($senha, PASSWORD_DEFAULT),
           //':senha'      => hash('whirlpool', $senha),
           //':senha'      => hash('sha512', $senha),
           //':senha'      => hash('sha256', $senha),
           //':senha'      => sha1($senha), // 40 caracteres
           //':senha'      => md5($senha), // 32 caracteres
           ':nivel'    => $nivel,
           ':status'   => $status, 
           ':foto'     => $foto
        ));
        

        if($comandoSQL->rowCount() > 0)
        {            
            if($flag == 1){                 
                //o move_uploaded_file pega o nome do arquivo temporário e grava na pasta do servidor
                move_uploaded_file($_FILES["foto"]["tmp_name"], $nome_final);
            } 
            
            echo "Sucesso!";
            //header('location:../sucesso.php');
        }
        else
        {
            echo "Erro ao inserir dados no banco";
        }
    }
    catch(PDOException $erro)
    {
        echo "ERRO: ".$erro->getCode()."<br>";
        echo "Mensagem: <br>".$erro->getMessage();
    }
    
    //fechar a conexão com o banco
    $conexao = null;         
}
else {
    echo "NO POST";
}