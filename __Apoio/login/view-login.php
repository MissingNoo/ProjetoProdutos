<?php
	session_start();
	if((isset($_SESSION["nome"])==false) and (isset($_SESSION["nivel"])==false)){
		session_unset();  // apaga as variáveis que por ventura estão na sessão
		session_destroy(); // destruir/apagar as sessão atual
		header("location:./index.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login : : Visualizar</title>
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
        require_once ("./view-loginbd.php");
        if($total > 0){
    ?> 

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>FOTO</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>FONE</th>
                    <th>EXCLUIR</th>
                    <th>EDITAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
					foreach($result as $linha)
					{
				?>
                        <tr>
                            <td><?= $linha["idLogin"]; ?></td>
                            <td><img src=".//imagens/<?= $linha["fotoLogin"]; ?>" alt="" width="100%"></td>
                            <td><?= $linha["nomeLogin"]; ?><br>
                                <p style="font-size: 14px;"><?= $status=$linha["nivelLogin"]==1?"Usuário":"Administrador";?></p></td>
                            <td><?= $linha["emailLogin"]; ?></td>
                            <td><?= $linha["telefoneLogin"]; ?></td>
                            <td>
                                <?php 
                                    if($_SESSION["nivel"]=="2")
                                    {
                                        
                                ?>
                                        <a href="exc-login.php?id=<?= $linha['idLogin']; ?>">
                                            <img src="./img/rectangle-xmark.svg" alt="Excluir" width="25%">
                                        </a>
                                <?php
                                    }
                                    else{
                                        echo '<img src="./img/rectangle-xmark.svg" alt="Excluir" width="25%">';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($_SESSION["nivel"]=="2")
                                    {
                                        
                                ?>
                                    <a href="alt-login.php?id=<?= $linha['idLogin']; ?>">
                                        <img src="./img/circle-check.svg" alt="Alterar" width="25%">
                                    </a>
                                <?php
                                    }
                                    else{
                                        echo '<img src="./img/rectangle-xmark.svg" alt="Excluir" width="25%">';
                                    }
                                ?>
                            </td>                    
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <?php
        }
        else{
            echo '<div class="row-flex">';
            echo '<div class="col-10 centralizar-h centralizar-v">';
            echo '     <h1 style="font-size: 5vw;">NÃO HÁ REGISTROS</h1>';
            echo '</div> ';            
            echo '</div>';
        }
    ?>


    <?php
        include("_rodape.php");
    ?>
    
</body>
</html>