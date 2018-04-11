<?php
require 'page.php';
ini_set('display_errors', true);
$p = new page();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Mark2</title>
    </head>
    <body class="container">
        <div >
            <form  action="index.php" method="post">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" name="tipo" id="tipo" >
                        <?php foreach ($p->getEscalas() as $key => $value) { ?>
                            <option<?php echo ( isset($_POST['tipo']) && ($_POST['tipo']) == $key ) ? ' selected="selected"' : ""; ?> ><?php echo $key ?></option>
                        <?php } ?>
                    </select>
                    <label for="notaInicial">Nota Inicial</label>
                    <select class="form-control" name="notaInicial" id="notaInicial" selected="<?php echo (isset($_POST['notaInicial'])) ? $_POST['notaInicial'] : ""; ?>">
                        <option >Grados</option>
                        <?php foreach ($p->getCromatica2() as $key => $value) { ?>
                            <option  <?php echo ( isset($_POST['notaInicial']) && ($_POST['notaInicial']) == $value) ? ' selected="selected"' : ""; ?> > <?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                    <label for="notaFinal">NotaFinal</label>
                    <select class="form-control" name="notaFinal" id="notaFinal" selected="<?php echo (isset($_POST['notaFinal'])) ? $_POST['notaFinal'] : ""; ?>">
                        <?php foreach ($p->getCromatica2() as $key => $value) { ?>
                            <option  <?php echo ( isset($_POST['notaFinal']) && ($_POST['notaFinal']) == $value) ? ' selected="selected"' : ""; ?> > <?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                    <label for="notas">Notas</label>
                    <textarea class="form-control" name="notas" id="notas" rows="4"><?php echo (isset($_POST['notas'])) ? $_POST['notas'] : ""; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </br>
            <?php if (!$p->getDatosValidos()) { ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="alert alert-warning" role="alert">
                        <?php echo $p->getMensaje() ?>
                    </div>
                </div>
            </div>
             <?php } ?>
            <div class="row">
                <?php if (count($p->getNotas()) > 0 && $p->getDatosValidos()) { ?>                
                    <?php foreach ($p->getCifrado() as $key => $value) { ?>    
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $key ?></h5>
                                    <?php foreach ($value as $key => $nota) { ?>
                                        <?php echo trim($nota['nota']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div> 
            <br>

            <?php if (isset($_POST['tipo'])) { ?>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ejemplo</h5>
                                <p class="card-text">Notas:   C D E F G A</p>
                                <p class="card-text">Grados:  1 2 3 4 5 6</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Estructura <?php echo $p->getTipo() ?></h5>
                                <?php foreach ($p->getEscalas()[$p->getTipo()] as $key => $nota) { ?>
                                    <?php echo trim($nota) . "t  "; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Escala de <?php echo $p->getNotaInicial() . " y " . $p->getNotaFinal() . " " . $p->getTipo() ?></h5>
                                <?php foreach ($p->getEscala() as $key => $nota) { ?>
                                    <?php $key = $key + 1; ?>
                                    <?php echo $nota . "=" . $key . ","; ?>
                                <?php } ?>
                                <br>
                                <?php foreach ($p->getEscalaTemp() as $key => $nota) { ?>
                                    <?php $key = $key + 1; ?>
                                    <?php echo $nota . "=" . $key . ","; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <div class="row">
                <?php } ?>
            </div>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>


