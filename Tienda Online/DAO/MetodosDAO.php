<?php
//incluyo los archivos del proyecto
include '../Utils/ConexionDB.php';
include '../Beans/Cliente.php';
include '../Beans/DetalleVenta.php';
include '../Beans/Venta.php';
include '../Beans/Producto.php';

//DataAccessObject a traves de esta clase creare las diferentes funciones del programa
class MetodosDAO {

    //creo la funcion listar productos 
        public function ListarProductos(){

    //para cada una de las funciones empezare creando la conexion a la base de datos
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();

    //hago una consulta  a la base de datos para obtener toda la informacion y la anadire a una lista
        $res = $cn->prepare("select * from productos");
        $res->execute();
        foreach ($res as $row)
        {
            $lista[]=$row;
        }
        return $lista;
    }
    
//funcion para listar los productos por codigo 
    public function ListarProductosCod($cod){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res = $cn->prepare("select * from productos where codPro=$cod");
        $res->execute();
        foreach ($res as $row)
        {
            $lista=$row;
        }
        return $lista;
    }
//creo funcion para registrar al cliente
    public function RegistrarCliente(Cliente $cli){
        $i=0;
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        //inserto los datos 
        $res=$cn->prepare("INSERT  INTO clientes VALUES(0,'$cli->nomCli','$cli->correo',
                '$cli->pas');");
        $i=$res->execute();
        return  $i;
    }

//Creo funcion para validar al usuario
    public function validar(Cliente $cli){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();

    //aqui confirmo que el correo y la contraseña coincidan
        $res = $cn->prepare("select * from clientes "
                . "where correo='$cli->correo' and pas='$cli->pas'");
        $res->execute();
        foreach ($res as $row)
        {
            $lista=$row;
        }
        return $lista;
    }
    
//creo funcion que servira para registrar las ventas
    public function registrarVenta(Venta $venta){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        //inserto los datos
        $res=$cn->prepare("INSERT  INTO venta VALUES(null,"
                . "'$venta->codCli','$venta->fecha')");
        $res->execute();
    }

//Creo funcion para obtener el numero de pedido
    public function numeroVenta(){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        //hago una consulta a la base de datos con un select max al numVenta que me dara el numero de pedidos
        $res = $cn->prepare("select max(numVenta) from venta");
        $res->execute();
        foreach ($res as $row)
        {
            $num=$row;
        }
        return $num;
    }

//Creo funcion para almacenar el detalle de la venta
    public function detalleVenta(DetalleVenta $det){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        //inserto los datos
        $res=$cn->prepare("INSERT  into detalleventa VALUES($det->num,"
                . "'$det->codpro','$det->can')");
        $res->execute();
    }
    
    public function agregarProducto(Producto $pro){
        
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res=$cn->prepare("INSERT into productos VALUES(null,'$pro->des',$pro->pre,"
                . "$pro->stock,'$pro->estado','$pro->detalle','$pro->imagen')");
        $res->execute();        
    }
    
    public function eliminarProducto($cod){
        
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res=$cn->prepare("delete from productos where codpro=$cod");
        $res->execute();        
    }
    public function editarProducto(Producto $pro){
        
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res=$cn->prepare("update productos set descripcion='$pro->des',precio=$pro->pre,"
                . "stock=$pro->stock,estado='$pro->estado',detalle='$pro->detalle',imagen='$pro->imagen'"
                . " where codpro=$pro->cod");
        $res->execute();        
    }
    
    public function ListarPedidos(){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res = $cn->prepare("select v.numpedido,v.codCli,c.nombre,v.fecha"
                . " from pedido v inner join clientes c on v.codcli=c.codcli");
        $res->execute();
        foreach ($res as $row)
        {
            $lista[]=$row;
        }
        return $lista;
    }
    
    public function ListarPedidosNum($num){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res = $cn->prepare("select d.numpedido,d.codpro,p.descripcion,p.precio,d.can"
                . " from detallepedido d inner join productos p on d.codpro=p.codpro where numpedido=$num");
        $res->execute();
        foreach ($res as $row)
        {
            $lista[]=$row;
        }
        return $lista;
    }
       public function ListarClientes(){
        $cnx=new ConexionDB();
        $cn=$cnx->getConexion();
        $res = $cn->prepare("select * from clientes");
        $res->execute();
        foreach ($res as $row)
        {
            $lista[]=$row;
        }
        return $lista;
    }
}
