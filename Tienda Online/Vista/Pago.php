<!DOCTYPE html>
<?php
include '../DAO/MetodosDAO.php';

session_start();

?>
<html>
    <head>
        <meta charset="UTF-8">
         <!-- plantilla -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carrito de Compras</title>

    <!-- Estilos-->
    <link href="../css/modern-business.css" rel="stylesheet">

 <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        
         <!-- Menu  -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="http://www.formandocodigo.com">Formando Codigo</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="Registro.php">Registrarse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Carrito.php">Carrito</a>
            </li>
            <?php
            if(!isset($_SESSION['acceso']) || $_SESSION['acceso']<>true){ 
            ?>
            <li class="nav-item">
                 <a  class="nav-link" href="" data-toggle="modal" data-target="#modalLogin">Iniciar Sesion</a>
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
          </ul>
        </div>
      </div>
    </nav>
        <!-- fin de menu -->
      
          
        <?php 
        //almaceno total en una variable que luego sera usada dentro del formulario paypal para obtener el total a pagar
        if(isset($_REQUEST['total'])){
            $total=$_REQUEST['total'];
        }
        $estado=$_REQUEST['estado'];
        if($estado=='pagar'){
        ?>
        
        <!---- FORMULARIO PAYPAL -->
    <center> <h4 style="margin-top:80px;">El monto a pagar es: <?php echo $total; ?>€</h4>
        <!---- añado todos los enlaces del formulario de paypaL --> 

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_ext-enter" />
<input type="hidden" name="redirect_cmd" value="_xclick" />
<input type="hidden" name="business" value="reyesr28@hotmail.com" />
<input type="hidden" name="item_name" value="Productos varios" />
<input type="hidden" name="quantity" value="1" />
<input type="hidden" name="amount" value="<?php echo $total ?>" />
<input type="hidden" name="currency_code" value="EUR" />
<input type="hidden" name="return" value="http://localhost:8080/carritoPHP/Vista/pago.php?estado=ok" />
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest" />
<input type="image" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif" border="0" name="submit" alt="Pagar para completar la compra." />

</form>

       
        </center>
     <!----- FIN DE PAYPAL -->   
        
        
       <?php 
       }else if($estado=='ok'){
      
        //Obtengo todos los datos a traves de la variable sesion para luego almacenarlos
      if(isset($_SESSION['carrito'])){
       $codCli=$_SESSION['codCli'];
       $fecha=date("Y-m-d");
       $objMetodos=new MetodosDAO();
       //creo un objeto de venta con los valores almacenados
       $objVenta=new venta(0,$codCli, $fecha);
       //procedo a registrar la venta haciendo uso de la funcion
       $objMetodos->registrarVenta($objVenta);
       $ultimaVenta=$objMetodos->numeroVenta();
       foreach($_SESSION['carrito'] as $id=>$x){
            $objDetalleVenta=new DetalleVenta($ultimaVenta[0], $id, $x);
            $objMetodos->detalleVenta($objDetalleVenta);
       }
       
       unset($_SESSION['carrito']);
       ?>
        <h3 align="center">Pedido Registrado Satisfactoriamente</h3>
        <?php
       }
    } 
        ?>
    <center>
        <a href="Catalogo.php" class="btn btn-primary">Volver a Catalogo</a>
    </center>
    </body>
</html>
