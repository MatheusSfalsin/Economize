// //######################## FUNÇÕES QUE IRÃO CONTROLAR QUAL ELEMENTO SERÁ ADICIONADO NA LISTA #######################//

// // Controla qual o tipo de elemento será criado na lista
// function controlerCategoriaCreate(classCategoria,divStr = ''){
//     let categoria = classCategoria[classCategoria.length-1];
//     switch(Number(categoria)){
//       case 0: // receitas
//         criaPlano(1,classCategoria,divStr);
//         break;
//       case 1: // receitas
//         CriaReceita(1,classCategoria);
//         break;
        
//       case 2:
//         CriaGasto(1,classCategoria);
//         break;
          
//       case 3: //Contas
//         CriaConta(1,classCategoria);
//         break;

//       default:
//         alert("Categoria ainda não disponível!")
//     }
    
//   }
  
// // Controla qual o tipo de elemento será Retornado a lista
// function controlerCategoriaReturn(classCategoria,divStr = ''){
//     let categoria = classCategoria[classCategoria.length-1];
//     switch(Number(categoria)){
//       case 0:
//         return RetornaPlanos(divStr);
//       case 1:
//         return RetornaReceitas();
//       case 2:
//         return RetornaGastos(); 
//       case 3:
//         return RetornaContas(); 
//       default:
//         alert("Categoria ainda não disponível!")
//     }
// }

// function buscaCategorias(classCategoria){
//     //alert('2');
    
//     let indice = classCategoria[classCategoria.length-1]; //Caputura o ultimo caracter da classe = Categoria
//     if(verificaLista(indice)){
//       switch(indice){
//         case '0':
//           idsSpans =  ["descricaoPlano", "valorPlano", "dataPlano", "tempo"];
//           classCategoria = "tg-0lax0";
//           divLista = 'idListOfRecords';
//           usaAjax(`./php/controler/ControlerPlano.php?acao=buscar&&categoria=1`,true,idsSpans,indice,divLista);
//           idsSpans =  ["descricaoPlano", "valorPlano", "dataPlano", "tempo"];
//           classCategoria = "tg-0lax0";
//           divLista = 'idListOfRecords';
//           usaAjax(`./php/controler/ControlerPlano.php?acao=buscar&&categoria=0`,true,idsSpans,indice,divLista);
//           break;

//         case '1':
//           idsSpans =  ["valueClient", "descClient", "dataReceita", "selectReceita"];
//           classCategoria = "tg-0lax1";
//           divLista = 'idListOfRecords'
//           usaAjax(`./php/controler/ControlerReceita.php?acao=buscar`,true,idsSpans,indice,divLista);
//           break;

//         case '2':
//           idsSpans =  ["descricaoGasto", "valorGasto", "dataGasto", "selectReceita"];
//           classCategoria = "tg-0lax2";
//           divLista = 'idListOfRecords'
//           usaAjax(`./php/controler/ControlerGasto.php?acao=buscar`,true,idsSpans,indice,divLista);
//           break;
  
//         case '3':
//           idsSpans =  ["descConta", "totalConta", "tipoConta"];
//           classCategoria = "tg-0lax3";
//           divLista = 'idListOfRecords'
//           usaAjax(`./php/controler/ControlerConta.php?acao=buscar`,true,idsSpans,indice,divLista);
//           break;
//       }
//     }
// }

function atualizaPagAtual(){
  if(localSelecionado == 'planoDeContas'){
    criaEstruturaPlano('tg-0lax0');
  }else if(localSelecionado == 'receita'){
    controlaReceita('tg-0lax1');
  }else if(localSelecionado == 'gasto'){
    controlaGasto("tg-0lax2");
  }else if(localSelecionado == 'conta'){
    controlaConta("tg-0lax3");
  }else if(localSelecionado == 'Menu'){
    buscarDadosMenu();
  }
}
  
function verificaLista(indice){
    let verifica = listElements[indice].length > 0? false : true;
    return verifica;
}
  
function pegaConteudos(){
  let corpo = document.getElementsByClassName('modal-body')[0];
  let numElements = corpo.childElementCount;
  let conteudos = []
  for(let element = 0; element<numElements;element++){
    if(!(corpo.children[element] instanceof HTMLSpanElement || corpo.children[element] instanceof HTMLBRElement)){
      if(corpo instanceof HTMLSelectElement){
        valor = corpo.options[corpo.selectedIndex].text;
        conteudos.push(corpo.value); // provisorio
      }else{
        conteudos.push(corpo.children[element].value)
      }
      
    }
  }
  return conteudos;
}
  
function salvaRegistro(indice,categoria='0'){
    conteudos = pegaConteudos();
    switch(indice){
      case '0':
        var valor = conteudos[1];
        var descricao = conteudos[0];
        var conta = conteudos[2];
        var dataVencimento = conteudos[3];
        var tempo = conteudos[4];
        
        if(controleModalPlanoDeContas(descricao,valor,conta,dataVencimento,tempo)){
          usaAjax(`./php/controler/ControlerPlano.php?acao=cria&&descricao=${descricao}&&estimativa=${valor}&&conta=${conta}&&tempo=${tempo}
                  &&dataVencimento=${dataVencimento}&&categoria=${categoria}`,[]);

          setTimeout('criaEstruturaPlano("tg-0lax0")',100)
          setTimeout('enviaPlanos()',150)
          limparCamposPlanoDeContas();
          ativaSnackbar('Registrado com Sucesso!','#4CAF50');
        }
        break;

      case '1':
        var valor = conteudos[1];
        var descricao = conteudos[0];
        var dataEfetiva = conteudos[3];
        var conta = conteudos[2];
        if(controleModalReceitas(descricao,valor,conta,dataEfetiva)){
          usaAjax(`./php/controler/ControlerReceita.php?acao=cria&&descricao=${descricao}&&valor=${valor}&&conta=${conta}
                  &&dataEfetiva=${dataEfetiva}`,[]);
        
          setTimeout('controlaReceita("tg-0lax1")',50)
          setTimeout('enviaPlanos()',150)
          limparCamposReceitas();
        }
        break;
      
      case '2':
        var descricao = conteudos[0];
        var valor = (conteudos[1])*-1;
        var dataEfetiva =conteudos[3];
        var conta = conteudos[2];
        //alert('TEste: '+descricao+' '+valor+' '+dataEfetiva+' '+conta)
        if(controleModalGastos(descricao,valor,conta,dataEfetiva)){
          usaAjax(`./php/controler/ControlerGasto.php?acao=cria&&descricao=${descricao}&&valor=${valor}&&conta=${conta}
                  &&dataEfetiva=${dataEfetiva}`,);
          setTimeout('controlaGasto("tg-0lax2")',50)
          setTimeout('enviaPlanos()',150)
          limparCamposGastos();
        }
        
        break;

      case '3':
        var descricao = conteudos[0];
        var total = conteudos[1];
        var tipo = conteudos[2];
        var datVencimento = conteudos[3];
        if(controleModalContas(descricao,total,tipo,dataEfetiva)){
          usaAjax(`./php/controler/ControlerConta.php?
          acao=cria&&descricao=${descricao}&&total=${total}&&tipo=${tipo}&&dataVencimento=${datVencimento}`,[]);
          setTimeout('controlaConta("tg-0lax2")',50)
          setTimeout('enviaPlanos()',150)
          limparCamposContas();
        }
        
        break;
    }
  
}


