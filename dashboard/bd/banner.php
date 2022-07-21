<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
/* print_r($_POST); */
$rutaActual = getcwd();
$rutaActualModificada = $rutaActual.DIRECTORY_SEPARATOR;
 
//sacamos por pantalla la ruta final
#echo $rutaActualModificada;
$errores = "";

/* if($_FILES['imagen']['type'] !== 'image/png'){
    $errores .= "- La imagen debe ser de la extensión PNG.";
}
 */
if($_FILES['imagen']['size'] >= 2097152){ // 2MB
    $errores .= "- La imagen debe ser de la extensión PNG.";
}

if(empty($errores)){
   /*  $path = "./images/". $_FILES['imagen']['name'];  */
   $path = "../../../images/". $_FILES['imagen']['name']; 

    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
      /*   echo "El archivo ".  $_FILES['imagen']['name']. " ha sido subido"; */
    } else{
       /*  echo "El archivo no se ha subido correctamente"; */
    }
}else{
    echo $errores;
}
$img = "https://laboratoriodefibraoptica.com/images/".$_FILES['imagen']['name'] ;

$link = (isset($_POST['link']) ) ? $_POST['link'] : NULL;
$lang = (isset($_POST['lang'])) ? $_POST['lang'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$prioridad = (isset($_POST['prioridad'])) ? $_POST['prioridad'] : 0;

$id = (isset($_POST['id'])) ? $_POST['id'] : '';


        $consulta = "INSERT INTO lab_banner (img, link, lang ,prioridad) VALUES('$img', '$link', '$lang', '$prioridad') ";			
        $resultado = $conexion->prepare($consulta);
       
  
    if( $resultado->execute()){
        echo   header('Location: ../banner.php');

    }
/* print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS */

