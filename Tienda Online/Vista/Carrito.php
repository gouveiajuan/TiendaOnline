<!DOCTYPE html>
<?php
    session_start();
   include '../DAO/MetodosDAO.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        
        <!-- plantilla -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Modern Business - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
        
        <!-- -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
 
    
    </head>
    <body>  
        
        
        <!-- Menu  -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="Catalogo.php">TIENDAAA</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <?php
            if(!isset($_SESSION['acceso']) || $_SESSION['acceso']<>true){ 
            ?>
            <li class="nav-item">
              <a class="nav-link" href="Registro.php">Registrarse</a>
            </li>

            <li class="nav-item">
                 <a  class="nav-link" href="" data-toggle="modal" 
                     data-target="#modalLogin">Iniciar Sesión</a>
            </li>
            </li>
            <?php
            }else{
                ?>
            <li class="nav-item">
                 <a  class="nav-link">Bienvenido <?php echo $_SESSION['nombre'];?></a>
            </li>
             <li class="nav-item">
                 <a href="Cerrar.php" class="nav-link">Cerrar Sesion</a>
            </li>
            <?php
            }
            ?>

            </li> <li class="nav-item">
                <a class="nav-link" href="Catalogo.php">Productos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
        <!-- fin de menu -->


        <!-- creo div que tendra toda la cesta de compra -->
        <div class="container">     
        <h3 align="center" style="margin-top:80px;">Carrito de Compras</h3>

        <!-- añado una tabla donde se mostrara la informacion de una forma mas ordenada-->
        <table border="1" width="400" align="center" class='table'>
            <tr bgcolor="#BEFFF0">
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Valor</th>
            </tr>
        <?php

        //creo un if para comprobar si hay algo en la variable de sesion 'carrito'
        if(isset($_SESSION['carrito'])){
            $total=0;
        
        //recorro la variable de sesion 'carrito'
        foreach($_SESSION['carrito'] as $id=>$x){
            $objMetodos=new MetodosDAO();
            $lista=$objMetodos->ListarProductosCod($id);
        //añadiremos los diferentes valores a las variables para posteriormente mostrarlo por pantalla
            $nombre=$lista[1];
            $precio=$lista[2];
            $costo=$x*$precio;
            $total=$total+$costo;
            
            ?>

        <!-- aqui mostramos por pantalla los valores de las variables -->
            <tr>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $precio; ?></td>
            <td><?php echo $x; ?>

            <!-- creo un moton que me permitira disminuir la cantidad de un articulo desde la cesta -->
                <a href='../DAO/CarritoDAO.php?id=<?php echo $id; 
                ?>&accion=eliminar&op=2'> Disminuir</a></td>
            <td><?php echo $costo; ?>€</td>
            </tr>
            <?php
            }
            ?>
            <tr>
            <th colspan="3">Total</td>
            <th><?php echo $total; ?>€</th>
            </tr>

        </table>
        <h6 align="center">

        <!-- añado los botones que tendra la cesta para cancelar pedido, seguir comprando y realizar pago -->
            <br><a href='../DAO/CarritoDAO.php?accion=vacio&op=2' class="btn btn-danger" 
                   style="width: 200px">Cancelar Pedido</a> 
             <a href='Catalogo.php' class="btn btn-info" style="width: 200px">Seguir Comprando</a>

             <!-- Este boton llamara a la funcion validar-->
             <button type="button" onclick="validar()" class="btn btn-success" 
                     data-toggle="modal" data-target="#modalLogin" style="width: 200px">
                     Realizar Pago</button>
 
    <?php
        }else{
          ?>
        El carrito se encuentra vacío<p><a href='Catalogo.php'>Empezar a comprar</a>
        <?php
            }
        ?>
        </h6>
        
        </div>  
     

    <!-- Bootstrap JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script>
    //Creo funcion para validar y enviar el total a la pagina "Pago"
        function validar() {
            //primero confirmo que el usuario se haya logeado
             <?php
             if($_SESSION['acceso']==true){
             ?>
                //para entonces enviar el total
                     location.href='Pago.php?total=<?php echo $total;?>&estado=pagar';
                     <?php
             }
             ?>       
        }
    </script>


    
    
    <?php
    
    if(isset($_SESSION['carrito'])){
    
    ?>
    <!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="Valida.php">
      <div class="modal-header">
          <h5 class="modal-title" id="modalLogin">Login de Usuarios</h5>
      </div>
      <div class="modal-body">
         
              <table border="0" align="center">
                  <tr>
                      <td>Usuario: </td>
                      <td><Input type="text" name="txtUsu"></td>
                  </tr><tr>
                      <td>Password: </td>
                      <td><Input type="text" name="txtPas"></td>
                  </tr>
              </table>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="submit()">Iniciar Sesion</button>
      </div>
             <h6 align="center"><a href="Registro.php">Registarse</a></h6>
        </form>
    </div>
  </div>
</div>

<?php
    }
?>
    
    </body>
</html>
