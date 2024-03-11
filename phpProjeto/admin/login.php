<?php

  include("../assets/includes/validacao.php")

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jornal & Cinema | Login</title>

  <?php include("../assets/includes/head.php"); ?>
  

</head>
<body class="hold-transition login-page">
<div class="login-box" >
  <div class="login-logo">
    
    <b>S.J</b>NEWS</a>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Faça seu login para iniciar a Sessão</p>
      
      <form action="valida_login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Lembrar
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <p class="mb-1">
        <a href="../admin/recover/forgot-password.php">Esqueci minha senha</a>
      </p>
      <p class="mb-1">
        <a href="cadastre-se.php">Criar Conta</a>
      </p>
      
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php include("../assets/includes/scripts.php"); ?>

</body>
</html>
