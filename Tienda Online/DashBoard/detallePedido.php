<!DOCTYPE html>
<?php
include '../DAO/MetodosDAO.php';

$num=$_REQUEST['num'];

$objMetodos=new MetodosDAO();
$lista=$objMetodos->ListarPedidosNum($num);

?>

<center>
    <table border="0" width="400" align="center" style="margin-top: 10px">
        <tr style="background: slategray;color: white">
        <th>Num</th>
        <th>codPro</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Cantidad</th>
    </tr>
         <?php
foreach ($lista as $row) {
    ?>
<tr>
    <td><?php echo $row[0]?></td>
    <td><?php echo $row[1]?></td>
    <td><?php echo $row[2]?></td>
    <td><?php echo $row[3]?></td>
    <td align="center"><?php echo $row[4]?></td>
</tr>
<?php
}
?>
</table>
</center>