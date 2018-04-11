<?php
ini_set('display_errors', true);
$notas = (isset($_POST['notas'])) ? $_POST['notas'] : "";
$notaRaiz = (isset($_POST['notaInicial'])) ? $_POST['notaInicial'] : "";
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : "";
$cifrado = [];
$cromatica = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
$cromaticaAsociada = ['C' => 1, 'C#' => 2, 'D' => 3, 'D#' => 4, 'E' => 5, 'F' => 6, 'F#' => 7, 'G' => '8', 'G#' => '9', 'A' => 10, 'A#' => 11, 'B' => 12];
$escalas = ["mayor" => ['1', '1', '1/2', '1', '1', '1', '1/2'],
    "menor" => ['1', '1/2', '1', '1', '1/2', '1', '1'],
    "blues" => [],
    "pentatonica" => []
]; 
//... 
if (isset($_POST['notas']) && isset($_POST['notaInicial']) && isset($_POST['tipo'])) {

    $indiceNotaRaiz = $cromaticaAsociada[$notaRaiz] - 1;

    $escala = [];
    $salto = $indiceNotaRaiz;
    foreach ($escalas[$tipo] as $key => $value) {
        if ($value == "1") {
            array_push($escala, $cromatica[$salto]);
            $salto = $salto + 2;
        } else {
            array_push($escala, $cromatica[$salto]);
            $salto = $salto + 1;
        }
        $escala;
    }
    $escala2 = $escala;
    foreach ($escala as $key => $value) {
        array_push($escala2, $value);
    }

    $notas = explode('|', $notas);


    $cifrado = ["primera" => [], "tercera" => [], "quinta" => []];
    $tercera = [];
    $quinta = [];
    if (count($notas) > 0) {
        foreach ($notas as $key => $value) {
            $nota = explode('-', $value);
            $notaModificada = explode("#", $nota[0]);

            if (count($notaModificada) > 1) {

                $nota1 = ['nota' => $cromatica[$cromaticaAsociada[$escala2[(int) $nota[0] - 1]]], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["primera"], $nota1);
                $nota1 = ['nota' => $cromatica[$cromaticaAsociada[$escala2[(int) $nota[0] + 1]]], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["tercera"], $nota1);
                $nota1 = ['nota' => $cromatica[$cromaticaAsociada[$escala2[(int) $nota[0] + 3]]], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["quinta"], $nota1);
            } else {

                $nota1 = ['nota' => $escala2[(int) $nota[0] - 1], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["primera"], $nota1);
                $nota3 = ['nota' => $escala2[(int) $nota[0] + 1], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["tercera"], $nota3);
                $nota5 = ['nota' => $escala2[(int) $nota[0] + 3], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                array_push($cifrado["quinta"], $nota5);
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Mark1</title>
    </head>
    <body class="container">

        <div >
            <form  action="index.php" method="post">

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select class="form-control" name="tipo" id="tipo" >
                        <?php foreach ($escalas as $key => $value) { ?>
                            <option<?php echo ( isset($_POST['tipo']) && ($_POST['tipo']) == $key ) ? ' selected="selected"' : ""; ?> ><?php echo $key ?></option>
                        <?php } ?>



                    </select>
                    <label for="notaInicial">Nota Inicial</label>
                    <select class="form-control" name="notaInicial" id="notaInicial" selected="<?php echo (isset($_POST['notaInicial'])) ? $_POST['notaInicial'] : ""; ?>">
                        <?php foreach ($cromatica as $key => $value) { ?>
                            <option  <?php echo ( isset($_POST['notaInicial']) && ($_POST['notaInicial']) == $value) ? ' selected="selected"' : ""; ?> > <?php echo $value; ?></option>

                        <?php } ?>


                    </select>
                    <label for="notas">Nota Inicial</label>
                    <textarea class="form-control" name="notas" id="notas" rows="4"><?php echo (isset($_POST['notas'])) ? $_POST['notas'] : ""; ?></textarea>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </br>
            <div class="row">

                <?php if (count($notas) > 1) { ?>                
                    <?php foreach ($cifrado as $key => $value) { ?>    


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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ejemplo</h5>
                                <p class="card-text">Ejemplo1:  1|3|6|5|1|2</p>
                                <p class="card-text">Ejemplo fase 2:  1-4-q|3-4-q|6-4-q|5-4-q|1-4-q|2-4-q</p>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Estructura <?php echo $tipo ?></h5>
                                <?php foreach ($escalas[$tipo] as $key => $nota) { ?>
                                    <?php echo trim($nota) . "t  "; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $tipo ?></h5>
                                
                          
                                <?php foreach ($escala as $key => $nota) { ?>

                                    <?php $key = $key + 1; ?>

                                    <?php echo $nota . "=" . $key . "<br>"; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


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


