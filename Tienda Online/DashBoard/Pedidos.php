<!DOCTYPE html>
<?php
include '../DAO/MetodosDAO.php';
session_start();
if(($_SESSION['acceso']<>true)){
    header("Location: login.php");
}
?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
       
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <table border="0" align="center" width="200">
                    <tr>
                        <th width="80"><img src="images/carrito.png" width="60" height="60"></th>
                        <th><h3>Carrito de <br> Compras</h3></th>
                    </tr>
                </table>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a href="Productos.php">
                                <i class="fas fa-tachometer-alt"></i>Productos</a>
                        </li>
                        <li>
                            <a href="Pedidos.php">
                                <i class="fas fa-check-square"></i>Pedidos</a>
                        </li>
                       <li>
                            <a href="Clientes">
                                <i class="fas fa-chart-bar"></i>Clientes</a>
                        </li>
                        <li>
                            <a href="Cerrar.php">
                                <i class="fas fa-battery"></i>Salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            
                            
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                
                                <h3 align="center">Detalle de Pedidos</h3>
                                <center>
                                    <table border="0" width="400" align="center" style="margin-top: 10px">
                                        <tr style="background: slategray;color: white">
                                            <th>Accion</th>
                                        <th>Num</th>
                                        <th>codCli</th>
                                        <th>NomCli</th>
                                        <th>Fecha</th>
                                    </tr>
                                         <?php
                                
                                $metodos=new MetodosDAO();
                                $lista=$metodos->ListarPedidos();
                                foreach ($lista as $row) {
                                    ?>
                                    <tr>
                                    <td><button  style="margin-top: 5px;" class="btn btn-primary" onclick="mostrarDetalle(<?php echo $row[0]?>)">Detalle</button></td>
                                    <td><?php echo $row[0]?></td>
                                    <td><?php echo $row[1]?></td>
                                    <td><?php echo $row[2]?></td>
                                    <td><?php echo $row[3]?></td>
                                </tr>
                                <?php
                                }
                                ?>
                                </table>
                                </center>
                                <div id="mostrar" style="margin: 0 auto;">
                                
                            </div>
                                <div class="copyright">
                                    <p>Copyright © Formando Codigo.</p>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    
    <script type="text/javascript">

var resultado=document.getElementById("mostrar");

function mostrarDetalle(num){
    //validamos navegador que estamos utilizando
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState===4 && xmlhttp.status===200){
            resultado.innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","detallePedido.php?num="+num,true);
    xmlhttp.send();
}

</script>

</body>

</html>
<!-- end document-->

