<?php

//creo la clase cliente con al cual crearemos los objetos clientes y los respectivos getters and setters
class Cliente {
    public $codCli;
    public $nomCli;
    public $correo;
    public $pas;
    
    //para el constructor añado los campos tal cual los he añadido en la base de datos
    function __construct($codCli, $nomCli, $correo, $pas) {
        $this->codCli = $codCli;
        $this->nomCli = $nomCli;
        $this->correo = $correo;
        $this->pas = $pas;
    }

    
    function getCodCli() {
        return $this->codCli;
    }

    function getNomCli() {
        return $this->nomCli;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getPas() {
        return $this->pas;
    }

    function setCodCli($codCli) {
        $this->codCli = $codCli;
    }

    function setNomCli($nomCli) {
        $this->nomCli = $nomCli;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setPas($pas) {
        $this->pas = $pas;
    }


}
