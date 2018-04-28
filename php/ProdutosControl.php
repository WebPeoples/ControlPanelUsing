<?php
require 'connection.php';
require 'ProdutosClass.php';

$ProdutosClass = new ProdutosClass();
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
        case 'getProdutos' : $ProdutosClass->getProdutos($conn, $subcat);
            break;
        case 'getProdutosFil': $ProdutosClass->getProdutosFil($conn, $subcat);
            break;
        case 'getSubcategorias' : $ProdutosClass->getSubcategorias($conn);
            break;
        case 'getSubcategoriasForFil' : $ProdutosClass->getSubcategoriasForFil($conn);
            break;
        case 'getMoreDetails' : $ProdutosClass->getMoreDetails($conn, $id_produto);
            break;
        case 'getCategoriaSubcatEspec' : $ProdutosClass->getCategoriaSubcatEspec($conn, $subcategoria);
            break;
        case 'getCategoriaSubcatEspecFil' : $ProdutosClass->getCategoriaSubcatEspecFil($conn, $subcategoria);
            break;
        case 'deleteProduto' : $ProdutosClass->deleteProduto($conn, $id_produto);
            break;
        case 'alterProduto' : $ProdutosClass->alterProduto($conn, $id_produto_more_details);
            break;
        case 'getFotosProd' :$ProdutosClass->getFotosProd($conn, $id_produto);
            break;
        case 'enviaProdFil' : $ProdutosClass->enviaProdFil($conn);
            break;
    }
}

?>

