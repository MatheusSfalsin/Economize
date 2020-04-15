function abreTelaParaLogin(acao = ''){
    login = document.getElementById('loginUser');
    // alert(login.style.visibility)
    if(!(acao) && login.style.visibility == 'hidden' || login.style.visibility == '' && !(acao) ){
        login.style.visibility = 'visible'
        login.style.opacity = '1'
    }else{
        login.style.visibility = 'hidden'
        login.style.opacity = '0'
    }
}

function fazLogin(login = '',senha = ''){
    if(!login && !senha){
        login = document.getElementById('emailUser').value;
        senha = document.getElementById('senhaUser').value;
    }
    usaAjax(`./php/services/login.php?login=${login}&&senha=${senha}`,'variavel');
    if(dadosGlobal == '1'){
        abreTelaParaLogin('N');
        removeEntrarECad();
        criaSair();
        atualizaPagAtual();
        document.getElementById('idInformativoDados').hidden = true;
        ativaSnackbar('Login efetuado com Sucesso!','#4CAF50');
    }else{
        ativaSnackbar('Email ou Senha Incorreto!','rgb(255, 83, 83)');
        document.getElementById('senhaUser').select();
    }
    
    buscarNomeUsuario();
}

//onload
function criaLoginECat(){
    verificaLogin();
    let pai =  document.getElementById('cadUsuario')
    if(dadosGlobal == '0'){
        let btEntrar =`<button class = 'btnEntrar' id = 'btnEntrar' onclick="abreTelaParaLogin()" >Entrar</button>` ;
        let btCad = `<button class = 'btnCadastro' id = 'btnCadastro' onclick="mostraTelaCadastro()" >Cadastrar</button>`;
        pai.innerHTML += btEntrar;
        pai.innerHTML += btCad;
        document.getElementById('idInformativoDados').hidden = false;
    }else{
        criaSair();
        document.getElementById('idInformativoDados').hidden = true;
    }
    buscarNomeUsuario();

}

function verificaLogin(){
    usaAjax(`./php/services/login.php?acao=verificaLogin`,'variavel');
}


function buscarNomeUsuario(){
    usaAjax(`./php/services/login.php?acao=buscarNome`,'variavel');
    let label =  document.getElementById('idNomeUsuario');
    label.innerText = dadosGlobal;
    if(dadosGlobal== 'Você não esta logado!'){
        let img =  document.getElementById('imgIconUser');
        img.src = 'exclamacaoverm.png';
    }else{
        let img =  document.getElementById('imgIconUser');
        img.src = 'img_avatar.png';
    }
}

function criaSair(){
    let pai =  document.getElementById('cadUsuario')
    btSair = `<button class = 'btnCadastro' id = 'btnSair' onclick="sairDaConta();criaLoginECat();removeSair()" >Sair</button>`
    pai.innerHTML += btSair;
}

function removeSair(){
    var node = document.getElementById("btnSair");
    node.parentNode.removeChild(node);
}


function removeEntrarECad(){
    var node = document.getElementById("btnEntrar");
    node.parentNode.removeChild(node);
    var node = document.getElementById("btnCadastro");
    node.parentNode.removeChild(node);

}

function sairDaConta(){
    usaAjax(`./php/services/login.php?acao=sair`,'variavel');
    ativaSnackbar(`Até mais ${dadosGlobal}!`);
    setTimeout('atualizaPagAtual',100);
    
}