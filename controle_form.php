<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['btnlimpar'])) {
        foreach ($_SESSION['itens_venda'] as $key => &$item) {
            unset($_SESSION['itens_venda'][$key]);
        }
        header('Location:logout.php');
    } elseif (isset($_POST['btnfinalizar'])) {
        foreach ($_SESSION['itens_venda'] as $key => &$item) {
            unset($_SESSION['itens_venda'][$key]);
        }
        header('Location:finalizar_venda.php');
    } else {
        
        echo '<form id="retransmissionForm" action="cad_alt/cad_alt_venda.php" method="post">';
        foreach ($_POST as $chave => $valor) {
            echo '<input type="hidden" name="' . htmlspecialchars($chave) . '" value="' . htmlspecialchars($valor) . '">';
        }
        echo '</form>';
        echo '<script>document.getElementById("retransmissionForm").submit();</script>';
        $urlDestino = 'cad_alt/cad_alt_venda.php?' . http_build_query($_POST);
        //header('Location:' . $urlDestino);
    }
    //exit();
}
?>