<?php
   session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }

    //conexion a base de datos
require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();

//traemos los datos 
require_once 'funciones/listar_proyectos.php'; 
$ListadoProyectos = Listar_Proyectos($MiConexion);
$CantidadProyectos = count($ListadoProyectos);

//mensaje si la tabla no tiene datos
global $p_mensaje;
global $p_estilo;
if (empty($ListadoProyectos)) {
    $p_mensaje = 'No hay datos de proyectos registrados';
    $p_estilo = 'warning';
}


    ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'partes/head.php';
    ?>

<body>
    <div class="wrapper">
        <?php require_once 'partes/lateral.php'; ?>
<               <div class="main">

           <?php require_once 'partes/cabecera.php'; ?> 
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Proyectos</strong> Listado general.  </h1>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">

                            <!-- mensaje -->
                            <div class="card-header">
                                    <h4 class="text-info">Visualizando 5 registros</h4>
                                    <?php if (!empty($p_mensaje)) { ?>
                                    <h4 class="text-<?php echo $p_estilo; ?>"><?php echo $p_mensaje; ?></h4>
                                    <?php } ?>
                            </div>

                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Denominación</th>
                                            <th  class="d-none d-md-table-cell" >Fecha Carga</th>
                                            <th  class="d-none d-md-table-cell" >Empresa</th>
                                            <th>Estado</th>
                                            <th class="d-none d-md-table-cell">Lider</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //recorremos el array para mostrar los datos
                                        $renglon = 0;
                                        for($i=0; $i<$CantidadProyectos; $i++){
                                            $renglon ++;
                                            if($i < 5){
                                        ?>
                                         <tr>
                                            <td> <?php echo $renglon; ?></td>
                                            <td><?php echo $ListadoProyectos[$i]['DENOMINACION']; ?></td>
                                            <td><?php echo $ListadoProyectos[$i]['FECHA']; ?></td>
                                            <td><img src="<?php echo $ListadoProyectos[$i]['BANDERA']; ?>" width="36" height="36" class="rounded-circle me-2" >    
                                            <?php echo $ListadoProyectos[$i]['EMPRESA']; ?></td>
                                            
                                            <td><span class="badge bg-<?php echo Dar_Color($ListadoProyectos[$i]['IDESTADO'])?>"><?php echo $ListadoProyectos[$i]['ESTADO']; ?></span></td>
                                            <td class="d-none d-md-table-cell">
                                                <img src="<?php echo $ListadoProyectos[$i]['IMG']; ?>" width="36" height="36" class="rounded-circle me-2" >    
                                                <?php echo $ListadoProyectos[$i]['NOMBRE'] . " ". $ListadoProyectos[$i]['APELLIDO']; ?>
                                            </td>
                                        <!--  -------------------------------------------  -->
                                          
                                            <td><!-- Boton de editar el proyecto usamos la variable session para verificar que sea administrador -->
                                                <a class="btn btn-primary btn-sm success"
                                                href="editar_proyecto.php?ID_proyecto=<?php echo $ListadoProyectos[$i]['ID']; ?>"
                                                role="button" title="Editar proyecto"><span data-feather="edit"></span> Editar</a>
                                                <!--  -------------------------------------------  -->
                                                
                                                <!-- Boton de cancelar el proyecto usamos la variable session para verificar que sea administrador -->
                                                <a class="btn btn-warning btn-sm"
                                                <?php if($_SESSION['Usuario_Rol'] == 1){ ?>
                                                    onclick= "if (confirm('Esta seguro de cancelar?')) {return true; } else {return false;}"
                                                    href="cambiar_estado.php?ID_estado=<?php echo $ListadoProyectos[$i]['ID']; ?>" 
                                                <?php }else{ ?>
                                                    onclick="alert('No tiene permisos para cancelar.'); "
                                                <?php } ?>
                                                    role="button" title="Cancelar proyecto"><span data-feather="alert-triangle"></span> Cancelar
                                                </a> 
                                                <!-- --------------------------------------------  -->
                                            </td>
                                        </tr>

                                        <?php 
                                            } 
                                        } 
                                        ?>
                                                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>


<?php 
require_once 'partes/pie.php';
?>

<?php 
require_once 'partes/estilos.php';
?>


</body>

</html>