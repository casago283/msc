<?php

class page {

    private $notas=[];
    private $notaInicial;
    private $notaFinal;
    private $tipo;
    private $cifrado = [];
    private $cromatica = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
    private $cromatica2 = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
    private $cromaticaAsociada = ['C' => 1, 'C#' => 2, 'D' => 3, 'D#' => 4, 'E' => 5, 'F' => 6, 'F#' => 7, 'G' => '8', 'G#' => '9', 'A' => 10, 'A#' => 11, 'B' => 12];
    private $escalas = ["mayor" => ['1', '1', '1/2', '1', '1', '1', '1/2'],
        "menor" => ['1', '1/2', '1', '1', '1/2', '1', '1']
    ];
    private $escala = [];
    private $tercera = [];
    private $quinta = [];
    private $escala2;
    private $escalaTemp = [];

    function __construct() {
        if (isset($_POST['notas']) && isset($_POST['notaInicial']) && isset($_POST['tipo']) && isset($_POST['notaFinal'])) {
            $this->notas = strtoupper($_POST['notas']);
            $this->notaInicial = $_POST['notaInicial'];
            $this->notaFinal = $_POST['notaFinal'];
            $this->tipo = $_POST['tipo'];
            $indiceNotaRaiz = $this->cromaticaAsociada[$this->notaFinal] - 1;
            $salto = $indiceNotaRaiz;
            foreach ($this->escalas[$this->tipo] as $key => $value) {
                if ($value == "1") {
                    array_push($this->escala, $this->cromatica[$salto]);
                    $salto = $salto + 2;
                } else {
                    array_push($this->escala, $this->cromatica[$salto]);
                    $salto = $salto + 1;
                }
            }
            $this->notas = explode(' ', $this->notas);

            if (isset($_POST['notaInicial']) && $_POST['notaInicial'] != 'Grados') {
                $salto = $this->cromaticaAsociada[$this->notaInicial] - 1;
                $this->escalaTemp2 = [];
                foreach ($this->escalas[$this->tipo] as $key => $value) {
                    if ($value == "1") {
                        array_push($this->escalaTemp, $this->cromatica[$salto]);
                        $salto = $salto + 2;
                    } else {
                        array_push($this->escalaTemp, $this->cromatica[$salto]);
                        $salto = $salto + 1;
                    }
                }
                foreach ($this->escalaTemp as $key => $value) {
                    $this->escalaTemp2[$value] = $key + 1;
                }
                $cuentaTemp = 0;
                foreach ($this->notas as $key => $value) {
                    $this->notas[$cuentaTemp] = $this->escalaTemp2[$value];
                    $cuentaTemp = $cuentaTemp + 1;
                }
                $this->escala2 = $this->escalaTemp;
            }

            $this->escala2 = $this->escala;
            foreach ($this->escala as $key => $value) {
                array_push($this->escala2, $value);
            }
            $this->cifrado = ["primera" => [], "tercera" => [], "quinta" => []];
            $this->tercera = [];
            $this->quinta = [];
            if (count($this->notas) > 0) {
                foreach ($this->notas as $key2 => $value) {
                    $nota = explode('-', $value);
       
                        $nota1 = ['nota' => $this->escala2[(int) $nota[0] - 1], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                        array_push($this->cifrado["primera"], $nota1);
                        $nota3 = ['nota' => $this->escala2[(int) $nota[0] + 1], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                        array_push($this->cifrado["tercera"], $nota3);
                        $nota5 = ['nota' => $this->escala2[(int) $nota[0] + 3], 'posicion' => (count($nota) > 2) ? $nota[1] : 0, 'duracion' => (count($nota) > 2) ? $nota[2] : 0];
                        array_push($this->cifrado["quinta"], $nota5);
                    
                }
            }
        }
    }

    public function getEscalaTemp() {
        return $this->escalaTemp;
    }

    public function getNotas() {
        return $this->notas;
    }

    public function getNotaInicial() {
        return $this->notaInicial;
    }

    public function getNotaFinal() {
        return $this->notaFinal;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCifrado() {
        return $this->cifrado;
    }

    public function getCromatica() {
        return $this->cromatica;
    }

    public function getCromatica2() {
        return $this->cromatica2;
    }

    public function getCromaticaAsociada() {
        return $this->cromaticaAsociada;
    }

    public function getEscalas() {
        return $this->escalas;
    }

    public function getEscala() {
        return $this->escala;
    }

    public function getTercera() {
        return $this->tercera;
    }

    public function getQuinta() {
        return $this->quinta;
    }

    public function getEscala2() {
        return $this->escala2;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

