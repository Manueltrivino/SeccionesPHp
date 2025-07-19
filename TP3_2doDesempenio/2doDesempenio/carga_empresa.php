<?php
    session_start();
    if (empty($_SESSION['Usuario_Nombre'])  || $_SESSION['Usuario_Rol'] != 1) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD(); 

require_once 'funciones/listar_pais.php';
$ListadoPais = Listar_Pais($MiConexion);
$CantidadPais= count($ListadoPais);

require_once 'funciones/validacion_registro.php'; 
require_once 'funciones/insertar_empresa.php';


$Mensaje='';
$Estilo='danger';
if (!empty($_POST['BotonRegistrar'])) {
    $Mensaje=Validar_Empresa();
    if (empty($Mensaje)) {
        if (InsertarEmpresa($MiConexion) != false) {
            $Mensaje = 'Registro cargado correctamente.';
            $_POST = array(); 
            $Estilo = 'success'; 
        }
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'partes/head.php' ;
    ?>


<body>
    <div class="wrapper">
        <?php require_once 'partes/lateral.php'; ?>
    
        <div class="main">
            <?php require_once 'partes/cabecera.php'; ?> 
            

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Cargar Nueva Empresa</h1>
                    </div>
                    <form role="form" method='post'>
                        <div class="row">
                            <div class="col-12 col-lg-6">

                                <div class="card-header">
                                    <?php if (!empty($Mensaje)) { ?>
                                        <h4 class="text-<?php echo $Estilo; ?>">
                                        <?php echo $Mensaje; ?>
                                        </h4>
                                        <?php } ?>
                                    
                                    <h4 class="text-info">
                                        Los campos con <i class="align-middle me-2" data-feather="command"></i> son obligatorios
                                    </h4> 
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Denominación <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <input type="text" class="form-control" name="denominacion" id="Denominacion" placeholder="Ingresa el nombre"
                                         value="<?php echo !empty($_POST['denominacion']) ? $_POST['denominacion'] : ''; ?>">
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Pais <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <select class="form-select mb-3" name="idpais" id="Idpais">
                                            <option value="" selected>Elige una opción</option>
                                            <?php 
                                                $selected='';
                                                for($i=0 ; $i < $CantidadPais ; $i++) {
                                                    if (!empty($_POST['idpais']) && $_POST['idpais'] ==  $ListadoPais[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else {
                                                        $selected='';
                                                    }
                                            ?>
                                            <option value="<?php echo $ListadoPais[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListadoPais[$i]['DENOMINACION']; ?>
                                                    </option>
                                            
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Observaciones</h5>
                                        <textarea class="form-control"  rows="2" name="observaciones" id="observaciones"
                                        placeholder="Observaciones del tema..."><?php echo !empty($_POST['observaciones']) ? $_POST['observaciones'] : ''; ?></textarea>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary" value="Registrar Datos" name="BotonRegistrar" >Registrar Datos</button>

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