<?php
//echo "<pre>SESSION";
//print_r($_SESSION);
//echo "</pre>";
//echo "<pre>REQUEST";
//print_r($_REQUEST);
//echo "</pre>";


if (isset($_SESSION['usuario']))
{
//    echo "existe session";
?>

    <form method="post" id="formIniSesForeing">
        <div class="form-group">
            <input type="hidden" name="ingUsuario" class="form-control" placeholder="Usuario" value="<?php echo $_SESSION['usuario'];?>">
        </div>

        <div class="form-group mb-4">
            <input type="hidden" name="ingPassword" class="form-control" placeholder="passsword" value="<?php echo $_SESSION['xxx'];?>">
        </div>
<!--        <button type="submit" class="btn btn-primary btn-block ">Entrar</button>-->
        <?php
        $login = new ControladorUsuarios();
        $login ->ctrIngreso();
        ?>
    </form>

    <script>

        $("#formIniSesForeing").submit();


    </script>
<?php
}
else
{

?>

<style>
body {
  font-family: "Karla", sans-serif;
  background-color: #fff;
  min-height: 100vh; }

.brand-wrapper {
  padding-top: 7px;
  padding-bottom: 8px; }
  .brand-wrapper .logo {
    width: 90%; }

.login-section-wrapper {
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
  padding: 68px 100px;
  background-color: #fff; }
  @media (max-width: 991px) {
    .login-section-wrapper {
      padding-left: 50px;
      padding-right: 50px; } }
  @media (max-width: 575px) {
    .login-section-wrapper {
      padding-top: 20px;
      padding-bottom: 20px;
      min-height: 100vh; } }

.login-wrapper {
  width: 300px;
  max-width: 100%;
  padding-top: 24px;
  padding-bottom: 24px; }
  @media (max-width: 575px) {
    .login-wrapper {
      width: 100%; } }
  .login-wrapper label {
    font-size: 14px;
    font-weight: bold;
    color: #b0adad; }
  .login-wrapper .form-control {
    border: none;
    border-bottom: 1px solid #e7e7e7;
    border-radius: 0;
    padding: 9px 5px;
    min-height: 40px;
    font-size: 18px;
    font-weight: normal; }
    .login-wrapper .form-control::-webkit-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::-moz-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control:-ms-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::-ms-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::placeholder {
      color: #b0adad; }
  .login-wrapper .login-btn {
    padding: 13px 20px;
    background-color: #fdbb28;
    border-radius: 0;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    margin-bottom: 14px; }
    .login-wrapper .login-btn:hover {
      border: 1px solid #fdbb28;
      background-color: #fff;
      color: #fdbb28; }
  .login-wrapper a.forgot-password-link {
    color: #080808;
    font-size: 14px;
    text-decoration: underline;
    display: inline-block;
    margin-bottom: 54px; }
    @media (max-width: 575px) {
      .login-wrapper a.forgot-password-link {
        margin-bottom: 16px; } }
  .login-wrapper-footer-text {
    font-size: 16px;
    color: #000;
    margin-bottom: 0; }

.login-title {
  font-size: 30px;
  color: #000;
  font-weight: bold;
  margin-bottom: 25px; }

.login-img {
  width: 100%;
  height: 100vh;
  -o-object-fit: cover;
     object-fit: cover;
  -o-object-position: left;
     object-position: left; }
</style>

<?php
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//session_destroy();

?>


  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="vistas/img/logoRotoplas.png" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Inicio de sesión</h1>
            <form action="" method="post">
              <div class="form-group">
                <input type="text" name="ingUsuario" class="form-control" placeholder="Usuario">
              </div>
              <div class="form-group mb-4">
                <input type="password" name="ingPassword" class="form-control" placeholder="passsword">
              </div>
              <button type="submit" class="btn btn-primary btn-block simulaLogin">Entrar</button>
        <?php
          $login = new ControladorUsuarios();
          $login ->ctrIngreso();
        ?>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="vistas/img/Imagen3.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
<?php
}
?>
<!--<script>-->
<!--    $(".simulaLogin").click(function(){-->
<!--        window.location.href = "usuarios";-->
<!---->
<!--    });-->
<!--</script>-->
