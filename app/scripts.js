document
  .getElementById("cadastrar")
  .addEventListener("click", Cadastrar, false);
document.getElementById("carregar").addEventListener("click", Carregar, false);
document
  .getElementById("carregarcidade")
  .addEventListener("click", CarregarCidade, false);
document
  .getElementById("cadastrarcidade")
  .addEventListener("click", CadastrarCidade, false);
document.getElementById("limpar").addEventListener("click", Limpar, false);

window.onload = function () {
  //openNav();
};
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
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
  window.history.pushState(null, null, "index.php?page=" + cat);
  var x = document.getElementById(cat);
  x.style.display = "block";
}

function Cadastrar() {
  console.log("clicou");
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

function CadastrarCidade() {
  console.log("clicou");
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

function Carregar() {
  let codigo = document.getElementById("Codigo").value;
  window.location.href = "index.php?page=2" + "&id=" + codigo;
}

function CarregarCidade() {
  let codigo = document.getElementById("Codigocidade").value;
  window.location.href = "index.php?page=3" + "&id=" + codigo;
}

function Limpar() {
  window.location.href = "index.php?page=2";
}
