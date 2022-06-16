<?php
	session_start();
	if((isset($_SESSION["nome"])==false) and (isset($_SESSION["nivel"])==false)){
		session_unset();
		session_destroy();
		header("location:./index.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login : : Excluir</title>
    <link rel="stylesheet" href="../../css/grids.css">
    <link rel="stylesheet" href="../../css/formulario.css">   
    <link rel="stylesheet" href="../../css/estilo.css">   
</head>
<body>
    <?php
        include("_menu.php");
    ?>
    <div class="espaco-v"></div> <!--abre um espaço entre os containers-->

    
    <?php
        $idLogin = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);
        include("./exc-login-view.php");
    ?>

    <form action="./exc-loginbd.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?=$linha['idLogin'];?>">
        <input type="hidden" name="imagem" value="<?=$linha['fotoLogin'];?>">

        <div class="container">
            <div class="container">
                <div class="row-flex">  
                    <div class="col-8 centralizar-h centralizar-v">
                        <h1 style="font-size: 5vw;">Excluir de Usuário</h1>
                    </div>        

                    <div class="col-2">
                        <img src="./imagens/<?= $linha["fotoLogin"]?>" alt="Foto do usuário"  style="border-radius:8px; max-width:100%;">
                    </div>              
                </div>
                
                
                <div class="row-flex">
                    <div class="col-10">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome completo do usuário" 
                        value="<?= $linha["nomeLogin"]?>" readonly>
                    </div>
                </div>

                <div class="row-flex">
                    <div class="col">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço de contato"
                        value="<?= $linha["enderecoLogin"]?>" readonly>
                    </div>

                    <div class="col">
                        <label for="fone">Telefone</label>
                        <input type="tel" name="fone" id="fone" placeholder="Fone comercial"
                        value="<?= $linha["telefoneLogin"]?>" readonly>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-10">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email comercial"
                        value="<?= $linha["emailLogin"]?>" readonly>
                    </div>
                </div>

                <div class="row-flex">                
                    <div class="col">
                        <label for="senha1">Senha</label>
                        <input type="password" name="senha1" id="senha1"  placeholder="Senha com 8 digitos"
                        value="********" readonly>
                    </div>

                    <div class="col">
                        <label for="senha2">Confirmação de senha</label>
                        <input type="password" name="senha2" id="senha2" placeholder="Confirmação de senha"
                        value="********" readonly>
                    </div>
                </div>

                <div class="row-flex">                
                    <div class="col">
                        <label for="nivel">Nível</label>
                        <select name="nivel" id="nivel">
                            <option value="1">   
                                <?= $ativo = $linha["nivelLogin"]=="1"?"Usuário":"Administrador"?>
                            </option>                   
                        </select>
                    </div>
                    <div class="col">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="1"><?= $ativo = $linha["statusLogin"]=="1"?"Desativado":"Ativado"?></option>                  
                        </select>
                    </div>
                </div>
                <div class="centralizar-h">
                    <hr style="margin: 30px; width:80%;">
                </div>

                <div class="row">
                    <div class="col-10 centralizar-h">
                        <input type="reset" onclick="javascript:history.go(-1);" value="V O L T A R">
                        <input type="submit" style="background-color: red;" value="E X C L U I R">
                    </div>
                </div>                    
            </div>
        </div>
    </form>

    <?php
        include("_rodape.php");
    ?>
</body>
</html>