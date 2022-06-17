<?php require_once("conexao/conexao.php");
if (isset($_GET['id']) & $_GET['page'] == 2) {
    $id = $_GET['id'];
    try {
        $comandoSQL = $conexao->prepare("SELECT * FROM Clientes WHERE id=" . $id);
        $comandoSQL->execute();
        if ($comandoSQL->rowCount() > 0) {
            $res = $comandoSQL->fetch();
            $nome = $res[1];
            $endereco = $res[2];
            $cidade = $res[3];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

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
        <h1>Cadastro de Clientes</h1>
    </div>
    <div class="centralizar-h">
        <table style="border: 1px solid;">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th style="width: 700px;"><input type="number" name="Codigo" id="Codigo" value="<?php echo (isset($id)) ? $id : ''; ?>"></th>
                    <th><button id="carregar" style="height: 100%;">Carregar</button></th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th colspan="2"><input type="text" name="Nome" id="Nome" value="<?php echo (isset($nome)) ? $nome : ''; ?>"></th>
                </tr>
                <tr>
                    <th>Endereço</th>
                    <th colspan="2"><input type="text" name="Endereco" id="Endereco" value="<?php echo (isset($endereco)) ? $endereco : ''; ?>"></th>
                </tr>
                <tr>
                    <th>Cidade</th>
                    <th colspan="2"><select style="height: 100%;" name="Cidade" id="Cidade">
                            <!--  -->
                            <option></option>"
                            <?php
                            try {
                                $comandoSQL = $conexao->prepare(
                                    "SELECT Nome FROM Cidades"
                                );

                                //executando o comando SELECT
                                $comandoSQL->execute();


                                if ($comandoSQL->rowCount() > 0) {
                                    while ($row = $comandoSQL->fetch()) {

                                        if ($cidade === $row[0]) {
                                            echo "<option selected='selected' value=" . $row[0] . ">" . $row[0] . "</option>";
                                        } else {
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
                    <th><button id="limpar">Limpar</button></th>
                    <th><button id="cadastrar">Cadastrar/Alterar</button></th>
                    <th><button>Excluir</button></th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>