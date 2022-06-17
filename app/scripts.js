//#region Actions

//#region Clientes
document.getElementById("carregar").addEventListener("click", Carregar, false);
document
  .getElementById("cadastrar")
  .addEventListener("click", Cadastrar, false);
document.getElementById("limpar").addEventListener("click", Limpar, false);
//#endregion

//#region Cidades
document
  .getElementById("carregarcidade")
  .addEventListener("click", CarregarCidade, false);
document
  .getElementById("cadastrarcidade")
  .addEventListener("click", CadastrarCidade, false);
//#endregion

//#region Produtos
document
  .getElementById("carregarProduto")
  .addEventListener("click", CarregarProduto, false);
document
  .getElementById("cadastrarProduto")
  .addEventListener("click", CadastrarProduto, false);
document
  .getElementById("limparProduto")
  .addEventListener("click", LimparProduto, false);
//#endregion

//#region Venda

document.getElementById("ClienteList").addEventListener("change", SetClientID, false);
document.getElementById("lstProdutos").addEventListener("change", FindProductInfo, false);
document.getElementById("qtd").addEventListener("change", ValorTotal, false);

document.getElementById("CodigoCliente").addEventListener("focusout", FindClientName, false);
document.getElementById("CodigoPedido").addEventListener("focusout", FindClientName, false);
//#endregion

//#endregion

//#region Funções

//#region Clientes
function Carregar() {
  let codigo = document.getElementById("Codigo").value;
  window.location.href = "index.php?page=2" + "&id=" + codigo;
}
function Cadastrar() {
  let codigo = document.getElementById("Codigo").value;
  let nome = document.getElementById("Nome").value;
  let endereco = document.getElementById("Endereco").value;
  let cidade = document.getElementById("Cidade").value;
  window.location.href =
    "app/func/cadastrarCliente.php?codigo=" +
    codigo +
    "&nome=" +
    nome +
    "&endereco=" +
    endereco +
    "&cidade=" +
    cidade;
}
function Limpar() {
  window.location.href = "index.php?page=2";
}
//#endregion

//#region Cidades
function CadastrarCidade() {
  let codigo = document.getElementById("Codigocidade").value;
  let nome = document.getElementById("Nomecidade").value;
  let estado = document.getElementById("Estado").value;
  console.log(estado);
  window.location.href =
    "app/func/cadastrarCidade.php?codigo=" +
    codigo +
    "&nome=" +
    nome +
    "&estado=" +
    estado;
}
function CarregarCidade() {
  let codigo = document.getElementById("Codigocidade").value;
  window.location.href = "index.php?page=3" + "&id=" + codigo;
}
//#endregion

//#region Produto
function CarregarProduto() {
  let codigo = document.getElementById("CodigoProduto").value;
  window.location.href = "index.php?page=4" + "&id=" + codigo;
}
function CadastrarProduto() {
  let codigo = document.getElementById("CodigoProduto").value;
  let descricao = document.getElementById("NomeProduto").value;
  let valor = document.getElementById("ValorProduto").value;
  let estoque = document.getElementById("EstoqueProduto").value;
  window.location.href =
    "app/func/cadastrarProduto.php?codigo=" +
    codigo +
    "&Descricao=" +
    descricao +
    "&Valor=" +
    valor +
    "&Estoque=" +
    estoque;
}
function LimparProduto() {
  window.location.href = "index.php?page=4";
}
//#endregion

//#region Venda
function SetClientID() {
  let codigoPedido = document.getElementById("CodigoPedido").value;
  let codigo = document.getElementById("ClienteList").value;
  window.location.href ="app/func/getuserid.php?q=" + codigo + "&CodigoPedido=" + codigoPedido;
}
function FindClientName() {
  let codigoCliente = document.getElementById("CodigoCliente").value;
  let codigoPedido = document.getElementById("CodigoPedido").value;
  window.location.href = "index.php?page=5" + "&idCliente=" + codigoCliente + "&CodigoPedido=" + codigoPedido;
}
function FindProductInfo(){
  let codigoCliente = document.getElementById("CodigoCliente").value;
  let codigoPedido = document.getElementById("CodigoPedido").value;
  let codigo = document.getElementById("lstProdutos").value;
  window.location.href ="app/func/getproductid.php?q=" + codigo + "&CodigoPedido=" + codigoPedido + "&CodigoCliente=" + codigoCliente;
}
function ValorTotal(){
  valor = document.getElementById("valor").value;
  qtd =document.getElementById("qtd").value;
  document.getElementById("vTotal").value = valor * qtd;
}
//#endregion

//#endregion

//#region Navbar
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.body.style.backgroundColor = "white";
}

function Menu(cat) {
  closeNav();
  document.getElementById("1").style.display = "none";
  document.getElementById("2").style.display = "none";
  document.getElementById("3").style.display = "none";
  document.getElementById("4").style.display = "none";
  //window.history.pushState(null, null, "index.php?page=" + cat);
  var x = document.getElementById(cat);
  x.style.display = "block";
}
//#endregion
