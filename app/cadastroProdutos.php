<?php require_once("conexao/conexao.php");
if (isset($_GET['id']) & $_GET['page'] == 4) {
    $id = $_GET['id'];
    try {
        $comandoSQL = $conexao->prepare("SELECT * FROM Produtos WHERE id=" . $id);
        $comandoSQL->execute();
        if ($comandoSQL->rowCount() > 0) {
            $resProdutos = $comandoSQL->fetch();
            $descricao = $resProdutos[1];
            $valor = $resProdutos[2];
            $estoque = $resProdutos[3];
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
        <h1>Cadastro de Produtos</h1>
    </div>
    <div class="centralizar-h">

        <table style="border: 1px solid;">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th style="width: 700px;"><input type="number" name="CodigoProduto" id="CodigoProduto" value="<?php echo (isset($id)) ? $id : ''; ?>"></th>
                    <th><button id="carregarProduto" style="height: 100%;">Carregar</button></th>
                </tr>
                <tr>
                    <th>Descricão</th>
                    <th colspan="2"><input type="text" name="NomeProduto" id="NomeProduto" value="<?php echo (isset($descricao)) ? $descricao : ''; ?>"></th>
                </tr>
                <tr>
                    <th>Valor</th>
                    <th colspan="2"><input type="text" name="ValorProduto" id="ValorProduto" value="<?php echo (isset($valor)) ? $valor : ''; ?>"></th>
                </tr>
                <tr>
                    <th>Estoque</th>
                    <th colspan="2"><input type="text" name="EstoqueProduto" id="EstoqueProduto" value="<?php echo (isset($estoque)) ? $estoque : ''; ?>"></th>
                </tr>
                <tr>
                    <th><button id="limparProduto">Limpar</button></th>
                    <th><button id="cadastrarProduto">Cadastrar/Alterar</button></th>
                    <th><button>Excluir</button></th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>