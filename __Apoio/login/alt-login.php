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
    <title>Login : : Alterar</title>
    <link rel="stylesheet" href="../../css/grids.css">
    <link rel="stylesheet" href="../../css/formulario.css">   
    <link rel="stylesheet" href="../../css/estilo.css">   
</head>
<body>
    <?php
        include("_menu.php");
    ?>
    <div class="espaco-v"></div> <!--abre um espaço entre os containers-->

    <!-- CODE -->
    
    <?php
        $idLogin = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);
        include("./alt-login-view.php");
    ?>
    
    <!-- CODE -->

    <form action="./alt-loginbd.php" method="POST" enctype="multipart/form-data">
        

        <input type="hidden" name="id" value="<?=$linha['idLogin'];?>">
        <input type="hidden" name="fotoAnterior" value="<?=$linha['fotoLogin'];?>">
        


        <div class="container">
            <div class="container">
                <div class="row-flex">  
                    <div class="col-6 centralizar-h centralizar-v">
                        <h1 style="font-size: 5vw;">Alterar de Usuário</h1>
                    </div>        
                    <div class="col-2 centralizar-v" >
                    <input type="file" name="foto" id="foto" 
                        onchange="previewImagem()" class="inputfile">
                        <label for="foto">Foto</label>
                    </div>
                    <div class="col-2">
                        <img src="./imagens/<?= $linha["fotoLogin"]?>" alt="Foto do usuário"  style="border-radius:8px; max-width:100%;">
                    </div>              
                </div>
                
                
                <div class="row-flex">
                    <div class="col-10">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome completo do usuário" 
                        value="<?= $linha["nomeLogin"]?>">
                    </div>
                </div>

                <div class="row-flex">
                    <div class="col">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço de contato"
                        value="<?= $linha["enderecoLogin"]?>">
                    </div>

                    <div class="col">
                        <label for="fone">Telefone</label>
                        <input type="tel" name="fone" id="fone" placeholder="Fone comercial"
                        value="<?= $linha["telefoneLogin"]?>">
                    </div>
                </div>

                <div class="row">                
                    <div class="col-10">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email comercial"
                        value="<?= $linha["emailLogin"]?>">
                    </div>
                </div>

                <div class="row-flex">                
                    <div class="col">
                        <label for="senha1">Senha</label>
                        <input type="password" name="senha1" id="senha1"  placeholder="Senha com 8 digitos"
                        value="********">
                    </div>

                    <div class="col">
                        <label for="senha2">Confirmação de senha</label>
                        <input type="password" name="senha2" id="senha2" placeholder="Confirmação de senha"
                        value="********">
                    </div>
                </div>

                <div class="row-flex">                
                    <div class="col">
                        <label for="nivel">Nível</label>
                        <select name="nivel" id="nivel">
                            <option value="1" <?= $ativo = $linha["nivelLogin"]=="1"?"selected":""?>>Usuário</option>                    
                            <option value="2" <?= $ativo = $linha["nivelLogin"]=="2"?"selected":""?>>Administrador</option>                    
                        </select>
                    </div>
                    <div class="col">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="1" <?= $ativo = $linha["statusLogin"]=="1"?"selected":""?>>Desativado</option>                    
                            <option value="2" <?= $ativo = $linha["statusLogin"]=="2"?"selected":""?>>Ativado</option>                    
                        </select>
                    </div>
                </div>
                <div class="centralizar-h">
                    <hr style="margin: 30px; width:80%;">
                </div>

                <div class="row">
                    <div class="col-10 centralizar-h">
                        <input type="reset" onclick="javascript:history.go(-1);" value="V O L T A R">
                        <input type="submit" value="S A L V A R">
                    </div>
                </div>                    
            </div>
        </div>
    </form>

    <?php
        include("_rodape.php");
    ?>
    
    <script type="text/javascript">
        //verifica se os campos são iguais e o tamanho do conteúdo
        let campoSenha = document.querySelector('input[name="senha1"]');
        let campoConfirmarSenha = document.querySelector('input[name="senha2"]');
        let botao = document.querySelector('input[name="btn-salvar"]');
        let errr = document.querySelector('.mens-erro');

        campoSenha.addEventListener('input', function(){
            verificaCampos();
        });

        campoConfirmarSenha.addEventListener('input', function(){
            verificaCampos();
        });

        function verificaCampos() {
            if(campoSenha.value == campoConfirmarSenha.value && campoSenha.value.length >= 2)
            {
            botao.disabled = false; // habilita o boão de salvar dados
            errr.style.display = 'none'; // esconde a mensagem
            errr.style.color = 'green'; // coloca a cor da mensagem em verde
            }
            else
            {
            botao.disabled = true; // desabilita o botão
            errr.style.display = 'block'; // mostra a mensagem
            errr.style.color = 'red'; // coloca a cor da mensagem em vermelho
            }   
        }
        // FINAL DA VALIDAÇÃO DA SENHA

        // INÍCIO DA VISUALIZAÇÃO DA IMAGEM
        function previewImagem(){
            var imagem = document.querySelector('input[name=foto]').files[0];
            var preview = document.querySelector('img');
            
            // variável que terá o conteúdo da imagem
            var reader = new FileReader();
            
            // a função será executada somente depois do carregamento
            reader.onloadend = function () {
                // mostrando a imagem na tela
                preview.src = reader.result;
            }
            
            if(imagem){
            //essa linha irá disparar o reader.onloadend quando terminar de carregar a imagem
                reader.readAsDataURL(imagem);
            }else{
                preview.src = "";
            }
        }
        // FINAL DA VISUALIZAÇÃO DA IMAGEM
   </script>      

</body>
</html>