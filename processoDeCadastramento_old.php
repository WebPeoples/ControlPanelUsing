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
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox] {
            display:none;
        }
        input[type=checkbox] + label
        {
            background: url("img/subcategorias/subcategoria_alime_mercados_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked + label
        {
            background: url("img/subcategorias/subcategoria_alime_mercados_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA RESTAURANTE */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#restau {
            display:none;
        }
        input[type=checkbox]#restau + label
        {
            background: url("img/subcategorias/subcategoria_alime_restau_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#restau + label
        {
            background: url("img/subcategorias/subcategoria_alime_restau_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA PIZZARIA */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#pizzarias {
            display:none;
        }
        input[type=checkbox]#pizzarias + label
        {
            background: url("img/subcategorias/subcategoria_alime_pizza_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#pizzarias + label
        {
            background: url("img/subcategorias/subcategoria_alime_pizza_check.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA FAST FOOD */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#fastfood {
            display:none;
        }
        input[type=checkbox]#fastfood + label
        {
            background: url("img/subcategorias/subcategoria_alime_fastfood_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#fastfood + label
        {
            background: url("img/subcategorias/subcategoria_alime_fastfood_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA DELIVERY */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#delivery {
            display:none;
        }
        input[type=checkbox]#delivery + label
        {
            background: url("img/subcategorias/subcategoria_alime_delivery_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#delivery + label
        {
            background: url("img/subcategorias/subcategoria_alime_delivery_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        /* SUBCATEGORIA HORTFRUIT */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#hortfruit {
            display:none;
        }
        input[type=checkbox]#hortfruit + label
        {
            background: url("img/subcategorias/subcategoria_alime_hortfrut_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#hortfruit + label
        {
            background: url("img/subcategorias/subcategoria_alime_hortfrut_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA PANIFICAÇÃO */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#panificacao {
            display:none;
        }
        input[type=checkbox]#panificacao + label
        {
            background: url("img/subcategorias/subcategoria_alime_panifica_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#panificacao + label
        {
            background: url("img/subcategorias/subcategoria_alime_panifica_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        /* SUBCATEGORIA SELF SERVICE */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#selfservice {
            display:none;
        }
        input[type=checkbox]#selfservice + label
        {
            background: url("img/subcategorias/subcategoria_alime_self_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#selfservice + label
        {
            background: url("img/subcategorias/subcategoria_alime_self_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }


        /* VESTUÁRIO */
        /* SUBCATEGORIA ROUPAS*/
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#roupas {
            display:none;
        }
        input[type=checkbox]#roupas + label
        {
            background: url("img/subcategorias/subcategoria_vestu_roupas_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#roupas + label
        {
            background: url("img/subcategorias/subcategoria_vestu_roupas_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        /* SUBCATEGORIA CALÇADOS */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#calcados {
            display:none;
        }
        input[type=checkbox]#calcados + label
        {
            background: url("img/subcategorias/subcategoria_vestu_calc_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#calcados + label
        {
            background: url("img/subcategorias/subcategoria_vestu_calc_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA BIJU */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#biju {
            display:none;
        }
        input[type=checkbox]#biju + label
        {
            background: url("img/subcategorias/subcategoria_vestu_biju_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#biju + label
        {
            background: url("img/subcategorias/subcategoria_vestu_biju_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }

        /* SUBCATEGORIA COSMÉTICOS */
        .btn{
            border-radius: 0%;
            font-style: inherit;
        }
        input[type=checkbox]#comesticos {
            display:none;
        }
        input[type=checkbox]#comesticos + label
        {
            background: url("img/subcategorias/subcategoria_vestu_comestico_not_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
        input[type=checkbox]:checked#comesticos + label
        {
            background: url("img/subcategorias/subcategoria_vestu_comestico_checked.png");
            background-size: 100%;
            height: 160px;
            width: 160px;
            display:inline-block;
            padding: 0 0 0 0px;
        }
    </style>
</head>
<body>
<div id="show_cnpj" style="text-align: center"></div>
<div id="info_process" style="text-align: center"> Escolha duas categorias para poder prosseguir.</div>
<div id="info" style="text-align: center"></div>

<div class="container-fluid">

    <div id="subcat" style="display: none;">

        <H1 style="text-align: center">SUBCATEGORIAS</H1>
        <div class="container-fluid">
                <!-- CATEGORIA ALIMENTOS -->
            <h2 style="text-align: center">Alimentos</h2>
                <input type='checkbox' name='mercados' value='mercad' id="mercados"/><label for="mercados"></label>
                <input type='checkbox' name='restau' value='restau' id="restau"/><label for="restau"></label>
                <input type='checkbox' name='pizzarias' value='pizza' id="pizzarias"/><label for="pizzarias"></label>
                <input type='checkbox' name='fastfood' value='fastf' id="fastfood"/><label for="fastfood"></label>
                <input type='checkbox' name='delivery' value='deliv' id="delivery"/><label for="delivery"></label>
                <input type='checkbox' name='hortfruit' value='hortf' id="hortfruit"/><label for="hortfruit"></label>
                <input type='checkbox' name='panificacao' value='panif' id="panificacao"/><label for="panificacao"></label>
                <input type='checkbox' name='selfservice' value='selfs' id="selfservice"/><label for="selfservice"></label>
                <!-- ==== -->
        </div>
        <div class="container-fluid">
            <!-- CATEGORIA VESTUÁRIO -->
            <h2 style="text-align: center">Vestuário</h2>
            <div style="margin: 0 auto">
                <input type='checkbox' name='roupas' value='roupa' id="roupas"/><label for="roupas"></label>
                <input type='checkbox' name='calcados' value='calca' id="calcados"/><label for="calcados"></label>
                <input type='checkbox' name='biju' value='bijut' id="biju"/><label for="biju"></label>
                <input type='checkbox' name='comesticos' value='comes' id="comesticos"/><label for="comesticos"></label>
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
    <div style="font-size: 35px" id="message"></div>
    <div class="row">
        <div class="col-md-4">
            <button id="btn_prosseguir" style="display: none" class="btn btn-default">Prosseguir</button>
        </div>
        <div class="col-md-4">
            <button id="btn_voltar" style="display: none" class="btn btn-default">Voltar</button>
        </div>
    </div>

    <div id="form-especialidade" class="container">
    </div>

</div>
<div style="font-size: 1000px" id="teste"></div>


<script>

    $(document).ready(function(){
        //Exibindo o cnpj via sessão
        $("#show_cnpj").html("<?php echo $_SESSION['cnpj']; ?>");
        // Desabilitando o botão prosseguir até que o usuário escolha duas subcategorias
        $("#btn_prosseguir").prop("disabled", true);


        //definindo a váriavel gratuito como 0 (desligado)
        var gratuito = 0;

        //instanciando a lista de valores das subcategorias que irão para o banco
        var valuesCheckBox = new Array();
        var checkboxesChecked = new Array();

        //Evento do botão plano gratuito, passando para o próximo passo do cadastro usando o fade's
        $("#btn_plano_gratuito").click(function(){
            $(".jumbotron").fadeOut(500);
            $("#btn_voltar").fadeIn(2000);
            $("#subcat").fadeIn(2000);
            $("#btn_prosseguir").fadeIn(2000);
            gratuito = 1;
        });

        //Evento botão voltar no momento de escolha das subcategorias.
        $("#btn_voltar").click(function () {
            $("#subcat").fadeOut(500);
            $(".jumbotron").fadeIn(1000);
            $(this).css({"display":"none"});
        });

        //método que desabilita as checkboxes quando escolhidas mais de duas subcategorias
        function disableCheckeboxes(checkArray){
            if(gratuito === 1){
                if(checkArray.length === 2){
                //alert(checkArray.length);
                    $("input[type=checkbox]").prop("disabled", true);
                    $("#btn_prosseguir").prop("disabled", false);
                    $("#info").html("Você atingiu o limite máximo de seu plano.");
                }else if (checkArray.length < 2){

                    $("#btn_prosseguir").prop("disabled", true);
                    $("#info").html("");

                }
                for (var i = 2; i < checkArray.length; i++){
                    var id=  "#"+checkArray[i];
                    $(id).prop('checked', false);
                }
            }
        }

        function insertEspecialidadeNoBD(especJson){
            var page = './php/insertEspecialidadesNoDB.php';
            $.ajax({
                type: 'POST',
                dataType:'html',
                url:page,
                beforeSend: function () {

                },
                data: {especJson: especJson},
                success: function (msg) {
                    alert(msg);
                },
                error: function () {

                }
            });
        }

        //Método que envia os valores das checkboxes para o banco de dados
        function insertSubcategorias(jsonList) {
            var page = './php/insertSubcategoriaToDb.php';
            $.ajax({
                type: 'POST',
                dataType:'html',
                url:page,
                beforeSend: function(){
                    $("#message").html("Carregando...");
                },
                data:{jsondata: jsonList},
                success: function(msg){
                    $("#message").html(msg);

                    $("#subcat").fadeOut(1000);
                    $("#btn_prosseguir").fadeOut(1000);
                    $("#btn_voltar").fadeOut(1000);
                    $("#message").fadeOut(1000);
                    $("#info").fadeOut(1000);
                    $("#form-especialidade").fadeIn(2000);
                    $("#info_process").html("Escreva seu carro chefe para cada sucategoria.");

                    var input = new Array();

                    for(var ii = 0; ii < checkboxesChecked.length; ii++){
                        var div = document.createElement("form");
                        div.setAttribute('class', 'form-group');
                        var label = document.createElement("label");
                        label.innerHTML = checkboxesChecked[ii];
                        div.appendChild(label);
                        input.push(document.createElement("input"));
                        input[ii].setAttribute('type','text');
                        input[ii].className = "form-control " + checkboxesChecked[ii];
                        input[ii].id = checkboxesChecked[ii];

                        div.appendChild(label);
                        div.appendChild(input[ii]);

                       document.getElementById('form-especialidade').appendChild(div);
                    }



                        var btn_finalizar = document.createElement("button");
                        btn_finalizar.innerHTML = "Finalizar";
                        btn_finalizar.className = "btn btn-default";
                        btn_finalizar.id = "espec_btn_finalizar";

                        document.getElementById("form-especialidade").appendChild(btn_finalizar);

                        $(btn_finalizar).click(function () {
                            var especList = new Array();
                            for(var x = 0; x < checkboxesChecked.length; x++ ){
                                especList.push($(input[x]).val());
                            }
                        });

                    $(".selfservice").autocomplete({
                        source: "./php/autoCompleteEspec.php",
                        minLength: 1
                    });

                },
                error: function(){
                    $("#message").html("Não carregou");
                }
            });
        }

        //Método que checa quais checkboxes estão habilitadas
        $("input[type=checkbox]").click(function(){
            valuesCheckBox = new Array();
            checkboxesChecked = new Array();

            if (gratuito === 1) {

                if($("#mercados").is(":checked"))
                {

                   if (valuesCheckBox.length >= 2) {
                       // alert("Você atingiu o limite máximo de seu plano.");
                        //$("input[type=checkbox]").prop("disabled", true);
                    }else{
                    checkboxesChecked.push($("#mercados").prop('id'));
                           valuesCheckBox.push($("#mercados").val());
                    }   
                }
                if($("#restau").is(":checked"))
                {
                     if (valuesCheckBox.length >= 2) {
                        //alert("Você atingiu o limite máximo de seu plano.");
                        //$("input[type=checkbox]").prop("disabled", true);
                    }else{
                    checkboxesChecked.push($("#restau").prop('id'));
                            valuesCheckBox.push($("#restau").val());
                    }
                }
                if($("#pizzarias").is(":checked"))
                {
                     if (valuesCheckBox.length >= 2) {
                        //alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                   checkboxesChecked.push($("#pizzarias").prop('id'));
                           valuesCheckBox.push($("#pizzarias").val());
                    }
                }
                if($("#fastfood").is(":checked"))
                {
                     if (valuesCheckBox.length >= 2) {
                        //alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                    checkboxesChecked.push($("#fastfood").prop('id'));
                          valuesCheckBox.push($("#fastfood").val());
                    }

                }
                if($("#delivery").is(":checked"))
                {

                    if (valuesCheckBox.length >= 2) {
                        //alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                     checkboxesChecked.push($("#delivery").prop('id'));
                          valuesCheckBox.push($("#delivery").val());
                    }
                    
                }
                if($("#panificacao").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                       //alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                    checkboxesChecked.push($("#panificacao").prop('id'));
                          valuesCheckBox.push($("#panificacao").val());
                    }
                    
                }
                if($("#selfservice").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                       // alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                   checkboxesChecked.push($("#selfservice").prop('id'));
                          valuesCheckBox.push($("#selfservice").val());
                    }
                }
                if($("#roupas").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                        //alert("Você atingiu o limite máximo de seu plano.");
                       // $("input[type=checkbox]").prop("disabled", true);
                    }else{
                   checkboxesChecked.push($("#roupas").prop('id'));
                         valuesCheckBox.push($("#roupas").val());
                    }
                }
                if($("#calcados").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                       // alert("Você atingiu o limite máximo de seu plano.");
                        // $("#calcados").prop("checked", false);
                    }else{
                    checkboxesChecked.push($("#calcados").prop('id'));
                        valuesCheckBox.push($("#calcados").val());
                    }
                }
                if($("#biju").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                       // alert("Você atingiu o limite máximo de seu plano.");
                       //  $("input[type=checkbox]").prop("disabled", true);
                    }else{
                     checkboxesChecked.push($("#biju").prop('id'));
                        valuesCheckBox.push($("#biju").val());
                    }
                    
                }
                if($("#comesticos").is(":checked"))
                {
                    if (valuesCheckBox.length >= 2) {
                       // alert("Você atingiu o limite máximo de seu plano.");
                       //  $("input[type=checkbox]").prop("disabled", true);
                    }else{
                        alert("");
                    checkboxesChecked.push($("#comesticos").prop('id'));
                        valuesCheckBox.push($("#comesticos").val());
                    }
                }

                disableCheckeboxes(checkboxesChecked);
            }

        });

        //Botão prosseguir que chama o método que insere os valores no banco
        $("#btn_prosseguir").click(function () {
            insertSubcategorias(JSON.stringify(valuesCheckBox));
        });
    });
</script>
</body>
</html>