
	var Ajax = false;
	function AjaxRequest() {
		Ajax = false;
		if (window.XMLHttpRequest) { // Mozilla, Safari,...
			Ajax = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE
			try {
				Ajax = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					Ajax = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			}
		}
	}
	
	function resposta(arq, cam) {
		AjaxRequest();
		
		if(!Ajax) {
			document.write( '[Erro na Chamada]');
			return;
		}		
		Ajax.onreadystatechange = function () {
		
			if (Ajax.readyState == 4) {
					if (Ajax.status == 200) {
						 if(cam == 'variavel'){
							dadosGlobal = Ajax.responseText;
							// alert(teste)
							dadosGlobal = dadosGlobal.trim();
							// alert(dadosGlobal);
						}else if(typeof(cam) == 'string'){
							let div = document.getElementById(cam);			
							div.innerHTML =  div.innerHTML + Ajax.responseText;
						}else if (typeof(cam) == 'boolean'){
							try {
								let conteudo = JSON.parse(Ajax.responseText); // array de arrays
								dadosGlobal = [];
								conteudo.forEach(elemento => {
									dadosGlobal.push(elemento);
								});
							} catch (error) {
								let msg = 'Falha ao carregar dados, recarregue a pagina.';
								dadosGlobal = [[[msg],[msg]],[[msg],[msg]],[[msg],[msg]]];
							}
							
						}else{
							//alert(typeof(cam))
						}
						
					}
			}
		}
		
		Ajax.open('GET', arq , false);
		Ajax.send(null);
	}

function decideListaASerAdicionada(){
	
}

/*	
	function saidaAjax(c) {
		if (Ajax.readyState == 4) {
				if (Ajax.status == 200) {
					alert('resultado:' + Ajax.responseText);
					document.getElementById(c).innerHTML = Ajax.responseText;
				}
		}
	}
*/	
	// function usaAjax(arquivo, camada,idsSpans = '',indice = '',divLista = 'idListOfRecords') { // arquivo = pagina que sera solicitada / camada = telefone
	// 	resposta(arquivo,camada,idsSpans,indice,divLista);
	// }

	usaAjax = (arquivo, camada) => { // arquivo = pagina que sera solicitada / camada = telefone
		resposta(arquivo,camada);
	}
