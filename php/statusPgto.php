<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
    require 'connection.php';
    session_start();
    $cnpj = $_SESSION["cnpj"];

$notificationCode = preg_replace('/[^[:alnum:]-]/','',
    $_POST['notificationCode']);

$data['token'] = 'E62936E79A1E4A9FB7E7EBBDE0AF8568';
$data['email'] = 'gabriel.n64@hotmail.com';

$data = http_build_query($data);

$url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/
". $notificationCode . '?'. $data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);
echo $xml->status . " " . $xml->reference;


$_status = $xml->status;
$_reference = $xml->reference;

$sql = "INSERT INTO _using.plano_usuario (cnpj_cliente, tipo_plano, status, reference) VALUES('$cnpj', 'pago', $_status, $_reference)";
$sql_ = "UPDATE _using.plano_usuario SET status_pagamento = '$_status' WHERE reference = '$_reference'";
$stmt = $conn->prepare($sql_);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Plano pago registrado com sucesso";
}


?>