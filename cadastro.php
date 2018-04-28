<!DOCTYPE html>
<html>
<head>

<!-- BAIXANDO AS BIBLIOTECAS DE JQUERY E BOOTSTRAP, ESTOU USANDO SOMENTE JQUERY-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Cadastro</title>


</head>
<body>


<body>

<!-- ESTOU DANDO UM ID PARA O FORMULÁRIO id="form"-->
<form method="post">

<!-- ESTOU DANDO UM ID PARA CADA CAMPO DO FORMULÁRIO -->
<!--  COD VALIDAÇÃO CNPJ-->



CNPJ: <input type="text" id="cnpj" name="cnpj"/>



<br>
Senha:<input type="password" id="password" name="senha"/><br>
Nome razão social: <input type="text" id="razaoSocial" name="nm_razao"/><br>
Nome fantasia : <input type="text" id="nomeFantasia" name="nm_fantasia"/><br>
País : <input type="text" id="pais" name="pais"/><br>
Estado : <input type="text" id="estado" name="estado"/><br>
Cidade : <input type="text" id="cidade" name="cidade"/><br>
CEP : <input type="text" id="cep" name="cep"/><br>
Bairro: <input type="text" id="bairro" name="bairro"/><br>
Nome da rua : <input type="text" id="rua" name="nm_rua"/><br>
Numero: <input type="text" id="numero" name="numero"/><br>
Telefone 1 (opcional): <input type="text" id="telefone" name="tel1"/><br>
Telefone 2 (opcional): <input type="text" id="telefone2" name="tel2"/><br>
E-mail:<input type="text" id="email" name="email"/><br>
Descrição expediente:<input type="text" id="dc_expediente" name="dc"/><br>
Web site : <input type="text" id="site" name="website"/><br>

logotipo:<br>

Possui filiais:
<select name="possui_filiais" id="possui_filiais">
  <option value="null"></option>
  <option value="s">Sim</option>
  <option value="n">Não</option>
</select><br>
Autoriza envio de e-mails ?:
<select name="envio_emails" id="envio_emails">
  <option value="null"></option>
  <option value="s">Sim</option>
  <option value="n">Não</option>
</select><br>


<!-- ESTOU DANDO UM ID PARA O BOTÃO -->


</form>
<button class="btn btn-default" id="btn" value ="Cadastrar">CADASTRAR</button>

<div id="message"></div>
<img src="img/lg.progress-bar-preloader.gif" id="gif" style="display: none">
<script type="text/javascript">

// A PALAVRA 'document' REPRESENTA O ARQUIVO INTEIRO, O MÉTODO QUE VEM APÓS (ready), DIZ QUE O CÓDIGO DENTRO DA FUNÇÃO
// SERÁ EXECUTANDO ANTES DA PÁGINA SER CARREGADA PARA EVITAR ERROS.
$(document).ready(function() {





// ESTOU CRIANDO UMA FUNÇÃO CUJO O OBJETIVO É CHECAR SE OS CAMPOS FORAM PREENCHIDOS
function checkData(){

	// ESTOU CRIANDO UMA LISTA CHAMADA ERRO PARA ARMEZANAR OS ERROS QUE VOU EXIBIR CASO ACONTEÇA
	var erros = new Array();

	//ESTOU CRIANDO VARIÁVEIS 'exemplo: var cnpj', '$('#cnpj').val();' ESTE CÓDIGO É JQUERY, O COMEÇO '$('#cnpj')' pega 
	// id que eu criei lá em cima nos campos do formulário, em seguida a part '.val();' é uma função responsável por 
	// pegar os dados que foram digitados em um campo do formulário.
	// Estou fazendo isso com todos os campos.
	var cnpj = $('#cnpj').val();
	var password = $('#password').val();
	var razao = $('#razaoSocial').val();
	var pais = $('#pais').val();
	var estado = $('#estado').val();
	var cidade = $('#cidade').val();
	var cep = $('#cep').val();
	var bairro = $('#bairro').val();
	var rua = $('#rua').val();
	var numero = $('#numero').val();
	var telefone = $('#telefone').val();
	var email = $('#email').val();


	//ESTOU CRIANDO UMA SÉRIE DE IF'S PARA CHECAR SE AS VÁRIAVEIS QUE EU CRIEI A CIMA ESTÃO VAZIAS
	// SE ESTIVEREM VAZIAS (cnpj = ""), QUER DIZER QUE O USUÁRIO NÃO DIGITOU NADA.
	if (cnpj === "") {
			
		// SE A VARIÁVEL ESTIVER VAZIA SIGNIFICA QUE O CAMPO ESTÁ TAMBÉM E O USUÁRIO NÃO DIGITOU NADA.
		// ENTÃO EU ARMAZENO O NOME 'CNPJ' NA MINHA LISTA DE ERRO QUE SERÁ EXIBIDO CASO ALGUM CAMPO ESTEJA EM BRANCO
		erros.push("\nCNPJ");
	}

	// FAÇO A MESMA COISA COM OS DEMAIS CAMPOS
	if (password ==="") {

		//IMPORTANTE SE ATENTAR QUE CASO O CAMPO ESTIVER VAZIO EU ADIOCIONO NA LISTA O NOME DO CAMPO
		erros.push("\nSenha");
	}

	if(razao ===""){
		erros.push("\nRazão Social");
	}

	if (pais === "") {
		erros.push("\nPaís");
	}

	if (estado === "") {
		erros.push("\nEstado");
	}

	if (cidade === "") {
		erros.push("\nCidade");
	}

	if (cep === "") {
		erros.push("\nCEP");
	}

	if (bairro === "") {
		erros.push("\nBairro");
	}

	if (rua === "") {
		erros.push("\nRua");
	}

	if (numero === "") {
		erros.push("\nNúmero local");
	}

	if (telefone === "") {
		erros.push("\nTelefone");
	}

	if (email === "") {
		erros.push("\nEmail");
	}

	// NO FINAL DE TUDO, EU CHECO SE MINHA LISTA DE ERROS É MAIOR QUE 0, SE FOR MAIOR QUE ZERO, QUER DIZER QUE EU ESQUECI
	// DE PREENCHER ALGUM CAMPO, LEMBRANDO QUE ANTERIORMENTE, EU CRIEI IF'S PARA CHECAR SE O CAMPO ESTAVA VAZIO
	// SE ESTIVESSE VAZIO, EU ADICIONAVA O NOME DE NA LISTA. ENTÃO SE DOIS CAMPOS ESTIVEREM VAZIOS, MINHA LISTA DE ERROS
	// É IGUAL A 2 E ENTÃO MAIOR QUE ZERO
	if (erros.length === 0 ) {
		insertClients();
		//AQUI EU CRIO UM ALERT, QUE É A MENSAGEM QUE APARECE NO TOPO DO SITE, VEJA QUE ESCREVI UMA MENSAGEM E EM SEGUIDA
		// ADICIONEI MINHAS LISTA DE ERROS QUE POSSUI OS CAMPO QUE OS USUÁRIOS NÃO PREENCHERAM
		//alert("Você não preencheu o(s) campo(s): " + erros);

		//O COMEÇO '$('$form')' pega o id do formulário criado lá em cima. A parte '.submit(function())' diz respeito 
		// ao botão de cadastrar, caso dê algum erro, eu retorno falso para o botão, assim a página 'cadastrando.php'
		// não será executada
	}else{
		alert("Você deixou de preencher os seguintes campos:" + erros);
	}
}
	
	

function insertClients(){
		
		var page = "./php/cadastrando.php";

		var cnpj = $('#cnpj').val();
		var password = $('#password').val();
		var razao = $('#razaoSocial').val();
		var nomeFantasia = $("#nomeFantasia").val();
		var pais = $('#pais').val();
		var estado = $('#estado').val();
		var cidade = $('#cidade').val();
		var cep = $('#cep').val();
		var bairro = $('#bairro').val();
		var rua = $('#rua').val();
		var numero = $('#numero').val();
		var telefone = $('#telefone').val();
		var telefone2 = $('#telefone2').val();
		var email = $('#email').val();
		var dc_expediente = $('#dc_expediente').val();
		var site = $('#site').val();
		var possui_filiais = $('#possui_filiais option:selected').val();
		var envio_emails = $('#envio_emails option:selected').val();


		var postData = '&senha='+password+'&razao='+razao+'&fantasia='+nomeFantasia+'&cnpj='+cnpj+'&numero='+numero+'&bairro='+bairro+'&cep='+cep+'&cidade='+cidade+'&estado='+estado+'&telefone='+telefone+'&telefone2='+telefone2+'&email='+email+'&dc_expediente='+dc_expediente+'&site='+site+'&possui_filiais='+possui_filiais+'&envio_emails='+envio_emails+'&pais='+pais+'&nm_rua='+rua;


		$.ajax({
			type: 'POST',
			dataType:'html',
			url:page,
			beforeSend: function(){
				$("#dados").html("Carregando...");
			},
			data:postData,
            beforeSend: function () {
                $("#gif").show();
            },
			success: function(msg){
				var cadastradoComSucesso = 'cadastrado com sucesso';
				if(msg === cadastradoComSucesso ){
				    $('#message').html(msg);
                    window.location.href = "./processoDeCadastramento.php";
                }else{
				    $('#message').html(msg);
                }
			},
			error: function(msg){
				$('#message').html(msg);
			}
		});
	}

	//o começo '$(document)' seleciona o arquivo inteiro, em seguida '.on('click', '#btn', function(){})' diz que 
	// a função é o click '.on('click'', e que o item a ser clicado é '.on('click','#btn'', #btn é o id dado ao botão cadastrar
	// lá em cima, em seguida damos uma função para o click no botão ".on('click', '#btn', function(){})"
	$(document).on('click','#btn', function(){

		//ESTOU CHAMANDO A FUNÇÃO CRIADA QUE É RESPONSÁVEL POR CHECAR SE TUDO FOI DIGITADO
		checkData();
		
	});
});
</script>
</body>
</html>