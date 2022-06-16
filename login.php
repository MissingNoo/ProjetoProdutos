<?php
# incia um sessão
session_start();
# limpa todas as variável da sessão
session_unset();
# destroi a sessão atual/inicial
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./css/grids.css">
    <link rel="stylesheet" href="./css/formulario.css">
    <link rel="stylesheet" href="./css/estilo.css">

    <style>
        .erro {
            background-color: lightpink;
            padding: 20px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bolder;
            text-align: center;
            font-size: 20px;
            display: block;
        }
    </style>

</head>

<body>

    <?php require_once 'app/_topo.php'; ?>

    <div class="espaco-v" style="margin-bottom: 5vh;"></div>
    <!--abre um espaço entre os containers-->

    <div class="container">
        <div class="row-flex centralizar-h">
            <h1>Login de Usuários</h1>
        </div>
    </div>


    <div class="espaco-v" style="margin-bottom: 10vh;"></div>
    <!--abre um espaço entre os containers-->

    <div class="container" style="background-color: #f3f3f3;">
        <form action="./valida.php" method="post">
            <div class="row centralizar-h">
                <div class="col-3">
                    <div class="row">

                        <?php
                        $status = filter_input(INPUT_GET, "status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        if ((isset($status)) && ($status == "erro")) {
                            echo '<div class="erro">Erro no login!</div>';
                        }

                        if ((isset($status)) && ($status == "erro-adm")) {
                            echo '<div class="erro">Procure o Administrador para Ativar sua conta!</div>';
                        }

                        ?>

                        <div class="col-10">
                            <label for="email">Usuário</label>
                            <input type="email" name="email" id="email" placeholder="Email do usuário" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senha" placeholder="Senha com 8 dígitos" minlength="3" required>
                        </div>
                    </div>

                    <div class="centralizar-h">
                        <a href="./app/login/cad-login-inicio.php">FAÇA SEU CADASTRO!</a>
                    </div>

                    <div class="centralizar-h">
                        <hr style="margin: 30px; width:80%;">
                    </div>

                    <div class="row">
                        <div class="col-10 centralizar-h">
                            <input type="submit" value="L O G A R">
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</body>

</html>