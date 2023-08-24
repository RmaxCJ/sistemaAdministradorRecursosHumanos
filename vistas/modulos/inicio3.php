<link rel="stylesheet" href="vistas/modulos/ihover.css"/>

<style>
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
.ih-item img {
  width: 100%;
  height: 100%;
}

.ih-item.square {
  position: relative;
  width: 316px;
  height: 216px;
  border: 8px solid #fff;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}
.ih-item.square .info {
  position: absolute;
  top: 0;
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
  background: rgba(26, 74, 114, 0.6);
}
.ih-item.square.effect7.colored .info h3 {
  background: rgba(12, 34, 52, 0.6);
}
.ih-item.square.effect7 .img {
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
  visibility: hidden;
  opacity: 0;
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
  -webkit-transform: scale(4);
  -moz-transform: scale(4);
  -ms-transform: scale(4);
  -o-transform: scale(4);
  transform: scale(4);
  -webkit-transition: all 0.35s 0.1s ease-in-out;
  -moz-transition: all 0.35s 0.1s ease-in-out;
  transition: all 0.35s 0.1s ease-in-out;
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







<div class="row">
    <div class="col-md-12 conte">
        <div class="titulo">Sindicatos</div>

        <div class="row">




          <div class="col-sm-3">
            <div class="ih-item square colored effect7">
                <a href="#">
                    <div class="img"><img src="vistas/modulos/rect/4.jpg" alt="img"></div>
                    <div class="info"><h3>Valuaciones</h3></div>
                </a>
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
        <div class="modal-dialog modal-sm" role="document">
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