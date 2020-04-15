var self_element = ""; // elemento(categoria) que esta selecionada anteriormente anterior 
var status = true;
var id = 0;
var listElements = [[],[],[],[],[],[],[]];
// var dadosGrafico = [];
var dadosGlobal = []; // recebe dado do ajax 
var dadosMenu = []; //  array de dados do menu 
var localSelecionado = 'Menu';
var mesAtual = '1';
var anoAtual = '2019';
atualizaContas();
enviaPlanos();
var status_arrow_plano = 0;

// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();   
//   });
// buscaDados(); // 
//###################### CHAMA FUNÇÕES QUE IRÃO ESCONDER E GERAR EFEITOS AO MENU ##############################//

// CHAMA FUNÇÕES QUE IRÃO EXECUTAR OUTRAS FUNÇÕES EM NOSSO FRONTEND - REDIRECIONA A UMA CATEGORIA SELECIONADA DO SITE //
function runCategoria(Element){
  // if((document.getElementById('imagemFundo'))){ // se não existe menu(evita doble efeito na tabela)
  //   modificaTable(0,1,51,90);
  // }

  destacaItemTabela(Element) // gera feito a sessão selecionada
  mostraInfoJanela(Element); // mostra qual aba esta selecionada na parte de cima do site
  greyEditAttributes();      //Ira criar um div de inclusão de elementos na categoria

  removeImagemFundoConteudo();
  controleDeImagemFundo(Element)

  document.getElementById('idConteudo').style.zIndex = '3';
  
  try {
    escondeMenu(); // irá esconder a tela do menu principal
    escondeSuporte(); // irá esconder a tela do suporte esquerdo 
  }catch (error) {
  }

  status = true; // possibilita usuario adicionar informação

}

// CHAMA FUNÇÕES QUE IRÃO EXECUTAR OUTRAS FUNÇÕES EM NOSSO FRONTEND - REDIRECIONA AO MENU DO SITE//
function runMenu(){
    // if(!(document.getElementById('imagemFundo'))){ // se existe menu(evita doble efeito na tabela)
    //   modificaTable(38,-1,89,51);
    // }

    destacaItemTabela();  //faz a ação de remover feito a um item selecinado anteriomente
    removeInfoJanela();   // remove a informação da parte de cima do site
    nullEditAttributes();
    criaSuporte();        // cria tela de suporte na parte esqueda do site 
    criaMenu();           // cria menu principal     
    removeBtAdd();
    removeLists();
    removeImagemFundoConteudo();
    destacaNavCat('Menu');
    buscarDadosMenu();

    document.getElementById('idConteudo').style.zIndex = '1';

    // if(document.getElementsByTagName('body')[0].clientHeight*51/100 < document.getElementById('idTable').clientHeight){
    //   modificaImagemMenu();
    // }

    status = true; // possibilita usuario adicionar informação
    localSelecionado = 'Menu';
}

function buscaDados(){
  for(let indice in listElements){
    buscaCategorias(String(indice))////
  }
}

function focoDescricao(){
  document.getElementById('descricao').focus();
}
function foco(){
  setTimeout("focoDescricao()",500);
}

function LimpaCamposModal(){
  let titulo = document.getElementById('tituloModal');
  let corpo = document.getElementById('corpoModal');
  let baixo = document.getElementById('baixoModal');
  //let todo = document.getElementById('criar');

  titulo.innerHTML = '';
  corpo.innerHTML = '';
  let numElements = baixo.childElementCount;
  
  for(let element = 0; element<numElements;element++){
    document.getElementById('baixoModal').children[element].style.visibility = 'hidden';
  }  

  //todo.className='modal fade';
} 
function alteraArrow(){
  arrow = document.getElementById('arrow');
  if(arrow.className = 'up'){
    arrow.className = 'down';
  }else{
    arrow.className = 'up';
  }

  if(status_arrow_plano == 0){
    status_arrow_plano = 1;
  }else{
    status_arrow_plano = 0;
  }

  criaEstruturaPlano('tg-0lax0');
}

function buscarDadosMenu(){
  dadosMenu =[];
  buscaDadosContaMenu(); // Nao mudar ordem de chamada
  buscaDadosReceitaMenu();
  buscaDadosGastoMenu();
  //aviso de alerta
  rotinaDeAlertaEconomia()
}

function carregaPeriodoAtual(){
  mesAtual = pegaMesAtual();
  anoAtual = pegaAnoAtual();
}

function setaDataInfoTopo(){
  if(10>mesAtual){
    mesAtual = '0'+mesAtual;
  }

  if(Number(pegaAnoAtual()) == anoAtual){
    document.getElementById('spanControleMes').innerHTML = mesAtual; 
  }else{
    document.getElementById('spanControleMes').innerHTML = mesAtual+'/'+anoAtual; 
  }
  
}

function diminuiMes(){
  // alert(mesAtual)
  if(mesAtual>1){
    mesAtual = Number(mesAtual) - 1;
  }else{
    mesAtual = 12;
    anoAtual = Number(anoAtual) - 1;
  }
  setaDataInfoTopo();
  buscarDadosMenu();
  atualizaPagAtual()
}

function aumentaMes(){
  if(mesAtual==12){
    mesAtual = 1;
    anoAtual = Number(anoAtual) + 1;
  }else{
    mesAtual = Number(mesAtual) + 1;
  }
  setaDataInfoTopo();
  buscarDadosMenu();
  atualizaPagAtual()
}

function formataDataAtualInfo(){
  let monName = ["janeiro", "fevereiro", "março", "abril", "maio", "junho","julho","agosto","setembro","outubro", "novembro", "dezembro"]
  let data = dataAtual();
  let array = formataValoresData(data);
  str = ', '+array[0]+' de '+ monName[array[1]-1]+ ' de '+ array[2];
  document.getElementById("dataTopo").innerText = str;
}

function relogio() {
  let tempo = new Date();
  let hora = tempo.getHours();
  let minuto = tempo.getMinutes();
  let segundo = tempo.getSeconds();
  let horario = `${hora}:${minuto}:${segundo}`
  document.getElementById("horaTopo").innerText = horario;
  setTimeout("relogio()",1000);
}
relogio();
formataDataAtualInfo();
