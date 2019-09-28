<?php
  $page_title = 'Gastos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   $datas = find_all('expenses');
   $totals= total_expenses('expenses');
?>

<?php
if(isset($_POST['add_expen'])){
   $req_field = array('services');
   $req_field = array('valor_ser');
   $req_field = array('fecha_ser');

   validate_fields($req_field);
   $cat_ser = remove_junk($db->escape($_POST['services']));
   $cat_valor = remove_junk($db->escape($_POST['valor_ser']));
   $cat_fecha = remove_junk($db->escape($_POST['fecha_ser']));

   if(empty($errors)){
      $sql  = "INSERT INTO expenses (services, pay, date_ser)";
      $sql .= " VALUES ('{$cat_ser}', '{$cat_valor}', '{$cat_fecha}')";
      if($db->query($sql)){
        $session->msg("s", "Registro agregado exitosamente.");
        redirect('add_gastos.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('add_gastos.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_gastos.php',false);
   }
 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
 </div>

  
   <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Gasto</span>
            
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="add_gastos.php">
            <div class="form-group">
              <label>Concepto</label>
                <input type="text" class="form-control" name="services" placeholder="Ingresa Gasto" required><br>
                <label>Valor Gasto</label>
                <input type="number" class="form-control" name="valor_ser" placeholder="Ingresa Valor" required><br>
                <label>Fecha del Gasto</label>
                <input type="date" class="form-control" name="fecha_ser" required><br>
                
            </div>
            <button type="submit" name="add_expen" class="btn btn-primary">Agregar Registro</button>
            
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Gastos</span>
          <div class=" pull-right">
            <?php foreach ($totals as $total):?>
          <div>
            <p>Total Gastos: $<?php echo number_format($total['pagos']); ?></p>
          </div>
            <?php endforeach; ?>
          </div>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table  table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" >No.</th>
                    <th class="text-center">Servicio</th>
                    <th class="text-center">Valor a Pagar</th>
                    <th class="text-center">Fecha De Pago</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($datas as $data):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($data['services'])); ?></td>
                    <td class="text-center"><?php echo number_format($data['pay']); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($data['date_ser'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_gastos.php?id=<?php echo (int)$data['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_gastos.php?id=<?php echo (int)$data['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>

  <?php include_once('layouts/footer.php'); ?>