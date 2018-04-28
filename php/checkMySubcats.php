<?php
//session_start();
require 'connection.php';
require 'ProdutosClass.php';

$ProdutosClass = new ProdutosClass();

define('MB', 1048576);
$subcat = null;
$id_produto = null;
$subcategoria = null;
if (isset($_POST['plan']) && !empty($_POST['plan'])) {
    $plan = $_POST['plan'];
}

if (isset($_POST['subcat']) && !empty($_POST['subcat'])) {
    $subcat = $_POST['subcat'];
}

if (isset($_POST['id_produto']) && !empty($_POST['id_produto'])) {
    $id_produto = $_POST['id_produto'];
}

if (isset($_POST['subcategoria']) && !empty($_POST['subcategoria'])) {
    $subcategoria = $_POST['subcategoria'];
}


if (isset($_POST['id_prod_more_details']) && !empty($_POST['id_prod_more_details'])) {
    $id_produto_more_details = $_POST['id_prod_more_details'];
}
if (isset($_POST['funct']) && !empty(($_POST['funct']))) {
    $function = $_POST['funct'];
    switch ($function) {
        case 'checkMySubcats' : checkMySubcats($conn);
            break;
        case 'checkPlanUser' : checkPlanUser($conn);
            break;
        case 'createPlanUser' : createPlanUser($conn, $plan);
            break;
        case 'logoff' : logoff();
            break;
        case 'changeCNPJ': changeCNPJ();
            break;
        case 'setCNPJ': setCNPJ();
            break;
        case 'getMyData': getMyData($conn);
            break;
        case 'sendMyData' : sendMyData($conn);
            break;
    }
}

function changeCNPJ(){
    $cnpj = $_SESSION['cnpj_matriz'];
    $_SESSION['cnpj'] = $cnpj;
    echo $cnpj;
}

function setCNPJ(){
     $cnpjMatriz = $_SESSION['cnpj'];
        $_SESSION['cnpj_matriz'] = $cnpjMatriz;
        $cnpj = $_POST['cnpj_fil'];
        $_SESSION['cnpj'] = $cnpj;
}

function checkMySubcats($conn) {
    $cnpj = $_SESSION["cnpj"];

    $sql = "Select id, subcategoria, cnpj from _using.subcategorias_especialidade_cliente
        where cnpj = '$cnpj';";

    $stmtQuery = $conn->prepare($sql);
    $stmtQuery->execute();

    $especialidade = [];

    // set the resulting array to associative
    $result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmtQuery->fetchAll() as $k => $v) {
        $especialidade[] = $v['subcategoria'];
    }

    echo json_encode($especialidade);
}

function logoff() {
    // remove all session variables
    session_unset();
    // destroy the session 
    session_destroy();
}

function checkPlanUser($conn) {
    $cnpj = $_SESSION["cnpj"];

    $sql = "SELECT qtd_subcat, tipo_plano, cnpj_cliente  FROM _using.plano_usuario
        WHERE cnpj_cliente = '$cnpj';";

    $stmtQuery = $conn->prepare($sql);
    $stmtQuery->execute();

    $qtd_subcat = null;
    $tipo_plano = 0;

    // set the resulting array to associative
    $result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmtQuery->fetchAll() as $k => $v) {
        $qtd_subcat = $v['qtd_subcat'];
        $tipo_plano = $v['tipo_plano'];
    }

    echo json_encode(array("qtd_subcat" => $qtd_subcat, "tipo_plano" => $tipo_plano));
}

function createPlanUser($conn, $plan) {
    $cnpj = $_SESSION['cnpj'];


    if ($plan == 'gratuito') {
        // estou checando se já há essa especialidade na tabela de especialidade
        $queryForPlanUser = "SELECT [cnpj_cliente] FROM [_using].[_using].[plano_usuario] WHERE cnpj_cliente = '$cnpj'
            AND tipo_plano = 'gratuito'";

        $stmtQuery = $conn->prepare($queryForPlanUser);
        $stmtQuery->execute();

        // set the resulting array to associative
        //$result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
        // se rowCount da busca for igual a zero, então eu não possuo está especialidade, neste caso eu insiro na tabela
        if ($stmtQuery->rowCount() === 0) {

            $sql = "INSERT INTO _using.plano_usuario (cnpj_cliente, tipo_plano) VALUES('$cnpj', 'gratuito')";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Plano gratuito registrado com sucesso";
            }
        } else {
            echo "Você já possui este plano";
        }
    } else if ($plan == 'pago') {
        // estou checando se já há essa especialidade na tabela de especialidade
        $queryForPlanUser = "SELECT [cnpj_cliente] FROM [_using].[_using].[plano_usuario] WHERE cnpj_cliente = '$cnpj'
            AND tipo_plano = 'pago'";

        $stmtQuery = $conn->prepare($queryForPlanUser);
        $stmtQuery->execute();

        // set the resulting array to associative
        //$result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
        // se rowCount da busca for igual a zero, então eu não possuo está especialidade, neste caso eu insiro na tabela
        if ($stmtQuery->rowCount() === 0) {

            $sql = "INSERT INTO _using.plano_usuario (cnpj_cliente, tipo_plano) VALUES('$cnpj', 'pago')";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Plano pago registrado com sucesso";
            }
        } else {
            echo "Você já possui este plano";
        }
    }
}

function createPlanPayUser($conn) {
    $cnpj = $_SESSION['cnpj'];

    $sql = "INSERT INTO _using.plano_usuario (cnpj_cliente, tipo_plano) VALUES('$cnpj', 'pago')";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Plano gratuito registrado com sucesso";
    }
}

function validar_cnpj($cnpj) {
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


?>