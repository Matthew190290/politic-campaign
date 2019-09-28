<?php
  $page_title = 'Editar categoría';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  //Display all catgories.
  $categorie = find_by_id('lideres',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('lider-name');
   $req_field = array('lider-cedula');
   $req_field = array('zona-lider');
   $req_field = array('mesa-lider');
   $req_field = array('dir-lider');
   $req_field = array('tel-lider');
   validate_fields($req_field);
   $cat_lider = remove_junk($db->escape($_POST['lider-name']));
   $cat_ced = remove_junk($db->escape($_POST['lider-cedula']));
   $cat_zone = remove_junk($db->escape($_POST['zona-lider']));
   $cat_mesa = remove_junk($db->escape($_POST['mesa-lider']));
   $cat_dir = remove_junk($db->escape($_POST['dir-lider']));
   $cat_tel = remove_junk($db->escape($_POST['tel-lider']));
  if(empty($errors)){
        $sql = "UPDATE lideres SET nombre_completo= '{$cat_lider}', Cedula='{$cat_ced}', zona_votacion='{$cat_zone}', mesa='{$cat_mesa}', direccion='{$cat_dir}', telefono='{$cat_tel}' ";
       $sql .= " WHERE id='{$categorie['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Líder actualizado(a) con éxito.");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('categorie.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php',false);
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
           <span>Editando <?php echo remove_junk(ucfirst($categorie['nombre_completo']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_lider.php?id=<?php echo (int)$categorie['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="lider-name" value="<?php echo remove_junk(ucfirst($categorie['nombre_completo']));?>"><br>
               <input type="number" class="form-control" name="lider-cedula" value="<?php echo remove_junk(ucfirst($categorie['Cedula']));?>"><br>
               <input type="text" class="form-control" name="zona-lider" value="<?php echo remove_junk(ucfirst($categorie['zona_votacion']));?>"><br>
               <input type="number" class="form-control" name="mesa-lider" value="<?php echo remove_junk(ucfirst($categorie['mesa']));?>"><br>
               <input type="text" class="form-control" name="dir-lider" value="<?php echo remove_junk(ucfirst($categorie['direccion']));?>"><br>
               <input type="number" class="form-control" name="tel-lider" value="<?php echo remove_junk(ucfirst($categorie['telefono']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Actualizar Lider</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
