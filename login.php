<?php
    #Login de inicio de la apliación. Aquí está el formulario de ingreso
    #Los atributos del formulario son mandados al servidor por post
    #Para el auto llenado de los campos
    $auto_fill = false;
    $usuario="";
    $clave="";

    #Condicional que me ayudará a recolectar informacion de autofill
    if(isset($_COOKIE["cookie_pref"]) && $_COOKIE["cookie_pref"] != ""){
        var_dump($_COOKIE);
        $auto_fill = true;
        $usuario = isset($_COOKIE["cookie_user"]) ? $_COOKIE["cookie_user"] : "";
        $clave = isset($_COOKIE["cookie_clave"]) ? $_COOKIE["cookie_clave"] : "";
    }
?>

<!DOCTYPE html>
<html>
    <head></head>

    <body></body>
    <h1>LOGIN</h1>
    <form action="panel_principal.php" method=POST>
        <fieldset>
            Usuario:</br><input type="text" name="input_usuario" id="input_usuario" value="<?php echo $usuario?>"></br>
            Clave:</br> <input type="password" name="input_clave" id="input_clave" value="<?php echo $clave?>"></br>
            <input type="checkbox" name="chk_autofill" <?php echo ($auto_fill)? "checked" : "" ?>>Recordarme</br>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</html>