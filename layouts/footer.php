     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  
  <script>
          function pepitojimenez(){
          var fecha= new Date();
          var horas= fecha.getHours();
          var minutos = fecha.getMinutes();
          var segundos = fecha.getSeconds();
          document.getElementById('cabecera').innerHTML=''+horas+':'+minutos+':'+segundos+'';
          setTimeout('pepitojimenez()',1000);
          }
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/w/bs4/dt-1.10.18/b-1.5.6/b-flash-1.5.6/datatables.min.js"></script>
  <script>
    $('#grid').DataTable({

                language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
              
            }
      }); 
  </script>
  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
