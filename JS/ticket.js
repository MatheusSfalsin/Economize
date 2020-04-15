//######################## FUNÇÕES QUE TRABALHARÃO AS LOGICAS DOS TICKETS #######################//
// CONFIRMA O TICKET DO USUÁRIO
confirmElementList = (self,id,classCategoria,divLista)=>{
    div = self.parentNode; // pega elemento pai do botão
    let numElements = div.childElementCount; // numero de elementos na div de baixo
    let conteudos = new Array();
    let idsSpans = new Array();
    
    for(let element = 0; element<numElements;element++){
      if(!(div.children[0] instanceof HTMLButtonElement)){                          /// ter cuidado com essa parte
        var valor = 0;
        var elemento = div.children[0];
        if(elemento instanceof HTMLSelectElement){
          valor = elemento.options[elemento.selectedIndex].text;
          conteudos.push(elemento.value); // provisorio
        }else if(elemento.className == "data"){
          valor = dataFormatoUsual(elemento.value);
          conteudos.push(valor);// provisorio
        }else{
          valor = elemento.value;
          conteudos.push(valor);// provisorio
        }

        spanInformationConfirm(elemento.id,valor,div);
        // conteudos.push(elemento.value);
        idsSpans.push(elemento.id);
      }
      div.removeChild(div.children[0]);
    }
    addListElements(idsSpans,classCategoria,conteudos,divLista);
    status = true;
}
  
// COLOCA AS INFORMAÇÕES NO TICKET DO USUÁRIO EM FORMA DE SPAN - Apos confirmação
function spanInformationConfirm(idElement,valueElement,elementDad){
    let span = document.createElement('span');
    span.id = idElement;
    span.innerText = valueElement;
    span.style.fontSize = "20px";
    //span.style.marginLeft = "";
    elementDad.appendChild(span);
  
}
  
// Retorna informações ao ticket em formato de span
  
function spanInformationReturn(idsSpans,valueElement,elementDad){
    for(indice in valueElement){
      let span = document.createElement('span');
      span.id = idsSpans[indice]; // array de ids
      span.innerText = valueElement[indice];
      span.style.fontSize = "20px";
      //span.style.marginLeft = "";
      elementDad.appendChild(span);
    }
}
  
// Remove elementos dos tickets
function removeLists(classCategoria = 'a0'){
    let indice = classCategoria[classCategoria.length-1]; //Caputura o ultimo caracter da classe = Categoria
    let divList = document.getElementById("idListOfRecords");
    let divList1 = document.getElementById("idListOfRecords1"); // teste
    let numDeElementsList1 = divList.childElementCount;
    let numDeElementsList2 = divList1.childElementCount;
    // if(indice > 0){
      try {
        for(let i = 0; i < numDeElementsList1; i++){
          divList.removeChild(divList.children[0])
        }
        for(let i = 0; i < numDeElementsList2; i++){
          divList1.removeChild(divList1.children[0])
        } 
      } catch (error) {
        alert(error)
      }
    // }
    
    
}
  
//Coloca os elementos de volta a lista
function retornaElements(classCategoria,divStr = ''){
    //let divList = document.getElementById("idListOfRecords");
    let indice = classCategoria[classCategoria.length-1];
    //alert(listElements[indice])
    for(let element in listElements[indice]){
      let elementList = controlerCategoriaReturn(classCategoria,divStr); // Elemento criado para abrigar ticket
      
      let idsSpans = listElements[indice][element].ids // array ids dos spans;
      let valueElement = listElements[indice][element].conteudo; // array com os conteúdos
      let divList = document.getElementById(''+listElements[indice][element].divLista);
      divList.appendChild(elementList) // adiciona na lista
  
      spanInformationReturn(idsSpans,valueElement,elementList.children[1]) // id do conteudo, valor e parte de baixo do ticket
    }
}
  
  
  
// Adiciona os elementos em uma lista de vetores onde cada vetor dessa lista 
// Pertence a uma funcionalidade
function addListElements(idsSpans,classCategoria,conteudos,divLista){
  let record = {            //Objetos - tickets das categorias
    ids: idsSpans,          // Array de ids dos spans
    idClass: classCategoria,   //
    conteudo : conteudos,   // Array do valores dos campos
    divLista: divLista            //Fazer 
  }
    
  let indice = classCategoria[classCategoria.length-1]; //Caputura o ultimo caracter da classe = Categoria
  salvaRegistro(indice,conteudos);
  listElements[indice].push(record); // Adiciona na lista de objetos dos elementos
}
  
  
  //OBjeto 
  /*
  let record = {
      id: id,                      // Identificação na lista de tickets 
      idClass: classObjeto,       //  Class da categoria que ela pertence 
      conteudo : conteudoElement //   Conteudo do campo
    }
  */

function dataFormatoSQL(data){
  return data.substr(6,4)+"-"+data.substr(3,2)+"-"+data.substr(0,2);
}

function dataFormatoUsual(data){
  return data.substr(8,2)+"/"+data.substr(5,2)+"/"+data.substr(0,4);
}