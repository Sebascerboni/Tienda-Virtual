<?php
    session_start();
    # Control de acceso con sesiones previamente creadas
    if (!isset($_SESSION["session_usuario"]) && !isset($_SESSION["session_clave"])){
        header("Location: login.php");
        die; #Una vez que el control se ejecuta, usamos die para evitar que php procese lo demás
    }
    #Una vez realizado el contro matamos la sesion
    session_destroy();
    #Borrar cookies
    if(isset($_GET["borrar"])){ //Si el usuario decidio guardar las preferencias
        if($_GET["borrar"] == 2){
            setcookie("cookie_user","");
            setcookie("cookie_clave","");
            setcookie("cookie_language","");
            setcookie("cookie_pref", "");
        }
    }
    header("Location: login.php");
?>