<?php

require 'connection.php';
error_reporting(0);
session_start();

$cnpj = $_SESSION['cnpj'];
$cd_cat = $_SESSION['cd_cat'];
$subcategoria = $_SESSION['subcategoria'];
$especialidade = $_SESSION['especialidade'];

$nome_produto = $_POST['nome_produto'];
$preco = $_POST['preco_produto'];
$marca_prod = $_POST['marca_prod'];
$descricao_prod = $_POST['descricao_prod'];
$preco_promo_div = $_POST['preco_promo_div'];
$porcentagem_promo = $_POST['porcentagem_promo'];
//echo $_POST['nome_produto'];

$target_dir = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\produtos\\";

$cnpjPath = str_replace("/", "", $cnpj);

if (file_exists($target_dir . $cnpj)) {
    $target_dir = $target_dir . $cnpjPath . "\\";
} else {
    mkdir($target_dir . $cnpjPath);
    $target_dir = $target_dir . $cnpjPath . "\\";
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Desculpe, esta imagem já existe, experimente alterar o nome da imagem. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 900000) {
    echo "Desculpe, sua imagem é muito grande.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Desculpe, apenas imagens JPG, JPEG, PNG & GIF são permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Desculpe, a sua imagem não foi enviada.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $img = basename($_FILES["fileToUpload"]["name"]);

        if ($preco_promo_div == "") {
            $sql = "insert into _using.produto
                (cnpj_cliente, cd_cat, subcat, nm_especialidade_sub_cat, nm_produto, marca_prod,
                preco, descricao_prod, cd_link_foto_1, if_promocao) VALUES(
                '$cnpj', '$cd_cat', '$subcategoria', '$especialidade',
                '$nome_produto','$marca_prod','$preco','$descricao_prod','$img', 'n')";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            //echo $sql;
        } else {
            $sql = "insert into _using.produto
                (cnpj_cliente, cd_cat, subcat, nm_especialidade_sub_cat, nm_produto, marca_prod,
                preco, precoStrike,porcentagemPromo , if_promocao, descricao_prod, cd_link_foto_1 ) VALUES(
                '$cnpj', '$cd_cat', '$subcategoria', '$especialidade',
                '$nome_produto','$marca_prod','$preco_promo_div','$preco','$porcentagem_promo','s','$descricao_prod','$img')";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            //echo $sql;
        }


        if ($stmt->rowCount() > 0) {
            echo "A imagem foi enviada.";
        } else {
            echo "A imagem não foi enviada.";
            //print_r($stmt->errorInfo());
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>