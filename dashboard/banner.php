<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    
    
    
 <?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM lab_banner";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                               <th>Prioridad.</th>  

                                <th>Ruta</th>
                                <th>Link</th>                                
                                <th>Idioma</th>  

                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                            <td><?php echo $dat['id'] ?></td>
                            <td><?php echo $dat['prioridad'] ?></td>    

                               
                                <td><?php echo $dat['img'] ?></td>
                                <td><?php echo $dat['link'] ?></td>
                                <td><?php echo $dat['lang'] ?></td>    

                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form  action="bd/banner.php" enctype="multipart/form-data" method="post" >    
            <div class="modal-body">
                <!-- <div class="form-group">
                <label for="img" class="col-form-label">Imagen:</label>
                <input type="text" class="form-control" id="img" value="https://laboratoriodefibraoptica.com/images/">
                </div> -->
                <div class="form-group">
                <label for="formFile" class="form-label">Seleccione la Imagen</label>
                <input class="form-control" type="file"  id="img"  name="imagen">
                </div>

                <div class="form-group text-center">
                <label for="link" class="col-form-label ">Link:</label>
                <input type="text" class="form-control" id="link" name="link">
                </div>                
                <div class="form-group text-center">
                <label for="lang" class="col-form-label">Idioma:</label>
              <!--   <input type="text" class="form-control" id="lang"> -->
                <select class="form-control text-center" aria-label="Default select example" id="lang" name="lang" required>
              <!--   <option disabled selected>IDIOMA</option> -->
                <option value="es">ESPAÑOL</option>
                <option value="en">INGLES</option>
                </select>
                </div> 
                <div class="form-group text-center">
                <label for="prioridad" class="col-form-label">Prioridad:</label>
                <input type="number" class="form-control" id="prioridad" name="prioridad">
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>