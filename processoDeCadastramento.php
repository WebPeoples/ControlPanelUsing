<?php
    session_start();

?>
<!DOCTYPE html>
<html>
<head>

    <!-- BAIXANDO AS BIBLIOTECAS DE JQUERY E BOOTSTRAP, ESTOU USANDO SOMENTE JQUERY-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type='text/javascript' src="js/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<title>Processo de Cadastramento</title>
    <style>
        /* SUBCATEGORIA MERCADOS */
        img{
            background-size: 100%;
            width: 160px;
            height: 160px;
            padding:0;
        }
        ul.ui-autocomplete {
            z-index: 1100;
        }

    </style>
</head>
<body>

<div id="myModal" class="modal fade" role="alertdialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Escolha uma especialidade para sua subcategoria</h4>
            </div>
            <div class="modal-body">
                <form class="form-group">
                    <label>Especialidade/Carro Chefe:</label>
                    <input type='text' name='country' value='' class='form-control auto'>
                </form>
                <br>

                <p>Exemplos:</p>
                <p>Mercados = Minimercados, Compra rápida, Hipermercados entre outras coisas.</p>
                <p>Restaurantes = Comida Mineira, Comida Japonesa, Comida Italiana entre outras coisas.</p>

                <div id="loading" style="display: none">
                    <img src="img/lg.progress-bar-preloader.gif"/>
                </div>

            </div>
            <div class="modal-footer">
                <button id="addEspec" type="button" class="btn btn-success" data-dismiss="modal" >Adicionar</button>
                <button id="cancelModal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>

<div id="show_cnpj" style="text-align: center"></div>
<div id="info_process" style="text-align: center"> Escolha duas categorias para poder prosseguir.</div>
<div id="info" style="text-align: center"></div>

<div class="container-fluid">

    <div id="subcat" style="display: none;">

        <H1 style="text-align: center">SUBCATEGORIAS</H1>
        <div class="container-fluid">
                <!-- CATEGORIA ALIMENTOS -->
            <h2 style="text-align: center">Alimentos</h2>
            <div class="subcat_buttons">
                <img src="img/subcategorias/subcategoria_alime_mercados_not_checked.png" class="subcat_btn" id="mercad"
                     data-toggle="modal" data-target="#myModal"/><label for="mercad"></label>

                <img src="img/subcategorias/subcategoria_alime_restau_not_checked.png" class="subcat_btn" id="restau"
                     data-toggle="modal" data-target="#myModal"/><label for="restau"></label>

                <img src="img/subcategorias/subcategoria_alime_pizza_not_checked.png" class="subcat_btn" id="pizza "
                 data-toggle="modal" data-target="#myModal"/><label for="restau"></label>
            </div>
                <!-- ==== -->
        </div>
        <div class="container-fluid">
            <!-- CATEGORIA VESTUÁRIO -->
            <h2 style="text-align: center">Vestuário</h2>
            <div style="margin: 0 auto">

            </div>
        </div>



    </div>

    <div class="row">
       <div class="col-xs-6">
                <div class="jumbotron">
                        <h1>Teste o Using</h1>
                        <p style="font-size:18px" >No plano gratuito, você pode utilizar nosso aplicativo Using por tempo ilimitado. No entanto, haverá limitações como:</p>
                        <p style="font-size:15px; color: red ">-Limite de produtos a serem exibidos.</p>
                        <p style="font-size:15px; color: red">-Limitado a uma unidade</p>
                        <p style="font-size:15px; color: red">-Limitado a duas subcategoria</p>
                     <button class="btn btn-danger" id="btn_plano_gratuito" style="position: relative; margin-left: 100px">PLANO GRATUITO</button>
               </div>
        </div>
        <div class="col-xs-6">
               <div class="jumbotron">
                        <h1>Compre e use o Using de forma ilimitada</h1>
                        <p style="font-size:18px">No plano pago, você pode utilizar nosso aplicativo Using por tempo ilimitado.
                        Sem restrições. Nosso plano pago atende exatamente o que você procura, adequando-se exatamente
                        ao que você precisa!</p>
                     <button class="btn btn-success" id="btn_painel_pago" style="position: relative; margin-left: 100px">ACESSE NOSSO PAINEL DE OPÇÕES</button>
               </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <button id="btn_prosseguir" style="display: none" class="btn btn-default">Prosseguir</button>
        </div>
        <div class="col-md-4">
            <button id="btn_voltar" style="display: none" class="btn btn-default">Voltar</button>
        </div>
    </div>

    <div class="row" id="plano_pago" style="display: none">
        <div class="container">
            <form class="form-group">
                <label for="subcat_range">Subcategorias</label>
                <input type="range" name="subcat_range" id="range_plano_pago_subcat" max="28" class="form-control" >
                <div style="font-size: 35px" id="message"></div>
                <div style="font-size: 25px" id="subcat_obtidas"></div>
            </form>
            <form class="form-group">
                <label for="produto_range">Produtos</label>
                <input type="range" name="subcat_range_produto" step="5" id="range_plano_pago_produto" max="250" class="form-control" >
                <div style="font-size: 35px" id="precoProduto"></div>
                <div style="font-size: 25px" id="qtdProduto"></div>
            </form>
            <form class="form-group">
                <label for="produto_range">Unidades</label>
                <input type="range" name="subcat_range_produto" step="1" id="range_plano_pago_filial"  max="400" class="form-control" >
                <div style="font-size: 35px" id="precoFilial"></div>
                <div style="font-size: 25px" id="qtdFilial"></div>
                <div style="font-size: 25px" id="subcat_inserida"></div>
            </form>

            <button class="btn btn-success" id="btn_comprar">Comprar</button>
        </div>
    </div>

    <div id="form-especialidade" class="container">
    </div>

</div>

<div style="font-size: 25px" id="subcat_inserida"></div>

<script type="text/javascript" >
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    //Exibindo o cnpj via sessão
    $("#show_cnpj").html("<?php echo $_SESSION['cnpj'] ?>");
    var precoSubcat = 0;
    var precoProduto = 0;
    var precoFilial = 0;
    var precoTotal = 0;

    $("#range_plano_pago_subcat").val(0);
    $('#range_plano_pago_subcat').on('input', function () {
        precoSubcat = $(this).val();
        if ($(this).val() > 0) {
            precoSubcat *= 7.99;
        }
        $("#message").html("Preço: R$" + precoSubcat);
        $("#subcat_obtidas").html("Subcategorias contratadas: " + $(this).val());
        precoTotal = precoSubcat + precoProduto + precoFilial;
        $("#subcat_inserida").html("Preço total: R$" + precoTotal);
    });

    $("#range_plano_pago_produto").val(0);
    $('#range_plano_pago_produto').on('input', function () {
        precoProduto = $(this).val();
        if ($(this).val() > 0) {
            var item = $(this).val() / 5;
            precoProduto = item * 4.99;
        }
        $("#precoProduto").html("Preço: R$" + precoProduto);
        $("#qtdProduto").html("Produtos contratados: " + $(this).val());
        precoTotal = precoSubcat + precoProduto + precoFilial;
        $("#subcat_inserida").html("Preço total: R$" + precoTotal);
    });

    $("#range_plano_pago_filial").val(0);
    $('#range_plano_pago_filial').on('input', function () {
        precoFilial = $(this).val();
        if ($(this).val() > 0) {
            precoFilial *= 24.99;
        }
        $("#precoFilial").html("Preço: R$" + precoFilial);
        $("#qtdFilial").html("Filiais contratadas: " + $(this).val());
        precoTotal = precoSubcat + precoProduto + precoFilial;
        $("#subcat_inserida").html("Preço total: R$" + precoTotal);
    });

    $("#btn_comprar").click(function () {
        $.post('./php/pagseguro.php', {preco: precoTotal}, function (data) {
            alert(data);
            window.location.href = 'https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html?code=' + data;
        })
    });

    $("#btn_painel_pago").click(function () {
        /*  $.post('./php/checkMySubcats.php',{funct: 'createPlanUser', plan: 'pago'}, function (data) {
         //alert(data);
         });*/
        $(".jumbotron").fadeOut(500);
        $("#plano_pago").fadeIn(2500);
    });


    $("#btn_prosseguir").click(function () {
        window.location.href = "login.php";
    });

    //Evento do botão plano gratuito, passando para o próximo passo do cadastro usando o fade's
    $("#btn_plano_gratuito").click(function () {

        $.post('./php/checkMySubcats.php', {funct: 'createPlanUser', plan: 'gratuito'}, function (data) {
            alert(data);
        });
        $(".jumbotron").fadeOut(500);
        $("#btn_voltar").fadeIn(2000);
        $("#subcat").fadeIn(2000);
        $("#btn_prosseguir").fadeIn(2000);

        checkSubcats();
    });

    // Desabilitando o botão prosseguir até que o usuário escolha duas subcategorias
    $("#btn_prosseguir").prop("disabled", true);

    var id;
    var subcatAlreadyGet = new Array();
    //instanciando a lista de valores das subcategorias que irão para o banco
    var subcatAlreadyGetForBtn = new Array();
    var checkboxesChecked = new Array();


    //Evento botão voltar no momento de escolha das subcategorias.
    $("#btn_voltar").click(function () {
        $("#subcat").fadeOut(500);
        $(".jumbotron").fadeIn(1000);
        $(this).css({"display": "none"});
    });


    $(".subcat_btn").click(function () {
        checkSubcats();
        var checkBtns = 0;
        id = $(this).prop('id');
        var id_ = "#" + id;
        alert(id);




        for (var x = 0; x < subcatAlreadyGetForBtn.length; x++) {
            if (subcatAlreadyGetForBtn[x] === id) {
                checkBtns = 1;
            }
        }

        if (checkBtns === 0) {
            //$(".modal-title").html(id);
            $(".auto").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: './php/autoCompleteEspec.php',
                        dataType: "json",
                        data: {
                            term: request.term,
                            subcat: id
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
        } else {
            $(id_).prop('disabled', true);
            alert("Você já possui esta subcategoria.");
        }

    });

    $("#addEspec").click(function () {
        insertSubcategorias(id, $(".auto").val());
    });





    //Método que envia os valores das checkboxes para o banco de dados
    function insertSubcategorias(subcategoria, especialidade) {
        var page = './php/insertSubcategoriaToDb.php';
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: page,
            beforeSend: function () {
                $("#loading").show();
            },
            data: {subcategoria: subcategoria, especialidade: especialidade},
            success: function (msg) {
                checkSubcats();

                $(".auto").val("");
                alert(msg);
            },
            error: function () {
                $("#message").html("Não carregou");
            }
        });
    }

    function checkSubcats() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'checkMySubcats'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                var json = JSON.parse(msg);

                var arr = $.map($(".subcat_btn"), function (n, i) {
                    return n.id;
                });

                for (var x = 0; x < json.length; x++) {
                    for (var y = 0; y < arr.length; y++) {
                        if (json[x] === arr[y]) {
                            var id = "#" + arr[y];
                            //$(id).prop('disabled', true);
                            subcatAlreadyGet.push(json[x]);
                            subcatAlreadyGetForBtn.push(json[x]);
                        }
                    }
                }

                if (subcatAlreadyGet.length > 0) {
                    $("#btn_prosseguir").prop('disabled', false);
                }

                checkForMyPlan();
            },
            error: function () {
                location.reload();
            }
        });
    }

    function checkSubcatsForBtn() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'checkMySubcats'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                var json = JSON.parse(msg);

                var arr = $.map($(".subcat_btn"), function (n, i) {
                    return n.id;
                });

                for (var x = 0; x < json.length; x++) {
                    for (var y = 0; y < arr.length; y++) {
                        if (json[x] === arr[y]) {
                            var id = "#" + arr[y];
                            //$(id).prop('disabled', true);
                            subcatAlreadyGet.push(json[x]);
                            $("#subcat_inserida").html("Subcategoria inserida -> " + subcatAlreadyGet[x]);
                            $("#subcat_inserida").html("valor de x -> " + x + " valor de y ->" + y);
                            //alert(subcatAlreadyGet.length + " " + subcatAlreadyGet[y] + " " + id);
                        }
                    }
                }

                checkForMyPlan();
            },
            error: function () {
                location.reload();
            }
        });
    }

    function checkForMyPlan() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'checkPlanUser'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                var json = JSON.parse(msg);
                var qtd_subcat = json['qtd_subcat'];
                $("#subcat_obtidas").html("Subcategorias já obtidas -> " + subcatAlreadyGet.length);

                if (qtd_subcat === String(subcatAlreadyGet.length)) {
                    alert("Você atingiu o limite máximo de subcategorias do seu plano.");
                    window.location.href = "./login.php";
                }

                subcatAlreadyGet = [];
            },
            error: function () {
                location.reload();
            }
        });
    }
});

</script>


</body>
</html>