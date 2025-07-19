<?php
    //Seccionamos para que solo las personas logueadas y con rol 1 (Administrador) accedan
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) || $_SESSION['Usuario_Rol'] != 1) {
        header('Location: cerrarsesion.php');
        exit;
    }

require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();

require_once 'funciones/listarUsuario.php';
$ListadoUsuarios = Listar_Usuarios($MiConexion);
$CantidadUsuarios = count($ListadoUsuarios);

//verificamos que la tabla tenga datos
global $U_mensaje;
global $U_estilo;
if (empty($ListadoUsuarios)) {
    $U_mensaje = 'No hay datos de usuarios registrados';
    $U_estilo = 'warning';
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
                    <h1 class="h3 mb-3"><strong>Usuarios</strong> Listado general. </h1>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <!-- mensaje -->
                                    <?php if (!empty($U_mensaje)) { ?>
                                    <h4 class="text-<?php echo $U_estilo; ?>"><?php echo $U_mensaje; ?></h4>
                                    <?php } ?>

                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Apellido y Nombre</th>
                                            <th>Rol</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                            //Recorremos el array de los usuarios para mostrar los usuarios 
                                            $renglon = 0;
                                            for($i=0; $i < $CantidadUsuarios; $i++){ 
                                            $renglon ++;    
                                            ?>
                                                
                                            <tr>
                                                <td><?php echo $renglon ; ?></td>

                                                <td>
                                                    <img src="<?php echo $ListadoUsuarios[$i]['IMG']; ?>" width="36" height="36" class="rounded-circle me-2" alt="<?php $ListadoUsuarios[$i]['IMG']; ?>">
                                                    <?php echo $ListadoUsuarios[$i]['APELLIDO']. " ". $ListadoUsuarios[$i]['NOMBRE']; ?>
                                                </td>

                                               <td>
                                                    <?php echo $ListadoUsuarios[$i]['ROL']; ?> 
                                                </td>

                                                <td>
                                                    <?php echo $ListadoUsuarios[$i]['ALIAS']; ?> 
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm success" href= "#" role="button" title="Editar proyecto">
                                                    <span data-feather="edit"></span> Editar</a>

                                                    <!-- -----------------este es el scrip  del boton de editar usuario -----------------

                                                    <a class="btn btn-primary btn-sm success"
                                                        <?php// if($_SESSION['Usuario_Rol'] == 1){ ?> 
                                                            href= "editar_usuario.php?ID_usuario= <?php // echo $ListadoUsuarios[$i]['ID']; ?>" 
                                                        <?php //}else{ ?>
                                                            onclick="alert('No tiene permisos para editar.'); return false;"
                                                        <?php //} ?>
                                                        role="button" title="Editar proyecto"><span data-feather="edit"></span> Editar</a> -->

                                                        <!-- boton de eliminar usuario -->
                                                    <a class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Esta seguro de ELIMINAR el usuario?')) {return true; } else {return false;}"
                                                            href="eliminar_usuario.php?ID_USER=<?php echo $ListadoUsuarios[$i]['ID']; ?>"
                                                            title="Borrar registro"><span data-feather="delete"></span> Borrar
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                                 
                                        
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