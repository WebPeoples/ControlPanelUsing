<?php
	require 'connection.php';
session_start();

$CNPJ=$_POST['cnpj'];
$senha=$_POST['senha'];
$razaoSocial=$_POST['razao'];
$nomeFantasia=$_POST['fantasia'];
$pais=$_POST['pais'];
$estado=$_POST['estado'];
$cidade=$_POST['cidade'];
$cep=$_POST['cep'];
$bairro=$_POST['bairro'];
$nomeRua=$_POST['nm_rua'];
$numero=$_POST['numero'];
$telfone1=$_POST['telefone'];
$telfone2=$_POST['telefone2'];
$email=$_POST['email'];
$descricao=$_POST['dc_expediente'];
$webSite=$_POST['site'];
$possuiFilial=$_POST['possui_filiais'];
$atEmail=$_POST['envio_emails'];

$CnpjRowCount = null;
$EmailRowCount = null;

// Get lat and long by address
$address = $nomeRua .", ". $numero ." - " . $bairro . ", " . $cidade . " - " . $estado;
//$prepAddr = str_replace(' ','+',$address);
//$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
//$output= json_decode($geocode);
//$latitude = $output->results[0]->geometry->location->lat;
//$longitude = $output->results[0]->geometry->location->lng;

//$address = "Kathmandu, Nepal";
$url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$responseJson = curl_exec($ch);
curl_close($ch);

$response = json_decode($responseJson);

if ($response->status == 'OK') {
    $latitude = $response->results[0]->geometry->location->lat;
    $longitude = $response->results[0]->geometry->location->lng;
} else {
    echo $response->status;
    var_dump($response);
}  



	
	if(!validar_cnpj($CNPJ)) {
        echo "Este cnpj não é valido.";
    }else{
	

	$ifCnpjExists = "SELECT nr_cpf_cnpj FROM _using.cliente WHERE nr_cpf_cnpj = '$CNPJ'";
	$stmtCnpj = $conn->prepare($ifCnpjExists,  array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmtCnpj->execute();
	$CnpjRowCount = $stmtCnpj->rowCount();


	$ifEmailExists = "SELECT nm_email FROM _using.cliente WHERE nm_email = '$email'";
	$stmtEmail = $conn->prepare($ifEmailExists,  array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmtEmail->execute();
	$EmailRowCount = $stmtEmail->rowCount();

	if($CnpjRowCount > 0 && $EmailRowCount > 0 && $CnpjRowCount != null && $EmailRowCount != null ){
		echo "Este cnpj e email já foram cadastrados.";
	}else if ($CnpjRowCount > 0){
		echo "Este cnpj já foi cadastrado.";
	}else if($EmailRowCount > 0){
		echo "Este email já foi cadastrado.";
	}else{

		$sql = "
		INSERT INTO [_using].[cliente]
		           ([nr_cpf_cnpj]
		           ,[senha]
		           ,[nm_razao_social]
		           ,[nm_fantasia]
		           ,[dt_inclusao_cli]
		           ,[cd_status_cli]
		           ,[nome_rua]
		           ,[numero_local]
		           ,[nm_bairro]
		           ,[cd_cep_cli]
		           ,[nm_cidade_cli]
		           ,[cd_estado_cli]
		           ,[pais_cli]
		           ,[nr_telefone1_cli]
		           ,[nr_telefone2_cli]
		           ,[nm_email]
		           ,[dc_expediente_cli]
		           ,[link_web]
		           ,[st_existe_filiais]
		           ,[st_autoriza_email]
		           , [latitude_cli]
		           , [longitude_cli]
		           )
		     VALUES
		           ('$CNPJ',
		           '$senha',
		           '$razaoSocial',
		           '$nomeFantasia',
		           CURRENT_TIMESTAMP,
		           'A',
		           '$nomeRua',
		           '$numero',
		           '$bairro',
		           '$cep',
		           '$cidade',
		           '$estado',
		           '$pais',
		           '$telfone1',
		           '$telfone2',
		           '$email',
		           '$descricao',
		           '$webSite',
		           '$possuiFilial',
		           '$atEmail',
		           '$latitude',
		           '$longitude'
		          )";

	$stmt = $conn->prepare($sql);



	/*$dt_inclusao_cli = 'CURRENT_TIMESTAMP';
	$cd_status_cli = 'A';

	$stmt->bindParam(':cnpj', $CNPJ);
	$stmt->bindParam(':senha', $senha);
	$stmt->bindParam(':nm_razao_social', $razaoSocial);
	$stmt->bindParam(':nm_fantasia', $nomeFantasia);
	$stmt->bindParam(':pais_cli', $pais);
	$stmt->bindParam(':estado', $estado);
	$stmt->bindParam(':nm_cidade_cli', $cidade);
	$stmt->bindParam(':cd_cep_cli', $cep);
	$stmt->bindParam(':nm_bairro', $bairro);
	$stmt->bindParam(':nome_rua', $nomeRua);
	$stmt->bindParam(':numero_local', $numero);
	$stmt->bindParam(':nr_telefone1_cli', $telfone1);
	$stmt->bindParam(':nr_telefone2_cli', $telfone2);
	$stmt->bindParam(':nm_email', $email);
	$stmt->bindParam(':dc_expediente_cli', $descricao);
	$stmt->bindParam(':link_web', $website);
	$stmt->bindParam(':st_existe_filiais', $possuiFilial);
	$stmt->bindParam(':st_autoriza_email', $atEmail);
	$stmt->bindParam(':dt_inclusao_cli', $dt_inclusao_cli);
	$stmt->bindParam(':cd_status_cli', $cd_status_cli);*/

	$stmt->execute();

	if($stmt->rowCount() > 0){
        $_SESSION['cnpj'] = $CNPJ;
		echo "cadastrado com sucesso";
	}else{
		echo "não foi cadastrado<br>";
		print_r($conn->errorInfo());
	}
}

}

function validar_cnpj($cnpj)
{
	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}
/*
echo $CNPJ . "<BR>";
echo $senha . "<br>";
echo $razaoSocial . "<br>";
echo $nomeFantasia . "<br>";
echo $pais . "<br>";
echo $estado . "<br>";
echo $cidade . "<br>";
echo $cep . "<br>";
echo $bairro . "<br>";
echo $nomeRua . "<br>";
echo $numero . "<br>";
echo $telfone1 . "<br>";
echo $telfone2 . "<br>";
echo $email . "<br>";
echo $descricao . "<br>";
echo $webSite . "<br>";
echo $possuiFilial . "<br>";
echo $atEmail . "<br>";*/
?>