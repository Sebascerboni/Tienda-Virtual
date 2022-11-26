<?php
    session_start();    
    #Creacion de la sesion
    if (isset($_POST["input_usuario"]) && isset($_POST["input_clave"]) ){
        $_SESSION["session_usuario"]=$_POST["input_usuario"];
        $_SESSION["session_clave"]=$_POST["input_clave"];
        if(isset($_POST["chk_autofill"])){
            $_SESSION["session_pref"]=$_POST["chk_autofill"];
        }            
    }
    
    $idioma="";
    #Control de que haya iniciado sesion previo a ingresar a la página
    if (!isset($_SESSION["session_usuario"]) && !isset($_SESSION["session_clave"])){
        header("Location: login.php");
        die; #Una vez que el control se ejecuta, usamos die para evitar que php procese lo demás
    }
    
    #Creacion de cookies si el usuario decidió elegir el Recordar[X]
    if(isset($_POST["chk_autofill"])){
        if(!isset($_COOKIE["cookie_language"])){
            setcookie("cookie_user",$_POST["input_usuario"], (time()+(60*60*24)));
            setcookie("cookie_clave",$_POST["input_clave"], (time()+(60*60*24)));
            setcookie("cookie_pref",$_POST["chk_autofill"], (time()+(60*60*24)));
            setcookie("cookie_language","es",(time()+60*60*24));
            $idioma="es";
        }            
    }else{
        if(!isset($_COOKIE["cookie_language"])){
            setcookie("cookie_language","es",(time()+60*60*24));
            $idioma="es";    
        }
    }

    #Validación de idioma si existe la cookie guardada
    if(isset($_COOKIE["cookie_language"])){
        $idioma = $_COOKIE["cookie_language"];
    }

    #Reasiganacion del lenguaje cuando se elige las opciones
    if(isset($_GET["language"])){
        if($_GET["language"] == 2){
            setcookie("cookie_language","en",(time()+60*60*24));
            $idioma = "en";
        }
        if($_GET["language"] == 1){
            setcookie("cookie_language","es",(time()+60*60*24));
            $idioma = "es";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>PANEL PRINCIPAL</h1>
        <h3>Bienvenido Usuario: <?php echo $_SESSION["session_usuario"]?></h2>
        <a href="panel_principal.php?language=1">ES (Español)</a> | <a href="panel_principal.php?language=2">EN (English)</a></br>
        <a href="close_session.php?borrar=<?php echo (isset($_SESSION["session_pref"]))? 1 : 2 ?>">Cerrar Sesion</a>
        <h2>Product List</h2>
        <?php
            #Impresion de productos de la tienda cuando el lenguaje es ESPAÑOL
            
            $open_file=null;
            if($idioma=="es"){
                $open_file= fopen("categorias_es.txt","r");
            }else{
            #Impresion de productos de la tienda cuando el lenguaje es INGLES
                $open_file= fopen("categorias_en.txt","r");
            }
            
            while(!feof($open_file)){
                $line = fgets($open_file);
                echo $line . "</br>";
            }
            fclose($open_file); 
        ?>
    </body>
</html>