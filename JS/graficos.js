function criaGraficoPlano(){
    try {
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);   
    } catch (error) {
    }
}

function drawChart() {
    arrayDados = dadosGlobal;
    let dados = [['MÊS', 'Receitas', 'Despesas']];
    arrayDados.forEach(element => {
        if(!element[1]){
            element[1] = 0;
        }
        if(!element[2]){
            element[2] = 0;
        }
        
        dados.push(element);
    });

    
    var data = google.visualization.arrayToDataTable(dados);

    var options = {
        chart: {
          title: 'Receitas e Despesas',
          subtitle: 'Relação entre receitas e gastos ',
        },
        vAxis: {format: 'decimal'},
        colors: ['rgb(117, 243, 149)', 'rgb(238, 113, 113)']
    };

    try {
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    } catch (error) {
    }
}

function buscaDadosParaGraficoPlano(){
    usaAjax(`./php/controler/ControlerPlano.php?acao=buscaGrafico&&mes=${mesAtual}&&ano=${anoAtual}`,true)
    // alert(dadosGrafico)
    //return [['setembro',1000,500],['Outubro',1000,600],['Novembro',1000,700],['Dezembro',1000,1100],['Janeiro',1000,900]]
}

var boraLa;
window.onresize = function(){
  if(localSelecionado == 'planoDeContas'){
    clearTimeout(boraLa);
    try {
        boraLa = setTimeout('criaGraficoPlano()', 100);
    } catch (error) {
    } 
  }
};