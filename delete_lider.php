<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $categorie = find_by_id('lideres',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","ID de la categoría falta.");
    redirect('categorie.php');
  }
?>
<?php
  $delete_id = delete_by_id('lideres',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","líder eliminado(a)");
      redirect('categorie.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('categorie.php');
  }
?>
