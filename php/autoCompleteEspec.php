<?php
require 'connection.php';

    $subcat = $_GET['subcat'];

if (isset($_GET['term'])) {

    $word = $_GET['term'];

    $sql = "Select nm_especialidade_sub_cat from _using.especialidade_sub_cat 
        where nm_especialidade_sub_cat like '%$word%' and cd_subcat = '$subcat';";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $data = array();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach($stmt->fetchAll() as $k=>$v) {
        $data[] = $v['nm_especialidade_sub_cat'];
    }

    //return json data
    echo json_encode($data);
}else{
    echo "Deu merda";
}


?>