function mostraTelaCadastro(){
    let modal = document.getElementById('modalCadastroUser');
    if(modal.style.display=='block'){
        modal.style.display='none';
    }else{
        modal.style.display='block';
    }
}

function criarContaUser(){
    let nome = document.getElementById('nomeUsuarioCad');
    let email = document.getElementById('cadastrarEmail');
    let senha = document.getElementById('cadastrarSenha');
    let rtsenha = document.getElementById('repetirSenha');
    let validacao = validaCamposCadastroUser(nome,email,senha,rtsenha);

    if(validacao){
        usaAjax(`./php/services/criarContaUsuario.php?
        nomeUser=${nome.value}&&email=${email.value}&&senha=${senha.value}&&rtsenha=${rtsenha.value}`,'variavel');
        alert(dadosGlobal)
        if(dadosGlobal == '1'){
            fazLogin(email.value,senha.value);
            nome.value = '';
            email.value = '';
            mostraTelaCadastro();
        }
        senha.value = '';
        rtsenha.value = '';
    } 
}

function validaCamposCadastroUser(nome,email,senha,rtsenha){
    let validado = true;
    // alert(!!(nome.value))
    if(nome.value == ""){
        validado = false;
        nome.style.background = '#dc35454a';
        ativaSnackbar('Nome Inválido','rgb(255, 83, 83)');
    }else if(email.value.indexOf('@') == -1 || email.value == ""){
        validado = false;
        email.style.background = '#dc35454a';
        ativaSnackbar('Email Inválido','rgb(255, 83, 83)');
    }else if(senha.value == ""){
        validado = false;
        senha.style.background = '#dc35454a';
        ativaSnackbar('Senha Inválida','rgb(255, 83, 83)');
    }else if(rtsenha.value == ""){
        validado = false;
        rtsenha.style.background = '#dc35454a';
        ativaSnackbar('Senha Inválida','rgb(255, 83, 83)');
    }else if(rtsenha.value != senha.value){
        validado = false;
        senha.style.background = '#dc35454a';
        rtsenha.style.background = '#dc35454a';
        ativaSnackbar('As duas senhas não são iguais!','rgb(255, 83, 83)');
    }

    return validado;
}

function clickInputCadastroUser(campo){
    campo.style.background = '#f1f1f1';
    document.getElementById('cadastrarSenha').style.background = '#f1f1f1'
    document.getElementById('repetirSenha').style.background = '#f1f1f1'
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    // Get the modal
    try {
        let modal = document.getElementById('modalCadastroUser');
        let modalEntrarUser = document.getElementById('loginUser');
        if (event.target == modal) {
            modal.style.display = "none";
            
        }

        if (event.target.className != 'loginUserBlock' && event.target.className != 'btnEntrar' 
        && event.target.className != 'loginUser' && event.target.className != 'btnLogin')
        {
            modalEntrarUser.style.visibility = "hidden";
        }
    } catch (error) {  
    }
}