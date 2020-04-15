
function criaEstruturaPlano(Element){
    localSelecionado = 'planoDeContas';
    removeLists(Element.className);///
    removeBtAdd();
    runCategoria(Element);
    usaAjax(`./php/controler/ControlerPlano.php?acao=buscar&&categoria=1&&classTopo= topoPlanoReceita&&classCorpo= corpoReceita&&arrow=${status_arrow_plano}`,'idListOfRecords');
    usaAjax(`./php/controler/ControlerPlano.php?acao=buscar&&categoria=0&&classTopo= topoPlanoGasto&&classCorpo= corpoGasto&&arrow=${status_arrow_plano}`,'idListOfRecords');
    setTimeout("criaGraficoPlan()",150);
    setTimeout("buscaDadosParaGraficoPlano()",220);
    // alert(dadosGrafico)
    setTimeout("criaGraficoPlano()",350);
}

function modalPlano(title = '',modalTop = '',categoria = ''){ // categoria define ao tipo sera o plano, gastou ou receita
    //let div = document.getElementById('idListOfRecords');
    let top = document.getElementsByClassName('modal-header')[0];
    top.id = modalTop;
    let titulo = document.getElementById('tituloModal');
    let corpo = document.getElementsByClassName('modal-body')[0];
    let baixo = document.getElementById('baixoModal');
    corpo.innerHTML="";

    setTimeout("usaAjax('./php/controler/ControlerPlano.php?acao=modal&&categoria="+categoria+"','corpoModal')",50) ;
    strTitulo = `Criar Plano`+title;
    LimpaCamposModal();
    strBaixo = `<button class="btn btn-secondary" id='criarRegistro' onclick="salvaRegistro('0','${categoria}')">Criar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>`;
    foco();

    baixo.innerHTML += strBaixo; 
    titulo.innerHTML = strTitulo;
}

function enviaPlanos(){
    usaAjax(`./php/controler/ControlerPlano.php?acao=atualiza`,[])
}

function criaGraficoPlan(){
    let list = document.getElementById('idListOfRecords');
    list.innerHTML += `<div id="columnchart_material"></div>`;
}

function controleModalPlanoDeContas(descricao='',valor='',conta='',dataRecebimento='',tempo=''){
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
        ativaSnackbar('Data de vencimento nao preenchida!','rgb(255, 83, 83)');
    }else if(tempo  == '-5' || tempo == '-1'){
        validado = false;
        ativaSnackbar('Selecione um tempo de Vingência!','rgb(255, 83, 83)');
    }
    return validado;
}

function limparCamposPlanoDeContas(){
    let desc  = document.getElementById('descricao');
    desc.value = '';
    desc.focus()
    document.getElementById('estimativa').value = '';
    document.getElementById('venciment').value = '';
}