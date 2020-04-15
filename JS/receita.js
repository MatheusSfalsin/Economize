function controlaReceita(Element){
  localSelecionado = 'receita';
  removeLists(Element.className);/// 
  runCategoria(Element);
  usaAjax(`./php/controler/ControlerReceita.php?acao=buscar&&classTopo= topoPlanoReceita&&
  classCorpo= corpoReceita&&mes=${mesAtual}&&ano=${anoAtual}`,'idListOfRecords');
  createBtAdd(Element);
}

function modalReceita(){
  //let div = document.getElementById('idListOfRecords');
  let top = document.getElementsByClassName('modal-header')[0];
  top.id = 'topoPlanoReceita';
  let titulo = document.getElementById('tituloModal');
  let corpo = document.getElementsByClassName('modal-body')[0];
  let baixo = document.getElementById('baixoModal');
  corpo.innerHTML="";

  setTimeout("usaAjax(`./php/controler/ControlerReceita.php?acao=modal`,'corpoModal')",50) ;
  strTitulo = `Criar Receita`;
  LimpaCamposModal();
  strBaixo = `<button class="btn btn-secondary" id='criarRegistro' onclick="salvaRegistro('1')">Criar</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>`;
  foco();

  baixo.innerHTML += strBaixo; 
  titulo.innerHTML = strTitulo;
}

function buscaDadosReceitaMenu(){
  usaAjax(`./php/controler/ControlerReceita.php?acao=buscaMenu&&mes=${mesAtual}&&ano=${anoAtual}`,true)
  dadosMenu.push(dadosGlobal);
}

function controleModalReceitas(descricao='',valor='',conta='',dataRecebimento=''){
  validado = true;
  if(descricao == ''){
      validado = false;
      ativaSnackbar('Preencha uma descrição!','rgb(255, 83, 83)');
  }else if(valor <= 0 || valor == ''){
      validado = false;
      ativaSnackbar('Valor deve ser maior que 0!','rgb(255, 83, 83)');
  }else if(conta  == '-5' || conta == '-1'){
      validado = false;
      ativaSnackbar('Selecione uma conta','rgb(255, 83, 83)');
  }else if(dataRecebimento == ''){
      validado = false;
      ativaSnackbar('Data de recebimento nao preenchida!','rgb(255, 83, 83)');
  }
  return validado;
}

function limparCamposReceitas(){
  let desc  = document.getElementById('descricao');
  document.getElementById('valor').value = '';
  document.getElementById('dataRecebimentoReceita').value = '';
  desc.value = '';
  desc.focus();
}

// // ESQUELETO QUE CRIA O ELEMENTO 00 -> FONTES DE RENDA

// function controlaReceita(Element){
//   runCategoria(Element);
//   createBtAdd(Element.className); // cria o elemento de adicionar um ticket(Parametro: classe da categoria)
//   removeLists(Element.className);///
//   buscaCategorias(Element.className)////
//   retornaElements(Element.className);
 
// }




// function CriaReceita(ids,classCategoria){
//   var div = document.getElementById('idListOfRecords');
    
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
//       let spanData = createSpanInformation("dataReceitaSpan","Data de Recebimento");
//       //baixo
//       let inputValuer = createInput("valueClient",'number');
//       let inputDescr = createInput('descClient');
//       let select = createSelect('./php/controler/ControlerConta.php?acao=buscarSelect',bottomElemente.id);
//       let inputData = createInput('dataReceita','date','data');
//       let btConfirme = btConfirm(classCategoria,'idConfirmListReceita','idListOfRecords');

 
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


// //Estrutura que será retornada da lista da categoria 00 = Fontes de renda 
// function RetornaReceitas(){
//     let div = document.getElementById('idListOfRecords');
  
//     let element = elementList(' elementListReceita');
//     let topElemente = topElement();
//     let bottomElemente = bottomElement();
//     let spanValuer = createSpanInformation("value","Valor");
//     let spanDescr = createSpanInformation("idDesc","Descrição");
//     let spanConta = createSpanInformation("contaReceitaSpan","Conta");
//     let spanData = createSpanInformation("dataReceitaSpan","Data de Pagamento");
  
//     div.appendChild(element);
//     element.appendChild(topElemente);
//     element.appendChild(bottomElemente);
//     topElemente.appendChild(spanValuer);
//     topElemente.appendChild(spanDescr);
//     topElemente.appendChild(spanConta);
//     topElemente.appendChild(spanData);
  
//     return element;
//   }
  