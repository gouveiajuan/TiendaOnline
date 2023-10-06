<?php

include '../DAO/MetodosDAO.php';

//creo variable que recibira los parametros en este caso el codigo del producto
$cod=$_REQUEST['cod'];

$objMetodos=new MetodosDAO();
$lista=$objMetodos->ListarProductosCod($cod);

//creo variables que recibiran el nombre, precio y el detalle de el producto seleccionado
$nombre=$lista[1];
$precio=$lista[2];
$detalle=$lista[5];
?>

<!-- envio el formulario hacia el archivo CarritoDAO.php-->
<form action="../DAO/CarritoDAO.php">

<!-- Creo una tabla para mostrar una ventana toda la informacion del producto seleccionado  -->
<table border="0">
    <tr>
<!-- Aqui buscaremos la imagen segun el nombre del producto -->
        <th rowspan="4"><img src="../Imagenes/<?php echo $nombre; ?>.jpg" width="200" height="170"></th>
        <th><?php echo $nombre; ?></th>
    </tr><tr>
<!-- muestro el detalle -->
        <td align="justify"><?php echo $detalle; ?></td>
    </tr><tr>
<!-- muestro el precio -->
        <th align="right"><?php echo $precio; ?>€</td>
    </tr><tr>
<!-- creo un campo para ingresar la cantidad que queremos comprar -->
        <td align="right">Ingrese Cantidad: <input type="number" min="1" max="100" value="1" name="txtCan"></td>
    </tr><tr>

<!-- añado botones para cerrar y agregar al carrito y otorgo estilo con bootsrap -->
        <th colspan="2" align="right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="submit(event)">Agregar al Carrito</button>
        </th>
    </tr>
</table>
<!-- creamos 3 input ocultos(hidden) para que no se vean en la ventana, se usaran para enviar el codigo de producto, la accion y la opcion-->
    <input type="hidden" name="id" value="<?php echo $cod; ?>">
    <input type="hidden" name="accion" value="agregar">
    <input type="hidden" name="op" value="2">
</form>
