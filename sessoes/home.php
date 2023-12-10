<?php 

session_start();

if ($_SESSION != NULL) {
    echo "Usuário: ". $_SESSION['user'];
} else {
    echo "Sessão não disponível";
}