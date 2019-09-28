<?php
  $page_title = 'Inscripcion de Votantes';
  require_once('includes/load.php');
  // permisos de nivel de usuario
  page_require_level(3);
  $votes = total_voters('votantes');
  $datas= join_product_table();
  $all_categories = find_all('lideres')
?>
<?php
 if(isset($_POST['add_vot'])){
   $req_field = array('vot-name');
   $req_field = array('vot-cedula');
   $req_field = array('zona-vot');
   $req_field = array('mesa-vot');
   $req_field = array('dir-vot');
   $req_field = array('tel-vot');
   $req_field = array('select_lider');

   validate_fields($req_field);
   $vot_name = $_POST['vot-name'];
   $vot_ced = $_POST['vot-cedula'];
   $vot_zone = $_POST['zona-vot'];
   $vot_mesa = $_POST['mesa-vot'];
   $vot_dir = $_POST['dir-vot'];
   $vot_tel = $_POST['tel-vot'];
   $lider_select = $_POST['select_lider'];

   if(empty($errors)){
      $sql  = "INSERT INTO votantes (nombre_vot, cedula_vot, zona_vot, mesa_vot, direccion_vot, telefono_vot, lider_id)";
      $sql .= " VALUES ('{$vot_name}', '{$vot_ced}', '{$vot_zone}', '{$vot_mesa}', '{$vot_dir}','{$vot_tel}', '{$lider_select}')";
      if($db->query($sql)){
        $session->msg("s", "Votante agregado exitosamente.");
        redirect('add_votantes.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('add_votantes.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('add_votantes.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
   <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 Agregar Votantes
</button><br><br>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #09c4e8;">
        <strong>
        <span class="glyphicon glyphicon-th"></span>
        <h4 class="modal-title" style="display: contents;">Inscribir Votante</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </strong>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="vot_name">
        <form method="post" action="add_votantes.php">
            <div class="form-group">
              
                <input type="text" class="form-control" name="vot-name"  placeholder="Nombre Completo del Votante" required><br>
                <input type="number" class="form-control" name="vot-cedula" placeholder="cedula" required><br>
                <input type="text" class="form-control" name="zona-vot" placeholder="Zona de Votación" required><br>
                <input type="number" class="form-control" name="mesa-vot" placeholder="Mesa " required><br>
                <input type="text" class="form-control" name="dir-vot" placeholder="Direccion" required><br>
                <input type="number" class="form-control" name="tel-vot" placeholder="Telefono" required><br>
                 <div >
                    <select class="form-control" name="select_lider">
                      <option value="">Selecciona un lider</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['nombre_completo'] ?></option>
                    <?php endforeach; ?>
                    </select><br>
                  </div>
            </div>
            <button type="submit" name="add_vot" class="btn btn-primary">Agregar Votantes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
   
   <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Votantes</span>
          <div class=" pull-right">
          <?php foreach ($votes as $vote):?>
          <div>
            <p>Total votantes: <?php echo number_format($vote['voters']); ?></p>
          </div>
          <?php endforeach; ?>
          </div>
       </strong>
       </strong>
        </div>
        <div class="panel-body">
          <table class="table  table-hover" id="grid">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" >Nombre Votante</th>
                <th class="text-center" >Cedula</th>
                <th class="text-center" >Zona de votacion</th>
                <th class="text-center" >Mesa</th>
                <th class="text-center" >Direccion</th>
                <th class="text-center" >Telefono</th>
                <th class="text-center" >Líder</th> 
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datas as $data):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>

                <td class="text-center"> <?php echo remove_junk(ucwords($data['nombre_vot'])); ?></td>
                <td class="text-center"> <?php echo remove_junk($data['cedula_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk(ucwords($data['zona_vot'])); ?></td>
                <td class="text-center"> <?php echo remove_junk($data['mesa_vot']); ?></td>
                <td class="text-center"> <?php echo remove_junk(ucwords($data['direccion_vot'])); ?></td>
                <td class="text-center"> <?php echo remove_junk($data['telefono_vot']); ?></td>
                <td class="text-center"> <?php echo remove_junk(ucwords($data['nombre_completo'])); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_votante.php?id=<?php echo (int)$data['id'];?>" class="btn btn-info btn-xs"  title="Editar votante" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?id=<?php echo (int)$data['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
  <?php include_once('layouts/footer.php'); ?>