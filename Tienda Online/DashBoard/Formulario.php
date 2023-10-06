<?php
include '../DAO/MetodosDAO.php';

$op=$_REQUEST['op'];

switch ($op) {
    case 1:
        $cod="";
        $des="";
        $pre="";
        $stock="";
        $estado="";
        $detalle="";
        break;
    case 3:
       $cod=$_REQUEST['cod'];
        $objMetodos=new MetodosDAO();
        $lista=$objMetodos->ListarProductosCod($cod);
        $cod=$lista[0];
        $des=$lista[1];
        $pre=$lista[2];
        $stock=$lista[3];
        $estado=$lista[4];
        $detalle=$lista[5];
        $op=3;
        break;
    default:
        break;
}
?>


<form enctype="multipart/form-data" action="Mantenimiento.php" method="POST">

    <table border="0" width="400">
                  <tr>
                      <td>Codigo: </td>
                      <td><input type="text" name="txtCod" value="<?php echo $cod; ?>"class="form-control input-sm" style="margin-top: 5px;" readonly="readonly"></td>
                  </tr>
                  <tr>
                      <td>Descripción: </td>
                      <td><input type="text" name="txtDes" value="<?php echo $des; ?>" class="form-control input-sm" style="margin-top: 5px;"></td>
                  </tr><tr>
                      <td>Precio: </td>
                      <td><input type="text" name="txtPre" value="<?php echo $pre; ?>" class="form-control input-sm" style="margin-top: 5px;"></td>
                  </tr><tr>
                      <td>Cantidad: </td>
                      <td><input type="text" name="txtCan" value="<?php echo $stock; ?>" class="form-control input-sm" style="margin-top: 5px;"></td>
                  </tr><tr>
                      <td>Estado: </td>
                      <td><input type="text" name="selectEstado" value="<?php echo $estado; ?>" class="form-control input-sm" style="margin-top: 5px;"></td>
                  </tr><tr>
                      <td>Detalle: </td>
                      <td><textarea name="txtDetalle" width="100" rows="3"class="form-control input-sm" style="margin-top: 5px;"><?php echo $detalle; ?></textarea>
                  </tr><tr>
                      <td>Imagen: </td>
                      <td><input name="archivo" type="file" /></td>
                  </tr><tr style="margin-top: 5px;">
                      <th><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></th>
                      <th><input type="submit" value="Guardar" class="btn btn-primary" name="btnGuardar"/></th>
                  <input type="hidden" value="<?php echo $op;?>" class="btn btn-primary" name="op"/>
    </table>
</form>