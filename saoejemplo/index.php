<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link href="css/style.css" rel="stylesheet" id="bootstrap-css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script language="JavaScript">

  function validarE(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13) 
      {
        document.formLogin.action = "index.php";
      document.formLogin.submit();
      }
  }

  function validarEU(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13) 
      {
      document.getElementById("contra").focus();
      }
  }

  function valida()
  { 
    var usuario = document.formLogin.usuario.value;
    var contrasena = document.formLogin.contra.value;
    if (usuario == "" || contrasena == "")
      document.getElementById("mensajes").innerHTML = 'Introduzca datos de acceso';
    else
    { 
      document.formLogin.action = "index.php";
      document.formLogin.submit();
    }
  }
  </script>
</head>

<body>

<div class="top">

</div>

<?php
$validar = $_REQUEST["validar"];


if($validar == 'S')
{
  require_once("includes/validar.inc.php");
  
  $obj_validar = new Validar;
  $obj_validar2 = new Validar;
  
  $usuario = trim($_REQUEST["usuario"]);
  $contrasena = trim($_REQUEST["contra"]);
  
  $active = $obj_validar->active($usuario);
  
  if($active == 'S')
  {
    ///valida con active
    require_once("includes/loginAC.inc.php");
    $login = new LoginAD;
    
    //echo 'entro - ';

    $result = $login->autentica($usuario, $contrasena);
    
    //echo $result;
    if($result == 1)
    {
      //echo '<br>entro 2';
      $datosU = $obj_validar->datos_usuario($usuario); 
      if(count($datosU)>0)
      {
        foreach($datosU as $dat)
        {
          $id_usuario = $dat->id;
          $usuario = $dat->usuario;
          $id_perfil = $dat->id_perfil;
          //$nombre = $dat->nombre;
          //echo '<br>entro 3';
        }
        
        $_SESSION["id_usuario"] = $id_usuario;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["id_perfil"] = $id_perfil;
        //$_SESSION["nombre"] = $nombre;

        $obj_validar2->registra_acceso($id_usuario);
        
        echo '<script>window.location ="inicio.php";</script>';
      }
      else
        $msg = "Los datos son incorrectos, intente de nuevo";
    }
    else
      $msg = "Los datos son incorrectos, intente de nuevo";
  }
  else
  {
    $contrasena = md5($contrasena);

    ///valida sin active
    $datosU = $obj_validar->login($usuario, $contrasena); 
    foreach($datosU as $dat)
    {
      $id_usuario = $dat->id;
      
      if($id_usuario > 0)
      {
        $usuario = $dat->usuario;
        $id_perfil = $dat->id_perfil;
        //$nombre = $dat->nombre;

        if($id_usuario == 1)
        {
          $id_usuario = 1040;
          $usuario = 'brojas';
          $id_perfil = 1;
        }
        
        $_SESSION["id_usuario"] = $id_usuario;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["id_perfil"] = $id_perfil;
        //$_SESSION["nombre"] = $nombre;

        $obj_validar2->registra_acceso($id_usuario);
        
        if($usuario == 'pablo')
          echo '<script>window.location ="inicio.php";</script>';
        else
          echo '<script>window.location ="inicio.php";</script>';
      }
      else
        $msg = "Los datos son incorrectos, intente de nuevo";
    }
  }
}
?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first">
      <img src="img/logo.png" id="icon" class="logo_login" /><br/><br/>

      <span style="color:gray;">Puedes accesar con el usuario <br/>de tu correo electrónico (sin el @rotoplas.com) <br/>y la contraseña de Windows.</span>

      <br/><br/>
      
    </div>

    <form name="formLogin" id="formLogin" action="" method="post">
      <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Usuario">
      <input type="password" id="contra" class="fadeIn third" name="contra" placeholder="Contraseña">
      <input type="submit" class="fadeIn fourth" value="Entrar" class="btn_entrar" onClick="javascript:valida()">
      <input type="hidden" name="validar" id="validar" value="S">

      <?php
      echo "<div id='mensajes' style='text-align: center; color: #000'>".$msg."</div>";
      ?>
    </form>

  </div>
</div>

<div class="foot">
  
</div>

</body>
</html>