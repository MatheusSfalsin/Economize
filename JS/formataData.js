function dataAtual(){
    return new Date();
}

function dataFormatadCasual(data){
    let dataForm = formataValoresData(data);
    return dataForm[0]+"/"+dataForm[1]+"/"+dataForm[2];
}

function formataValoresData(data){
    dia  = data.getDate().toString(),
    diaF = (dia.length == 1) ? '0'+dia : dia,
    mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
    mesF = (mes.length == 1) ? '0'+mes : mes,
    anoF = data.getFullYear();
    return [diaF,mesF,anoF];
}

function dataParaFormatoSQL(data){
    let dataForm = formataValoresData(data);
    return dataForm[2]+"-"+dataForm[1]+"-"+dataForm[0];

}

function pegaMesAtual(){
    let data = dataAtual();
    return data.getMonth() + 1;
}

function pegaAnoAtual(){
    let data = dataAtual();
    return data.getFullYear();
}

function converteFormatoSQlAoPadrao(data){
    date = new Date(data.substr(6,4)+'-'+data.substr(3,2)+'-'+data.substr(0,2))
    return date;
}