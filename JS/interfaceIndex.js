//###################### Gera estilos e executa estruturas de base ao site(Menu,suporte,tabela de categorias...) ##############################//

// gera feito a categoria selecionada ou a retira//
function destacaItemTabela(Element){
    let Elemento = document.getElementsByClassName(Element)[0];
    try {
      // Elemento.style.textDecoration = "underline";
      Elemento.style.background = '#a13a3a';
      if(self_element && self_element != Element){
        let self_elemento = document.getElementsByClassName(self_element)[0];
        // self_elemento.style.textDecoration = "";
        self_elemento.style.background = "";
        
      }
      self_element = Element;
    } catch (error){
      try {
        let self_elemento = document.getElementsByClassName(self_element)[0];
        // self_elemento.style.textDecoration = "";
        self_elemento.style.background = ""; 
      } catch (error1) {
      }
    }
}

// adiciona a informação da categoria na parte de cima do site
function mostraInfoJanela(element){
  // alert(element+" : "+ document.getElementsByClassName(element)[0].children[0].innerHTML)
  document.getElementById('infoJanela').innerText = document.getElementsByClassName(element)[0].children[0].innerHTML;
}
// remove a informação da categoria na parte de cima do site
function removeInfoJanela(){
  document.getElementById('infoJanela').innerText = "";
}

//Gera efeito de opacidade do menu e da tela de suporte//
function modificaImagemMenu() {
    var elem = document.getElementById("imagemFundo");
    let elemSuporte = document.getElementById('imgspt')
    
    var pos = 0.2;
    elem.style.opacity = '0';
    elemSuporte.style.opacity = '0';
    var id = setInterval(frame, 150);
    fator = 0.1;
    

    function frame() {
      if (pos > 1) {
        clearInterval(id);
      } else {
        pos+=fator; 
        elem.style.opacity = pos + ''; 
        elemSuporte.style.opacity = pos + ''; 
      }
    }
  }

 /*receberá na ordem de parametro: tamanho do objeto de suporte, fator define se o objeto ira reduzir(-1) ou aumentar(1) de tamanho,
  porcentagem: a % do tamanho do elemento em relação a altura, porcFinal: porcentagem final que o elemento estará no final do efeito  */
function modificaTable(tmSuport,fator,porcenatagem,porcFinal) {
    var elem = document.getElementById("idTable");
    
    document.getElementById('IdSuporte').style.height = `${tmSuport}%`;  
    var pos = porcenatagem;
    var id = setInterval(frame, 5);
    fator = fator/2;
    
    function frame() {
      if (pos == porcFinal) {
        clearInterval(id);
      } else {
        pos+=fator; 
        elem.style.height = pos + '%'; 
      }
    }
  }

//remove o Fundo menu do site
function escondeMenu(){
    let divMenu = document.getElementById('Menu');
    divMenu.removeChild(document.getElementById('imagemFundo')); 
    divMenu.style.visibility = 'hidden';  
}

//remove o Fundo do suporte do site
function escondeSuporte(){
    let divSuport = document.getElementById('IdSuporte');
    divSuport.removeChild(document.getElementById('imgspt'));
}
// Cria novamente a tela de fundo do menu 
function criaMenu(){
    let divMenu = document.getElementById('Menu');
    divMenu.style.visibility = 'visible';

    if(document.getElementById('imagemFundo')){
    }else{
        let imgMenu = document.createElement('img');
        imgMenu.id = 'imagemFundo';
        imgMenu.src = "fundo-site.jpg";
        divMenu.appendChild(imgMenu);
    }
}

// Cria novamente a tela de fundo do menu
function criaSuporte(){
    let divSuport = document.getElementById('IdSuporte');
    if(document.getElementById('imgspt')){
    }else{
        let imgSort = document.createElement('img');
        imgSort.id = 'imgspt';
        imgSort.src = "./images/contimg1.png";
        divSuport.appendChild(imgSort)
    }
}

//########## Edita barra que irá criar, editar,excluir tickets ou exibir informações sobre a categoria  ###############//

function createBtAdd(classCategoria){
  verificaLogin();
  if(dadosGlobal == '1'){
    let div = document.getElementById('idEditAttributes');
    let categoria = classCategoria[classCategoria.length-1];
    
    removeBtAdd();

    let modal ='';

    if(categoria == '1'){
      modal = 'modalReceita()'
    }
    else if(categoria == '2'){
      modal = 'modalGasto()'
    }
    else if(categoria == '3'){
      modal = 'modalConta()'
    }
    
    

    let btAdd = `<button id="btCreate" onclick = "${modal}"  data-target="#criar" data-toggle="modal" style="background: url(./images/add.png)"></button>`
    div.innerHTML += btAdd;
  }
  
  
}
  
function removeBtAdd(){
    let editAttributes = document.getElementById('idEditAttributes');
    try {
      editAttributes.removeChild(document.getElementById('btCreate'));
    } catch (error) {
    }
}
  
function greyEditAttributes(){
    document.getElementById('idEditAttributes').style.background = "#4F4F4F";
    // document.getElementById('idEditAttributes').style.borderTop = "1px solid #c34444";
  
}

function nullEditAttributes(){
    document.getElementById('idEditAttributes').style.background = "";
}
  

function criaImagemFundoConteudo(url){
    let conteudo = document.getElementById('idConteudo');
    let imagemFundo = document.createElement('img');
    imagemFundo.id = 'imagemFundoConteudo';
    imagemFundo.src = url;
    conteudo.appendChild(imagemFundo);
}
  
  function removeImagemFundoConteudo(){
    let imagemFundo = document.getElementById('imagemFundoConteudo');
    if(imagemFundo){ // se existir ele irá remover imagem
      let conteudo = document.getElementById('idConteudo');
      conteudo.removeChild(imagemFundo);
    }
  }
  
  function controleDeImagemFundo(classCategoria){
    let categoria = classCategoria[classCategoria.length-1];
    switch (Number(categoria)){
      case 0:
        criaImagemFundoConteudo("./images/plano3.png")
        break;
      case 1:
        criaImagemFundoConteudo("./images/receitas135.png")
        break;
      case 2:
        criaImagemFundoConteudo("./images/gastos3.png")
        break;
      case 3:
        criaImagemFundoConteudo("./images/contas3.png");
        break;
  
    }
}

function mouseCimaIconeMenu(elemento){
  try {
    if(elemento.id == 'contaTool'){
      document.getElementById('toolConta').style.visibility = 'visible'
      document.getElementById('toolContaDados').style.visibility = 'visible'
  
      document.getElementById('toolContaDados').innerHTML = 
          `<span>Total nas contas:</span> <br>
          <span>${dadosMenu[0][0][0]}: ${dadosMenu[0][0][1]}</span> <br>
          <span>${dadosMenu[0][1][0]}: ${dadosMenu[0][1][1]}</span> `;
  
    }else if(elemento.id == 'receitasTool'){
      document.getElementById('toolReceita').style.visibility = 'visible'
      document.getElementById('toolReceitaDados').style.visibility = 'visible'
      document.getElementById('toolReceitaDados').innerHTML = 
          `<span>Total no Mês:</span> <br>
          <center><span>${dadosMenu[1][0][0]}</span></center>`;
    }else{
      document.getElementById('toolGasto').style.visibility = 'visible'
      document.getElementById('toolGastoDados').style.visibility = 'visible'
      document.getElementById('toolGastoDados').innerHTML = 
          `<span>Total no Mês:</span> <br>
          <center><span>${dadosMenu[2][0][0]}</span></center>`;
    }
  } catch (error) {   
    document.getElementById('toolGastoDados').innerHTML = 
          `<span>Total no Mês:</span> <br>
          <center><span>${dadosMenu[2][0][0]}</span></center>`;
    document.getElementById('toolContaDados').innerHTML = 
          `<span>Total nas contas:</span> <br>
          <span>${dadosMenu[0][0][0]}: ${dadosMenu[0][0][1]}</span> <br>
          <span>${dadosMenu[0][1][0]}: ${dadosMenu[0][1][1]}</span> `;
    document.getElementById('toolReceitaDados').innerHTML = 
          `<span>Total no Mês:</span> <br>
          <center><span>${dadosMenu[1][0][0]}</span></center>`;
  }
  
}
function mouseForaIconeMenu(elemento){
  try {
    if(elemento.id == 'contaTool'){
      document.getElementById('toolConta').style.visibility = 'hidden'
      document.getElementById('toolContaDados').style.visibility = 'hidden'
    }else if(elemento.id == 'receitasTool'){
      document.getElementById('toolReceita').style.visibility = 'hidden'
      document.getElementById('toolReceitaDados').style.visibility = 'hidden'
    }else{
      document.getElementById('toolGasto').style.visibility = 'hidden'
      document.getElementById('toolGastoDados').style.visibility = 'hidden'
    }
  } catch (error) { 
  }
}


function alteraSetaNav(elemento){
  sideNav = document.getElementById('sideMenuNav');
  if(elemento.innerText == '>'){
    elemento.innerText = '<';

    sideNav.style.left = '50%';
    sideNav.style.alignItems = 'center';
    sideNav.style.transform = 'translateX(-50%)';

    document.getElementById('idControleMesAno').style.top = '3.2%';
  }else{
    elemento.innerText = '>';

    sideNav.style.left = '-160px';
    sideNav.style.alignItems = 'none';
    sideNav.style.transform = '';

    document.getElementById('idControleMesAno').style.top = '6.2%';
    try {
      document.getElementById('active').id = '';
    } catch (error) {
    }
  }
}

// function alteraNavPosi(){
//   elemento = document.getElementById('setaNav');
//   if(elemento.innerText == '>' && document.getElementById('sideMenuNav').style.left !='-370px'){
//     document.getElementById('sideMenuNav').style.left = '-370px';
//   }else if(document.getElementById('sideMenuNav').style.left =='-370px'){
//     document.getElementById('sideMenuNav').style.left = '0px';
//   }

// }
function destacaNavCat(elemento){
  try {
    document.getElementById('active').id = '';
  } catch (error) {
  }

  if(elemento == 'Menu'){
    try {
      document.getElementById('active').id = '';
    } catch (error) {
    }
  }else{
    elemento.id = 'active';
  }

}

function openNavSideConf() {
  document.getElementById("mySidenav").style.width = "280px";
  colocaValoresNosCampos();
}

function closeNavSideConf() {
  document.getElementById("mySidenav").style.width = "0";
}


function ativaSnackbar(texto,corDeFundo = '#333'){
  let snackbar = document.getElementById("snackbar");
  let snackbarSpan = document.getElementById("snackbarSpan");
  snackbarSpan.innerText = texto;
  snackbar.style.backgroundColor = corDeFundo;
  snackbar.className = "show";
  setTimeout(function(){ 
    snackbar.className = snackbar.className.replace("show", ""); 
    snackbar.style.backgroundColor = '#333';
  }, 3000);
}


function ativaCelularMenu(elemento){
  if(elemento.style.opacity == '0' || elemento.style.opacity  == '' ){
    elemento.style.opacity ='0.7';
  }else{
    elemento.style.opacity = '0';
  }
}

function controlaIconeAlerta(){
  let icon = document.getElementById("iconDeAlerta");
  if(sitDesejoEconomia == 1){
    icon.className = 'iconeAlertaSpanVermelho';
  }else{
    icon.className = 'iconeAlertaSpanBranco';
  }
}

function visualizaAlerta(){
  let snackbar = document.getElementById("snackbar");
  snackbar.style.visibility = 'visible';
}

function fechaAlerta(){
  let snackbar = document.getElementById("snackbar");
  snackbar.style = '';
}