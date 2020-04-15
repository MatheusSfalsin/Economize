<html lang="pt-br">
<head>

<!------------------------------------------------------------------------------------------------------------ -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Economize</title>
	<link href ="./css/style.css" type="text/css" rel="stylesheet">
	<link href ="./css/receitas.css" type="text/css" rel="stylesheet">
	<link href="./css/Contas.css" type = "text/css" rel = "stylesheet">
	<link href="./css/Gastos.css" type = "text/css" rel = "stylesheet">
	<link href="./css/planoContas.css" type = "text/css" rel = "stylesheet">
	<link href="./css/tabela.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/menu.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/ToolTip.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/topNavigation.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/login.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/criarConta.css" type = "text/css" rel = "stylesheet"> 
	<link href="./css/NavSideConf.css" type = "text/css" rel = "stylesheet"> 

</head>

<body onload='carregaPeriodoAtual();buscarDadosMenu();setaDataInfoTopo();criaLoginECat();
pegaDadosMenuParaAlerta();alertaDeEconomia();ativaBarraInformativoSnackbar();'>

<div class = "topo">
	<h1 class = 'barraTopoSite' id = "barraTopo"></h1>
	<p id = 'titulo' onclick="runMenu()">Economize</p>
	<p id = "infoJanela"></p>

	<div class ='controleMesDoAno' id='idControleMesAno'>
		<div class='capsIndicadorMes'>
			<span id = 'spanControleMes'></span>
		</div>
		<span id = 'spanControleMesAMenos' onclick = 'diminuiMes()'><</span>
		<span id = 'spanControleMesAMais' onclick = 'aumentaMes()'>></span>
	</div>
	<!-- data e hora -->
	<div class='horarioTopo' id='horarioTopo'>
		<span id='horaTopo'></span>
		<span id='dataTopo'></span>
	</div>

	<!-- Icone e nome do usuário -->
	<div id= 'nomeUsuario'>
		<img id= 'imgIconUser'src="exclamacaoverm.png" alt="Person" width="96" height="96">
		<div id='idNomeUsuario'></div>
		<span id = 'iconDeAlerta' class="iconeAlertaSpanBranco" onclick='visualizaAlerta()'>1</span>
	</div>

	<!-- login do usuário -->
	<div class = 'cadUsuario' id = 'cadUsuario'>
		<div class="loginUser" id = 'loginUser'>
			<label class="loginUserBlock" for="email" id='labelEmail'><b>Email</b></label>
			<input class="loginUserBlock" type="text" placeholder="Email" name="email" id = 'emailUser' required>

			<label class="loginUserBlock" for="psw" id='labelEmail'><b>Senha</b></label>
			<input class="loginUserBlock" type="password" placeholder="Sua senha" name="psw" id = 'senhaUser' required>

			<button class="btnLogin" onclick= 'fazLogin()'>Login</button>
		</div>
	</div>

	<!-- modal para cadastro do usuario no site  -> botão de cadastrar é gerado via Javascript arquivo login.js -->
	<div id="modalCadastroUser" class="modalCadastroUser">
		<span onclick="mostraTelaCadastro()" class="closeRegistroUser" title="Close Modal">&times;</span>
		<div class="modal-content_RegitrarUser">
			<div class="containerRegistroUser">
				<h1>Cadastra-se</h1>
				<p>Por favor, preencha este formulário para criar uma conta.</p>
				<hr>
				<label for="nome"><b>Qual é o seu nome?</b></label>
				<input class = 'inputsCadastro' id = 'nomeUsuarioCad' type="text" placeholder="Ex: João Batista" 
				name="nomeUser" required onclick='clickInputCadastroUser(this)'>

				<label for="email"><b>Cadastra-se seu Email</b></label>
				<input class = 'inputsCadastro' id = 'cadastrarEmail' type="text" placeholder="joao@email.com" 
				name="email" required onclick='clickInputCadastroUser(this)'>
		
				<label for="psw"><b>Crie uma senha</b></label>
				<input class = 'inputsCadastro' id = 'cadastrarSenha' type="password" placeholder="Crie uma senha" 
				name="psw" required onclick='clickInputCadastroUser(this)'> 
		
				<label for="psw-repeat"><b>Repetir a senha</b></label>
				<input class = 'inputsCadastro' id = 'repetirSenha' type="password" placeholder="Mesma senha do campo a cima" 
				name="psw-repeat" required onclick='clickInputCadastroUser(this)'>
				
				<label>
				<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Lembre-me
				</label>
		
				<p>Ao criar uma conta, você concorda com nosso <a href="#" style="color:dodgerblue">Termos & Privacidade</a>.</p>
		
				<div class="bottomRegistroUser">
				<button  class="registrarUserBtn cancelaResgistroUser" type="button" onclick="mostraTelaCadastro()">Cancelar</button>
				<button class="registrarUserBtn confirmaResgistroUser" type="button" onclick="criarContaUser()">Registrar-se</button>
				</div>
			</div>
		</div>
    </div>

	
	<img src="./images/home.png" alt="imgHome " id='imagemHome' onclick="runMenu()">

	<div class="topnav" id='sideMenuNav' >
		<div class="topNavElement destaqueNav" onclick = 'criaEstruturaPlano("tg-0lax0");destacaNavCat(this)'>Plano de Contas</div>
		<div class='topNavElement destaqueNav' onclick = 'controlaReceita("tg-0lax1");destacaNavCat(this) '>Receitas</div>
		<div class='topNavElement destaqueNav' onclick = 'controlaGasto("tg-0lax2");destacaNavCat(this)'>Gastos</div>
		<div class='topNavElement destaqueNav' onclick = 'controlaConta("tg-0lax3");destacaNavCat(this)'>Contas</div>
		<!-- <i class="topNavElement up" id = "arrow" onclick="alteraArrow()"></i> -->
		<div class='topNavElement'>
			<div class='destaquePontaNav' id='setaNav' onclick ='alteraSetaNav(this)'><</div>
		</div>
	</div>
</div>



<div class = "colunm" id = "idColunm">
	
	<table class="tg" id = "idTable">
		<tr>
			<td class="tg-0lax0" id = 'idPlanoDeContasTableNav' onclick = 'criaEstruturaPlano(this.className)'>
				<span style="font-weight:bold " >Plano de Contas</span>
			</td>
		</tr>
	
		<tr>
			<td class="tg-0lax1" onclick = 'controlaReceita(this.className)'>
				<span style="font-weight:bold">Receitas</span>
			</td>
		</tr>
		
	  	<tr>
			<td class="tg-0lax2" id = 'idPlanoDeContasTableNav' onclick = 'controlaGasto(this.className)'>
				<span style="font-weight:bold">Gastos</span>
			</td>
		</tr>
		
		<tr>
			<td class="tg-0lax3" onclick = 'controlaConta(this.className)'>
				<span style="font-weight:bold">Contas</span>
			</td>
	  	</tr>
	  
	  	<tr>
			<td class="tg-0lax4" onclick = 'runCategoria(this.className)'>
				<span style="font-weight:bold">Economias</span>
			</td>
	  	</tr>

	  	<tr>
			<td class="tg-0lax5" onclick = 'runCategoria(this.className)'>
				<span style="font-weight:bold">Metas ou Sonhos</span>
			</td>
	  	</tr>

	  	<tr>
			<td class="tg-0lax6" onclick = 'runCategoria(this.className)'>
				<span style="font-weight:bold">Dividas</span>
			</td>
	 	 </tr>

	</table>

</div>

<div class = 'Menu' id = 'Menu' >
	<div class = 'botaoMenuReceita'>
		<span class="tooltiptext toolReceita" id='toolReceita'>Receitas</span>
		<div class="tooltiptext toolReceitaDados cimaTool" id='toolReceitaDados'>Receitas</div>
		
		<div name="" value="" class="menuReceita" id= 'receitasTool' onclick = 'controlaReceita("tg-0lax1")'
		onmouseover = 'mouseCimaIconeMenu(this)' onmouseout='mouseForaIconeMenu(this)'><img src="receitas12.jpg" alt=""></div>
	
	</div>
	
	<div class = 'botaoMenuConta'>
		<span class="tooltiptext toolConta" id='toolConta'>Contas</span>
		<div class="tooltiptext toolContaDados esquerdaTool" id='toolContaDados'></div>

		<div  class="menuConta" id= 'contaTool' onclick = 'controlaConta("tg-0lax3")'
		onmouseover = 'mouseCimaIconeMenu(this)' onmouseout='mouseForaIconeMenu(this)'><img src="contasMenu2.png" alt=""></div>
	</div>

	<span class="tooltiptext toolGasto" id='toolGasto'>Gastos</span>
	<div class="tooltiptext toolGastoDados cimaTool" id='toolGastoDados'>Gastos</div>

	<div name="" value="" class="menuGasto" id= 'gastoTool' onclick = 'controlaGasto("tg-0lax2")'
	 onmouseover = 'mouseCimaIconeMenu(this)' onmouseout='mouseForaIconeMenu(this)'><img src="gastos1.jpg" alt=""></div>
	
	<img src="fundo-site.jpg" alt="imagem"  id='imagemFundo' >

	<!-- detalhes -->
	<div id = 'divCelularMenu' onclick = 'ativaCelularMenu(this)'>
	easter egg ;)
	</div>


</div>

<div class = "suporte" id = 'IdSuporte'>
	<img id = 'imgspt' src="./images/contimg1.png" alt="img" top = "5px">
</div>

<div class = "conteudo" id = "idConteudo">
	<div class = "editAttributes" id = "idEditAttributes">
		<div id = 'idInformativoDados'>DADOS APENAS DEMONSTRATIVOS</div>
	</div>

	<div class = "listOfRecords" id = "idListOfRecords">
	</div>
	<div class = "listOfRecords1" id = "idListOfRecords1"></div>
	<div id="idTabelaHistorico" class="tableHistorico">

	</div>
</div>

 
<div id="mySidenav" class="sidenavConf">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavSideConf()">&times;</a>
    <h3 style='color:white'>Configurações</h3>
    <span id = 'spanQuantEconomizar'>Informe o quanto deseja Economizar:</span> <br> 
    <input placeholder= 'Ex:300 'id ='inputQuantEconomizar' type="number">
    <button class="btconfirmConf" id="btconfirmConf" onclick="atualizaValorConfigEconomia()">OK</button>
</div>
<span id = 'abreNavSideConf' style="font-size:26px;cursor:pointer;color:white" onclick="openNavSideConf()">&#9776;</span>




<p id = 'log'></p>

<!-- The Modal -->
<div class="container">
 <div class="modal fade" id="criar" data-backdrop = "static" tabindex = "-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id = 'tituloModal'></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body" id = 'corpoModal'></div>
          
          <!-- Modal footer -->
          <div class="modal-footer" id = 'baixoModal'>
		</div>
          
        </div>
      </div>
    </div>
</div>

<div id="snackbar">
 	<span id="snackbarSpan"></span>
	<button type="button" class="close" id = 'modCloseAlert' onclick='fechaAlerta()' >&times;</button>
</div>


<script src = './JS/ajax.js'></script>
<script src = './JS/formataData.js'></script>
<script src = './JS/ticket.js'></script>
<script src = './JS/controladores.js'></script>
<script src = './JS/interfaceIndex.js'></script>
<script src = './JS/elementosHTML.js'></script>
<script src = './JS/planoDeContas.js'></script>
<script src = './JS/conta.js'></script>
<script src = './JS/receita.js'></script>
<script src = './JS/gasto.js'></script>
<script src = './JS/graficos.js'></script>
<script src = './JS/login.js'></script>
<script src = './JS/criarConta.js'></script>
<script src = './JS/configuracoes.js'></script>
<script src = './JS/main.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<!-- <script src="Table/script.js"></script> -->
<!-- <script>
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.lineTo(300, 150);
        ctx.stroke();
        </script> -->
</body>
</html>

