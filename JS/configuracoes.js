var totalReceita = 0; // variável global
var totalGasto = 0; // variável global
var alertaEconomia = '';
var sitDesejoEconomia = 0;

function colocaValoresNosCampos(){
    usaAjax(`./php/services/alertaDeEconomia.php`,'variavel');
    document.getElementById('inputQuantEconomizar').value = dadosGlobal;
}

function atualizaValorConfigEconomia(){
    let input =  document.getElementById('inputQuantEconomizar');
    usaAjax(`./php/services/configuracoesUser.php?acao=updateValor&&valor=${input.value}`,'variavel');
    if(dadosGlobal == '1'){
        ativaSnackbar('Valor atualizado!');    
    }else{
        ativaSnackbar('Falha ao tentar atualizar!');
    }
    
}

function pegaDadosMenuParaAlerta(){
    try {
        totalReceita = parseFloat(dadosMenu[1][0][0].replace('R$','').replace('.','').replace(',','.'));
        totalGasto = parseFloat(dadosMenu[2][0][0].replace('R$','').replace('.','').replace(',','.')*-1);
    } catch (error) {
    }
    
}

function alertaDeEconomia(){
    try {
        usaAjax(`./php/services/alertaDeEconomia.php`,'variavel');
        var texto = '';
        
        if(totalReceita < 1 && dadosGlobal > 0){
            texto = 'Receitas zerada, não é possível economizar!';
            sitDesejoEconomia = 0;
        }else if(dadosGlobal >totalReceita){
            texto = `Receita abaixo do valor para economizar!`;
            sitDesejoEconomia = 1;
        }else if(dadosGlobal > 0){
            dadosGlobal = parseFloat(dadosGlobal)
            totalGasto =  parseFloat(totalGasto)
            
            maxGasto = totalReceita - dadosGlobal; // PEGA O MAXIMO QUE PODE SER GASTO
            maxGastoPorcent80 = maxGasto*0.8; 
            paraGastar = (parseFloat(maxGasto))- (totalGasto);
            // alert(`total receita: ${totalReceita} - total Gasto: ${totalGasto} - Quer Economizar:${dadosGlobal}
            //  maxParaGastar:${maxGasto} - MAx80Porc:${maxGastoPorcent80} - paraGastar: ${paraGastar}`)
            if(maxGasto < totalGasto){
                texto = `Você gastou R$${paraGastar*-1} a mais, evite mais gastos!`;
                sitDesejoEconomia = 1;
            }else if(maxGastoPorcent80 <= totalGasto){
                texto = `Gasto ultrapassou 80% do valor estipulado!`;
                sitDesejoEconomia = 1;
            }else{
                texto = `Você ainda pode gastar R$${paraGastar}!`;
                
                sitDesejoEconomia = 0;
            }
        }else{
            texto = 'Defina uma Economia na aba configurações!';
            sitDesejoEconomia = 0;
        }
        informativoDeEconomia(texto);
    } catch (error) {
        
    }
    

}

function informativoDeEconomia(texto){
    alertaEconomia = texto; 
}

function ativaBarraInformativoSnackbar(){
    try {
        let snackbarSpan = document.getElementById("snackbarSpan");
        snackbarSpan.innerText = alertaEconomia;
        if(!!(sitDesejoEconomia)){
            ativaSnackbar(alertaEconomia);
        }
    } catch (error) {
        
    }
    
}

function rotinaDeAlertaEconomia(){
    try {
        let mes = pegaMesAtual();
        let ano = pegaAnoAtual();
        if(ano < anoAtual){
            pegaDadosMenuParaAlerta()
            alertaDeEconomia()
            ativaBarraInformativoSnackbar()
        }else if(ano == anoAtual){
            if(mes <= mesAtual){
                pegaDadosMenuParaAlerta()
                alertaDeEconomia()
                ativaBarraInformativoSnackbar()
            }
        }

        controlaIconeAlerta();
    } catch (error) {
    }
    
    
}


