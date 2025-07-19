<?php
//verificamos que este logueado y se administrador
    session_start();
    if (empty($_SESSION['Usuario_Nombre'])) {
        header('Location: cerrarsesion.php');
        exit;
    }

require_once 'funciones/conexion.php';
$MiConexion=ConexionBD(); 

require_once 'funciones/listar_empresa.php';
require_once 'funciones/listarUsuario.php';
$ListadoEmpresa = Listar_Empresa($MiConexion);
$CantidadEmpresa= count($ListadoEmpresa);
$ListadoUsuarios = Listar_Usuarios($MiConexion);
$CantidadUsuarios= count($ListadoUsuarios);
require_once 'funciones/listar_estados.php';
$ListaEstados =Listar_estado($MiConexion);
$cantidadEstados = count($ListaEstados);

require_once 'funciones/validacion_registro.php';
require_once 'editar/metodo_editar.php';
// buscamos los datos necesarios del proyecto a cambiar 
if(isset($_GET['ID_proyecto'])){
    $data = EncontrarProyecto($_GET['ID_proyecto'], $MiConexion);  
}
// si se oprime el boton 'BotonEditar', procedemos a hacer los cambios
$Mensaje='';
$Estilo='warning';
if (isset($_POST['BotonEditar'])) {
    $Mensaje=Validar_Datos();
    if (empty($Mensaje)) {
        if (Modificar_Proyecto($_GET['ID_proyecto'], $MiConexion) != false) {
            header('Location: listado_proyectos.php');
        exit;
        }
    }
}
  // -------------------------------------------  
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

                    <div class="mb-3">
                        <h1 class="h3 mb-3"><strong>Proyectos</strong> Actualizar proyecto.  </h1>
                    </div>
                    <form role="form" method='post'>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card">            
                                    <div class="card-header">
                                        <!-- mensaje -->
                                        <?php if (!empty($Mensaje)) { ?>
                                        <h4 class="text-<?php echo $Estilo; ?>">
                                        <?php echo $Mensaje; ?>
                                        </h4>
                                        <?php } ?>
                                        <!-- ---------------------------- -->

                                        <h4 class="text-info">
                                            Los campos con <i class="align-middle me-2" data-feather="command"></i> son obligatorios
                                        </h4> 
                                    </div>

                                    
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Denominación <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <input class="form-control" type="text" name="denominacion" id="Denominacion" placeholder="Ingresa el nombre del Proyecto"
                                            value="<?php echo !empty( $data['PROYECTO']) ?  $data['PROYECTO'] : ''; ?>">
                                    </div>

                                    <div class="card-body">
                                        <!-- Empresa       -->
                                        <h5 class="card-title mb-0">Empresa <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <select class="form-select mb-3" name="idEmpresa" id="idEmpresa">
                                            <option value="" selected>Para quien trabajaremos...</option>
                                                <?php 
                                                $selected='';
                                                for ($i=0 ; $i < $CantidadEmpresa ; $i++) {
                                                    if (!empty($data['IDEMPRESA']) && $data['IDEMPRESA'] ==  $ListadoEmpresa[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else {
                                                        $selected='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $ListadoEmpresa[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListadoEmpresa[$i]['DENOMINACION']; ?>
                                                    </option>
                                                <?php } ?>
                                            <!-- ------------------------------ -->
                                            
                                        </select>
                                    </div>
                                    <!-- estado del proyecto -->
                                     <div class="card-body">
                                        <h5 class="card-title mb-0">Estado del proyecto <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <select class="form-select mb-3" name="idEstado" id="IdEstado">
                                            <option value="" selected>En que estado esta el proyecto...</option>
                                                <?php 
                                                $selected='';
                                                for ($i=0 ; $i < $cantidadEstados ; $i++) {
                                                    if (!empty($data['IDESTADO']) && $data['IDESTADO'] ==  $ListaEstados[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else {
                                                        $selected='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $ListaEstados[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListaEstados[$i]['DENOMINACION']; ?>
                                                    </option>
                                                <?php } ?>
                                            
                                        </select>
                                    </div>
                                    <!-- ------------------------------------- -->
                                    

                                    <!-- Lider -->
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Líder <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <select class="form-select mb-3" name="idlider" id="idlider">
                                            <option value="" selected> Selecciona una opción</option>
                                            <?php 
                                                $selected='';
                                                for ($i=0 ; $i < $CantidadUsuarios ; $i++) {
                                                    if($ListadoUsuarios[$i]['IDROL'] == 2){
                                                    if (!empty($data['IDUSUARIO']) && $data['IDUSUARIO'] ==  $ListadoUsuarios[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else{
                                                        $selected='';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $ListadoUsuarios[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListadoUsuarios[$i]['NOMBRE'] . " ".$ListadoUsuarios[$i]['APELLIDO'] ; ?>
                                                    </option>
                                                    
                                                <?php 
                                                    }
                                                } ?>
                                            
                                        </select>
                                    </div><!-- -------------------------------------------- -->

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Observaciones</h5>
                                        <textarea class="form-control"  rows="2" name="observaciones" id="Observaciones"placeholder="Observaciones del tema..." 
                                        value="<?php echo !empty($data['OBSERVACIONES']) ? $data['OBSERVACIONES'] : ''; ?>"></textarea>
                                    </div>

                                   <!-- check de verificacion si es de proridad -->
                                    <div class="card-body">
                                        <label class="form-check">
                                            <input type="hidden" name="prioridad" value="0">
                                            <input class="form-check-input"  type="checkbox"  name = "prioridad"
                                            value = "1" 
                                            <?php echo (!empty($_POST['prioridad']) && $_POST['prioridad'] == "1") ? 'checked':''; ?>>
                                            <span class="form-check-label">
                                                Tildar si es solicitado con prioridad 
                                            </span>
                                        </label>
                                    </div>
                                    <!-- Boton editar proyecto -->
                                    <button type="submit" class="btn btn-primary" value="editar" name="BotonEditar" >Actualizar datos</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <?php 
require_once 'partes/pie.php';
?>
           

</body>

</html>