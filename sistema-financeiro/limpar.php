<?php
session_start();
session_destroy();
echo "Sessão limpa! <a href='index.php'>Voltar</a>";
?>