<?php

//Aqui trabajare con el listado de productos y la cesta
session_start();

//variable op que se usara para trabajar las opciones del switch 1 para la lista y 2 para el carrito
$op=$_REQUEST['op'];
include './MetodosDAO.php';
echo $op;

//creare dos opciones con un switch para trabajar con la lista y el carrito 
switch ($op){

//el case 1 lo uso para llamar al metodo listar productos y almacenarlos en la variable SESSION 'lista'
    case 1:
        unset($_SESSION['lista']);
        $objMetodos=new MetodosDAO();
        $lista=$objMetodos->ListarProductos();
        $_SESSION['lista']=$lista;
        header("Location: ../Vista/Catalogo.php");
        break;
//el case 2 lo uso para el carrito de la compra, el cual inicialmente estara vacio
    case 2:

// creo else if para recibir el id del producto
        if(isset($_REQUEST['id'])){
            $id=$_REQUEST['id'];
        }else{
            $id=1;
        }
//creo else if para recibir la accion que puede ser agregar o eliminar el producto y por defecto la accion sera vacio para cuando no haya ningun producto en el carrito
        if(isset($_REQUEST['accion'])){
            $accion=$_REQUEST['accion'];
        }else{
            $accion='vacio';
        }
//con este switch evaluare la accion que se tomara bien sea agregar, eliminar o vacio
        switch($accion){
        //el primer case lo usare para agregar el producto al carrito
            case'agregar':
                //recibo la cantidad 
                $can=$_REQUEST['txtCan'];

                //añado la cantidad a la variable sesion si ya hay en el carrito se sumara a la cantidad que ya hay
                if(isset($_SESSION['carrito'][$id]))
                    $_SESSION['carrito'][$id]+=$can;
                else
                    $_SESSION['carrito'][$id]=$can;
            break;

        //el segundo case para eliminar el producto del carrito
            case 'eliminar':
                if(isset($_SESSION['carrito'][$id])){
                    $_SESSION['carrito'][$id]--;
                if($_SESSION['carrito'][$id]==0)
                    unset($_SESSION['carrito'][$id]);}
            break;

        //el tercer case para cuando el carrito esta vacio
            case 'vacio':
                unset($_SESSION['carrito']);
                break;
            }
        //redireccionaremos con el header al archivo Carrito.php que leera la cesta que cree
       header("Location: ../Vista/Carrito.php");
       break;
   
 }

?>
