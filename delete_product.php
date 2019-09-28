<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $voters = find_by_id('votantes',(int)$_GET['id']);
  if(!$voters){
    $session->msg("d","ID vacío");
    redirect('add_votantes.php');
  }
?>
<?php
  $delete_id = delete_by_id('votantes',(int)$voters['id']);
  if($delete_id){
      $session->msg("s","votante eliminado");
      redirect('add_votantes.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('add_votantes.php');
  }
?>
