function controlaGasto(Element){
  localSelecionado = 'gasto';
  removeLists(Element.className);/// 
  runCategoria(Element);
  usaAjax(`./php/controler/ControlerGasto.php?acao=buscar&&classTopo= topoPlanoGasto&&
        classCorpo= corpoGasto&&mes=${mesAtual}&&ano=${anoAtual}`,'idListOfRecords');
  createBtAdd(Element);
  rotinaDeAlertaEconomia();
}

function modalGasto(){
  //let div = document.getElementById('idListOfRecords');
  let top = document.getElementsByClassName('modal-header')[0];
  top.id = 'topoPlanoGasto';
  let titulo = document.getElementById('tituloModal');
  let corpo = document.getElementsByClassName('modal-body')[0];
  let baixo = document.getElementById('baixoModal');
  corpo.innerHTML="";

  setTimeout("usaAjax(`./php/controler/ControlerGasto.php?acao=modal`,'corpoModal')",50) ;
  strTitulo = `Criar Gasto`;
  LimpaCamposModal();
  strBaixo = `<button class="btn btn-secondary" id='criarRegistro' onclick="salvaRegistro('2')">Criar</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal" >Fechar</button>`;
  foco();

  baixo.innerHTML += strBaixo; 
  titulo.innerHTML = strTitulo;
}

function buscaDadosGastoMenu(){
  usaAjax(`./php/controler/ControlerGasto.php?acao=buscaMenu&&mes=${mesAtual}&&ano=${anoAtual}`,true);
  dadosMenu.push(dadosGlobal);
}


function controleModalGastos(descricao='',valor='',conta='',dataRecebimento=''){
  validado = true;
  if(descricao == ''){
      validado = false;
      ativaSnackbar('Preencha uma descrição!','rgb(255, 83, 83)');
  }else if(valor >= 0 || valor == ''){
      validado = false;
      ativaSnackbar('Valor deve ser maior que 0!','rgb(255, 83, 83)');
  }else if(conta  == '-5' || conta == '-1'){
      validado = false;
      ativaSnackbar('Selecione uma conta','rgb(255, 83, 83)');
  }else if(dataRecebimento == ''){
      validado = false;
      ativaSnackbar('Data de pagamento nao preenchida!','rgb(255, 83, 83)');
  }
  return validado;
}

function limparCamposGastos(){
  let desc  = document.getElementById('descricao');
  document.getElementById('valor').value = '';
  document.getElementById('venciment').value = '';
  desc.value = '';
  desc.focus();
}


// function controlaGasto(Element){
//   runCategoria(Element);
//   createBtAdd(Element.className); // cria o elemento de adicionar um ticket(Parametro: classe da categoria)
//   removeLists(Element.className);///
//   buscaCategorias(Element.className)////
//   retornaElements(Element.className);
 
// }
// // ESQUELETO QUE CRIA O ELEMENTO 00 -> FONTES DE RENDA
// function CriaGasto(ids,classCategoria){
//     let div = document.getElementById('idListOfRecords');
      
//       if(!!(status)){
//         id += ids;
//         status = "";
        
//         let element = elementList(' elementListGasto','elementListGasto');
//         let topElemente = topElement();
//         let bottomElemente = bottomElement(); // parte de baixo do ticket
//         //cima
//         let spanValuer = createSpanInformation("valorGastoSpan","Valor");
//         let spanDescr = createSpanInformation("descricaoGastoSpan","Descrição");
//         let spanConta = createSpanInformation("contaReceitaSpan","Conta");
//         let spanData = createSpanInformation("dataGastoSpan","Data de Pagamento");
//         //baixo
//         let inputValuer = createInput("valorGasto",'number');
//         let inputDescr = createInput('descricaoGasto');
//         let select = createSelect('./php/controler/ControlerConta.php?acao=buscarSelect',bottomElemente.id);
//         let inputData = createInput('dataGasto','date','data');
//         let btConfirme = btConfirm(classCategoria,'idConfirmListGasto','idListOfRecords');
  
   
//         div.appendChild(element);
//         element.appendChild(topElemente);
//         element.appendChild(bottomElemente);
        
//         topElemente.appendChild(spanValuer);
//         topElemente.appendChild(spanDescr);
//         topElemente.appendChild(spanConta);
//         topElemente.appendChild(spanData);
          
//         bottomElemente.appendChild(inputDescr);
//         bottomElemente.appendChild(inputValuer);
//         bottomElemente.appendChild(inputData);
//         bottomElemente.appendChild(btConfirme);

//       }
//   }
  
  
//   //Estrutura que será retornada da lista da categoria 00 = Fontes de renda 
//   function RetornaGastos(){
//       let div = document.getElementById('idListOfRecords');
    
//       let element = elementList(' elementListGasto');
//       let topElemente = topElement();
//       let bottomElemente = bottomElement();
//       let spanValuer = createSpanInformation("valorGastoSpan","Valor");
//       let spanDescr = createSpanInformation("descricaoGastoSpan","Descrição");
//       let spanConta = createSpanInformation("contaReceitaSpan","Conta");
//       let spanData = createSpanInformation("dataReceitaSpan","Data de Pagamento");
    
//       div.appendChild(element);
//       element.appendChild(topElemente);
//       element.appendChild(bottomElemente);
//       topElemente.appendChild(spanDescr);
//       topElemente.appendChild(spanValuer);
//       topElemente.appendChild(spanConta);
//       topElemente.appendChild(spanData);
    
//       return element;
//     }
    