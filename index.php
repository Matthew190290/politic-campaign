<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<style>
  body{
    text-align: center;
    color: #fff;
    font-family: sans-serif;
  }
  .login-page{
    display: inline-block;
    background-color: rgba(0,0,0,.8);
    padding: 37px;
    border-radius: 8px;
  }
  .form-control{
    margin: 10px;
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    width: 100%;
    color: white;
    font-size: 15px;

  }


img{
  width: 80px;
  height: 80px;
}
button{
  width: 100%;
  margin-left: 10px;
  margin-top: 20px;
  padding: 10px;
  border:none;
  background: #5FCECA;
  color: white;
  border-radius: 20px;
  font-weight: bold;

}
button:hover{
  background: #0088ff;
}
</style>
<body style="background-image: url(assets/img/890117.jpg); background-size: cover;">
  <div class="row text-center">
    <div class="row-fluid">
       <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3" style="margin-top: 100px;" >
        <div class="panel-login">
        <div class="container">
        <div class="login-page" >
           <?php echo display_msg($msg); ?>
            <form method="post" action="auth.php" class="clearfix">
          <div class="text-center leters">
              <img src="assets/img/login.png" alt="">
             <h1>Bienvenidos</h1>
             <h2>a la Familia Sarmientista</h2>
             <p>Iniciar Sesión </p>
           </div>
              <div class="form-group">
                    <input type="name"  class="form-control" name="username" placeholder="Usario">
              </div>
              <div class="form-group">
              
                  <input type="password" name= "password" class="form-control" placeholder="Contraseña">
              </div>
              <div class="form-group">
                      <button type="submit" class="btn btn-info ">Entrar</button>
              </div>
          </form>
      </div>
      </div>
      </div>
    </div>
      
    </div>
    
  </div>
<?php include_once('layouts/footer.php'); ?>

</body>
</html>
