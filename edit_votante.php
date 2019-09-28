<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php

$votantes = find_by_id('votantes',(int)$_GET['id']);
$lideres = find_by_id('lideres',(int)$_GET['id']);
$all_categories = find_all('lideres');
if(!$votantes){
  $session->msg("d","Missing product id.");
  redirect('add_votantes.php');
}
?>
<?php
 if(isset($_POST['edit_vot'])){
    $req_field = array('nombre_votante');
   $req_field = array('cedula_votante');
   $req_field = array('zona_votante');
   $req_field = array('mesa_votante');
   $req_field = array('direccion_votante');
   $req_field = array('telefono_votante');
   $req_field = array('select_lider');

   validate_fields($req_field);
   $vot_name = remove_junk($db->escape($_POST['nombre_votante']));
   $vot_ced = remove_junk($db->escape($_POST['cedula_votante']));
   $vot_zone = remove_junk($db->escape($_POST['zona_votante']));
   $vot_mesa = remove_junk($db->escape($_POST['mesa_votante']));
   $vot_dir = remove_junk($db->escape($_POST['direccion_votante']));
   $vot_tel = remove_junk($db->escape($_POST['telefono_votante']));
   $lider_select = remove_junk($db->escape($_POST['select_lider']));
   
   if(empty($errors)){
       $query   = "UPDATE votantes SET";
       $query  .=" nombre_vot='{$vot_name}', cedula_vot='{$vot_ced}', zona_vot='{$vot_zone}', mesa_vot='{$vot_mesa}', direccion_vot='{$vot_dir}',  telefono_vot='{$vot_tel}', lider_id='{$lider_select}' ";
       $query  .=" WHERE id='{$votantes['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Registro ha sido actualizado. ");
                 redirect('add_votantes.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_votante.php?id='.$votantes['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_votante.php?id='.$votantes['id'], false);
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
           <span>Editando <?php echo remove_junk(ucfirst($votantes['nombre_vot']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_votante.php?id=<?php echo (int)$votantes['id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="nombre_votante" value="<?php echo remove_junk(ucfirst($votantes['nombre_vot']));?>"><br>
               <input type="text" class="form-control" name="cedula_votante" value="<?php echo remove_junk(ucfirst($votantes['cedula_vot']));?>"><br>
        
              
               <input type="text" class="form-control" name="zona_votante" value="<?php echo remove_junk(ucfirst($votantes['zona_vot']));?>"><br>
               <input type="number" class="form-control" name="mesa_votante" value="<?php echo remove_junk(ucfirst($votantes['mesa_vot']));?>"><br>
               <input type="text" class="form-control" name="direccion_votante" value="<?php echo remove_junk(ucfirst($votantes['direccion_vot']));?>"><br>
               <input type="number" class="form-control" name="telefono_votante" value="<?php echo remove_junk(ucfirst($votantes['telefono_vot']));?>"><br>

                  <select class="form-control" name="select_lider">
                      <option value="">Selecciona un lider</option>
                        <?php  foreach ($all_categories as $cat): ?>                    
                      <option <?php if($cat['id'] === $votantes['lider_id']) echo 'selected="selected"' ?> value="<?php echo $cat['id'] ?>">
                        <?php echo $cat['nombre_completo'] ?></option>
                    <?php endforeach; ?>
                  </select><br>
           </div>
           <button type="submit" name="edit_vot" class="btn btn-primary">Actualizar Registro</button>
       </form>
       </div>
     </div>
   </div>
</div>


<?php include_once('layouts/footer.php'); ?>
