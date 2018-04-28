<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();
	
//EFETUAR PAGAMENTO	
$venda = array("codigo"=>"1",
			   "valor"=>100.00,
			   "descricao"=>"VENDA DE NONONONONONO",
			   "nome"=>"Luc",
			   "email"=>"luc@gmail.com",
			   "telefone"=>"(11) 1234-1234",
			   "rua"=>"Rua tal",
			   "numero"=>"121",
			   "bairro"=>"Jardim Santo Eduardo",
			   "cidade"=>"Embu das Artes",
			   "estado"=>"SP", //2 LETRAS MAIÚSCULAS
			   "cep"=>"06.824-270",
			   "codigo_pagseguro"=>"1000");
			   
$PagSeguro->executeCheckout($venda,"http://192.168.1.37:8079/login.php/".$_GET['codigo']);

//----------------------------------------------------------------------------


//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
		
	}else{
		//ATUALIZAR NA BASE DE DADOS
	}
}

?>