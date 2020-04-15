// var self_element = "";
// var status = true;
// var id = 0;
// var listElements = [[],[],[],[],[],[],[]];
// atualizaContas();

// //###################### CHAMA FUNÇÕES QUE IRÃO ESCONDER E GERAR EFEITOS AO MENU ##############################//

// // CHAMA FUNÇÕES QUE IRÃO EXECUTAR OUTRAS FUNÇÕES EM NOSSO FRONTEND - REDIRECIONA A UMA CATEGORIA SELECIONADA DO SITE //
// function runCategoria(Element){
//   if((document.getElementById('imagemFundo'))){ // se não existe menu(evita doble efeito na tabela)
//     modificaTable(0,1,51,90);
//   }

//   destacaItemTabela(Element) // gera feito a sessão selecionada
//   mostraInfoJanela(Element); // mostra qual aba esta selecionada na parte de cima do site
//   greyEditAttributes();      //Ira criar um div de inclusão de elementos na categoria
//   createBtAdd(Element.className); // cria o elemento de adicionar um ticket(Parametro: classe da categoria)
//   removeLists();
//   buscaCategorias(Element.className)
//   removeImagemFundoConteudo();
//   controleDeImagemFundo(Element.className)



//   try {
//     escondeMenu(); // irá esconder a tela do menu principal
//     escondeSuporte(); // irá esconder a tela do suporte esquerdo 
//   }catch (error) {
//   }

//     status = true; // possibilita usuario adicionar informação
//   retornaElements(Element.className);
// }

// // CHAMA FUNÇÕES QUE IRÃO EXECUTAR OUTRAS FUNÇÕES EM NOSSO FRONTEND - REDIRECIONA AO MENU DO SITE//
// function runMenu(){
//     if(!(document.getElementById('imagemFundo'))){ // se existe menu(evita doble efeito na tabela)
//       modificaTable(38,-1,89,51);
//     }

//     destacaItemTabela();  //faz a ação de remover feito a um item selecinado anteriomente
//     removeInfoJanela();   // remove a informação da parte de cima do site
//     nullEditAttributes();
//     criaSuporte();        // cria tela de suporte na parte esqueda do site 
//     criaMenu();           // cria menu principal     
//     removeBtAdd();
//     removeLists();
//     removeImagemFundoConteudo();
  
//     if(document.getElementsByTagName('body')[0].clientHeight*51/100 < document.getElementById('idTable').clientHeight){
//       modificaImagemMenu();
//     }

//     status = true; // possibilita usuario adicionar informação
// }


// //###################### Gera estilos e executa estruturas de base ao site(Menu,suporte,tabela de categorias...) ##############################//

// // gera feito a categoria selecionada ou a retira//
// function destacaItemTabela(Element){
//     try {
//         Element.style.textDecoration = "underline";
//         Element.style.background = '#a13a3a';
        
//         if(self_element){
//             self_element.style.textDecoration = "";
//             self_element.style.background = "";
//         }
//         self_element = Element;
//     } catch (error){
//       try {
//         self_element.style.textDecoration = "";
//         self_element.style.background = ""; 
//       } catch (error) {
        
//       }
//     }
// }

// // adiciona a informação da categoria na parte de cima do site
// function mostraInfoJanela(element){
//   document.getElementById('infoJanela').innerText = element.innerText;
// }
// // remove a informação da categoria na parte de cima do site
// function removeInfoJanela(){
//   document.getElementById('infoJanela').innerText = "";
// }

// //Gera efeito de opacidade do menu e da tela de suporte//
// function modificaImagemMenu() {
//     var elem = document.getElementById("imagemFundo");
//     let elemSuporte = document.getElementById('imgspt')
    
//     var pos = 0.2;
//     elem.style.opacity = '0';
//     elemSuporte.style.opacity = '0';
//     var id = setInterval(frame, 150);
//     fator = 0.1;
    

//     function frame() {
//       if (pos > 1) {
//         clearInterval(id);
//       } else {
//         pos+=fator; 
//         elem.style.opacity = pos + ''; 
//         elemSuporte.style.opacity = pos + ''; 
//       }
//     }
//   }

//  /*receberá na ordem de parametro: tamanho do objeto de suporte, fator define se o objeto ira reduzir(-1) ou aumentar(1) de tamanho,
//   porcentagem: a % do tamanho do elemento em relação a altura, porcFinal: porcentagem final que o elemento estará no final do efeito  */
// function modificaTable(tmSuport,fator,porcenatagem,porcFinal) {
//     var elem = document.getElementById("idTable");
    
//     document.getElementById('IdSuporte').style.height = `${tmSuport}%`;  
//     var pos = porcenatagem;
//     var id = setInterval(frame, 5);
//     fator = fator/2;

//     function frame() {
//       if (pos == porcFinal) {
//         clearInterval(id);
//       } else {
//         pos+=fator; 
//         elem.style.height = pos + '%'; 
//       }
//     }
//   }

// //remove o Fundo menu do site
// function escondeMenu(){
//     let divMenu = document.getElementById('Menu');
//     divMenu.removeChild(document.getElementById('imagemFundo'));   
// }

// //remove o Fundo do suporte do site
// function escondeSuporte(){
//     let divSuport = document.getElementById('IdSuporte');
//     divSuport.removeChild(document.getElementById('imgspt'));
// }
// // Cria novamente a tela de fundo do menu 
// function criaMenu(){
//     let divMenu = document.getElementById('Menu');

//     if(document.getElementById('imagemFundo')){
//     }else{
//         let imgMenu = document.createElement('img');
//         imgMenu.id = 'imagemFundo';
//         imgMenu.src = "./images/ft1.jpg";
//         divMenu.appendChild(imgMenu);
//     }
// }

// // Cria novamente a tela de fundo do menu
// function criaSuporte(){
//     let divSuport = document.getElementById('IdSuporte');
//     if(document.getElementById('imgspt')){
//     }else{
//         let imgSort = document.createElement('img');
//         imgSort.id = 'imgspt';
//         imgSort.src = "./images/contimg1.png";
//         divSuport.appendChild(imgSort)
//     }
// }



// //########## Edita barra que irá criar, editar,excluir tickets ou exibir informações sobre a categoria  ###############//

// function createBtAdd(classObjeto){
//   let div = document.getElementById('idEditAttributes');

//   if(document.getElementById('btCreate')){ // verfica se botão ja existe
//     removeBtAdd();
//   }
//   let btAdd = document.createElement('button');
//   btAdd.id = 'btCreate';
//   btAdd.style.background =  "url(./images/add.png)";
//   btAdd.setAttribute("onclick",`controlerCategoriaCreate('${classObjeto}')`);
//   div.appendChild(btAdd)
  
// }

// function removeBtAdd(){
//   let editAttributes = document.getElementById('idEditAttributes');
//   try {
//     editAttributes.removeChild(document.getElementById('btCreate'));
//   } catch (error) {
//   }
// }

// function greyEditAttributes(){
//   document.getElementById('idEditAttributes').style.background = "#4F4F4F";
//   document.getElementById('idEditAttributes').style.borderTop = "1px solid white";

// }
// function nullEditAttributes(){
//   document.getElementById('idEditAttributes').style.background = "";
// }

// //##################################### ELEMENTOS DE UM TICKET ###################################################//
// function elementList(classElemento = '',idElemento = ''){
//   let element = document.createElement('div');
//   element.className = 'elementList' + classElemento;
//   element.id = 'elementList' + idElemento+id;
//   return element;
// }

// function topElement(){
//   let topElement = document.createElement('div');
//   topElement.id = "idTopList";
//   return topElement;
// }

// function bottomElement(){
//   let bottomElement = document.createElement('div');
//   bottomElement.id = "idBottomList"+id;
//   bottomElement.className = "bottomList"
//   return bottomElement;
// }

// function createSpanInformation(idSpan,valorSpan){
//   let spanValue = document.createElement('span');
//   spanValue.id = idSpan;
//   spanValue.innerHTML =valorSpan;
//   return spanValue;
// }

// function createInput(idInput,type = 'text'){
//   let inputValue = document.createElement('input');
//   inputValue.type = type;
//   inputValue.id = idInput;
//   return inputValue;
// }

// function createSelect(arquivo,camada){
//   usaAjax(arquivo, camada);
// }

// function btConfirm(classCategoria,idElemento = "idConfirmList"){
//   let btConfirm = document.createElement('button');
//   btConfirm.setAttribute("onclick",`confirmElementList(this,${id},'${classCategoria}');`);
//   btConfirm.id = idElemento;
//   btConfirm.innerText = "OK"

//   return btConfirm;
// }

// function criaImagemFundoConteudo(url){
//   let conteudo = document.getElementById('idConteudo');
//   let imagemFundo = document.createElement('img');
//   imagemFundo.id = 'imagemFundoConteudo';
//   imagemFundo.src = url;
//   conteudo.appendChild(imagemFundo);
// }

// function removeImagemFundoConteudo(){
//   let imagemFundo = document.getElementById('imagemFundoConteudo');
//   if(imagemFundo){ // se existir ele irá remover imagem
//     let conteudo = document.getElementById('idConteudo');
//     conteudo.removeChild(imagemFundo);
//   }
// }

// function controleDeImagemFundo(classCategoria){
//   let categoria = classCategoria[classCategoria.length-1];
//   switch (Number(categoria)){
//     case 0:
//       criaImagemFundoConteudo("./images/plano3.png")
//       break;
//     case 1:
//       criaImagemFundoConteudo("./images/receitas135.png")
//       break;
//     case 2:
//       criaImagemFundoConteudo("./images/gastos3.png")
//       break;
//     case 3:
//       criaImagemFundoConteudo("./images/contas3.png");
//       break;

//   }
// }



// //######################## FUNÇÕES QUE IRÃO CONTROLAR QUAL ELEMENTO SERÁ ADICIONADO NA LISTA #######################//

// // Controla qual o tipo de elemento será criado na lista
// function controlerCategoriaCreate(classCategoria){
//   let categoria = classCategoria[classCategoria.length-1];
//   switch(Number(categoria)){
//     case 1: // receitas
//       createElementList00(1,classCategoria);
//       break;
    
//     case 3: //Contas
//       createElementList01(1,classCategoria)
//       break;

//     default:
//       alert("Categoria ainda não disponível!")
//   }
  
// }

// // Controla qual o tipo de elemento será Retornado a lista
// function controlerCategoriaReturn(classCategoria){
//   let categoria = classCategoria[classCategoria.length-1];
//   switch(Number(categoria)){
//     case 1:
//       return createCategoria00();
//     case 3:
//       return createCategoria01(); 
//     default:
//       alert("Categoria ainda não disponível!")
//   }
  
// }

//######################## FUNÇÕES QUE IRÃO CRIAR ELEMENTOS(TICKETS) #######################//
// // ESQUELETO QUE CRIA O ELEMENTO 00 -> FONTES DE RENDA
// function createElementList00(ids,classCategoria){
//   let div = document.getElementById('idListOfRecords');
    
//     if(!!(status)){
//       id += ids;
//       status = "";
      
//       let element = elementList(' elementListReceita','elementListReceita');
//       let topElemente = topElement();
//       let bottomElemente = bottomElement(); // parte de baixo do ticket
//       //cima
//       let spanValuer = createSpanInformation("value","Valor");
//       let spanDescr = createSpanInformation("idDesc","Descrição");
//       let spanConta = createSpanInformation("contaReceitaSpan","Conta");
//       let spanData = createSpanInformation("dataReceitaSpan","Data de Pagamento");
//       //baixo
//       let inputValuer = createInput("valueClient",'number');
//       let inputDescr = createInput('descClient');
//       //let select = createSelect('selectReceita','idConta','descricao','conta','','','' ); // MODIFICAR
//       let select = createSelect('./php/controler/ControlerConta.php?acao=buscarSelect',bottomElemente.id);
//       //comboWhere (${idSelect}, ${idTabela}, ${descTabela}, ${tabela}, ${filtro}, ${evento}, ${posicao});
//       let inputData = createInput('dataReceita','date');
//       let btConfirme = btConfirm(classCategoria,'idConfirmListReceita');

 
//       div.appendChild(element);
//       element.appendChild(topElemente);
//       element.appendChild(bottomElemente);
      
//       topElemente.appendChild(spanValuer);
//       topElemente.appendChild(spanDescr);
//       topElemente.appendChild(spanConta);
//       topElemente.appendChild(spanData);

//       bottomElemente.appendChild(inputValuer);
//       bottomElemente.appendChild(inputDescr);
//       bottomElemente.appendChild(btConfirme);
//       bottomElemente.appendChild(inputData);
//       //bottomElemente.appendChild(select);
//       div = bottomElemente.children[2].parentNode;
//       //alert(div.className)
//     }
// }

// ESQUELETO QUE CRIA O ELEMENTO 01 -> ARMAZENAGEM
// function createElementList01(ids,classCategoria){
  
//   let div = document.getElementById('idListOfRecords');
//   //conteudo.src = "imagens/contas3.png";

//     if(!!(status)){
//       id += ids;
//       status = "";
      
//       let element = elementList(' elementListContas');
//       let topElemente = topElement();
//       let bottomElemente = bottomElement();
      
//       //let spanValuer = createSpanInformation("totalContaSpan","Total na Conta");
//       let spanDescr = createSpanInformation("descContaSpan","Descrição");
//       let spanTipo = createSpanInformation("tipoContaSpan","Tipo da Conta");
//       //let spanBt = createSpanInformation("btConfirmaContasSpan","Tipo da Conta");

//       let inputValuer = createInput("descConta");
//       //let inputDescr = createInput('totalConta','number');
//       createSelect('./php/services/tipoDeConta.php',bottomElemente.id);
// 	    //let inputData = createInput('dataReceita','date');
//       //let select = createSelect('tipoContaSpan');
//       let btConfirme = btConfirm(classCategoria,'idConfirmListConta');

 
//       div.appendChild(element);
//       element.appendChild(topElemente);
//       element.appendChild(bottomElemente);

//       //topElemente.appendChild(spanValuer);
//       topElemente.appendChild(spanDescr);
//       topElemente.appendChild(spanTipo);
//       //topElemente.appendChild(spanBt);

//       bottomElemente.appendChild(inputValuer);
//       //bottomElemente.appendChild(inputDescr);
//       //bottomElemente.appendChild(inputData);
//       bottomElemente.appendChild(btConfirme);
     
//     }
// }



//######################## FUNÇÕES QUE IRÃO RETORNAR ELEMENTOS A LISTA DE TICKETS #######################//
// //Estrutura que será retornada da lista da categoria 00 = Fontes de renda 
// function createCategoria00(){
//   let div = document.getElementById('idListOfRecords');

//   let element = elementList(' elementListReceita');
//   let topElemente = topElement();
//   let bottomElemente = bottomElement();
//   let spanValuer = createSpanInformation("value","Valor");
//   let spanDescr = createSpanInformation("idDesc","Descrição");
//   let spanConta = createSpanInformation("contaReceitaSpan","Conta");
//   let spanData = createSpanInformation("dataReceitaSpan","Data de Pagamento");

//   div.appendChild(element);
//   element.appendChild(topElemente);
//   element.appendChild(bottomElemente);
//   topElemente.appendChild(spanValuer);
//   topElemente.appendChild(spanDescr);
//   topElemente.appendChild(spanConta);
//   topElemente.appendChild(spanData);

//   return element;
// }

//Estrutura que será retornada da lista da categoria 01 = armazenagem
// function createCategoria01(){
//   let div = document.getElementById('idListOfRecords');
//   //let conteudo = document.getElementById('imagemFundoConteudo');
//   //conteudo.src = "imagens/contas3.png";

//   let element = elementList(' elementListContas');
//   let topElemente = topElement();
//   let bottomElemente = bottomElement();

//   let spanValuer = createSpanInformation("totalConta","Total na Conta");
//   let spanDescr = createSpanInformation("descContaSpan","Descrição");
//   let spanTipo = createSpanInformation("tipoContaSpan","Tipo da Conta");

//   //let spanValuer = spanValue('idDesc');
//   //let spanDescr = spanDesc("value"); // provisório

//   div.appendChild(element);
//   element.appendChild(topElemente);
//   element.appendChild(bottomElemente);

//   topElemente.appendChild(spanValuer);
//   topElemente.appendChild(spanDescr);
//   topElemente.appendChild(spanTipo);

//   return element;
// }



// //######################## FUNÇÕES QUE TRABALHARÃO AS LOGICAS DOS TICKETS #######################//
// // CONFIRMA O TICKET DO USUÁRIO
// confirmElementList = (self,id,classCategoria)=>{
//   div = self.parentNode; // pega elemento pai do botão

//   let numElements = div.childElementCount; // numero de elementos na div de baixo
//   let conteudos = new Array();
//   let idsSpans = new Array();
  
//   for(let element = 0; element<numElements;element++){
//     if(!(div.children[0] instanceof HTMLButtonElement)){                          /// ter cuidado com essa parte
//       var valor = 0;
//       var elemento = div.children[0];
//       if(div.children[0] instanceof HTMLSelectElement){
//         valor = elemento.options[elemento.selectedIndex].text;
//       }else{
//         valor = elemento.value;
//       }

//       spanInformationConfirm(elemento.id,valor,div);
//       conteudos.push(elemento.value);
//       idsSpans.push(elemento.id);
//     }
//     div.removeChild(div.children[0]);
//   }
//   addListElements(idsSpans,classCategoria,conteudos);
//   status = true;
// }

// // COLOCA AS INFORMAÇÕES NO TICKET DO USUÁRIO EM FORMA DE SPAN - Apos confirmação
// function spanInformationConfirm(idElement,valueElement,elementDad){
//   let span = document.createElement('span');
//   span.id = idElement;
//   span.innerText = valueElement;
//   span.style.fontSize = "20px";
//   //span.style.marginLeft = "";
//   elementDad.appendChild(span);

// }

// // Retorna informações ao ticket em formato de span
// function spanInformationReturn(idsSpans,valueElement,elementDad){
//   for(indice in valueElement){
//     let span = document.createElement('span');
//     span.id = idsSpans[indice]; // array de ids
//     span.innerText = valueElement[indice];
//     span.style.fontSize = "20px";
//     //span.style.marginLeft = "";
//     elementDad.appendChild(span);
//   }
// }

// // Remove elementos dos tickets
// function removeLists(){
//   let divList = document.getElementById("idListOfRecords");
//   let numDeElements = divList.childElementCount;

//   for(let i = 0; i < numDeElements; i++){
//     divList.removeChild(divList.children[0])
//   }
// }

// //Coloca os elementos de volta a lista
// function retornaElements(classCategoria){
//   let divList = document.getElementById("idListOfRecords");
//   let indice = classCategoria[classCategoria.length-1];
//   //alert(listElements[indice])
//   for(let element in listElements[indice]){
//     let elementList = controlerCategoriaReturn(classCategoria); // Elemento criado para abrigar ticket
    
//     let idsSpans = listElements[indice][element].ids // array ids dos spans;
//     let valueElement = listElements[indice][element].conteudo; // array com os conteúdos
//     divList.appendChild(elementList) // adiciona na lista

//     spanInformationReturn(idsSpans,valueElement,elementList.children[1]) // id do conteudo, valor e parte de baixo do ticket
//   }
// }



// // Adiciona os elementos em uma lista de vetores onde cada vetor dessa lista 
// // Pertence a uma funcionalidade
// function addListElements(idsSpans,classCategoria,conteudos){
//   let record = {            //Objetos - tickets das categorias
//     ids: idsSpans,          // Array de ids dos spans
//     idClass: classCategoria,   //
//     conteudo : conteudos    // Array do valores dos campos
//   }
  
//   let indice = classCategoria[classCategoria.length-1]; //Caputura o ultimo caracter da classe = Categoria
//   salvaRegistro(indice,conteudos);
//   listElements[indice].push(record); // Adiciona na lista de objetos dos elementos
// }


// //OBjeto 
// /*
// let record = {
//     id: id,                      // Identificação na lista de tickets 
//     idClass: classObjeto,       //  Class da categoria que ela pertence 
//     conteudo : conteudoElement //   Conteudo do campo
//   }
// */

// function buscaCategorias(classCategoria){
//   //alert('2');
  
//   let indice = classCategoria[classCategoria.length-1]; //Caputura o ultimo caracter da classe = Categoria
//   if(verificaLista(indice)){
//     switch(indice){
//       case '1':
//         idsSpans =  ["valueClient", "descClient", "dataReceita", "selectReceita"];
//         classCategoria = "tg-0lax1";
//         usaAjax(`./php/controler/ControlerReceita.php?acao=buscar`,true,idsSpans,indice);
//         break;
//       case '3':
//         idsSpans =  ["descConta", "totalConta", "tipoConta"];
//         classCategoria = "tg-0lax3";
//         usaAjax(`./php/controler/ControlerConta.php?acao=buscar`,true,idsSpans,indice);
//         break;
//     }
//   }
// }

// function verificaLista(indice){
//   let verifica = listElements[indice].length > 0? false : true;
//   return verifica;
// }


// function salvaRegistro(indice,conteudos){
  
//   //alert(listElements[Number(indice)])
//   switch(indice){
//     case '1':
//       let valor = conteudos[0];
//       var descricao = conteudos[1];
//       let dataEfetiva = conteudos[2];
//       let conta = conteudos[3];
//       usaAjax(`./php/controler/ControlerReceita.php?acao=cria&&descricao=${descricao}&&valor=${valor}&&conta=${conta}
//                 &&dataEfetiva=${dataEfetiva}`,[]);
//       break;
//     case '3':
//       var descricao = conteudos[0];
//       let total = conteudos[2];
//       let tipo = conteudos[1];
//       usaAjax(`./php/controler/ControlerConta.php?acao=cria&&descricao=${descricao}&&total=${total}&&tipo=${tipo}`,[]);
//       break;
//   }

// }


