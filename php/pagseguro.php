<?php
require "connection.php";
session_start();

$cnpj = $_SESSION['cnpj'];
/*
$data['token'] = 'E62936E79A1E4A9FB7E7EBBDE0AF8568';
$data['email'] = 'gabriel.n64@hotmail.com';
$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Serviços Using';
$data['itemAmount1'] = $_POST['preco'];

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);
echo $xml -> code;*/
$queryForEspecialidade = "SELECT [reference] FROM [_using].[plano_usuario] WHERE [cnpj_cliente] = '$cnpj'";

$stmtQuery = $conn->prepare($queryForEspecialidade);
$stmtQuery->execute();
$reference = null;
$result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
foreach($stmtQuery->fetchAll() as $k=>$v) {
    $reference = $v['reference'];
}


$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/request';
$data['email'] = 'gabriel.n64@hotmail.com';
$data['token'] = 'E62936E79A1E4A9FB7E7EBBDE0AF8568';
$data['currency'] = 'BRL';
$data['reference'] = $reference;
$data['senderName'] = 'Marcos';
$data['senderEmail'] = 'marcos@gmail.com';
// $data['senderAreaCode'] = '55';
// $data['senderPhone'] = $cliente['telefone'];
// $data['shippingAddressStreet'] = "";
// $data['shippingAddressNumber'] = "";
// $data['shippingAddressPostalCode'] = "";
// $data['shippingAddressCity'] = "";
// $data['shippingAddressState'] = "";
// $data['shippingAddressCountry'] = 'BRA';
$data['redirectURL'] = 'http://www.gmc0304.esy.es/perfil?pagseguro-ok';
$data['preApprovalCharge'] = 'manual';
$data['preApprovalName'] = 'Serviços Using - Assinatura mensal';
$data['preApprovalDetails'] = 'Cobrança de valor mensal para assinatura';
$data['preApprovalAmountPerPayment'] = $_POST['preco'];
$data['preApprovalPeriod'] = 'MONTHLY';
//$data['preApprovalFinalDate'] = '2020-10-17T19:20:30.45+01:00';
//$data['preApprovalMaxTotalAmount'] = '999.00';
$data['reviewURL'] = 'http://seusite.com.br.com.br/planos';
$data = http_build_query($data);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$xml= curl_exec($curl);
if($xml == 'Unauthorized'){
    echo "Unauthorized";
    exit();
}
curl_close($curl);
$xml= simplexml_load_string($xml);
if(count($xml->error) > 0){
    echo "XML ERRO";
    exit();
}
//header('Location: https://pagseguro.uol.com.br/v2/pre-approvals/request.html?code='.$xml->code);
echo $xml->code;
?>