<?php
//verificamos que alguien este logueado
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
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
        
<                <div class="main">

             <?php require_once 'partes/cabecera.php'; ?> 

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Has ingresado al panel de administración.</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Elige tu opción desde el menú.</h5>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php 
require_once 'partes/pie.php';
?>
</body>

</html>