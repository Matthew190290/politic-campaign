<?php
  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // checkar que nivel de usuario tiene permiso de acceso 
  page_require_level(1);
   
?>
<?php
$totals= total_expenses('expenses');
 $c_categorie     = count_by_id('lideres');
 $c_product       = count_by_id('votantes');
 $c_sale          = count_by_id('expenses');
 $c_user          = count_by_id('users');
 // $products_sold   = find_higest_saleing_product('10');
  $recent_liders = find_recent_product_added('5');
 $recent_voters    = find_recent_voter_added('5');
 
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Usuarios</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-hand-up"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Lideres</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Votantes</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <?php foreach ($totals as $total):?>
          <h2 class="margin-top"><?php echo number_format($total['pagos']); ?></h2>
        <?php endforeach; ?>  
          <p class="text-muted">Gastos</p>
        </div>
       </div>
    </div>
</div>

  <div class="row">
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>VOTANTES RECIENTEMENTE AGREGADOS</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Votante</th>
           <th>Cedula</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_voters as  $recent_voter): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_votante.php?id=<?php echo (int)$recent_voter['id']; ?>">
             <?php echo remove_junk(first_character($recent_voter['nombre_vot'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_voter['cedula_vot'])); ?></td>
           
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4 pull-right">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lideres recientemente añadidos</span>
        </strong>
      </div>
      <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Líder</th>
           <th>Cedula</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_liders as  $recent_lid): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_lider.php?id=<?php echo (int)$recent_lid['id']; ?>">
             <?php echo remove_junk(first_character($recent_lid['nombre_completo'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_lid['cedula'])); ?></td>
           
        </tr>

       <?php endforeach; ?>
       </tbody>

    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
