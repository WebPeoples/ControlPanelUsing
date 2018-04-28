<?php

session_start();
define('MB', 1048576);
error_reporting(0);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeusDadosClass
 *
 * @author Web People
 */
class SeusDadosClass {

    //put your code here


    public function getMyData($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT nm_fantasia, nome_rua, numero_local, nm_bairro, cd_cep_cli,
nm_cidade_cli, pais_cli, dc_expediente_cli, link_logotipo_cliente,
 icon_logo_maps, nm_email FROM _using.cliente
WHERE nr_cpf_cnpj = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $nm_fantasia = "";
        $nome_rua = "";
        $numero_local = "";
        $nm_bairro = "";
        $cd_cep_cli = "";
        $nm_cidade_cli = "";
        $pais_cli = "";
        $expediente = "";
        $nm_email = "";

        $icon_maps = "";
        $logo_cliente = "";

        foreach ($stmt->fetchAll() as $k => $v) {
            $nm_fantasia = $v['nm_fantasia'];
            $nome_rua = $v['nome_rua'];
            $numero_local = $v['numero_local'];
            $nm_bairro = $v['nm_bairro'];
            $cd_cep_cli = $v['cd_cep_cli'];
            $nm_cidade_cli = $v['nm_cidade_cli'];
            $pais_cli = $v['pais_cli'];
            $expediente = $v['dc_expediente_cli'];
            $nm_email = $v['nm_email'];
            $icon_maps = $v['icon_logo_maps'];
            $logo_cliente = $v['link_logotipo_cliente'];
        }

        echo json_encode(array("nm_fantasia" => $nm_fantasia, "nome_rua" => $nome_rua, "numero_local" => $numero_local,
            "nm_bairro" => $nm_bairro, "cep" => $cd_cep_cli, "cidade" => $nm_cidade_cli, "pais" => $pais_cli
            , "expediente" => $expediente, "icon" => $icon_maps, "logo_cliente" => $logo_cliente, "nm_email" => $nm_email));
    }

    public function getMyDataFil($conn) {
        $cnpj = $_SESSION['cnpj'];
        //echo $cnpj;
        $sql = "SELECT nome_rua, nr_numero_fil, nm_bairro_fil, nr_cep_fil,
nm_cidade_fil, cd_pais_fil, dc_expediente_fil, link_logotipo_filial,
 icon_logo_maps FROM _using.filiais
WHERE nr_cnpj_filial = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        //print_r($stmt->errorInfo());
        $nm_fantasia = $_SESSION['nm_fantasia'];
        $nome_rua = "";
        $numero_local = "";
        $nm_bairro = "";
        $cd_cep_cli = "";
        $nm_cidade_cli = "";
        $pais_cli = "";
        $expediente = "";
        $nm_email = "";

        $icon_maps = "";
        $logo_cliente = "";

        foreach ($stmt->fetchAll() as $k => $v) {
            //$nm_fantasia = $v['nm_fantasia'];
            $nome_rua = $v['nome_rua'];
            $numero_local = $v['nr_numero_fil'];
            $nm_bairro = $v['nm_bairro_fil'];
            $cd_cep_cli = $v['nr_cep_fil'];
            $nm_cidade_cli = $v['nm_cidade_fil'];
            $pais_cli = $v['cd_pais_fil'];
            $expediente = $v['dc_expediente_fil'];
            //$nm_email = $v['nm_email'];
            $icon_maps = $v['icon_logo_maps'];
            $logo_cliente = $v['link_logotipo_filial'];
        }

        echo json_encode(array("nm_fantasia" => $nm_fantasia, "nome_rua" => $nome_rua, "numero_local" => $numero_local,
            "nm_bairro" => $nm_bairro, "cep" => $cd_cep_cli, "cidade" => $nm_cidade_cli, "pais" => $pais_cli
            , "expediente" => $expediente, "icon" => $icon_maps, "logo_cliente" => $logo_cliente, "nm_email" => $nm_email));
    }

    public function sendMyData($conn) {
        $thisClass = new SeusDadosClass();

        $cnpj = $_SESSION['cnpj'];

        $nm_fantasia = $_POST['nm_fantasia_myData'];

        $rua = $_POST['input_alterar_rua'];
        $numero = $_POST['input_alterar_numero'];
        $bairro = $_POST['input_alterar_bairro'];
        $cidade = $_POST['input_alterar_cidade'];
        $cep = $_POST['input_alterar_cep'];

        $email = $_POST['email_myData'];

        $expediente = $_POST['expediente_myData'];

        $logo = $_POST['fileNameToUpload'];
        $icone = $_POST['iconNameToUpload'];

        $sql = "UPDATE _using.cliente SET nm_fantasia = '$nm_fantasia',nome_rua = '$rua', numero_local = '$numero', "
                . "nm_bairro = '$bairro', nm_cidade_cli = '$cidade', nm_email = '$email',"
                . "cd_cep_cli = '$cep', dc_expediente_cli = '$expediente',"
                . " link_logotipo_cliente = '$logo',"
                . "icon_logo_maps = '$icone' WHERE nr_cpf_cnpj = '$cnpj'";

//    $sql_ = "UPDATE cliente SET nm_fantasia = '$nm_fantasia', nome_rua = '$rua', "
//            . "numero_local = '$numero', nm_bairro = '$bairro', cd_cep_cli = '$cep', "
//            . "nm_email = '$email', dc_expediente_cli = '$expediente', link_logotipo_cliente = '$logo',"
//            . "icon_logo_maps = '$logo' WHERE nr_cpf_cnpj = '$cnpj'";
        $stmt = $conn->prepare($sql);

        $attInfoSemImagem = 0;


        if (isset($logo) && !empty($logo)) {

            $target_dir = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_logo\\";

            $cnpjPath = str_replace("/", "", $cnpj);

            if (file_exists($target_dir . $cnpj)) {
                $target_dir = $target_dir . $cnpjPath . "\\";
            } else {
                mkdir($target_dir . $cnpjPath);
                $target_dir = $target_dir . $cnpjPath . "\\";
            }

            $target_file = $target_dir . basename($_FILES["logoToUpload"]["name"]);

            //$target_file = $target_dir . $logo;
            //echo "\n" . "Nome do arquivo: " . basename($_FILES['logoToUpload']['name']);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["logoToUpload"]["tmp_name"]);
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
                echo "Desculpe, esta imagem já existe, experimente alterar o nome da imagem.\n ";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["logoToUpload"]["size"] > 7 * MB) {
                echo "Desculpe, sua imagem é muito grande.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Desculpe, apenas imagens JPG, JPEG, PNG & GIF são permitidos.\n";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Desculpe, a sua imagem não foi enviada.\n";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["logoToUpload"]["tmp_name"], $target_file)) {
                    $thisClass->deleteLogo($conn);
                    echo "Imagem salva com sucesso\n";
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo "atualizado com sucesso\n";
                    } else {
                        echo "Não foi possível inserir\n";
                        print_r($stmt->errorInfo());
                    }
                }
            }
        } else {
            $attInfoSemImagem = 1;
            echo "Você não inseriu uma imagem.<br>";
        }

        if (isset($icone) && !empty($icone)) {
            $target_dir = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_icon\\";


            $cnpjPath = str_replace("/", "", $cnpj);

            if (file_exists($target_dir . $cnpj)) {
                $target_dir = $target_dir . $cnpjPath . "\\";
            } else {
                mkdir($target_dir . $cnpjPath);
                $target_dir = $target_dir . $cnpjPath . "\\";
            }

            $target_file = $target_dir . basename($_FILES["iconeToUpload"]["name"]);

            //$target_file = $target_dir . $logo;
            //echo "\n" . "Nome do arquivo: " . basename($_FILES['logoToUpload']['name']);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["iconeToUpload"]["tmp_name"]);
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
                echo "Desculpe, esta imagem já existe, experimente alterar o nome da imagem.\n ";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["iconeToUpload"]["size"] > 7 * MB) {
                echo "Desculpe, sua imagem é muito grande.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Desculpe, apenas imagens JPG, JPEG, PNG & GIF são permitidos.\n";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Desculpe, a sua imagem não foi enviada.\n";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["iconeToUpload"]["tmp_name"], $target_file)) {
                    $thisClass->deleteIcon($conn);
                    echo "Imagem salva com sucesso\n";

                    $sqlIcone = "UPDATE _using.cliente SET icon_logo_maps = '$icone' WHERE nr_cpf_cnpj = '$cnpj'";

                    $stmtIcone = $conn->prepare($sqlIcone);

                    $stmtIcone->execute();

                    if ($stmtIcone->rowCount() > 0) {
                        echo "atualizado com sucesso\n";
                    } else {
                        echo "Não foi possível inserir\n";
                        print_r($stmtIcone->errorInfo());
                    }
                }
            }
        } else {
            $attInfoSemImagem = 1;
            echo "Você não inseriu uma icone.<br>";
        }

        if ($attInfoSemImagem === 0) {
            echo "Alguma foto foi selecionada";
        } else {

            $sqlInfoSemImagem = "UPDATE _using.cliente SET nm_fantasia = '$nm_fantasia',nome_rua = '$rua', numero_local = '$numero', "
                    . "nm_bairro = '$bairro', nm_cidade_cli = '$cidade', nm_email = '$email',"
                    . "cd_cep_cli = '$cep', dc_expediente_cli = '$expediente'"
                    . " WHERE nr_cpf_cnpj = '$cnpj'";

//    $sql_ = "UPDATE cliente SET nm_fantasia = '$nm_fantasia', nome_rua = '$rua', "
//            . "numero_local = '$numero', nm_bairro = '$bairro', cd_cep_cli = '$cep', "
//            . "nm_email = '$email', dc_expediente_cli = '$expediente', link_logotipo_cliente = '$logo',"
//            . "icon_logo_maps = '$logo' WHERE nr_cpf_cnpj = '$cnpj'";
            $stmtInfoSemImagem = $conn->prepare($sqlInfoSemImagem);

            $stmtInfoSemImagem->execute();

            if ($stmtInfoSemImagem->rowCount() > 0) {
                echo "Seus dados foram atualizados com sucesso.";
            } else {
                print_r($stmtInfoSemImagem->errorInfo());
            }
        }
    }

    public function sendMyDataFill($conn) {
        $thisClass = new SeusDadosClass();

        $cnpj = $_SESSION['cnpj'];

        $nm_fantasia = $_POST['nm_fantasia_myData'];

        $rua = $_POST['input_alterar_rua_fil'];
        $numero = $_POST['input_alterar_numero_fil'];
        $bairro = $_POST['input_alterar_bairro_fil'];
        $cidade = $_POST['input_alterar_cidade_fil'];
        $cep = $_POST['input_alterar_cep_fil'];

        $email = $_POST['email_myData'];

        $expediente = $_POST['expediente_myData_fil'];

        $logo = $_POST['fileNameToUploadFil'];
        $icone = $_POST['iconNameToUploadFil'];

        $sql = "UPDATE _using.filiais SET nome_rua = '$rua', nr_numero_fil = '$numero', "
                . "nm_bairro_fil = '$bairro', nm_cidade_fil = '$cidade',"
                . "nr_cep_fil = '$cep', dc_expediente_fil = '$expediente',"
                . " link_logotipo_filial = '$logo'"
                . "WHERE nr_cnpj_filial = '$cnpj'";

//    $sql_ = "UPDATE cliente SET nm_fantasia = '$nm_fantasia', nome_rua = '$rua', "
//            . "numero_local = '$numero', nm_bairro = '$bairro', cd_cep_cli = '$cep', "
//            . "nm_email = '$email', dc_expediente_cli = '$expediente', link_logotipo_cliente = '$logo',"
//            . "icon_logo_maps = '$logo' WHERE nr_cpf_cnpj = '$cnpj'";
        $stmt = $conn->prepare($sql);

        $attInfoSemImagem = 0;


        if (isset($logo) && !empty($logo)) {

            $target_dir = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_logo\\";

            $cnpjPath = str_replace("/", "", $cnpj);

            if (file_exists($target_dir . $cnpj)) {
                $target_dir = $target_dir . $cnpjPath . "\\";
            } else {
                mkdir($target_dir . $cnpjPath);
                $target_dir = $target_dir . $cnpjPath . "\\";
            }

            $target_file = $target_dir . basename($_FILES["logoToUploadFil"]["name"]);

            //$target_file = $target_dir . $logo;
            //echo "\n" . "Nome do arquivo: " . basename($_FILES['logoToUpload']['name']);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["logoToUploadFil"]["tmp_name"]);
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
                echo "<span style='color:red'><strong>Erro logo:</strong></span> Desculpe, esta imagem já existe, experimente alterar o nome da imagem.<br>";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["logoToUploadFil"]["size"] > 7 * MB) {
                echo "<span style='color:red'><strong>Erro logo:</strong></span> Desculpe, sua imagem é muito grande.<br>";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<span style='color:red'><strong>Erro logo:</strong></span> Desculpe, apenas imagens JPG, JPEG, PNG & GIF são permitidos.<br>";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<span style='color:red'><strong>Erro logo:</strong></span> Desculpe, a sua imagem não foi enviada.<br>";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["logoToUploadFil"]["tmp_name"], $target_file)) {
                    $thisClass->deleteLogoFil($conn);
                    echo "<span style='color:green'><strong>Aviso logo:</strong></span> Imagem salva com sucesso<br>";
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo "<span style='color:green'><strong>Aviso logo:</strong></span> Atualizado com sucesso<br>";
                    } else {
                        echo "<span style='color:red'><strong>Erro logo:</strong></span> Não foi possível inserir.<br>";
                        //print_r($stmt->errorInfo());
                    }
                }
            }
        } else {
            $attInfoSemImagem = 1;
            echo "Você não inseriu uma imagem.<br>";
        }
        // ***********************************************
        // ************* INSERINDO O ÍCONE ***************
        if (isset($icone) && !empty($icone)) {
            $target_dir = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_icon\\";
            $cnpjPath = str_replace("/", "", $cnpj);
            if (file_exists($target_dir . $cnpj)) {
                $target_dir = $target_dir . $cnpjPath . "\\";
            } else {
                mkdir($target_dir . $cnpjPath);
                $target_dir = $target_dir . $cnpjPath . "\\";
            }

            $target_file = $target_dir . basename($_FILES["iconeToUploadFil"]["name"]);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["iconeToUploadFil"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
// Check if file already exists
            //echo "<br>".$target_file."<br>";
            if (file_exists($target_file)) {
                echo "<span style='color:red'><strong>Erro ícone:</strong></span> Desculpe, esta imagem já existe, experimente alterar o nome da imagem.<br> ";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["iconeToUploadFil"]["size"] > 7 * MB) {
                echo "<span style='color:red'><strong>Erro ícone:</strong></span> Desculpe, sua imagem é muito grande.<br>";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<span style='color:red'><strong>Erro ícone:</strong></span> Desculpe, apenas imagens JPG, JPEG, PNG & GIF são permitidos.<br>";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<span style='color:red'><strong>Erro ícone:</strong></span> Desculpe, a sua imagem não foi enviada.<br>";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["iconeToUploadFil"]["tmp_name"], $target_file)) {
                    $thisClass->deleteIconFil($conn);
                    echo "<span style='color:green'><strong>Aviso ícone:</strong></span> Imagem salva com sucesso<br>";

                    $sqlIcone = "UPDATE _using.filiais SET icon_logo_maps = '$icone' WHERE nr_cnpj_filial = '$cnpj'";

                    $stmtIcone = $conn->prepare($sqlIcone);

                    $stmtIcone->execute();

                    if ($stmtIcone->rowCount() > 0) {
                        echo "<span style='color:green'><strong>Aviso ícone:</strong></span> Atualizado com sucesso<br>";
                    } else {
                        echo "<span style='color:red'>Erro ícone:</span> Não foi possível inserir<br>";
                       // print_r($stmtIcone->errorInfo());
                    }
                }
            }
        } else {
            $attInfoSemImagem = 1;
            echo "Você não inseriu uma icone.<br>";
        }

        if ($attInfoSemImagem === 0) {
            //echo "Alguma foto foi selecionada";
        } else {

            $sqlInfoSemImagem = "UPDATE _using.filiais SET nome_rua = '$rua', nr_numero_fil = '$numero', "
                    . "nm_bairro_fil = '$bairro', nm_cidade_fil = '$cidade',"
                    . "nr_cep_fil = '$cep', dc_expediente_fil = '$expediente'"
                    . "WHERE nr_cpf_cnpj = '$cnpj'";

//    $sql_ = "UPDATE cliente SET nm_fantasia = '$nm_fantasia', nome_rua = '$rua', "
//            . "numero_local = '$numero', nm_bairro = '$bairro', cd_cep_cli = '$cep', "
//            . "nm_email = '$email', dc_expediente_cli = '$expediente', link_logotipo_cliente = '$logo',"
//            . "icon_logo_maps = '$logo' WHERE nr_cpf_cnpj = '$cnpj'";
            $stmtInfoSemImagem = $conn->prepare($sqlInfoSemImagem);

            $stmtInfoSemImagem->execute();

            if ($stmtInfoSemImagem->rowCount() > 0) {
                echo "Seus dados foram atualizados com sucesso.";
            } else {
                print_r($stmtInfoSemImagem->errorInfo());
            }
        }
    }

    public function getEnderecoForInput($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT nome_rua, numero_local, nm_bairro, cd_cep_cli,
nm_cidade_cli FROM _using.cliente
WHERE nr_cpf_cnpj = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        foreach ($stmt->fetchAll() as $k => $v) {

            $nome_rua = $v['nome_rua'];
            $numero_local = $v['numero_local'];
            $nm_bairro = $v['nm_bairro'];
            $cd_cep_cli = $v['cd_cep_cli'];
            $nm_cidade_cli = $v['nm_cidade_cli'];
        }

        echo json_encode(array("nome_rua" => $nome_rua, "numero_local" => $numero_local,
            "nm_bairro" => $nm_bairro, "cep" => $cd_cep_cli, "cidade" => $nm_cidade_cli));
    }

    public function deleteLogo($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT link_logotipo_cliente FROM _using.cliente WHERE nr_cpf_cnpj = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $path = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_logo\\";

        $path = $path . str_replace("/", "", $cnpj) . "\\";
        foreach ($stmt->fetchAll() as $k => $v) {
            $logo = $v['link_logotipo_cliente'];
            //echo $logo;
        }

        unlink($path . $logo);
    }

    public function deleteLogoFil($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT link_logotipo_filial FROM _using.filiais WHERE nr_cnpj_filial = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $path = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_logo\\";

        $path = $path . str_replace("/", "", $cnpj) . "\\";
        foreach ($stmt->fetchAll() as $k => $v) {
            $logo = $v['link_logotipo_filial'];
            //echo $logo;
        }

        unlink($path . $logo);
    }

    public function deleteIcon($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT icon_logo_maps FROM _using.cliente WHERE nr_cpf_cnpj = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $path = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_icon\\";

        $path = $path . str_replace("/", "", $cnpj) . "\\";

        foreach ($stmt->fetchAll() as $k => $v) {
            $logo = $v['icon_logo_maps'];
            //echo $logo;
        }

        unlink($path . $logo);
    }

    public function deleteIconFil($conn) {
        $cnpj = $_SESSION['cnpj'];

        $sql = "SELECT icon_logo_maps FROM _using.filiais WHERE nr_cnpj_filial = '$cnpj'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $path = "C:\Users\gabri\OneDrive\Documentos\NetBeansProjects\WebUsing\web\img\loja_icon\\";

        $path = $path . str_replace("/", "", $cnpj) . "\\";

        foreach ($stmt->fetchAll() as $k => $v) {
            $logo = $v['icon_logo_maps'];
            //echo $logo;
        }

        unlink($path . $logo);
    }

}
