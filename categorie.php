<?php
  $page_title = 'Lista de Líderes';
  require_once('includes/load.php');
  page_require_level(3);
 
 $lead = total_leader('lideres');
  $all_categories = find_all('lideres');
?>
<?php
 if(isset($_POST['add_cat'])){
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
      $sql  = "INSERT INTO lideres (nombre_completo, cedula, zona_votacion, mesa, direccion, telefono)";
      $sql .= " VALUES ('{$cat_lider}', '{$cat_ced}', '{$cat_zone}', '{$cat_mesa}', '{$cat_dir}', '{$cat_tel}')";
      if($db->query($sql)){
        $session->msg("s", "Líder agregado exitosamente.");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>


  <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 Agregar Líder
</button><br><br>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #09c4e8;">
        <strong>
        <span class="glyphicon glyphicon-th"></span>
        <h4 class="modal-title" style="display: contents;">Inscribir Líder</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </strong>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="categorie.php">
            <div class="form-group">
              
                <input type="text" class="form-control" name="lider-name" placeholder="Nombre Completo del lider" required><br>
                <input type="number" class="form-control" name="lider-cedula" placeholder="cedula" required><br>
                <input type="text" class="form-control" name="zona-lider" placeholder="Zona de Votación" required><br>
                <input type="number" class="form-control" name="mesa-lider" placeholder="Mesa " required><br>
                <input type="text" class="form-control" name="dir-lider" placeholder="Direccion" required><br>
                <input type="number" class="form-control" name="tel-lider" placeholder="Telefono" required>
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Agregar Lider</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
      

    </div>
  </div>
</div>
   <div class="row">
 
    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Líderes</span>
          <div class=" pull-right">
          <?php foreach ($lead as $lid):?>
          <div>
            <p>Total Líderes: <?php echo number_format($lid['cant']); ?></p>
          </div>
          <?php endforeach; ?>
          </div>
       </strong>
      </div>
        <div class="panel-body">
          <table  id="grid" class="table  table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" >#</th>
                    <th class="text-center">Nombre completo</th>
                    <th class="text-center">cedula</th>
                    <th class="text-center">Zona votacion</th>
                    <th class="text-center">Mesa</th>
                    <th class="text-center" >Direccion</th>
                    <th class="text-center" >telefono</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo remove_junk(ucfirst($cat['id'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucwords($cat['nombre_completo'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($cat['Cedula'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucwords($cat['zona_votacion'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($cat['mesa'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucwords($cat['direccion'])); ?></td>
                    <td class="text-center"><?php echo remove_junk(ucfirst($cat['telefono'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_lider.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_lider.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        <a href="list_votantes.php?id=<?php echo (int)$cat['id'];?>"  style="padding: 1px 5px; height: 22px;" class="btn btn-primary" data-toggle="tooltip" title="Ver Votantes"><span class="glyphicon glyphicon-eye-open" style="font-size: 12px;" ></span>
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
