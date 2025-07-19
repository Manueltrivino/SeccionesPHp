<?php
// seccionamos para verificar que el usuario este logueado y sea administrador
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) || $_SESSION['Usuario_Rol'] != 1) {
        header('Location: cerrarsesion.php');
        exit;
    }

    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
    require_once 'funciones/listar_pais.php';
    $ListadoPais = Listar_Pais($MiConexion);
    $CantidadPais = count($ListadoPais);

    //mensaje si la tabla esta vacia
    global $pais_mensaje;
    global $pais_estilo;
if (empty($ListadoPais)) {
    $pais_mensaje = 'No hay datos de paises registrados';
    $pais_estilo = 'warning';
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
                    <div class="main">
                        <?php require_once 'partes/cabecera.php'; ?> 

            
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Paises con que trabajamos.</strong> Listado general. </h1>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h4 class="text-info">Visualizando 4 registros</h4>
                                    <hr />
                                    <!-- mensaje -->
                                    <?php if (!empty($pais_mensaje)) { ?>
                                    <h4 class="text-<?php echo $pais_estilo; ?>"><?php echo $pais_mensaje; ?></h4>
                                    <?php } ?>
                                </div>

                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Denominación</th>
                                            <th class="d-none d-md-table-cell">Pais</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // recorremos el array para mostrar la tabla
                                            for($i=0; $i < $CantidadPais; $i++){
                                                if($i < 4){
                                        ?>
                                            <tr>
                                                <td><?php echo $ListadoPais[$i]['ID']; ?></td>
                                                <td><?php echo $ListadoPais[$i]['DENOMINACION']; ?></td>
                                                <td>
                                                    <img src="<?php echo $ListadoPais[$i]['IMG']; ?>" width="36" height="36" class="rounded-circle me-2" alt="<?php $ListadoPais[$i]['IMG']; ?>">
                                                </td>
                                            <!-- ------------------------------ -->
                                            
                                                <td>
                                                    <a class="btn btn-primary btn-sm success" href="#"><span data-feather="edit"></span> Editar</a>
                                                    
                                                <!-- Boton de editar el proyecto usamos la variable session para verificar que sea administrador

                                                <a class="btn btn-primary btn-sm success"
                                                <?php //if($_SESSION['Usuario_Rol'] == 1){ ?> 
                                                href="editar_pais.php?ID_pais=<?php //echo $ListadoPais[$i]['ID']; ?>"
                                                <?php// }else{ ?>
                                                    onclick="alert('No tiene permisos para editar.'); return false;"
                                                <?php //} ?>
                                                role="button" title="Editar proyecto"><span data-feather="edit"></span> Editar</a>
                                                  -------------------------------------------  -->

                                                  <!-- boton borrar pais -->
                                                    <a class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Esta seguro de ELIMINAR el pais?')) {return true; } else {return false;}"
                                                            href="eliminar_pais.php?ID_PA=<?php echo $ListadoPais[$i]['ID']; ?>"
                                                            role="button" title="Borrar registro"><span data-feather="delete"></span> Borrar
                                                    </a>
                                                    <!--  ------------------------------------- -->
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