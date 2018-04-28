<?php
require "connection.php";
?>

<html>
    <head>
        <title>Autenticando usuario</title>
        <script type="text/javascript">
            function loginsuccessfully() {
                setTimeout("window.location='./painelcontrole.php'", 100);
            }
            function loginfailed() {
                setTimeout("window.location='login.php", 100);
            }
        </script>
    </head>
    <body>
<?php
$CNPJ = $_POST['cnpj'];
$senha = $_POST['senha'];

$sql = "SELECT nr_cpf_cnpj, senha, nm_fantasia FROM _using.cliente WHERE nr_cpf_cnpj ='$CNPJ' and senha='$senha'";

$stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

$stmt->execute();

$row = $stmt->rowCount();
if ($row > 0) {
    session_start();
    $_SESSION['cnpj'] = $CNPJ;
    $_SESSION['cnpj_matriz'] = $CNPJ;

    foreach ($stmt->fetchAll() as $k => $v) {
        $_SESSION['nm_fantasia'] =  $v['nm_fantasia'];
    }
    // $_SESSION['senha']=$_POST['senha'];
    echo "<center> Login efetuado com sucesso! Aguarde um instante.</center>";
    echo "<script> loginsuccessfully();</script>";
} else {
    echo "<center>Número do CNPJ ou senha inválida !</center>";
    echo "<script>loginfailed();</script>";
}
?>
    </body>
</html>