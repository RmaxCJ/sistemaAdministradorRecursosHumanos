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
</style>

<?php
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//$_SESSION['pais']='Argentina';
//$_SESSION['id_perfil']=5;
$paisSES=$_SESSION['pais'];
$idperfilSES=$_SESSION['id_perfil'];

?>

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
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard   Mexico [1.-admin,2.-gerente CH] -->

<section class="content">
    <div class="container-fluid">

        <div class="conte mb-4" style="background-color: #f4f4f4;">
        <div class="row">
            <div class="col-md-12">
                    <div class="titulo">Sindicatos</div>
            </div>
            <div class="col-xs-3">
                <div class="ih-item square colored effect7">
                    <a href="sindicatospais">
                        <div class="img"><img src="vistas/modulos/01/1.jpg" alt="img"></div>
                        <div class="info"><h3>Sindicatos</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3">
                <div class="ih-item square colored effect7">
                    <a href="pliegos">
                        <div class="img"><img src="vistas/modulos/01/2.jpg" alt="img"></div>
                        <div class="info"><h3>Pliegos Petitorios</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3">
                <div class="ih-item square colored effect7 ">
                    <a href="minutas">
                        <div class="img"><img src="vistas/modulos/01/3.jpg" alt="img"></div>
                        <div class="info"><h3>Minutas</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3">
                <div class="ih-item square colored effect7 ">
                    <a href="calendario">
                        <div class="img"><img src="vistas/modulos/01/4.jpg" alt="img"></div>
                        <div class="info"><h3>Pagos</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3 mt-3">
                <div class="ih-item square colored effect7 ">
                    <a href="negociaciones">
                        <div class="img"><img src="vistas/modulos/01/5.jpg" alt="img"></div>
                        <div class="info"><h3>Negociaciones</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3 mt-3">
                <div class="ih-item square colored effect7">
                    <a href="valuaciones">
                        <div class="img"><img src="vistas/modulos/01/6.jpg" alt="img"></div>
                        <div class="info"><h3>Valuaciones</h3></div>
                    </a>
                </div>
              </div>
              <div class="col-xs-3 mt-3">
                <div class="ih-item square colored effect7">
                    <a  data-toggle="modal" data-target="#modalHistorico">
                        <div class="img"><img src="vistas/modulos/01/7.jpg" alt="img"></div>
                        <div class="info"><h3>Historico</h3></div>
                    </a>
                </div>
              </div>
        </div>
    </div>



        <div class="row mb-4">
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo-2">Demandas</div>
                    <div class="ih-item square colored effect7">
                        <a href="demandas">
                            <div class="img"><img src="vistas/modulos/01/8.jpg" alt="img"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo-3">Revisiones y Auditorias</div>
                    <div class="ih-item square colored effect7">
                        <a href="revisiones">
                            <div class="img"><img src="vistas/modulos/01/9.jpg" alt="img"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo-4">Multas</div>
                    <div class="ih-item square colored effect7">
                        <a href="multas">
                            <div class="img"><img src="vistas/modulos/01/10.jpg" alt="img"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo-6">Consecuencias</div>
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
                            <div class="titulo-5">RIT / Comisiones</div>
                        </div>
                        <div class="col-md-6">
                            <div class="ih-item square colored effect7">
                                <a href="rit">
                                    <div class="img"><img src="vistas/modulos/01/12.jpg" alt="img"></div>
                                    <div class="info"><h3>RIT</h3></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ih-item square colored effect7">
                                <a href="comisiones">
                                    <div class="img"><img src="vistas/modulos/01/13.jpg" alt="img"></div>
                                    <div class="info"><h3>Comisiones</h3></div>
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
}
?>



    <!-- Modal -->
    <div class="modal fade" id="modalHistorico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h5 class="modal-title" id="exampleModalLabel">Historico por año</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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

     $(document).ready(function()
     {

         /*
         * BAR CHART
         * ---------
         */

     var bar_data = {
         data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
         bars: { show: true }
     }
     $.plot('#bar-chart', [bar_data], {
         grid  : {
             borderWidth: 1,
             borderColor: '#f3f3f3',
             tickColor  : '#f3f3f3'
         },
         series: {
             bars: {
                 show: true, barWidth: 0.5, align: 'center',
             },
         },
         colors: ['#3c8dbc'],
         xaxis : {
             ticks: [[1,'J'], [2,'F'], [3,'M'], [4,'A'], [5,'M'], [6,'J']]
         }
     })
     /* END BAR CHART */

         /*
 * BAR CHART 2
 * ---------
 */

         var bar_data = {
             data : [[1,10], [2,8]],
             bars: { show: true }
         }
         $.plot('#bar-chart2', [bar_data], {
             grid  : {
                 borderWidth: 1,
                 borderColor: '#f3f3f3',
                 tickColor  : '#f3f3f3'
             },
             series: {
                 bars: {
                     show: true, barWidth: 0.5, align: 'center',
                 },
             },
             colors: ['#121f75'],
             xaxis : {
                 ticks: [[1,'J'], [2,'F']]
             }
         })
         /* END BAR CHART2 */
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         var densityCanvas = document.getElementById("densityChart");

         // Chart.defaults.global.defaultFontFamily = "Lato";
         // Chart.defaults.global.defaultFontSize = 18;

         var densityData =
             {
             label: 'Ejemplo',
             data: [5427, 5243, 5514],
             backgroundColor: [
                 'rgba(90, 99, 132, 0.6)',
                 'rgba(120, 99, 132, 0.6)',
                 'rgba(240, 99, 132, 0.6)'
             ],
             borderColor: [
                 'rgba(0, 99, 132, 1)',
                 'rgba(30, 99, 132, 1)',
                 'rgba(240, 99, 132, 1)'
             ],
             borderWidth: 2,
             hoverBorderWidth: 0
         };


         var barChart = new Chart(densityCanvas, {
             type: 'horizontalBar',
             data: {
                 labels: ["Uno", "Dos", "Tres"],
                 datasets: [densityData],
             },
             // options: chartOptions
         });

         //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         var densityCanvas2 = document.getElementById("densityChart2");

         // Chart.defaults.global.defaultFontFamily = "Lato";
         // Chart.defaults.global.defaultFontSize = 18;

         var densityData2 =
             {
                 label: 'Ejemplo',
                 data: [5427, 5243, 5514,6666,6000],
                 backgroundColor: [
                     'rgba(90, 99, 132, 0.6)',
                     'rgba(120, 99, 132, 0.6)',
                     'rgba(240, 99, 132, 0.6)',
                     'rgba(90, 99, 132, 0.6)',
                     'rgba(240, 99, 132, 0.6)',

                 ],
                 borderColor: [
                     'rgba(0, 99, 132, 1)',
                     'rgba(30, 99, 132, 1)',
                     'rgba(240, 99, 132, 1)',
                     'rgba(0, 99, 132, 1)',
                     'rgba(240, 99, 132, 1)',

                 ],
                 borderWidth: 2,
                 hoverBorderWidth: 0
             };


         var barChart2 = new Chart(densityCanvas2, {
             type: 'horizontalBar',
             data: {
                 labels: ["Uno", "Dos", "Tres","Cuatro","Cinco"],
                 datasets: [densityData2],
             },
             // options: chartOptions
         });
     });

 </script>