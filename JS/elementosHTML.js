//##################################### ELEMENTOS DE UM TICKET ###################################################//
function elementList(classElemento = '',idElemento = ''){
    let element = document.createElement('div');
    element.className = 'elementList' + classElemento;
    element.id = 'elementList' + idElemento+id;
    return element;
}
  
function topElement(){
    let topElement = document.createElement('div');
    topElement.id = "idTopList";
    return topElement;
}
  
function bottomElement(){
    let bottomElement = document.createElement('div');
    bottomElement.id = "idBottomList"+id;
    bottomElement.className = "bottomList"
    return bottomElement;
}
  
function createSpanInformation(idSpan,valorSpan){
    let spanValue = document.createElement('span');
    spanValue.id = idSpan;
    spanValue.innerHTML =valorSpan;
    return spanValue;
}
  
function createInput(idInput,type = 'text',classe = '',minDate = ''){
    let inputValue = document.createElement('input');
    inputValue.type = type;
    inputValue.id = idInput;
    inputValue.className = classe;
    if(minDate){
        inputValue.min = minDate;
    }
    return inputValue;
}
  
function createSelect(arquivo,camada){
    usaAjax(arquivo, camada);
    //return 'tese'
}

function btConfirm(classCategoria,idElemento = "idConfirmList",lista){
    let btConfirm = document.createElement('button');
    btConfirm.setAttribute("onclick",`confirmElementList(this,${id},'${classCategoria}','${lista}');`);
    btConfirm.id = idElemento;
    btConfirm.innerText = "OK"
  
    return btConfirm;
}