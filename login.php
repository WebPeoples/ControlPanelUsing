<!DOCTYPE html>
<html>
<head>
	<title></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
</head>
<body>
<form name="login" method="post">

CNPJ : <input type="text" id="cnpj" name="cnpj"><br>
Senha : <input type="password" id="password" name="senha"><br><br>
</form>

<Button class="btn btn-default" id="btn_entrar">Entrar</Button>

<div id="message"></div>

<script type="text/javascript">
	
$(document).ready(function(){


	function insertClients(){
		
		var page = "./php/loginefetuado.php";

		var cnpj = $('#cnpj').val();
		var password = $('#password').val();
		//alert(cnpj + password);

		/*var postData = '&senha='+password+'&razao='+razao+'&fantasia='+nomeFantasia+'&cnpj='+cnpj+'&numero='+numero+'&bairro='+bairro+'&cep='+cep+'&cidade='+cidade+'&estado='+estado+'&telefone='+telefone+'&telefone2='+telefone2+'&email='+email+'&dc_expediente='+dc_expediente+'&site='+site+'&possui_filiais='+possui_filiais+'&envio_emails='+envio_emails+'&pais='+pais+'&nm_rua='+rua;*/


		$.ajax({
			type: 'POST',
			dataType:'html',
			url:page,
			beforeSend: function(){
				$("#message").html("Carregando...");
			},
			data:{cnpj: cnpj, senha:password},
			success: function(msg){
				$('#message').html(msg);
			},
			error: function(msg){
				$('#message').html(msg);
			}
		});
	}

	  $(document).on('click', '#btn_entrar', function(){
            //alert("saa");
            insertClients();

        });
});


</script>
</body>
</html>