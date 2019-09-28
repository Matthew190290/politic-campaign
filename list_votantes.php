<?php
  $page_title = 'Lista de Votantes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
 $results=join_student_table();
 $categorie = find_by_id('lideres',(int)$_GET['id']);
 $cant_votantes = voters_by_lider('lideres', (int)$_GET['id']);
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">  
          <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Lista de votantes de <?php echo remove_junk(ucfirst($categorie['nombre_completo']));?></span>
            <div class=" pull-right">
              <?php foreach ($cant_votantes as $cant):?>
              <div>
                <p>Total Votantes Por lider: <?php echo number_format($cant['voter_cant']); ?></p>
              </div>
              <?php endforeach; ?>
            </div>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 1%;">#</th>
                <th class="text-center" style="width: 10%;">Nombre Votantes</th>
                <th class="text-center" style="width: 10%;">Cedula</th>
                <th class="text-center" style="width: 10%;">Zona</th>
                <th class="text-center" style="width: 10%;">Mesa</th>
                <th class="text-center" style="width: 10%;">Direccion</th>
                <th class="text-center" style="width: 10%;">Telefono</th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $data):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>

                <td class="text-center"><?php echo remove_junk($data['nombre_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk($data['cedula_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk($data['zona_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk($data['mesa_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk($data['direccion_vot']); ?></td>
                <td class="text-center"><?php echo remove_junk($data['telefono_vot']); ?></td>
               
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>



<?php include_once('layouts/footer.php'); ?>