<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
//foreach ($_SESSION['paisesDivisiones'] as $paisesDiv)
//{
//
//    print_r($paisesDiv->pais);
//
//}
  if($_SESSION['id_perfil']==1)
  {
      $_SESSION['cod_division']='TODAS';
  }
//$_SESSION['pais']='Argentina';
//$_SESSION['id_perfil']=5;
 $paisSES=$_SESSION['pais'];
 $idperfilSES=$_SESSION['id_perfil'];
    if($_SESSION['resetear_pass'])
    {
    ?>
            <section>
                <div id="divCambiarContraseña" align="center">
                    <br>
                    <a  data-toggle="modal" data-target="#modalContraseña">
                        <div class="img"><img src="vistas/img/Restablecerpass.png" width="10%" height="10%"></div>
                        <div class="info"><h3>Restablecer Contrseña</h3></div>
                    </a>
                </div>
            </section>
        <!-- Modal -->
        <div class="modal fade" id="modalContraseña" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-m" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                            <span aria-hidden="true">&times;</span>-->
<!--                        </button>-->
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <span>Contraseña</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                </div>
                                <input type="password" class="form-control input-lg" name="pass1" id="pass1" placeholder="Contraseña" required >
                            </div>
                        </div>
                        <!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Confirmar Contraseña</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                </div>
                                <input type="password" class="form-control input-lg" name="pass2" id="pass2" placeholder="Confirmar Contraseña" required >
                            </div>
                        </div>
                        <!-- ./ form-gruop-->

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-primary cambiarContraseña" idUsuario="<?php echo $_SESSION['id'];?>" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
                    </div>

                </div>
            </div>
        </div>


        <script>
            $("#modalContraseña").modal("show");
            $('#modalContraseña').modal({backdrop: 'static', keyboard: false})

            $(".cambiarContraseña").click(function()
            {


                var pass1 = $("#pass1").val();
                var pass2 = $("#pass2").val();
                if (pass1!=pass2)
                {
                    Swal.fire({
                        title: '¡Las constraseñas no coinciden',
                        icon: 'error',
                        // showCancelButton: true,
                        confirmButtonColor: '#d33',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'Enterado'
                    });
                }
                else
                {

                    var idUsuario = $(this).attr("idUsuario");
                    var dataForm = new FormData();
                    var funcion="resetPassUser";
                    dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
                    dataForm.append("idUsuario", idUsuario);//PARA MANDARLO A LA VARIABLE datos
                    dataForm.append("pass", pass2);//PARA MANDARLO A LA VARIABLE datos



                    Swal.fire({
                        title: '¡Estas seguro que deseas cambiar la contraseña?',
                        text: "Si no es asi puedes presionar el boton cancelar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si'
                    }).then((result) => {
                        if (result.value) {
                            // window.location = "usuarios";

                            $.ajax({
                                url:"ajax/usuarios.ajax.php",
                                method: "POST",
                                data: dataForm,
                                async: true,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function(respuesta)
                                {
                                    if (respuesta=="ok")
                                    {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: '¡Listo!',
                                            icon: 'success',
                                            confirmButtonText:'Ok'
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = 'salir';
                                            }
                                        });
                                    }
                                    else
                                    {
                                        Swal.fire({
                                            title: 'Warning!',
                                            text: '¡Se presento un error, intente de nuevo!',
                                            icon: 'warning',
                                            confirmButtonText:'Ok'
                                        }).then((result)=>{
                                            if(result.value){
                                                location.reload();
                                            }
                                        });
                                    }

                                },
                                error : function(respuesta)
                                {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: '¡error al guardar!',
                                        icon: 'error',
                                        confirmButtonText:'Ok'
                                    });
                                }

                            });

                        }
                    });
                }

            });


        </script>






    <?php
    }
    else
    {


?>


<style>
    @media (min-width: 768px) {
  .col-sm-7 {
    float: left;
    width: 14.28%;
  }
}

@media (min-width: 992px) {
  .col-md-7 {
    float: left;
    width: 14.28%;
  }
}

@media (min-width: 1200px) {
  .col-lg-7 {
    float: left;
    width: 14.28%;
  }
}

    .conte{
        border: 1px solid #000;
    }
    .titulo{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #009CDE;
    }
    .titulo-2{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #2b6193;
    }
    .titulo-3{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #d56636;
    }
    .titulo-4{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #81b951;
    }
    .titulo-5{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #803b91;
    }
    .titulo-6{
        font-size: 20px;
        color: #fff;
        text-align: center;
        background-color: #cf3f4c;
    }



    
.ih-item {
  position: relative;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.ih-item,
.ih-item * {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.ih-item a {
  color: #333;
}
.ih-item a:hover {
  text-decoration: none;
}
.ih-item img {
  width: 100%;
  height: 100%;
}

.ih-item.square {
  position: relative;
  width: 300px;
  height: 200px;
  border: 8px solid #f4f4f4;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}
.ih-item.square .info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  text-align: center;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.ih-item.square.effect7 {
  overflow: hidden;
}
.ih-item.square.effect7.colored .info {
  background: #1a4a72;
  background: rgba(26, 74, 114, 0);
}
.ih-item.square.effect7.colored .info h3 {
  background: rgba(12, 34, 52, 1);
}
.ih-item.square.effect7 .img {
    filter:grayscale(0%);
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
}
.ih-item.square.effect7 .info {
  background: #333333;
  background: rgba(0, 0, 0, 0.6);
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.ih-item.square.effect7 .info h3 {
  text-transform: uppercase;
  color: #fff;
  text-align: center;
  font-size: 17px;
  padding: 10px;
  background: #111111;
  margin: 0;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
  -webkit-transition: all 0.35s 0.1s ease-in-out;
  -moz-transition: all 0.35s 0.1s ease-in-out;
  transition: all 0.35s 0.1s ease-in-out;
}
.ih-item.square.effect7 a:hover .img {
    filter:grayscale(100%);
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
  -o-transform: scale(1.2);
  transform: scale(1.2);
}
.ih-item.square.effect7 a:hover .info {
  background: #1a4a72;
  background: rgba(26, 74, 114, 0.6);
  visibility: visible;
  opacity: 1;
}
.ih-item.square.effect7 a:hover .info h3,
.ih-item.square.effect7 a:hover .info p {
  background: rgba(12, 34, 52, 0.5);
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(100%);
}
.mt-3{
  margin: 3px;
}



.nota{
    position: absolute;
    right: 0;
    top:0;
    z-index: 99999;
    background-color: red;
    padding: 10px;
    color: #fff;
    font-size: 11px;
    border-bottom-left-radius: 10px;
    box-shadow: -1px 1px 3px #000;
    display: none;
}
.nota i{
    margin-right: 5px;
}
.esp{
    left: 20px;
}













</style>



    <br>
    <div class="container-fluid d-flex justify-content-end">
        <div class="col-md-12">
        	<img src="vistas/img/Imagen2.jpg" style="width: 100%">
        </div>
    </div>

    <br>
<?php
if ($paisSES=='Mexico')
{
    if ($idperfilSES==1 || $idperfilSES==2 || $idperfilSES==6)
    {


?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [1.-admin,2.-gerente CH,6.-Gerente Regional] -->



        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp">
                                <a href="sindicatospais">
                                    <div class="img"><img src="vistas/modulos/01/1.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[176];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp">
                                <a href="pliegos">
                                    <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[177];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp ">
                                <a href="minutas">
                                    <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[178];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <?php
                        $borderPago="";
                        if ($_SESSION['id_perfil']!=1)
                        {
                            $res=ControladorPagos::ctrAlertaPagosPendientes($_SESSION['divisiones']);
//                            echo "<pre>";
//                            print_r($res);
//                            print_r(count($res));
//
//                            echo "</pre>";

                            if($res>0)
                            {
                                $borderPago='style="display: inline;"';
                                $pendientesPago=count($res);
                            }
                            else
                            {
                                $pendientesPago="";

                            }
                        }
                        else
                        {
                            $res=ControladorPagos::ctrAlertaPagosPendientes("");
//                            echo "<pre>";
//                            print_r($res);
//                            print_r(count($res));
//
//                            echo "</pre>";
                            if($res>0)
                            {
                                $borderPago='style="display: inline;"';
                                $pendientesPago=count($res);

                            }

                        }
                        ?>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp">
                                <div class="nota"<?php echo $borderPago;?>><i class="fas fa-question-circle"></i>Pendiente</div>
                                <a href="calendario">
                                    <div class="img"><img src="vistas/modulos/01/4.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[179];?> </h3></div>

                                </a>
                            </div>
                        </div>

                        <?php
                        $borderNeg="";
                        if ($_SESSION['id_perfil']!=1)
                        {
                            $res2=ControladorNegociaciones::ctrAlertaNegociacionesPendientes($_SESSION['divisiones']);
//                            echo "<pre>";
//                            print_r($res2);
//                            print_r(count($res2));
//
//                            echo "</pre>";

                            if($res2>0)
                            {
                                $borderNeg='style="display: inline;"';
                                $pendientesNeg=count($res2);
                            }
                            else
                            {
                                $pendientesNeg="";

                            }
                        }
                        else
                        {
                            $res2=ControladorNegociaciones::ctrAlertaNegociacionesPendientes("");
//                            echo "<pre>";
//                            print_r($res2);
//                            print_r(count($res2));
//
//                            echo "</pre>";
                            if($res2>0)
                            {
                                $borderNeg='style="display: inline;"';
                                $pendientesNeg=count($res2);

                            }

                        }
                        ?>
                        <div class="col-xs-3 mt-3" >
                            <div class="ih-item square colored effect7 esp ">
                                <div class="nota"<?php echo $borderNeg;?>><i class="fas fa-question-circle"></i>Pendiente</div>
                                <a href="negociaciones">
                                    <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[180];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp">
                                <a href="valuaciones">
                                    <div class="img"><img src="vistas/modulos/01/6.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[182];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3 mt-3">
                            <div class="ih-item square colored effect7 esp">
                                <a  data-toggle="modal" data-target="#modalHistorico">
                                    <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[183];?></h3></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row mb-4" align="center">
                    <div class="col-md-4 ">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-3"><?php echo $textosArray[186];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="revisiones">
                                    <div class="img"><img src="vistas/modulos/01/9.jpg" alt="img"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-4"><?php echo $textosArray[109];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="multas">
                                    <div class="img"><img src="vistas/modulos/01/10.jpg" alt="img"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-6"><?php echo $textosArray[188];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="consecuencias">
                                    <div class="img"><img src="vistas/modulos/01/11.jpg" alt="img"></div>
                                </a>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-8 mt-4">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="titulo-5">RIT / <?php echo $textosArray[189];?></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ih-item square colored effect7">
                                        <!-- <a href="rit"> -->
                                        <a href="ritpais">
                                            <div class="img"><img src="vistas/modulos/01/12.jpg" alt="img"></div>
                                            <div class="info"><h3>RIT</h3></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ih-item square colored effect7">
                                        <a href="comisiones">
                                            <div class="img"><img src="vistas/modulos/01/13.jpg" alt="img"></div>
                                            <div class="info"><h3><?php echo $textosArray[189];?></h3></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </section>

<?php
    }
    elseif ($idperfilSES==3)
    {
        ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [3.- Sindicato] -->


        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="pliegos">
                                    <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[177];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="minutas">
                                    <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[178];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="negociaciones">
                                    <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[180];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7">
                                <a  data-toggle="modal" data-target="#modalHistorico">
                                    <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[182];?></h3></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>



        <?php
    }
    elseif ($idperfilSES==4)
    {
        echo " ";
    ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [4.- Abogado General] -->
        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="sindicatospais">
                                    <div class="img"><img src="vistas/modulos/01/1.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[176];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="pliegos">
                                    <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[177];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="minutas">
                                    <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[178];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="negociaciones">
                                    <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[180];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7">
                                <a  data-toggle="modal" data-target="#modalHistorico">
                                    <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[182];?></h3></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 mt-4">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="titulo-5">RIT / <?php echo $textosArray[189];?></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ih-item square colored effect7">
                                        <a href="ritpais">
                                            <div class="img"><img src="vistas/modulos/01/12.jpg" alt="img"></div>
                                            <div class="info"><h3>RIT</h3></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ih-item square colored effect7">
                                        <a href="comisiones">
                                            <div class="img"><img src="vistas/modulos/01/13.jpg" alt="img"></div>
                                            <div class="info"><h3><?php echo $textosArray[189];?></h3></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </section>



    <?php

    }
    elseif ($idperfilSES==5)
    {
        echo "";
    ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [5.- Abogado Local] -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>



    <?php
    }
    elseif ($idperfilSES==7)
    {
      ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [7.- Pagos] -->

        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>

                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="calendario">
                                    <div class="img"><img src="vistas/modulos/01/4.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[179];?></h3></div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <?php
    }
}
elseif ($paisSES=='Argentina')
{
    if ($idperfilSES==2 || $idperfilSES==6)
    {




?>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Argentina[2.- Gerente CH] -->
        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="sindicatospais">
                                    <div class="img"><img src="vistas/modulos/01/1.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[176];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="pliegos">
                                    <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[177];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="minutas">
                                    <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[178];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="negociaciones">
                                    <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[180];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7">
                                <a  data-toggle="modal" data-target="#modalHistorico">
                                    <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[182];?></h3></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-3"><?php echo $textosArray[186];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="revisiones">
                                    <div class="img"><img src="vistas/modulos/01/9.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-4"><?php echo $textosArray[109];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="multas">
                                    <div class="img"><img src="vistas/modulos/01/10.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-6"><?php echo $textosArray[188];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="consecuencias">
                                    <div class="img"><img src="vistas/modulos/01/11.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>



        <?php
    }
    elseif ($idperfilSES==3)
    {
     ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Argentina [3.- Sindicato] -->


        <section class="content">
            <div class="container-fluid">

                <div class="conte mb-4" style="background-color: #f4f4f4;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titulo"><?php echo $textosArray[176];?></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7">
                                <a href="pliegos">
                                    <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[177];?></h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="minutas">
                                    <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[178];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7 ">
                                <a href="negociaciones">
                                    <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[180];?></h3></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-3 mt-3">
                            <div class="ih-item square colored effect7">
                                <a  data-toggle="modal" data-target="#modalHistorico">
                                    <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                                    <div class="info"><h3><?php echo $textosArray[182];?></h3></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>




        <?php
    }
    elseif ($idperfilSES==5)
    {
        ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Argentina [5.- Abogado Local] -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <?php
    }

}
else
{
    if ($idperfilSES==2)
    {



?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Resto de paises -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-3"><?php echo $textosArray[186];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="revisiones">
                                    <div class="img"><img src="vistas/modulos/01/9.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-4"><?php echo $textosArray[109];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="multas">
                                    <div class="img"><img src="vistas/modulos/01/10.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-6">Gestión de Consecuencias</div>
                            <div class="ih-item square colored effect7">
                                <a href="consecuencias">
                                    <div class="img"><img src="vistas/modulos/01/11.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($_SESSION['paisesDivisiones'] as $paisesDiv)
                    {
                    
//                        print_r($paisesDiv->pais);
                    
                    
                    if($paisesDiv->pais=='Nicaragua'){?>
                        <div class="col-md-3">
                            <div class="conte" style="background-color: #f4f4f4;">
                                <div class="titulo-5">RIT</div>
                                <div class="ih-item square colored effect7">
                                    <a href="ritpais">
                                        <div class="img"><img src="vistas/modulos/01/12.jpg" alt="img"></div>

                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        } 
                    }?>

                </div>

            </div>
        </section>




<?php
    }
    elseif ($idperfilSES==5)
    {
      ?>
        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Resto de paises [5.- Abogado Local] -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="conte" style="background-color: #f4f4f4;">
                            <div class="titulo-2"><?php echo $textosArray[63];?></div>
                            <div class="ih-item square colored effect7">
                                <a href="demandas">
                                    <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>

                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>



        <?php
    }
}
?>

<!-- +++++++++++++++++++++++++++++++++++++++ Modal Historico-->

<!-- Modal -->
<div class="modal fade" id="modalHistorico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-m" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #002554; color: white;">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[183];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-warning btnHistorico" id="2017">2017</button>
                <button class="btn btn-warning btnHistorico" id="2018">2018</button>
                <button class="btn btn-warning btnHistorico" id="2019">2019</button>
                <button class="btn btn-warning btnHistorico" id="2020">2020</button>
                <button class="btn btn-warning btnHistorico" id="2021">2021</button>
                <form style="display: none" action="cct" method="POST" id="formCCT">
                    <input type="hidden" id="añoCCT" name="añoCCT" value=""/>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary agregarPliego" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
            </div>

        </div>
    </div>
</div>





 <script>
     $(".btnHistorico").click(function()
     {

         var añobusca = $(this).attr("id");
         $("#añoCCT").val(añobusca);
         $("#formCCT").submit();

     });
 </script>

<?php
    }
    ?>