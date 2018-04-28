<?php

session_start();
error_reporting(0);

/* define('MB', 1048576);
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutosClass
 *
 * @author Web People
 */
class ProdutosClass {

    //put your code here

    public function getProdutos($conn, $subcat) {
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT * FROM _using.produto WHERE cnpj_cliente = '$cnpj' AND subcat ='$subcat'";
        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        // set the resulting array to associative
        $result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
        echo "<table class='table table-bordered'>
                <thead>
                  <tr>
                    <th>Nome Produto</th>
                    <th>Preço</th>
                    <th>Especialidade</th>
                    <th>Em promoção</th>
                    <th>Mais detalhes</th>
                  </tr>
                </thead>
                <tbody>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $nome = $v['nm_produto'];
            $preco = $v['preco'];
            $especialidade = $v['nm_especialidade_sub_cat'];
            $ifPromo = $v['if_promocao'];
            $id = $v['id_produto'];

            if ($ifPromo == 's') {
                $ifPromo = "Sim";
            } else {
                $ifPromo = "Não";
            }
            $path_cnpj = str_replace("/", "", $cnpj);
            $foto_1 = "http://localhost:8080/WebUsing/img/produtos/" .$path_cnpj."/" .$v['cd_link_foto_1'];
            echo "<tr>
                    <td id=''>$nome</td>
                    <td>$preco</td>
                    <td>$especialidade</td>
                    <td>$ifPromo</td>
                    <td id='$id' class='td_produtos' data-toggle='modal' data-target='#moreDetails'><button  class='btn btn-success'>+</button></td>
                    <td id='$id' class='delete_prod'><button class='btn btn-danger'>X</button></td>
                    <td id='$id' class='td_fotos_prod' data-toggle='modal' data-target='#alterImg'><img src='$foto_1' style='width: 100px;height: 100px'></td>
                  </tr>";
        }
        echo "  </tbody>
              </table>";
    }

    public function getProdutosFil($conn, $subcat) {
        $cnpj = $_SESSION['cnpj'];
        //$cnpjFil = $_POST['']
        $sql = "SELECT * FROM _using.produto WHERE cnpj_filial = '$cnpj' AND subcat ='$subcat'";

        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        // set the resulting array to associative
        $result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);
        echo "<table class='table table-bordered'>
                <thead>
                  <tr>
                    <th>Nome Produto</th>
                    <th>Preço</th>
                    <th>Especialidade</th>
                    <th>Em promoção</th>
                    <th>Mais detalhes</th>
                  </tr>
                </thead>
                <tbody>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $nome = $v['nm_produto'];
            $preco = $v['preco'];
            $especialidade = $v['nm_especialidade_sub_cat'];
            $ifPromo = $v['if_promocao'];
            $id = $v['id_produto'];

            if ($ifPromo == 's') {
                $ifPromo = "Sim";
            } else {
                $ifPromo = "Não";
            }

            $foto_1 = "http://localhost:8080/WebUsing/img/produtos/" . $v['cd_link_foto_1'];

            echo "<tr>
                    <td id=''>$nome</td>
                    <td>$preco</td>
                    <td>$especialidade</td>
                    <td>$ifPromo</td>
                    <td id='$id' class='td_produtos' data-toggle='modal' data-target='#moreDetails'><button  class='btn btn-success'>+</button></td>
                    <td id='$id' class='delete_prod'><button class='btn btn-danger'>X</button></td>
                    <td id='$id' class='td_fotos_prod' data-toggle='modal' data-target='#alterImg'><img src='$foto_1' style='width: 100px;height: 100px'></td>
                  </tr>";
        }
        echo "  </tbody>
              </table>";
    }

    public function getSubcategorias($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT cd_cat, subcategoria, nm_subcat, especialidade FROM _using.subcategorias_especialidade_cliente sec
                INNER JOIN _using.sub_categoria sb on sec.subcategoria = sb.cd_subcat
                WHERE cnpj = '$cnpj'";

        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        // echo "<select name='subcategoria' class='form-control'>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $subcat = $v['nm_subcat'];
            $cd_subcat = $v['subcategoria'];
            echo "<button id='$cd_subcat' class='btn btn-default btns_subcats'>$subcat</button>";
        }


        //echo"</select>";
    }

    public function getSubcategoriasForFil($conn) {
        $cnpj = $_SESSION['cnpj'];


        $sql = "SELECT cd_cat, subcategoria, nm_subcat, especialidade FROM _using.subcategorias_especialidade_cliente sec
                INNER JOIN _using.sub_categoria sb on sec.subcategoria = sb.cd_subcat
                WHERE cnpj_fil = '$cnpj'";

        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        // echo "<select name='subcategoria' class='form-control'>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $subcat = $v['nm_subcat'];
            $cd_subcat = $v['subcategoria'];
            echo "<div class='container'><button id='$cd_subcat' class='btn btn-default btns_subcats_fil'>$subcat</button></div>";
        }


        //echo"</select>";
    }

    public function getCategoriaSubcatEspec($conn, $subcategoria) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT cd_cat, subcategoria, cd_subcat, especialidade FROM _using.subcategorias_especialidade_cliente sec
                INNER JOIN _using.sub_categoria sb on sec.subcategoria = sb.cd_subcat
                WHERE cnpj = '$cnpj' and cd_subcat = '$subcategoria'";

        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        $cd_cat = null;
        $especialidade = null;
        $subcategoria = null;
        // echo "<select name='subcategoria' class='form-control'>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $cd_cat = $v['cd_cat'];
            $subcategoria = $v['cd_subcat'];
            $especialidade = $v['especialidade'];
        }

        $_SESSION['cd_cat'] = $cd_cat;
        $_SESSION['subcategoria'] = $subcategoria;
        $_SESSION['especialidade'] = $especialidade;

        echo json_encode(array("cd_cat" => $cd_cat, "subcategoria" => $subcategoria, "especialidade" => $especialidade));
    }

    public function getCategoriaSubcatEspecFil($conn, $subcategoria) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT cd_cat, subcategoria, cd_subcat, especialidade FROM _using.subcategorias_especialidade_cliente sec
                INNER JOIN _using.sub_categoria sb on sec.subcategoria = sb.cd_subcat
                WHERE cnpj_fil = '$cnpj' and cd_subcat = '$subcategoria'";

        $stmtQuery = $conn->prepare($sql);
        $stmtQuery->execute();

        $cd_cat = null;
        $especialidade = null;
        $subcategoria = null;
        // echo "<select name='subcategoria' class='form-control'>";
        foreach ($stmtQuery->fetchAll() as $k => $v) {
            $cd_cat = $v['cd_cat'];
            $subcategoria = $v['cd_subcat'];
            $especialidade = $v['especialidade'];
        }

        print_r($stmtQuery->errorInfo());

        $_SESSION['cd_cat'] = $cd_cat;
        $_SESSION['subcategoria'] = $subcategoria;
        $_SESSION['especialidade'] = $especialidade;

        echo json_encode(array("cd_cat" => $cd_cat, "subcategoria" => $subcategoria, "especialidade" => $especialidade));
    }

    public function getMoreDetails($conn, $id_produto) {
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT * FROM _using.produto WHERE id_produto = '$id_produto'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $nome = "";
        $preco = "";
        $marca_produto = "";
        $if_promo = "";
        $porcentagem = "";
        $precoStrike = "";
        $desc = "";

        foreach ($stmt->fetchAll() as $k => $v) {
            $promo = 's';

            $nome = $v['nm_produto'];
            $marca_produto = $v['marca_prod'];
            $if_promo = $v['if_promocao'];
            $preco = $v['preco'];
            $precoStrike = $v['precoStrike'];
            $porcentagem = $v['porcentagemPromo'];
            $desc = $v['descricao_prod'];
            $foto_1 = $v['cd_link_foto_1'];
            $foto_2 = $v['cd_link_foto_2'];
            $foto_3 = $v['cd_link_foto_3'];
            $foto_4 = $v['cd_link_foto_4'];
            $foto_5 = $v['cd_link_foto_5'];
        }

        echo json_encode(array("nome_produto" => $nome, "marca_produto" => $marca_produto, "if_promo" => $if_promo,
            "preco" => $preco, "precoStike" => $precoStrike, "porcentagem" => $porcentagem,
            "desc" => $desc, "id_produto" => $id_produto, "foto_1" => $foto_1, "foto_2" => $foto_2,
            "foto_3" => $foto_3, "foto_4" => $foto_4, "foto_5" => $foto_5));
    }

    public function getFotosProd($conn, $id_produto) {
        $cnpj = $_SESSION['cnpj'];
        $sql = "SELECT cd_link_foto_1, cd_link_foto_2, cd_link_foto_3, cd_link_foto_4, cd_link_foto_5 FROM _using.produto WHERE id_produto = '$id_produto'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $k => $v) {
            $foto_1 = $v['cd_link_foto_1'];
            $foto_2 = $v['cd_link_foto_2'];
            $foto_3 = $v['cd_link_foto_3'];
            $foto_4 = $v['cd_link_foto_4'];
            $foto_5 = $v['cd_link_foto_5'];
        }

        echo json_encode(array("foto_1" => $foto_1, "foto_2" => $foto_2, "foto_3" => $foto_3, "foto_4" => $foto_4, "foto_5" => $foto_5));
    }

    // ---

    public function enviaProdFil($conn) {

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

        $target_dir = "C:\Users\Web People\Downloads\WebUsing\web\img\produtos\\";

        $cnpjPath = str_replace("/", "", $cnpj);

        if (file_exists($target_dir . $cnpj)) {
            $target_dir = $target_dir . $cnpjPath . "\\";
        } else {
            mkdir($target_dir . $cnpjPath);
            $target_dir = $target_dir . $cnpjPath . "\\";
        }

        $target_file = $target_dir . basename($_FILES["input_prodFil_1"]["name"]);
//echo $target_file;
        $uploadOk = 1;

        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["input_prodFil_1"]["tmp_name"]);
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
        if ($_FILES["input_prodFil_1"]["size"] > 7 * 1048576) {
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
            if (move_uploaded_file($_FILES["input_prodFil_1"]["tmp_name"], $target_file)) {
                $img = basename($_FILES["input_prodFil_1"]["name"]);

                if ($preco_promo_div == "") {
                    $sql = "insert into _using.produto
                (cnpj_filial, cd_cat, subcat, nm_especialidade_sub_cat, nm_produto, marca_prod,
                preco, descricao_prod, cd_link_foto_1, if_promocao) VALUES(
                '$cnpj', '$cd_cat', '$subcategoria', '$especialidade',
                '$nome_produto','$marca_prod','$preco','$descricao_prod','$img', 'n')";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    //echo $sql;
                } else {
                    $sql = "insert into _using.produto
                (cnpj_filial, cd_cat, subcat, nm_especialidade_sub_cat, nm_produto, marca_prod,
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
                    // print_r($stmt->errorInfo());
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function deleteProduto($conn, $id_produto) {


        $cnpj = $_SESSION['cnpj'];
        $selectForDelete = "SELECT * FROM _using.produto WHERE id_produto = '$id_produto'";

        $stmtForDelete = $conn->prepare($selectForDelete);
        $stmtForDelete->execute();

        $path = "C:\Users\Web People\Downloads\WebUsing\web\img\produtos\\";

        $path = $path . str_replace("/", "", $cnpj) . "\\";

        foreach ($stmtForDelete->fetchAll() as $k => $v) {
            // echo $path . $v['cd_link_foto_1'];
            if (file_exists($path . $v['cd_link_foto_1'])) {
                if (!empty($v['cd_link_foto_1'])) {
                    unlink($path . $v['cd_link_foto_1']);
                }
            }

            if (file_exists($path . $v['cd_link_foto_2'])) {
                if (!empty($v['cd_link_foto_2'])) {
                    unlink($path . $v['cd_link_foto_2']);
                }
            }

            if (file_exists($path . $v['cd_link_foto_3'])) {
                if (!empty($v['cd_link_foto_3'])) {
                    unlink($path . $v['cd_link_foto_3']);
                }
            }

            if (file_exists($path . $v['cd_link_foto_4'])) {
                if (!empty($v['cd_link_foto_4'])) {
                    unlink($path . $v['cd_link_foto_4']);
                }
            }

            if (file_exists($path . $v['cd_link_foto_5'])) {
                if (!empty($v['cd_link_foto_5'])) {
                    unlink($path . $v['cd_link_foto_5']);
                }
            }
        }


        $sql = " DELETE FROM _using.produto WHERE id_produto = '$id_produto'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // print_r($stmt->errorInfo());

        if ($stmt->rowCount() > 0) {
            echo 'Produto deletado com sucesso';
        } else {
            echo 'Não foi possível deletar este produto. Por favor, tente mais tarde.';
        }
    }

    public function alterProduto($conn, $id_produto) {
        $nome_produto = null;
        $preco = null;
        $marca_prod = null;
        $descricao_prod = null;
        $preco_promo_div = null;
        $porcentagem_promo = null;


        if (isset($_POST['nome_produto']) && !empty($_POST['nome_produto'])) {
            $nome_produto = $_POST['nome_produto'];
        }

        if (isset($_POST['preco_produto']) && !empty($_POST['preco_produto'])) {
            $preco = $_POST['preco_produto'];
        }

        if (isset($_POST['marca_prod']) && !empty($_POST['marca_prod'])) {
            $marca_prod = $_POST['marca_prod'];
        }

        if (isset($_POST['descricao_prod']) && !empty($_POST['descricao_prod'])) {
            $descricao_prod = $_POST['descricao_prod'];
        }

        if (isset($_POST['preco_promo_div']) && !empty($_POST['preco_promo_div'])) {
            $preco_promo_div = $_POST['preco_promo_div'];
        }

        if (isset($_POST['porcentagem_promo']) && !empty($_POST['porcentagem_promo'])) {
            $porcentagem_promo = $_POST['porcentagem_promo'];
        }
        $sql = "UPDATE _using.produto SET nm_produto = '$nome_produto', preco = '$preco'
                ,marca_prod = '$marca_prod', descricao_prod ='$descricao_prod' WHERE id_produto = '$id_produto'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Produto alterado.";
        } else {
            print_r($stmt->errorInfo());
            echo "Produto não alterado.";
        }
    }

}
