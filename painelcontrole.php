<?php
session_start();

if (isset($_SESSION['cnpj_matriz']) && !empty($_SESSION['cnpj_matriz'])) {
    $CNPJ = $_SESSION['cnpj_matriz'];
    $_SESSION['cnpj'] = $CNPJ;
} else {
    header("Location: login.php");
    die();
}
?>
<html>
    <head>
        <title>Painel de controle</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>
    
    
    
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><?php echo $CNPJ; ?></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#" id="btn_home">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="./login.php" id="btn_logoff"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
                </ul>
            </div>
        </nav>

        <!-- BOTÕES PARA FILIAIS (PRODUTOS/SEUS DADOS)-->
        <div style="display: none;" class="container" id="linha_fil">
            <div class="row" >
                <div class="col-xs-12" >
                    <div class="jumbotron" id="jumbotron_produtos_fil"style="cursor: pointer; box-shadow: 0 0 10px black;">
                        <p style="text-align: center" id="produtos">PRODUTOS</p>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="jumbotron" id="jumbotron_seus_dados_fil" style="cursor: pointer; box-shadow: 0 0 10px black;">
                        <p style="text-align: center">SEUS DADOS</p>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="container">
            <div class="row" id="linha">
                <div class="col-xs-6" >
                    <div class="jumbotron" id="jumbotron_produtos"style="cursor: pointer; box-shadow: 0 0 10px black;">
                        <p style="text-align: center" id="produtos">PRODUTOS</p>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="jumbotron" id="jumbotron_filial" style="cursor: pointer; box-shadow: 0 0 10px black;">
                        <p style="text-align: center">FILIAIS</p>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="jumbotron" id="jumbotron_seus_dados" style="cursor: pointer; box-shadow: 0 0 10px black;">
                        <p style="text-align: center">SEUS DADOS</p>
                    </div>
                </div>
            </div>
            

            <div class="row" id="btns_subcats" style="display:none;">
                <div id="col-sm-12">
                    <div id="btn_subcategoria"></div>
                </div>
            </div>

            <div class="row" id="lista_produtos" style="display:none;">
                <div id="col-sm-12">
                    <div id="produtos_atual"></div>
                    <button class="btn btn-success" id="btn_add_prod" data-toggle="modal" data-target="#myModal">Adicionar produto</button>
                    <button class="btn btn-danger" id="btn_voltar">Voltar</button>
                </div>
            </div>
            
            <div class="row" id="lista_produtos_fil" style="display:none;">
                <div id="col-sm-12">
                    <div id="produtos_atual_fil"></div>
                    <button class="btn btn-success" id="btn_add_prod" data-toggle="modal" data-target="#modalAddProdFil">Adicionar produto</button>
                    <button class="btn btn-danger" id="btn_voltar">Voltar</button>
                </div>
            </div>
        </div>

        <div style="display: none;" id="loading" ><p>Carregando...</p></div>

        <div style="display: none;" id="infoDiv" ><p>Carregando...</p></div>

        <div style="display: none;" id="showFiliais"></div>

        <div class="container" id="form_fil" style="display: none">
            <div class="col-sm-12" id="">
                <form method="POST" name="form_add_fil">

                    <div class="form-group">
                        <label for="razao_social">Razão Social</label>
                        <input class="form-control" name="razao_social" id="razao_social">
                    </div>
                    <div class="form-group">
                        <label for="cnpj_fil">CNPJ Filial</label>
                        <input class="form-control" name="cnpj_fil" id="cnpj_fil">
                    </div>
                    <div class="form-group">
                        <label for="rua_fil">Rua Filial</label>
                        <input class="form-control" name="rua_fil" id="rua_fil">
                    </div>
                    <div class="form-group">
                        <label for="numero_fil">Número Filial</label>
                        <input class="form-control" name="numero_fil" id="numero_fil">
                    </div>
                    <div class="form-group">
                        <label for="cep_fil">CEP Filial</label>
                        <input class="form-control" name="cep_fil" id="cep_fil">
                    </div>
                    <div class="form-group">
                        <label for="bairro_fil">Bairro Filial</label>
                        <input class="form-control" name="bairro_fil" id="bairro_fil">
                    </div>
                    <div class="form-group">
                        <label for="cidade_fil">Cidade Filial</label>
                        <input class="form-control" name="cidade_fil" id="cidade_fil">
                    </div>
                    <div class="form-group">
                        <label for="estado_fil">Código Estado(Ex: São Paulo -> SP)</label>
                        <input class="form-control" name="estado_fil" id="estado_fil">
                    </div>
                    <div class="form-group">
                        <label for="pais_fil">País</label>
                        <input class="form-control" name="pais_fil" id="pais_fil">
                    </div>
                    <div class="form-group">
                        <label for="expediente_fil">Horários de funcionamento</label>
                        <textarea rows="3" class="form-control" id="expediente_fil" name="expediente_fil"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telefone_fil">Telefone</label>
                        <input class="form-control" name="telefone_fil" id="telefone_fil">
                    </div>
                    <div class="form-group">
                        <label for="email_fil">Email Filial</label>
                        <input class="form-control" name="email_fil" id="email_fil">
                    </div>
                    <div class="form-group">
                        <label for="site_fil">Site Filial(Opcional)</label>
                        <input class="form-control" name="site_fil" id="site_fil">
                    </div>
                    <input value="insertFil" style="display: none" name="funct" id="funct">
                    <button type="submit" class="btn btn-success" id="add_filial">Finalizar</button>
                </form>


            </div>
        </div>


        <!-- Modal adicionar produto -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Novo produto</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" name="foto_prod_1" method="post" id="imageUpload" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nome_produto">Nome:</label>
                                <input name="nome_produto" class="form-control" id="nome_produto" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="preco_produto">Preço(R$):</label>
                                <input id="preco_produto" name="preco_produto" class="form-control" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="subcategoria">Especialidade</label>
                                <div id="select_tag_subcategoria"></div>
                            </div>
                            <div class="form-group">
                                <label for="marca_prod">Marca produto (opcional):</label>
                                <input class="form-control" id="marca_prod" name="marca_prod">
                            </div>
                            <div class="form-group">
                                <label for="if_promo">Em promoção:</label>
                                <select class="form-control" id="if_promo">
                                    <option value="n">Não</option>
                                    <option value="s">Sim</option>
                                </select>
                            </div>
                            <div id="form_preco_promo"  class="form-inline" style="display: none">
                                <label for="preco_old">Porcentagem promoção(%):</label>
                                <input class="form-control" id="porcentagem_promo" name="porcentagem_promo">
                                <p id="btn_calculcar_promo" class="btn btn-default">Calcular</p>
                            </div>
                            <div class="form-inline" id="preco_em_promo">
                                <label for="preco_em_promo">Preço em promo:</label>
                                <input id="preco_promo_div" class="form-control" name="preco_promo_div" />
                            </div>
                            <div class="form-group">
                                <label for="descricao_prod">Descrição produto:</label>
                                <textarea name="descricao_prod" id="descricao_prod" rows="3" class="form-control"></textarea>
                            </div>

                            <div name="foto_prod_1" method="post" enctype="multipart/form-data">
                                <label for="fileToUpload" class="fileToUpload"><span id="fileName">Selecione uma foto para o produto:</span></label>

                                <input type="file" name="fileToUpload" class="form-control btn-btn-default" id="fileToUpload">

                            </div>

                            <input type="submit" class="btn btn-success" value="Enviar">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

            <div id="modalAddProdFil" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Novo produto</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" name="form_envia_prod_fil" method="post" id="imageUpload" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nome_produto">Nome do Produto:</label>
                                <input name="nome_produto" class="form-control" id="nome_produto_fil" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="preco_produto">Preço(R$):</label>
                                <input id="preco_produto_fil" name="preco_produto" class="form-control" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="subcategoria">Especialidade</label>
                                <div id="select_tag_subcategoria"></div>
                            </div>
                            <div class="form-group">
                                <label for="marca_prod">Marca produto (opcional):</label>
                                <input class="form-control" id="marca_prod" name="marca_prod">
                            </div>
                            <div class="form-group">
                                <label for="if_promo">Em promoção:</label>
                                <select class="form-control" id="if_promo">
                                    <option value="n">Não</option>
                                    <option value="s">Sim</option>
                                </select>
                            </div>
                            <div id="form_preco_promo"  class="form-inline" style="display: none">
                                <label for="preco_old">Porcentagem promoção(%):</label>
                                <input class="form-control" id="porcentagem_promo" name="porcentagem_promo">
                                <p id="btn_calculcar_promo" class="btn btn-default">Calcular</p>
                            </div>
                            <div class="form-inline" id="preco_em_promo">
                                <label for="preco_em_promo">Preço em promo:</label>
                                <input id="preco_promo_div" class="form-control" name="preco_promo_div" />
                            </div>
                            <div class="form-group">
                                <label for="descricao_prod">Descrição produto:</label>
                                <textarea name="descricao_prod" id="descricao_prod" rows="3" class="form-control"></textarea>
                            </div>

                            <div name="foto_prod_1" method="post" enctype="multipart/form-data">
                                <label for="input_prodFil_1" class="fileToUpload"><span id="label_prodFil_1">Selecione uma foto para o produto:</span></label>

                                <input type="file" name="input_prodFil_1" class="form-control btn-btn-default" id="input_prodFil_1">

                            </div>
                            <input value="enviaProdFil" name="funct" style="display: none">
                            <input type="submit" class="btn btn-success" value="Enviar">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- style file to upload-->
        <style>
            input[type='file'] {
                display: none
            }

            .fileToUpload{
                background-color: pink;
                border: 3px solid #ddd;
                cursor: pointer;
                color: white;
                padding: 20px;
                width: 150px;
                height: 150px;
            }

            .fileToUpload:hover{
                background-color: red;
            }

            .logoToUpload{
                background-color: #dfc8ca; 
                border: 2px solid black;
                border-radius: 100px;
                padding: 2%;
                cursor: pointer;
                transition: 0.5s;
            }

            .logoToUpload:hover{
                box-shadow: 0px 0px 5px black;
            }

        </style>

        <!-- Modal more details -->
        <div id="moreDetails" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Novo produto</h4>
                    </div>
                    <div class="modal-body">

                        <form class="form-group" name="alterProduto" method="post" id="imageUpload" enctype="multipart/form-data">
                            <input name="funct" style="display:none;" value="alterProduto">
                            <input name="id_prod_more_details" id="id_prod_more_details" style="display: none">
                            <div class="form-group">
                                <label for="nome_produto">Nome:</label>
                                <input name="nome_produto" class="form-control" id="nome_prod_more_details" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="preco_produto">Preço(R$):</label>
                                <input id="preco_produto_more_details" name="preco_produto" class="form-control" inputmode="text">
                            </div>
                            <div class="form-group">
                                <label for="subcategoria">Especialidade</label>
                                <div id="select_tag_subcategoria"></div>
                            </div>
                            <div class="form-group">
                                <label for="marca_prod">Marca produto (opcional):</label>
                                <input class="form-control" id="marca_prod_more_details" name="marca_prod">
                            </div>
                            <div class="form-group">
                                <label for="if_promo">Em promoção:</label>
                                <select class="form-control" name="if_promo_more_details" id="if_promo_more_details">
                                    <option value="n">Não</option>
                                    <option value="s">Sim</option>
                                </select>
                            </div>
                            <div id="form_preco_promo_more_details"  class="form-inline" style="display: none">
                                <label for="preco_old">Porcentagem promoção(%):</label>
                                <input class="form-control" id="porcentagem_promo_more_details" name="porcentagem_promo">
                                <p id="btn_calculcar_promo" class="btn btn-default">Calcular</p>
                            </div>
                            <div class="form-inline" id="preco_em_promo_more_details" style="display: none">
                                <label for="preco_em_promo">Preço em promo:</label>
                                <input id="preco_promo_div_more_details" class="form-control" name="preco_promo_div" />
                            </div>
                            <div class="form-group">
                                <label for="descricao_prod">Descrição produto:</label>
                                <textarea name="descricao_prod" id="descricao_prod_more_details" rows="3" class="form-control"></textarea>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal more details -->
        <div id="alterImg" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Alterar imagens</h4>
                    </div>
                    <div class="modal-body" id="fotos_produtos_more_details" class="col-sm-12">

                        <div id="alterImg_1">
                            <label for='fileToUpload' class='fileToUpload'><span id='fileName'>Selecione uma foto para o produto:</span></label><input type='file' name='fileToUpload'class='fileToUpload_more form-control btn-btn-default' id='foto_1_fileToUpload'>
                        </div>
                        <div id="img_1"></div>
                        <div id="alterImg_2">
                            <label for='fileToUpload' class='fileToUpload'><span id='fileName'>Selecione uma foto para o produto:</span></label><input type='file' name='fileToUpload'class='fileToUpload_more form-control btn-btn-default' id='foto_2_fileToUpload'>
                        </div>
                        <div id="img_2"></div> 
                        <div id="alterImg_3">
                            <label for='fileToUpload' class='fileToUpload'><span id='fileName'>Selecione uma foto para o produto:</span></label><input type='file' name='fileToUpload'class='fileToUpload_more form-control btn-btn-default' id='foto_3_fileToUpload'>
                        </div>
                        <div id="img_3"></div>
                        <div id="alterImg_4">
                            <label for='fileToUpload' class='fileToUpload'><span id='fileName'>Selecione uma foto para o produto:</span></label><input type='file' name='fileToUpload'class='fileToUpload_more form-control btn-btn-default' id='foto_4_fileToUpload'>
                        </div>
                        <div id="img_4"></div>
                        <div id="alterImg_5">
                            <label for='fileToUpload' class='fileToUpload'><span id='fileName'>Selecione uma foto para o produto:</span></label><input type='file' name='fileToUpload'class='fileToUpload_more form-control btn-btn-default' id='foto_5_fileToUpload'>
                        </div>
                        <div id="img_5"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal adicionar produto -->
        <div id="myMessage_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #44d ">
                        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <h4 class="modal-title" style="color:white">Inserir Filial</h4>
                    </div>
                    <div class="modal-body">
                        <p id="message_modal" ></p>
                    </div>

                </div>

            </div>
        </div>

        <form style="display: none;" name="form_myData" id="form_myData" method="post" enctype="multipart/form-data">
            <div id="meusDados" class="container">

                <div class="col-xs-12">
                    <div style="float: left;">
                        <h2>Logo</h2>
                        <img style="width: 200px;height: 180px; box-shadow: 0px 0px 5px black; border: 2px solid black"
                             class="img-circle img-responsive" id="logo_cliente" src="./img/empty_image.png" >
                        <label for="input_logo" class="logoToUpload"><span id="input_logo_span">Selecione uma foto</span></label>
                        <input type="file" name="logoToUpload" class="form-control btn-btn-default" id="input_logo">
                        

                        <h2>Ícone para o mapa</h2>
                        <img style="width: 150px;height: 100px; box-shadow: 0px 0px 5px black; border: 2px solid black"
                             class="img-responsive" id="icon_cliente" src="./img/empty_image.png" >
                        <label for="iconeToUpload" class="logoToUpload"><span id="input_icon_span">Selecione uma foto</span></label>
                        <input type="file" name="iconeToUpload" class="form-control btn-btn-default" id="iconeToUpload">
                    </div>

                    <input type="text" name="fileNameToUpload" id="fileNameToUpload" style="display: none">
                    <input type="text" name="iconNameToUpload" id="iconNameToUpload" style="display: none">

                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="nm_fantasia_myData">Razão Social:</label>
                        <input type="text" class="form-control form_myData" placeholder="Razão Social" name="nm_fantasia_myData" id="nm_fantasia_myData">
                    </div>

                    <!--   <div id="div_endereco" class="form-group" style="float: right; width: 70%;border:1px solid black; padding:5px">       
                           <p>Endereço:</p>
                           <p id="endereco_myData"></p>
                           <button id="btn_fade_endereco" class="btn btn-success">Alterar</button>
                       </div>-->



                    <div class="form-group"  style="float: right; width: 70%;">
                        <label>Rua:</label>
                        <input type="text" id="input_alterar_rua" class="form-control" name="input_alterar_rua">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Número:</label>
                        <input type="text" id="input_alterar_numero" class="form-control" name="input_alterar_numero">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Bairro:</label>
                        <input type="text" id="input_alterar_bairro" class="form-control" name="input_alterar_bairro">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Cidade:</label>
                        <input type="text" id="input_alterar_cidade" class="form-control" name="input_alterar_cidade">
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>CEP:</label>
                        <input type="text" id="input_alterar_cep" class="form-control" name="input_alterar_cep">    
                    </div>


                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="email_myData">Email para contato:</label>
                        <input type="text" class="form-control form_myData" placeholder="Email para contato" name="email_myData" id="email_myData">
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="expediente_myData">Expediente:</label>
                        <textarea rows="3" type="text" class="form-control form_myData" placeholder="Expediente" name="expediente_myData" id="expediente_myData"></textarea>
                    </div>
                </div>
                <input name="funct" value="sendMyData" style="display: none;">
                <button style="width: 100%;"  class="btn btn-default" id="btn_saveChange_myData">Salvar Alterações</button>



            </div>
        </form>
        
        <form style="display: none;" name="form_myData" id="form_myData_fil" method="post" enctype="multipart/form-data">
            <div id="meusDados" class="container">

                <div class="col-xs-12">
                    <div style="float: left;">
                        <h2>Logo</h2>
                        <img style="width: 200px;height: 180px; box-shadow: 0px 0px 5px black; border: 2px solid black"
                             class="img-circle img-responsive" id="logo_fil" src="./img/empty_image.png" >
                        <label for="input_logoFil" class="logoToUpload"><span id="input_logo_spanFil">Selecione uma foto</span></label>
                        <input type="file" name="logoToUploadFil" class="form-control btn-btn-default" id="input_logoFil">
                        

                        <h2>Ícone para o mapa</h2>
                        <img style="width: 150px;height: 100px; box-shadow: 0px 0px 5px black; border: 2px solid black"
                             class="img-responsive" id="icon_fil" src="./img/empty_image.png" >
                        <label for="iconeToUploadFil" class="logoToUpload"><span id="input_icon_spanFil">Selecione uma foto</span></label>
                        <input type="file" name="iconeToUploadFil" class="form-control btn-btn-default" id="iconeToUploadFil">
                    </div>

                    <input type="text" name="fileNameToUploadFil" id="fileNameToUploadFil" style="display: none">
                    <input type="text" name="iconNameToUploadFil" id="iconNameToUploadFil" style="display: none">

                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="nm_fantasia_myData">Razão Social:</label>
                        <input type="text" disabled class="form-control form_myData" placeholder="Razão Social" name="nm_fantasia_myData" id="nm_fantasia_myData_fil">
                    </div>
                 
                    <div class="form-group"  style="float: right; width: 70%;">
                        <label>Rua:</label>
                        <input type="text" id="input_alterar_rua_fil" class="form-control" name="input_alterar_rua">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Número:</label>
                        <input type="text" id="input_alterar_numero_fil" class="form-control" name="input_alterar_numero">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Bairro:</label>
                        <input type="text" id="input_alterar_bairro_fil" class="form-control" name="input_alterar_bairro">    
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>Cidade:</label>
                        <input type="text" id="input_alterar_cidade_fil" class="form-control" name="input_alterar_cidade">
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">
                        <label>CEP:</label>
                        <input type="text" id="input_alterar_cep_fil" class="form-control" name="input_alterar_cep">    
                    </div>


                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="email_myData">Email para contato:</label>
                        <input type="text" class="form-control form_myData" placeholder="Email para contato" name="email_myData" id="email_myData_fil">
                    </div>

                    <div class="form-group" style="float: right; width: 70%;">       
                        <label for="expediente_myData">Expediente:</label>
                        <textarea rows="3" type="text" class="form-control form_myData" placeholder="Expediente" name="expediente_myData" id="expediente_myData_fil"></textarea>
                    </div>
                </div>
                <input name="funct" value="sendMyDataFil" style="display: none;">
                <button style="width: 100%;"  class="btn btn-default" id="btn_saveChange_myData_fil">Salvar Alterações</button>
            </div>
        </form>

        <!-- 56.674.799/0001-56-->
        <script src="./js/painelDeControle_1.js"></script>
    </body>
</html>