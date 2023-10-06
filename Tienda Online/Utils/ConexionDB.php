<?php

class ConexionDB {
    
    public function getConexion(){
    $cnx=new PDO("mysql:host=localhost;dbname=tiendafc","root","");    
    return $cnx;
    }

}
