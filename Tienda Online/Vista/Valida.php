<?php

include '../DAO/MetodosDAO.php';

//creo dos variables que recibiran el usuario y la contraseña
$usu=$_REQUEST['txtUsu'];
$pas=$_REQUEST['txtPas'];

//aqui creare el objeto e instancio la clase metodos 
$objCli=new Cliente(0, '', $usu, $pas); 
$objMetodos=new MetodosDAO();

//la lista me tiene que devolver o 1 usuario o 0 usuarios si no coincide el usuario y la contraseña
$lista=$objMetodos->validar($objCli);

//creo el if para abrir la sesion si se logro validar al cliente el resultado de la variable lista sera 1 por ende mayor que cero
if(sizeof($lista)>0){

    //tras validar al cliente se creara las variables de sesion
    session_start();
    $_SESSION['acceso']=true;
    $_SESSION['codCli']=$lista[0];
    $_SESSION['nombre']=$lista[1];
//redirecciono a la pagina principal "Catalogo"
    header("Location: Catalogo.php");
}else{
    header("Location: Catalogo.php");
}

?>