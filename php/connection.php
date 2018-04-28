<?php
//header("Content-type: text/html; charset=utf-8");
$servername = "192.168.1.106:3306";
$username = "mypc";
$senha = "gabrieldopc";
$db = "using_26jul(1)";

try {
	$conn = new PDO("sqlsrv:Server=localhost\SQLEXPRESS;Database=_using", "sa", "sparda");
	// define o modo dos erros PDO para excessão
	//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connection successfuly";	


} catch (PDOException $e) {

	echo "Connection failed: " . $e->getMessage();
}
//$conn = null;

?>