<?php

include '../DAO/MetodosDAO.php';

$op=$_REQUEST['op'];

switch ($op) {
    case 1:
        
       $target_path = "../Imagenes/";
        echo $archivo;
        $target_path = $target_path . basename( $_FILES['archivo']['name']); 
        move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);
        $img=basename( $_FILES['archivo']['name']);

       $objPro=new Producto(0, $_REQUEST['txtDes'],$_REQUEST['txtPre'],
        $_REQUEST['txtCan'],$_REQUEST['selectEstado'],$_REQUEST['txtDetalle'],$img);

        $metodos=new MetodosDAO();
        $metodos->agregarProducto($objPro);
    
        header('Location: Productos.php');
 
        break;
    
    case 2:
        $metodos=new MetodosDAO();
        $metodos->eliminarProducto($_REQUEST['cod']);
    
        header('Location: Productos.php');
 
        break;
    case 3:
        $target_path = "../Imagenes/";
        $target_path = $target_path . basename( $_FILES['archivo']['name']); 
        move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path);
        $img=basename( $_FILES['archivo']['name']);
        
        $objPro=new Producto($_REQUEST['txtCod'], $_REQUEST['txtDes'],$_REQUEST['txtPre'],
        $_REQUEST['txtCan'],$_REQUEST['selectEstado'],$_REQUEST['txtDetalle'],$img);

        $metodos=new MetodosDAO();
        $metodos->editarProducto($objPro);
    
        header('Location: Productos.php');
 
        break;

    default:
        break;
}

?>

