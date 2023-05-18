<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['btnlimpar'])) {
        session_destroy();
        session_start();
        header("Location:cad_alt/cad_alt_venda.php");
    } elseif (isset($_POST['btnfinalizar'])) {
       
        header('Location:finalizar_venda.php');
    } else {
        //os dados do post vão ser recarregados no formulário abaixo para que possam ser retransmitidos
        echo '<form id="formularioRetransmissao" action="cad_alt/cad_alt_venda.php" method="post">';
        foreach ($_POST as $chave => $valor) {
            echo '<input type="hidden" name="' . htmlspecialchars($chave) . '" value="' . htmlspecialchars($valor) . '">';
        }
        echo '</form>';
        echo '<script>document.getElementById("formularioRetransmissao").submit();</script>';
    }
    exit();
}
?>