<?php

session_start();
//Al clicar en cerrar sesion elimino las variables de sesion acceso para que la pagina pida iniciar sesion o registrarse nuevamente
    unset($_SESSION['acceso']);
    unset($_SESSION['nombre']);
    header("Location: Catalogo.php");
?>

