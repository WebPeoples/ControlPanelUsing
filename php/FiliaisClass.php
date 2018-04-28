<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FiliaisClass
 *
 * @author Web People
 */
class FiliaisClass {

    //put your code here
    public function getFiliais($conn) {
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT nm_razao_social, nr_cnpj_filial, cliente.nr_cpf_cnpj,
        filiais.nome_rua, filiais.nr_numero_fil, nr_cep_fil, nm_bairro_fil,
        cd_estado_fil,nm_cidade_fil from _using.filiais 
        INNER JOIN _using.cliente on filiais.nr_cpf_cnpj = cliente.nr_cpf_cnpj
        WHERE cliente.nr_cpf_cnpj = '$cnpj'";
        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        foreach ($stmtQuery->fetchAll() as $k => $v) {

            echo "<div id=".$v['nr_cnpj_filial']." class='container fil_card' style='border: 1px solid black;padding: 10px;cursor:pointer'>"
            . "<p>Nome: " . $v['nm_razao_social'] . "</p>"
            . "<p>Endereço: " . $v['nome_rua'] . ", " . $v['nr_numero_fil']
            . " - " . $v['nm_bairro_fil'] . ", " . $v['nm_cidade_fil']
            . " - " . $v['cd_estado_fil'] . ", " . $v['nr_cep_fil']
            . "</div>";
        }
    }

    public function checkPlanUserAndGetFil($conn) {
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT [qtd_filiais]  FROM [_using].[_using].[plano_usuario]   WHERE cnpj_cliente = '$cnpj'";
        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        foreach ($stmtQuery->fetchAll() as $k => $v) {
            echo $v['qtd_filiais'];
        }
    }

    public function validar_cnpj($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function insertFil($conn) {
        
        $cnpj = $_SESSION['cnpj'];

        $cnpj_fil = $_POST['cnpj_fil'];
        $pais = $_POST['pais_fil'];
        $estado = $_POST['estado_fil'];
        $cidade = $_POST['cidade_fil'];
        $cep = $_POST['cep_fil'];
        $bairro = $_POST['bairro_fil'];
        $nomeRua = $_POST['rua_fil'];
        $numero = $_POST['numero_fil'];
        $telfone1 = $_POST['telefone_fil'];
        $email = $_POST['email_fil'];
        $descricao = $_POST['expediente_fil'];
        $webSite = $_POST['site_fil'];

        $CnpjRowCount = null;
        $EmailRowCount = null;


// Get lat and long by address
        $address = $nomeRua . ", " . $numero . " - " . $bairro . ", " . $cidade . " - " . $estado;
//$prepAddr = str_replace(' ','+',$address);
//$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
//$output= json_decode($geocode);
//$latitude = $output->results[0]->geometry->location->lat;
//$longitude = $output->results[0]->geometry->location->lng;
//$address = "Kathmandu, Nepal";
        $url = "http://maps.google.com/maps/api/geocode/json?address=" . urlencode($address);

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

        echo $latitude . " " . $longitude;
        if ($latitude !== 0 && $longitude !== 0) {

            if (!$this->validar_cnpj($cnpj_fil)) {
                echo "Este cnpj não é valido.";
            } else {
                $ifCnpjExists = "SELECT nr_cnpj_filial FROM _using.filiais WHERE nr_cnpj_filial = '$cnpj_fil'";
                $stmtCnpj = $conn->prepare($ifCnpjExists, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmtCnpj->execute();
                $CnpjRowCount = $stmtCnpj->rowCount();

                $ifEmailExists = "SELECT nm_email_fil FROM _using.filiais WHERE nm_email_fil = '$email'";
                $stmtEmail = $conn->prepare($ifEmailExists, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stmtEmail->execute();
                $EmailRowCount = $stmtEmail->rowCount();

                if ($CnpjRowCount > 0 && $EmailRowCount > 0 && $CnpjRowCount != null && $EmailRowCount != null) {
                    echo "Este cnpj e email já foram cadastrados.";
                } else if ($CnpjRowCount > 0) {
                    echo "Este cnpj já foi cadastrado.";
                } else if ($EmailRowCount > 0) {
                    echo "Este email já foi cadastrado.";
                } else {

                    $sql = "
INSERT INTO [_using].[filiais]
           ([nr_cnpj_filial]
           ,[nr_cpf_cnpj]
           ,[nome_rua]
           ,[nr_numero_fil]
           ,[nr_cep_fil]
           ,[nm_bairro_fil]
           ,[nm_cidade_fil]
           ,[cd_estado_fil]
           ,[cd_pais_fil]
           ,[cd_filial_ativa]
           ,[dc_expediente_fil]
           ,[nr_telefone1_fil]
           ,[nm_email_fil]
           ,[dt_inclusao_fil]
           ,[link_web_fil]
           ,[latitude_fil]
           ,[longitude_fil])
     VALUES
           ('$cnpj_fil'
           ,'$cnpj'
           ,'$nomeRua'
           ,'$numero'
           ,'$cep'
           ,'$bairro'
           ,'$cidade'
           ,'$estado'
           ,'$pais'
           ,'s'
           ,'$descricao'
           ,'$telfone1'
           ,'$email'
           ,CURRENT_TIMESTAMP
           ,'$webSite'
           ,'$latitude'
           ,'$longitude')";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {

                        echo "Cadastrado com sucesso";
                    } else {
                        echo "Não foi cadastrado<br>";
                        print_r($conn->errorInfo());
                    }
                }
            }
        } else {
            echo "Endereço inválido";
        }
    }

    public function checkQtdFil($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT count(*) f from _using.filiais WHERE nr_cpf_cnpj = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        foreach ($stmt->fetchAll() as $k => $v) {
            echo $v['f'];
        }
    }

}
