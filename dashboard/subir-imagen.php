<?php 

$errores = "";

/* if($_FILES['imagen']['type'] !== 'image/png'){
    $errores .= "- La imagen debe ser de la extensión PNG.";
}
 */
if($_FILES['imagen']['size'] >= 2097152){ // 2MB
    $errores .= "- La imagen debe ser de la extensión PNG.";
}

if(empty($errores)){
    $path = "./". $_FILES['imagen']['name']; 

    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
        echo "El archivo ".  $_FILES['imagen']['tmp_name']. " ha sido subido";
    } else{
        echo "El archivo no se ha subido correctamente";
    }
}else{
    echo $errores;
}
