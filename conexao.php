<?php
$banco = "loja";
$usuario = "root";
$senha = "";
$servidor = "localhost";
$con = Mysqli_connect($servidor,$usuario,$senha,$banco);
mysqli_set_charset($con, "utf8mb4");
if(!$con){
    echo "Não foi possível conectar";
}
else{
}
?>