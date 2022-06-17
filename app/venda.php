<?php require_once("conexao/conexao.php");
if ($_GET['page'] == 5) {
    if (isset($_GET['CodigoPedido'])) {
        $CodigoPedido = $_GET['CodigoPedido'];
        try {
            $comandoSQL = $conexao->prepare("SELECT * FROM Pedidos WHERE id=" . $CodigoPedido);
            $comandoSQL->execute();
            if ($comandoSQL->rowCount() > 0) {
                $p = $comandoSQL->fetch();
                $idCliente = $p[1];
                $items = $p[2];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    if (isset($idCliente) or isset($_GET['idCliente'])) {
        if (!isset($idCliente)) {
            $idCliente = $_GET['idCliente'];
        }
        try {
            $comandoSQL = $conexao->prepare("SELECT Nome FROM Clientes WHERE id=" . $idCliente);
            $comandoSQL->execute();
            if ($comandoSQL->rowCount() > 0) {
                $a = $comandoSQL->fetch();
                $cliente = $a[0];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    if (isset($_GET['idProduto'])) {
        $idProduto = $_GET['idProduto'];
        try {
            $comandoSQL = $conexao->prepare("SELECT * FROM Produtos WHERE id=" . $idProduto);
            $comandoSQL->execute();
            if ($comandoSQL->rowCount() > 0) {
                $b = $comandoSQL->fetch();
                $descricao = $b[1];
                $valor = $b[2];
                $estoque = $b[3];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
        <h1>Venda</h1>
    </div>
    <div class="centralizar-h">

        <table style="border: 1px solid;">
            <thead>
                <tr>
                    <th>Pedido N</th>
                    <th><input type="number" name="CodigoPedido" id="CodigoPedido" value="<?php echo (isset($CodigoPedido)) ? $CodigoPedido : ''; ?>"></th>
                    <th><button id="CarregarPedido">Carregar</button></th>
                    <th><button id="SalvarPedido">Salvar/Alterar</button></th>
                    <th><button id="ExcluirPedido">Excluir</button></th>
                    <th><button id="LimparPedido">Limpar</button></th>
                </tr>
                <tr>
                    <th>Cliente</th>
                    <th><input type="number" name="CodigoCliente" id="CodigoCliente" value="<?php echo (isset($idCliente)) ? $idCliente : ''; ?>"></th>
                    <th colspan="4"><select name="ClienteList" id="ClienteList">
                            <option></option>"
                            <!--  -->
                            <?php
                            try {
                                $comandoSQL = $conexao->prepare(
                                    "SELECT Nome FROM Clientes"
                                );

                                //executando o comando SELECT
                                $comandoSQL->execute();


                                if ($comandoSQL->rowCount() > 0) {
                                    while ($row = $comandoSQL->fetch()) {

                                        if ($cliente === $row[0]) {
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
                    <th>Codigo</th>
                    <th>Descrição</th>
                    <th>Valor Un.</th>
                    <th>Qtd</th>
                    <th>Valor Total</th>
                </tr>
                <tr>
                    <th><input type="number" name="CProduto" id="CProduto" value="<?php echo (isset($idProduto)) ? $idProduto : ''; ?>"></th>
                    <th><select name="lstProdutos" id="lstProdutos">
                            <option></option>"
                            <!--  -->
                            <?php
                            try {
                                $comandoSQL = $conexao->prepare(
                                    "SELECT Descricao FROM Produtos"
                                );

                                //executando o comando SELECT
                                $comandoSQL->execute();


                                if ($comandoSQL->rowCount() > 0) {
                                    while ($row = $comandoSQL->fetch()) {

                                        if ($descricao === $row[0]) {
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
                        </select></th>
                    <th><input style="text-align: center;" type="number" name="valor" id="valor" disabled value="<?php echo (isset($valor)) ? $valor : ''; ?>"></th>
                    <th><input style="text-align: center;" type="number" name="qtd" id="qtd" value="0"></th>
                    <th><input style="text-align: center;" type="number" name="vTotal" id="vTotal" disabled></th>
                    <th><button id="AdicionarItem">Adicionar</button></th>
                </tr>
                <tr>
                    <th colspan="6" style="height: 3px; background-color: black;"></th>

                </tr>
                <tr>
                    <th style="background-color: grey;">Codigo</th>
                    <th style="background-color: grey;">Descrição</th>
                    <th style="background-color: grey;">Valor Un.</th>
                    <th style="background-color: grey;">Qtd</th>
                    <th style="background-color: grey;">Valor Total</th>
                    <th style="background-color: grey;">X</th>
                </tr>
                <tr>
                    <?php
                    $tt = 0;
                    if (isset($items)) {
                        $p1 = explode("|", $items);

                        foreach ($p1 as $key) {
                            $p2 = explode(":", $key);
                            /*  */
                            try {
                                $comandoSQL = $conexao->prepare(
                                    "SELECT * FROM Produtos Where id=" . $p2[0]
                                );
                                $comandoSQL->execute();
                                if ($comandoSQL->rowCount() > 0) {
                                    $desc = $comandoSQL->fetch();
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            /*  */

                            echo '<tr>
                            <th><input style="text-align: center;" type="number" name="" id="" value="' . $desc[0] . '" disabled></th>
                            <th><input style="text-align: center;" type="text" name="" id="" value="' . $desc[1] . '" disabled></th>
                            <th><input style="text-align: center;" type="text" name="" id="" value="' . $desc[2] . 'R$" disabled></th>
                            <th><input style="text-align: center;" type="text" name="" id="" value="' . $p2[1] . '" disabled></th>
                            <th><input style="text-align: center;" type="text" name="" id="" value="' . $desc[2] * $p2[1] . 'R$" disabled></th>
                            <th>X</th>
                            </tr>';
                            $tt=$tt+($desc[2] * $p2[1]);
                        }
                        echo '<th></th><th></th><th></th><th></th><th>' . $tt . 'R$</th>
                        </tr>';
                    }
                    ?>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>