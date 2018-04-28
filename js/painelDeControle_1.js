/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* ************** PAINEL DE  CONTROLE *********************** */

$(document).ready(function () {


    /* ***** BOTÃO HOME ***** */
    var btn_home = $("#btn_home");

    btn_home.click(function () {
        lista_produtos.hide();
        btns_subcats.hide();
        $("#showFiliais").hide();
        $("#form_fil").hide();
        $("#infoDiv").hide();
        $("#loading").hide();
        linha.fadeIn(500);
        $("#form_myData").hide();
        $("#lista_produtos_fil").hide();
        $("#linha_fil").hide();
        $("#form_myData_fil").hide();
        changeCNPJ();
    });
    /* ********************* */
    var cnpj = null;
    $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'changeCNPJ'},

            success: function (msg) {
               cnpj = msg;
            },
            error: function () {

            }
        });
   

    function changeCNPJ() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'changeCNPJ'},

            success: function (msg) {
                $(".navbar-brand").html(msg);
            },
            error: function () {

            }
        });
    }


//var path = "http://localhost:8080/WebUsing/img/produtos/cerveja1.jpg";


    /* VARIÁVEIS */
    var linha = $("#linha");
    var btn_voltar = $("#btn_voltar");
    var btn_enviar = $("#btn_enviar");
    var jumbotron_seus_dados = $("#jumbotron_seus_dados");
    var subcategoria_temp = null;
    var cnpj_fil_temp = null;
    var id_prod = 0;
    var btn_finalizar_fil = $("#add_filial");
    var $input = document.getElementById('fileToUpload');
    var imagem_logo = document.getElementById('input_logo');
    var imagem_icone = document.getElementById('iconeToUpload');
    var imagem_logo_fil = document.getElementById('input_logoFil');
    var imagem_icone_fil = document.getElementById('iconeToUploadFil');
    var foto_logo = "";
    var foto_icone = "";
    var foto_logo_fil = "";
    var foto_icone_fil = "";
    /* ****************** */

    jumbotron_seus_dados.click(function () {

    });
    $("#input_logo").change(function () {
        var filename = imagem_logo.files[0].name;
        foto_logo = filename;

        var maiorQue19 = filename.substring(0, 19) + "...";
        var strLength = filename.length;

        if (strLength > 19) {
            $("#input_logo_span").html(maiorQue19);
        } else {
            $("#input_logo_span").html(filename);
        }

    });

    $("#input_logoFil").change(function () {
        var filename = imagem_logo_fil.files[0].name;
        foto_logo_fil = filename;

        var maiorQue19 = filename.substring(0, 19) + "...";
        var strLength = filename.length;

        if (strLength > 19) {
            $("#input_logo_spanFil").html(maiorQue19);
        } else {
            $("#input_logo_spanFil").html(filename);
        }

    });


    $("#iconeToUpload").change(function () {
        var filename = imagem_icone.files[0].name;
        // alert(filename);
        foto_icone = filename;

        var maiorQue19 = filename.substring(0, 19) + "...";
        var strLength = filename.length;

        if (strLength > 19) {
            $("#input_icon_span").html(maiorQue19);
        } else {
            $("#input_icon_span").html(filename);
        }

    });

    $("#iconeToUploadFil").change(function () {
        var filename = imagem_icone_fil.files[0].name;
        //alert(filename);
        foto_icone_fil = filename;

        var maiorQue19 = filename.substring(0, 19) + "...";
        var strLength = filename.length;

        if (strLength > 19) {
            $("#input_icon_spanFil").html(maiorQue19);
        } else {
            $("#input_icon_spanFil").html(filename);
        }

    });





    /* **** LOG OFF ***** */
    var btn_logoff = $("#btn_logoff");

    btn_logoff.click(function () {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'logoff'},

            success: function (msg) {

            },
            error: function () {

            }
        });
    });
    /* **************** */

    /* ***** JUMBOTRON PRODUTOS ****** */
    var lista_produtos = $("#lista_produtos");
    var btn_add_prod = $("#btn_add_prod");
    var btns_subcats = $("#btns_subcats");
    var if_promo = $("#if_promo");
    var btn_calcular_promo = $("#btn_calculcar_promo");
    var form_preco_promo = $("#form_preco_promo");

    var jumbotron_produtos = $("#jumbotron_produtos");

    jumbotron_produtos.mouseenter(function () {
        jumbotron_produtos.css({"color": "blue", "font-size": "200%"});
    });

    jumbotron_produtos.mouseleave(function () {
        jumbotron_produtos.css({"color": "#333", "font-size": "150%"});
    });

    jumbotron_produtos.click(function () {
        linha.hide();
        //lista_produtos.fadeIn(3000);
        btns_subcats.fadeIn(500);
        getSubcategorias();
        //getProdutos();
    });

    /* ************************ */

    /* **** EVENTOS DE PRODUTOS **** */
    btn_calcular_promo.click(function () {

        if ($("#preco_produto").val() !== "" && $("#porcentagem_promo").val() !== "")
        {
            var porcentagem = $("#porcentagem_promo").val();
            var preco_normal = $("#preco_produto").val();

            var promo = preco_normal - ((preco_normal / 100) * porcentagem);
            $("#preco_promo_div").val("R$" + promo);
        } else
        {
            $("#message_modal").html("Insira um preço e uma porcentagem para poder inserir uma promoção!");
            $("#myMessage_modal").modal('show');
            //alert("Insira um preço e uma porcentagem para poder inserir uma promoção!");
        }
    });

    if_promo.change(function () {
        var if_promocao = $("#if_promo :selected").val();
        if (if_promocao === 's')
        {
            $("#form_preco_promo").fadeIn(200);
        } else
        {
            $("#form_preco_promo").fadeOut(200);
        }
    });

    $("form[name='foto_prod_1']").submit(function (e) {
        if ($("#nome_produto").val() !== "" && $("#precoProduto").val() !== "") {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "./php/upload_php.php",
                type: "POST",
                data: formData,
                async: false,
                beforeSend: function () {
                    $("#message_modal").html("Enviado imagem...");
                    $("#myMessage_modal").modal('show');
                },
                success: function (msg) {
                    var info = "A imagem foi enviada.";
                    if (msg === info) {
                        $("#myModal").modal('hide');
                        $("#message_modal").html(msg);
                        $("#myMessage_modal").modal('show');
                        /* $("#nome_produto").val("");
                         $("#preco_produto").val("");
                         $("#marca_prod").val("");
                         $("#porcentagem_promo").val("");
                         $("#descricao_prod").val("");
                         $("#fileToUpload").val("");*/

                        $("form[name='foto_prod_1']")[0].reset();

                        $("#produtos_atual").html("");
                        getProdutos(subcategoria_temp);
                    } else
                    {
                        $("#message_modal").html(msg);
                        $("#myMessage_modal").modal('show');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            e.preventDefault();
            return false;
        } else {
            $("#message_modal").html("Digite um preço e ou o nome do produto.");
            $("#myMessage_modal").modal('show');
            //alert("Digite um preço e ou o nome do produto.");
            e.preventDefault();
        }

    });

    $("form[name='form_envia_prod_fil']").submit(function (e) {
        if ($("#nome_produto_fil").val() !== "" && $("#preco_produto_fil").val() !== "") {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "./php/ProdutosControl.php",
                type: "POST",
                data: formData,
                async: false,
                beforeSend: function () {
                    $("#message_modal").html("Enviado...");
                    $("#myMessage_modal").modal('show');
                },
                success: function (msg) {

                    //var info = "A imagem foi enviada.";

                    $("#message_modal").html(msg);
                    $("#myMessage_modal").modal('show');
                    /* $("#nome_produto").val("");
                     $("#preco_produto").val("");
                     $("#marca_prod").val("");
                     $("#porcentagem_promo").val("");
                     $("#descricao_prod").val("");
                     $("#fileToUpload").val("");*/

                    $("form[name='form_envia_prod_fil']")[0].reset();
                    $("#input_prodFil_1").val("");
                    $("#label_prodFil_1").html("Selecione uma foto para o produto:");
                    $("#modalAddProdFil").modal('hide');

                    $("#produtos_atual_fil").html("");
                    getProdutosFil(subcategoria_temp, cnpj_fil_temp);

                },
                cache: false,
                contentType: false,
                processData: false
            });

            e.preventDefault();
            return false;
        } else {
            $("#message_modal").html("Digite um preço e ou o nome do produto.");
            $("#myMessage_modal").modal('show');
            //alert("Digite um preço e ou o nome do produto.");
            e.preventDefault();
        }

    });

    $("form[name='alterProduto']").submit(function (e) {

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "./php/ProdutosControl.php",
            type: "POST",
            data: formData,
            async: false,
            beforeSend: function () {
                alert("Enviando imagem");
            },
            success: function (msg) {
                var info = "Produto alterado.";
                if (msg === info) {
                    alert(msg);
                    //alert(msg);
                    /*$("#nome_produto").val("");
                     $("#preco_produto").val("");
                     $("#marca_prod").val("");
                     $("#porcentagem_promo").val("");
                     $("#descricao_prod").val("");
                     $("#fileToUpload").val("");
                     */

                    $("produtos_atual").html("");
                    alert("antes de getProd");
                    getProdutos(subcategoria_temp);
                } else {
                    alert(msg);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
        return false;


    });

    btn_finalizar_fil.click(function () {
        $("form[name='form_add_fil']").submit(function (e) {
            if ($("#cnpj_fil").val() !== "" && $("#rua_fil").val() !== ""
                    && $("#numero_fil").val() !== "" && $("#cep_fil").val() !== ""
                    && $("#bairro_fil").val() !== "" && $("#cidade_fil").val() !== ""
                    && $("#estado_fil").val() !== "" && $("#pais_fil").val() !== "") {
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: "./php/FiliaisControl.php",
                    type: "POST",
                    data: formData,
                    async: false,
                    beforeSend: function () {
                        $("#loading").show();
                    },
                    success: function (msg) {
                        $("#loading").hide();

                        var info = "Cadastrado com sucesso";
                        $("#message_modal").html(msg);
                        $("#myMessage_modal").modal('show');
                        if (msg === info) {
                            $("form[name='form_add_fil']")[0].reset();
                        } else {
                            $("#form_fil").fadeOut(500);
                        }
                        /* $("#nome_produto").val("");
                         $("#preco_produto").val("");
                         $("#marca_prod").val("");
                         $("#porcentagem_promo").val("");
                         $("#descricao_prod").val("");
                         $("#fileToUpload").val("");*/

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            } else {
                $("#message_modal").html("Você deixou de preencher alguns campos.");
                $("#myMessage_modal").modal('show');
            }


            e.preventDefault();
            return false;
        });
    });

    btn_add_prod.click(function () {

    });

    form_preco_promo.submit(function () {
        return false;
    });

    /* ************************* */


    /* FUNCTIONS PRODUTO */

    function getProdutos(subcat) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getProdutos', subcat: subcat},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                $("#produtos_atual").html(msg);

                $(".td_produtos").click(function () {
                    var id = $(this).prop('id');
                    getMoreDetails(id);
                    id_prod = id;
                });

                $(".delete_prod").click(function () {
                    var id = $(this).prop('id');
                    // alert(id);
                    deleteProduto(id);
                });

                $(".td_fotos_prod").click(function () {
                    var id = $(this).prop('id');
                    getFotosProd(id);
                });
            },
            error: function () {
                location.reload();
            }
        });
    }

    function getProdutosFil(subcat, cnpj) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getProdutosFil', subcat: subcat, cnpj_fil: cnpj},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                $("#produtos_atual_fil").html(msg);

                $(".td_produtos").click(function () {
                    var id = $(this).prop('id');
                    getMoreDetails(id);
                    id_prod = id;
                });

                $(".delete_prod").click(function () {
                    var id = $(this).prop('id');
                    // alert(id);
                    deleteProdutoFil(id);
                });

                $(".td_fotos_prod").click(function () {
                    var id = $(this).prop('id');
                    getFotosProd(id);
                });
            },
            error: function () {
                location.reload();
            }
        });
    }

    function getSubcategorias() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getSubcategorias'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                if (msg !== "") {
                    $("#btn_subcategoria").html(msg);

                    $(".btns_subcats").click(function () {
                        var id = $(this).prop('id');
                        var subcategoria = $(this).html();
                        $(".modal-title").html("Subcategoria: " + subcategoria);
                        $("#select_tag_subcategoria").html(subcategoria);
                        btns_subcats.fadeOut(100);
                        lista_produtos.fadeIn(1000);
                        subcategoria_temp = id;
                        getProdutos(id);
                        getCategoriaSubcatEspec(id);
                    });
                } else {
                    $("#btn_subcategoria").html("Você ainda não escolheu suas subcategorias<br>\n\
                                            <button id='choose_cat'>Escolher categorias</button>");
                    $("#choose_cat").click(function () {
                        window.location = "processoDeCadastramento.php";
                    });
                }


            },
            error: function () {
                location.reload();
            }
        });
    }

    function getCategoriaSubcatEspec(id) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getCategoriaSubcatEspec', subcategoria: id},
            beforeSend: function () {
                //alert("c");
                $("#loading").show();
            },
            success: function (msg) {
                //alert(msg);
                var json = JSON.parse(msg);
                var cat = json['cd_cat'];
                // alert(cat);
            },
            error: function () {
                alert("erro");
                location.reload();
            }
        });
    }

    function getCategoriaSubcatEspecFil(id, cnpj) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getCategoriaSubcatEspecFil', subcategoria: id, cnpj_fil: cnpj},
            beforeSend: function () {
                //alert("c");
                $("#loading").show();
            },
            success: function (msg) {
                //alert(msg);
                var json = JSON.parse(msg);
                var cat = json['cd_cat'];
                // alert(cat);
            },
            error: function () {
                alert("erro");
                location.reload();
            }
        });
    }

    function getMoreDetails(idproduto) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getMoreDetails', id_produto: idproduto},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                var json = JSON.parse(msg);
                var promo = json['if_promo'];
                var s = 's';
                $("#loading").hide();
                $("#nome_prod_more_details").val(json['nome_produto']);
                $("#marca_prod_more_details").val(json['marca_produto']);
                $("#preco_produto_more_details").val(json['preco']);

                if (promo === s)
                {
                    $("#if_promo_more_details").val('s');
                    $("#form_preco_promo_more_details").fadeIn(100);
                    $("#preco_em_promo_more_details").fadeIn(100);
                } else
                {
                    $("#if_promo_more_details").val('n');
                }

                $("#descricao_prod_more_details").val(json['desc']);
                $("#id_prod_more_details").val(json['id_produto']);

                var path = "http://192.168.1.50:8080/WebUsing/img/produtos/";

                //$("#foto_1_more_details").attr("src",path+json['foto_1']);
                var length_fotos = 0;

                if (json['foto_1'] !== null) {

                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_1'] + "'>");
                } else {

                }
                if (json['foto_2'] !== null) {

                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_2'] + "'>");
                } else {

                }
                if (json['foto_3'] !== null) {
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_3'] + "'>");
                } else {

                }
                if (json['foto_4'] !== null) {
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_4'] + "'>");
                } else {

                }
                if (json['foto_5'] !== null) {
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_5'] + "'>");
                } else {

                }

                $("#add_foto_produto").click(function () {

                    return false;
                });


                /*var foto_1 = document.getElementById('foto_1_more_details');
                 var newFoto1 = new Image;
                 newFoto1.onload = function(){
                 foto_1 = this.src;
                 }
                 newFoto1.src = path + json['foto_1'];*/
            },
            error: function () {
                location.reload();
            }
        });
    }

    function enviaProduto() {
        var nome_produto = $("#nome_produto").val();
        var preco_produto = $("#preco_produto").val();
        var marca_prod = $("#marca_prod").val();
        var descricao_prod = $("#descricao_prod");

        if (nome_produto !== "" && preco_produto !== "" && marca_prod !== "" && descricao_prod !== "")
        {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: "./php/upload_php.php",
                beforeSend: function () {
                    $("#message_modal").html("Adicionando produto...");
                    $("#myMessage_modal").modal('show');
                },
                data: {nome_produto: nome_produto, preco_produto: preco_produto, marca_prod: marca_prod,
                    descricao_prod: descricao_prod, funct: 'enviaProduto'},
                success: function (msg) {
                    checkSubcats();

                    $(".auto").val("");
                    $("#message_modal").html(msg);
                    $("#myMessage_modal").modal('show');
                },
                error: function () {
                    $("#message").html("Não carregou");
                }
            });
        } else
        {
            $("#message_modal").html("Você deixou de preencher alguns campos.");
            $("#myMessage_modal").modal('show');
        }
    }

    function deleteProduto(id) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'deleteProduto', id_produto: id},
            beforeSend: function () {
                $("#message_modal").html("Deletando...");
                $("#myMessage_modal").modal('show');
            },
            success: function (msg) {
                $("#message_modal").html(msg);
                $("#myMessage_modal").modal('show');
                $("#produtos_atual").html("");
                getProdutos(subcategoria_temp);

            },
            error: function () {
                location.reload();
            }
        });
    }

    function deleteProdutoFil(id) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'deleteProduto', id_produto: id},
            beforeSend: function () {
                $("#message_modal").html("Deletando...");
                $("#myMessage_modal").modal('show');
            },
            success: function (msg) {
                $("#message_modal").html(msg);
                $("#myMessage_modal").modal('show');
                $("#produtos_atual_fil").html("");
                getProdutosFil(subcategoria_temp, cnpj_fil_temp);

            },
            error: function () {
                location.reload();
            }
        });
    }

    function getFotosProd(id) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getFotosProd', id_produto: id},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {

                var json = JSON.parse(msg);
                var path = "http://192.168.1.50:8080/WebUsing/img/produtos/";

                //$("#foto_1_more_details").attr("src",path+json['foto_1']);
                var length_fotos = 0;

                if (json['foto_1'] !== null) {
                    $("#alterImg_1").hide();
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_1'] + "'>");
                } else {

                }
                if (json['foto_2'] !== null) {
                    $("#alterImg_2").hide();
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_2'] + "'>");
                } else {

                }
                if (json['foto_3'] !== null) {
                    $("#alterImg_3").hide();
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_3'] + "'>");
                } else {

                }
                if (json['foto_4'] !== null) {
                    $("#alterImg_4").hide();
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_4'] + "'>");
                } else {

                }
                if (json['foto_5'] !== null) {
                    $("#alterImg_5").hide();
                    $("#fotos_produtos_more_details")
                            .append("<img class='foto_prod_more_details' style='width: 150px; height: 150px;position: relative;' src='" + path + json['foto_5'] + "'>");
                } else {

                }


                $("#alterImg").on("hidden.bs.modal", function () {
                    $("#fotos_produtos_more_details").empty();
                });
            },
            error: function () {
                location.reload();
            }
        });
    }
    /* **************************** */





    /* ****** JUMBOTRON FILIAL ****** */
    var jumbotron_filial = $("#jumbotron_filial");

    jumbotron_filial.click(function () {
        linha.hide();

        checkPlanAndGetFil();
    });

    jumbotron_filial.mouseenter(function () {
        jumbotron_filial.css({"color": "blue", "font-size": "200%"});
    });

    jumbotron_filial.mouseleave(function () {
        jumbotron_filial.css({"color": "#333", "font-size": "150%"});
    });

    $input.addEventListener('change', function () {
        $("#fileName").html(this.files.item(0).name);
    });

    $("#input_prodFil_1").change(function () {
        $("#label_prodFil_1").html(this.files.item(0).name);
    });

    btn_voltar.click(function () {
        lista_produtos.fadeOut(500);
        btns_subcats.fadeIn(3000);
    });
    /* **************************** */


    /* ****** FUNCTIONS FILIAIS ******** */

    $("#jumbotron_produtos_fil").click(function () {
        //alert(cnpj_fil_temp);
        $("#linha_fil").hide();
        getSubcategoriasForFil(cnpj_fil_temp);
    });

    $("#jumbotron_seus_dados_fil").click(function () {
        getMyDataFil();
        $("#linha_fil").hide();
        $("#form_myData_fil").fadeIn(500);

    });


    function getFiliais() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/FiliaisControl.php',
            data: {funct: 'getFiliais'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {

                if (msg !== "")
                {
                    $("#infoDiv").html(msg);


                    $(".fil_card").click(function () {
                        $("#infoDiv").html("");
                        $(".navbar-brand").html($(this).prop('id'));
                        cnpj_fil_temp = $(this).prop('id');
                        $("#linha_fil").fadeIn(500);
                        btns_subcats.hide();
                        setCNPJ($(this).prop('id'));
                        // getSubcategoriasForFil($(this).prop('id'));
                        // lista_produtos.fadeOut(500);
                        //$("#showFiliais").fadeOut(500);
                        //$("#form_fil").fadeOut(500);
                        // $("#loading").fadeOut(500);
                        //linha.fadeIn(500);
                        //$("#form_myData").fadeOut(500);
                    });

                } else
                {
                    $("#showFiliais").fadeIn(500).html("Você não possui nenhuma filial.<br>\n\
                                        <button class='btn btn-default' id='btn_nova_filial'>Nova filial</button>");
                    $("#btn_nova_filial").click(function () {
                        checkPlanAndGetFil();
                    });
                }
            },
            error: function () {
                location.reload();
            }
        });
    }
    function setCNPJ(cnpj) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/checkMySubcats.php',
            data: {funct: 'setCNPJ', cnpj_fil: cnpj},
            beforeSend: function () {
            },
            success: function (msg) {
            },
            error: function () {
            }
        });
    }

    function getSubcategoriasForFil(cnpj) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/ProdutosControl.php",
            data: {funct: 'getSubcategoriasForFil', cnpj_fil: cnpj},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {

                // alert(msg);
                var retorno = msg;
                $("#loading").hide();
                //alert(msg);


                if (retorno.length) {
                    $("#infoDiv").html("");
                    $("#infoDiv").html(msg);

                    $(".btns_subcats_fil").click(function () {
                        var id = $(this).prop('id');
                        var subcategoria = $(this).html();
                        $(".modal-title").html("Subcategoria: " + subcategoria);
                        $("#select_tag_subcategoria").html(subcategoria);
                        // btns_subcats.fadeOut(100);
                        $("#infoDiv").hide();
                        $("#lista_produtos_fil").fadeIn(1000);
                        subcategoria_temp = id;

                        getProdutosFil(id, cnpj);
                        getCategoriaSubcatEspecFil(id, cnpj);
                    });
                } else {

                    //  $("#message_modal").html(retorno);
                    //$("#myMessage_modal").modal('show');

                    $("#infoDiv").html("Você ainda não escolheu suas subcategorias<br>\n\
                                            <button id='choose_cat'>Escolher categorias</button>");
                    $("#choose_cat").click(function () {
                        window.location = "processoDeCadastramento.php";
                    });
                }


            },
            error: function () {
                location.reload();
            }
        });
    }

    function checkPlanAndGetFil() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/FiliaisControl.php',
            data: {funct: 'checkPlanUserAndGetFil'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();

                if (msg > 0)
                {
                    $("#showFiliais").fadeOut(500);
                    checkQtdFil(msg);
                    //$("#form_fil").fadeIn(500);
                    getFiliais();
                } else
                {
                    $("#message_modal").html("Seu plano atual é de " + msg + " filiais.");
                    $("#myMessage_modal").modal('show');
                    //alert("Seu plano atual é de " + msg + " filiais.");
                    $("#showFiliais").fadeIn(300);
                    $("#showFiliais").append("<button class='btn btn-success' id='btn_getfil'>Alterar Plano</button>");
                    $("#btn_getfil").click(function () {
                        window.location = "processoDeCadastramento.php";
                    });
                }
            },
            error: function () {
                location.reload();
            }
        });
    }

    function checkQtdFil(planUser) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: './php/FiliaisControl.php',
            data: {funct: 'checkQtdFil'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                if (msg < planUser) {
                    $("#form_fil").fadeIn(500);
                } else {
                    $("#infoDiv").fadeIn(400);
                    $("#infoDiv").empty();
                    $("#infoDiv").append("<p style='text-align: center'>Você atingiu o limite máximo de filiais.</p>");
                }
            },
            error: function () {
                location.reload();
            }
        });
    }
    /* ******************************* */

    /* ***** JUMBOTRON FILIAL **** */
    jumbotron_seus_dados.click(function () {
        linha.hide();
        $("#form_myData").fadeIn(1000);
        getMyData();
        
    });

    $("#btn_saveChange_myData").click(function () {

        $("#fileNameToUpload").val(foto_logo);
        $("#iconNameToUpload").val(foto_icone);

        $("form[name='form_myData']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "./php/SeusDadosControl.php",
                type: "POST",
                data: formData,
                async: false,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (msg) {
                    $("#loading").hide();
                    $("#message_modal").html(msg);
                    $("#myMessage_modal").modal('show');
                    getMyData();
                },
                cache: false,
                contentType: false,
                processData: false
            });
            e.preventDefault();
            return false;
        });
    });

    $("#input_logo").change(function () {
        $("#loading").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            $('#logo_cliente').attr('src', './../img/empty_image.png');
            $("#loading").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
        } else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

    function imageIsLoaded(e) {
        $("#input_logo").css("color", "green");
        $('#logo_cliente').css("display", "block");
        $('#logo_cliente').attr('src', e.target.result);
        $('#logo_cliente').attr('width', '250px');
        $('#logo_cliente').attr('height', '230px');
    }
    ;

    $("#btn_saveChange_myData_fil").click(function () {

        $("#fileNameToUploadFil").val(foto_logo_fil);
        $("#iconNameToUploadFil").val(foto_icone_fil);

        $("form[name='form_myData']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "./php/SeusDadosControl.php",
                type: "POST",
                data: formData,
                async: false,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (msg) {
                    $("#loading").hide();
                    $("#message_modal").html(msg);
                    $("#myMessage_modal").modal('show');
                    getMyDataFil();


                },
                cache: false,
                contentType: false,
                processData: false
            });
            e.preventDefault();
            return false;
        });
    });
    /* ***** FUNCTIONS SEUS DADOS ***** */
    function save_endereco() {

        var rua = $("#input_alterar_rua").val(json['nome_rua']);

        /*input_alterar_numero:$("#input_alterar_numero").val(json['numero_local']),
         input_alterar_bairro:$("#input_alterar_bairro").val(json['nm_bairro']),
         input_alterar_cidade:$("#input_alterar_cidade").val(json['cidade']),
         input_alterar_cep:$("#input_alterar_cep").val(json['cep'])*/

        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/SeusDadosControl.php",
            data: {funct: 'getEnderecoForInput'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                $("#message_modal").html(msg);
                $("#myMessage_modal").modal('show');

            },
            error: function () {
                alert("erro");
            }
        });
        return false;

    }

    function getEnderecoForInput() {

        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/SeusDadosControl.php",
            data: {funct: 'getEnderecoForInput'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                var json = JSON.parse(msg);

                $("#input_alterar_rua").val(json['nome_rua']);
                $("#input_alterar_numero").val(json['numero_local']);
                $("#input_alterar_bairro").val(json['nm_bairro']);
                $("#input_alterar_cidade").val(json['cidade']);
                $("#input_alterar_cep").val(json['cep']);
            },
            error: function () {
                location.reload();
            }
        });

    }

    function getMyData() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/SeusDadosControl.php",
            data: {funct: 'getMyData'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
           
                var json = JSON.parse(msg);

                $("#nm_fantasia_myData").val(json['nm_fantasia']);
                //$("#endereco_myData").html(json['nome_rua'] + ", " + json['numero_local'] + " - " + json['nm_bairro'] + ", " + json['cidade'] +
                //         " - " + json['cep']);
                $("#email_myData").val(json['nm_email']);

                $("#input_alterar_rua").val(json['nome_rua']);
                $("#input_alterar_numero").val(json['numero_local']);
                $("#input_alterar_bairro").val(json['nm_bairro']);
                $("#input_alterar_cidade").val(json['cidade']);
                $("#input_alterar_cep").val(json['cep']);

                $("#expediente_myData").val(json['expediente']);

                var path = "http://localhost:8080/WebUsing/img/loja_logo/"+cnpj.replace("/", "")+"/";
                if (json['logo_cliente'] !== "" && json['logo_cliente'] !== null) {
                    $("#logo_cliente").prop('src', path + json['logo_cliente']);
                    
                } else {
                    $("#logo_cliente").prop('src', "./img/empty_image.png");
                }

                var pathIcon = "http://localhost:8080/WebUsing/img/loja_icon/"+cnpj.replace("/","")+"/";

                if (json['icon'] !== "" && json['icon'] !== null) {
                    $("#icon_cliente").prop('src', pathIcon + json['icon']);
                    alert(pathIcon + json['icon']);
                    
                } else {
                    $("#icon_cliente").prop('src', "./img/empty_image.png");
                }
            },
            error: function () {
                location.reload();
            }
        });
    }

    function getMyDataFil() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/SeusDadosControl.php",
            data: {funct: 'getMyDataFil'},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                var json = JSON.parse(msg);

                $("#nm_fantasia_myData_fil").val(json['nm_fantasia']);
                //$("#endereco_myData").html(json['nome_rua'] + ", " + json['numero_local'] + " - " + json['nm_bairro'] + ", " + json['cidade'] +
                //         " - " + json['cep']);
                //$("#email_myData").val(json['nm_email']);

                $("#input_alterar_rua_fil").val(json['nome_rua']);
                $("#input_alterar_numero_fil").val(json['numero_local']);
                $("#input_alterar_bairro_fil").val(json['nm_bairro']);
                $("#input_alterar_cidade_fil").val(json['cidade']);
                $("#input_alterar_cep_fil").val(json['cep']);

                $("#expediente_myData_fil").val(json['expediente']);

                var path = "http://localhost:8080/WebUsing/img/loja_logo/" + cnpj;
                if (json['logo_cliente'] !== "" && json['logo_cliente'] !== null) {
                    $("#logo_fil").prop('src', path + json['logo_cliente']);
                } else {
                    $("#logo_fil").prop('src', "./img/empty_image.png");
                }

                var pathIcon = "http://localhost:8080/WebUsing/img/loja_icon/"+cnpj;

                if (json['icon'] !== "" && json['icon'] !== null) {
                    $("#icon_fil").prop('src', pathIcon + json['icon']);
                } else {
                    $("#icon_fil").prop('src', "./img/empty_image.png");
                }
            },
            error: function () {
                location.reload();
            }
        });
    }

    function sendMyData() {
        var nm_fantasia = $("#nm_fantasia_myData").val();
        var email = $("#email_myData").val();
        var expediente = $("#expediente_myData").val();

        // alert(nm_fantasia);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "./php/SeusDadosControl.php",
            data: {funct: 'sendMyData', nm_fantasia: nm_fantasia, email: email, expediente: expediente,
                logo: foto_logo, icone: foto_icone},
            beforeSend: function () {
                $("#loading").show();
            },
            success: function (msg) {
                $("#loading").hide();
                $("#message_modal").html(msg);
                $("#myMessage_modal").modal('show');
            },
            error: function () {
                location.reload();
            }
        });
    }

});

