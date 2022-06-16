<?php require_once("conexao/conexao.php");
if (isset($_GET['id']) & $_GET['page'] == 3) {
    $id = $_GET['id'];
    try {

        $comandoSQL = $conexao->prepare("SELECT * FROM Cidades WHERE id=" . $id);
        
        $comandoSQL->execute();
        
        if ($comandoSQL->rowCount() > 0) {
            $rescidade = $comandoSQL->fetch();
            $nomecidade = $rescidade[1];
            $estado = $rescidade[2];
            
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        font-size: 18px;
        background-color: #8f7aff;
    }

    input,
    select,
    button {
        border: 0px;
        background-color: #8eb4ff;
        height: 100%;
        width: 100%;
    }
</style>

<body>

    <div class="centralizar-h">
        <table style="border: 1px solid;">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th style="width: 700px;"><input type="number" name="Codigocidade" id="Codigocidade" value="<?php echo (isset($id)) ? $id : ''; ?>"></th>
                    <th><button id="carregarcidade" style="height: 100%;">Carregar</button></th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th colspan="2"><input type="text" name="Nomecidade" id="Nomecidade" value="<?php echo (isset($nomecidade)) ? $nomecidade : ''; ?>"></th>
                </tr>
                <tr>
                    <th>Estado</th>
                    <th colspan="2"><select style="height: 100%;" name="Estado" id="Estado">
                    <option></option>"
                            <!--  -->
                            <?php
                            try {
                                $comandoSQL = $conexao->prepare(
                                    "SELECT Nome FROM Estados"
                                );

                                //executando o comando SELECT
                                $comandoSQL->execute();

                                
                                if ($comandoSQL->rowCount() > 0) {
                                    while ($row = $comandoSQL->fetch()) {
                                        
                                        if ($estado === $row[0]){                                            
                                            echo "<option selected='selected' value=" . $row[0] . ">" . $row[0] . "</option>";
                                        }
                                        else {
                                            echo "<option value=" . $row[0] . ">" . $row[0] . "</option>";
                                        }
                                        
                                    }
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            ?>
                            <!--  -->
                        </select></th>
                </tr>
                <tr>
                    <th><button id="limparcidade">Limpar</button></th>
                    <th><button id="cadastrarcidade">Cadastrar/Alterar</button></th>
                    <th><button>Excluir</button></th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>