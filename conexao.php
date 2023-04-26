<?php
$banco = "loja";
$usuario = "root";
$senha = "";
$servidor = "localhost";
$con = Mysqli_connect($servidor,$usuario,$senha,$banco);
if(!$con){
    echo "Não foi possível conectar";
}
else{
}
?>