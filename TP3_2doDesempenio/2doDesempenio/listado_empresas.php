<?php
// seccionamos para verificar que el usuario este logueado
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }

    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
    require_once 'funciones/listar_empresa.php';
    $ListadoEmpresa = Listar_Empresa($MiConexion);
    $CantidadEmpresa = count($ListadoEmpresa);

    //verificamos que la tabla tenga datos
    global $E_mensaje ;
    global $E_estilo ;
if (empty($ListadoEmpresa)) {
    $E_mensaje = 'No hay datos de empresas registradas';
    $E_estilo = 'warning';
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
                    <h1 class="h3 mb-3"><strong>Empresas</strong> Listado general. </h1>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h4 class="text-info">Visualizando 4 registros</h4>
                                    <hr />
                                    <!-- mensaje -->
                                    <?php if (!empty($E_mensaje)) { ?>
                                    <h4 class="text-<?php echo $E_estilo; ?>"><?php echo $E_mensaje; ?></h4>
                                    <?php } ?>
                                </div>

                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Denominación</th>
                                            <th>Fecha de carga</th>
                                            <th>Cargada por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                            //recorremos el array para mostrar los datos
                                                $renglon = 0;
                                                for($i=0; $i < $CantidadEmpresa; $i++){
                                                    if($i < 4){
                                                    $renglon ++;
                                            ?>
                                            <tr>
                                                <td><?php echo $renglon ; ?></td>
                                                <td>
                                                    <img src="<?php echo $ListadoEmpresa[$i]['BANDERA']; ?>" width="36" height="36" class="rounded-circle me-2" alt="<?php $ListadoEmpresa[$i]['BANDERA']; ?>" title="<?php $ListadoEmpresa[$i]['BANDERA']; ?>">
                                                    <?php echo $ListadoEmpresa[$i]['DENOMINACION']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ListadoEmpresa[$i]['FECHA']; ?>
                                                </td>
                                                <td>
                                                    <img src="<?php echo $ListadoEmpresa[$i]['FOTO']; ?>" width="36" height="36" class="rounded-circle me-2" alt="<?php $ListadoEmpresa[$i]['FOTO']; ?>">
                                                    <?php echo $ListadoEmpresa[$i]['NOMBRE']. " ".$ListadoEmpresa[$i]['APELLIDO'] ; ?>
                                                </td>
                                                <!-- ----------------------------- -->

                                                <td>
                                                    <!--  ----------------------- Editar Empresa --------------------------- -->
                                                    <a class="btn btn-primary btn-sm success" 
                                                    <?php if($_SESSION['Usuario_Rol'] == 1){ ?> 
                                                href="editar_empresa.php?ID_empresa=<?php echo $ListadoEmpresa[$i]['ID']; ?>"
                                                <?php }else{ ?>
                                                    onclick="alert('No tiene permisos para editar.');"
                                                <?php } ?>
                                                role="button" title="Editar empresa">
                                                <span data-feather="edit"></span> Editar</a>
                                                <!-- ---------------------------------- -->
                                                    <!-- --------------eliminar empresa------------------------- -->
                                                    <a class="btn btn-danger btn-sm"
                                                        <?php if($_SESSION['Usuario_Rol'] == 1){?>
                                                            onclick="if (confirm('Esta seguro de ELIMINAR la empresa?')) {return true; } else {return false;}"
                                                            href="eliminar_empresa.php?ID_EM=<?php echo $ListadoEmpresa[$i]['ID']; ?>"
                                                        <?php }else{ ?>
                                                            onclick="alert('No tiene permisos para elimar.');"
                                                        <?php } ?>
                                                            role="button" title="Borrar registro"><span data-feather="delete"></span> Borrar
                                                    </a>
                                                    <!-- -------------------------------- -->
                                                </td>

                                            </tr>
                                            <?php 
                                                    } 
                                                } ?>
                                                
                                        
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