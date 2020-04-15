function controlaConta(Element){
    localSelecionado = 'conta';
    atualizaContas();
    removeLists(Element);/// 
    runCategoria(Element);
    setTimeout("usaAjax(`./php/controler/ControlerConta.php?acao=buscar&&classTopo= topoConta&&classCorpo= corpoConta`,'idListOfRecords')",50) 
    createBtAdd(Element);
   
}
  
function modalConta(){
    //let div = document.getElementById('idListOfRecords');
    let top = document.getElementsByClassName('modal-header')[0];
    top.id = 'topoConta';
    let titulo = document.getElementById('tituloModal');
    let corpo = document.getElementsByClassName('modal-body')[0];
    let baixo = document.getElementById('baixoModal');
    corpo.innerHTML="";
  
    
    setTimeout("usaAjax(`./php/controler/ControlerConta.php?acao=modal`,'corpoModal')",50) ;
    strTitulo = `Criar Conta`;
    LimpaCamposModal();
    strBaixo = `<button class="btn btn-secondary" data-dismiss="modal" id='criarRegistro' onclick="salvaRegistro('3')">Criar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Fechar</button>`;
    foco();
  
    baixo.innerHTML += strBaixo; 
    titulo.innerHTML = strTitulo;
}

function atualizaContas(){
  // if(status){
  usaAjax(`./php/controler/ControlerConta.php?acao=atualiza`,[])
  // }

}

function buscaDadosContaMenu(){
  usaAjax(`./php/controler/ControlerConta.php?acao=buscaMenu`,true)
  dadosMenu.push(dadosGlobal);
}

function selecionouConta(elemento){
  try {
    usaAjax(`./php/controler/ControlerConta.php?acao=vencimentoConta&&idConta=${elemento.value}`,'variavel')
    document.getElementById('venciment').value= dadosGlobal;
    if(dadosGlobal){
      document.getElementById('venciment').disabled= true; 
    }else{
     
      document.getElementById('venciment').disabled= false; 
    } 
  } catch (error) {
    
  }
}

function controleModalContas(descricao='',valor='',tipo='',dataRecebimento=''){
  validado = true;
  if(descricao == ''){
      validado = false;
      ativaSnackbar('Preencha uma descrição!','rgb(255, 83, 83)');
  }else if(valor < 0 || valor == ''){
      validado = false;
      ativaSnackbar('Valor deve ser maior ou igual a 0!','rgb(255, 83, 83)');
  }else if(tipo  == '-5' || tipo == '-1'){
      validado = false;
      ativaSnackbar('Selecione uma conta','rgb(255, 83, 83)');
  }else if(dataRecebimento == ''){
      validado = false;
      ativaSnackbar('Data de vencimento nao preenchida!','rgb(255, 83, 83)');
  }
  return validado;
}

function limparCamposContas(){
  let desc  = document.getElementById('descricao');
  document.getElementById('valor').value = '';
  document.getElementById('venciment').value = '';
  desc.value = '';
  desc.focus();
}
