<?php
    require 'connection.php';
    session_start();
    $cnpj = $_SESSION["cnpj"];
    $subcategoria =  $_POST['subcategoria'];
    $especialidade = $_POST['especialidade'];
    $nm_subcat;


                // estou checando se já há essa especialidade na tabela de especialidade
                $queryForEspecialidade = "Select nm_especialidade_sub_cat from _using.especialidade_sub_cat 
                where nm_especialidade_sub_cat = '$especialidade';";

                $stmtQuery = $conn->prepare($queryForEspecialidade);
                $stmtQuery->execute();

                // set the resulting array to associative
                $result = $stmtQuery->setFetchMode(PDO::FETCH_ASSOC);

                // se rowCount da busca for igual a zero, então eu não possuo está especialidade, neste caso eu insiro na tabela
                if ($stmtQuery->rowCount() === 0 ){
                    echo "Esta especialidade não existe \n";

                    $insertEspecialidade = "INSERT INTO [_using].[especialidade_sub_cat]
                    ([cd_subcat]
                    ,[nm_especialidade_sub_cat])
                    VALUES
                    ('$subcategoria',
                     '$especialidade')";

                    $stmtInsertEspecialidade = $conn->prepare($insertEspecialidade);
                    $stmtInsertEspecialidade->execute();

                        if ($stmtInsertEspecialidade->rowCount() > 0){
                            // em seguida eu atrelo a especialidade ao cnpj do cliente em outra tabela
                            $insertEspecialidadeInCnpj = "INSERT INTO [_using].[subcategorias_especialidade_cliente]
                           ([cnpj]
                           ,[subcategoria]
                           ,[especialidade])
                     VALUES
                           ('$cnpj', 
                            '$subcategoria',
                            '$especialidade')";

                            $stmtInsertEspecialidadeInCnpj = $conn->prepare($insertEspecialidadeInCnpj);
                            $stmtInsertEspecialidadeInCnpj->execute();

                            if ($stmtInsertEspecialidadeInCnpj->rowCount() > 0){
                                echo "Especialidade inserida com sucesso.";
                            }else{
                                echo "Não foi possível inserir esta especialidade";
                            }

                        }else{
                            echo "Não foi possível inserir sua especialidade";
                        }
                }else{
                    // caso já exista a especialidade na tabela, eu atrelo o cnpj do cliente a especialidade diretamente.
                    echo "Já existe esta especialidade \n";
                    $insertEspecialidadeInCnpj = "INSERT INTO [_using].[subcategorias_especialidade_cliente]
                           ([cnpj]
                           ,[subcategoria]
                           ,[especialidade])
                     VALUES
                           ('$cnpj', 
                            '$subcategoria',
                            '$especialidade')";

                    $stmtInsertEspecialidadeInCnpj = $conn->prepare($insertEspecialidadeInCnpj);
                    $stmtInsertEspecialidadeInCnpj->execute();

                    if ($stmtInsertEspecialidadeInCnpj->rowCount() > 0){
                        echo "Especialidade inserida com sucesso. \n";
                    }

                }
?>