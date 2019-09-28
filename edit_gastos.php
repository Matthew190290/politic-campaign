<?php
  $page_title = 'Editar Gasto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$expen = find_by_id('expenses',(int)$_GET['id']);
if(!$expen){
  $session->msg("d","Missing product id.");
  redirect('add_gastos.php');
}
?>
<?php
if(isset($_POST['edit_expen'])){
  $req_field = array('expen_service');
   $req_field = array('expen_pay');
   $req_field = array('expen_date');
 
   validate_fields($req_field);
   $expen_ser = remove_junk($db->escape($_POST['expen_service']));
   $expen_pago = remove_junk($db->escape($_POST['expen_pay']));
   $expen_fecha = remove_junk($db->escape($_POST['expen_date']));

  if(empty($errors)){
        $sql = "UPDATE expenses SET services= '{$expen_ser}', pay='{$expen_pago}', date_ser='{$expen_fecha}'";
       $sql .= " WHERE id='{$expen['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Registro Actualizado con éxito.");
       redirect('add_gastos.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('edit_gastos.php',false);
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
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando Concepto de <?php echo remove_junk(ucfirst($expen['services']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_gastos.php?id=<?php echo (int)$expen['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="expen_service" value="<?php echo remove_junk(ucfirst($expen['services']));?>"><br>
               <input type="number" class="form-control" name="expen_pay" value="<?php echo remove_junk(ucfirst($expen['pay']));?>"><br>
               <input type="date" class="form-control" name="expen_date" value="<?php echo remove_junk(ucfirst($expen['date_ser']));?>"><br>
               
           </div>
           <button type="submit" name="edit_expen" class="btn btn-primary">Actualizar Gasto</button>
       </form>
       </div>
     </div>
   </div>
</div>

<?php include_once('layouts/footer.php'); ?>
