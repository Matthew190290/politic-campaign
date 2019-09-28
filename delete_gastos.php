<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('expenses',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('add_gastos.php');
  }
?>
<?php
  $delete_id = delete_by_id('expenses',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Gasto eliminado.");
      redirect('add_gastos.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_gastos.php');
  }
?>
