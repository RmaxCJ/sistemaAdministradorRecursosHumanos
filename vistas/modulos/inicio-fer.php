<style>
    .conte{
        border: 1px solid #000;
        padding: 10px 0;
    }
    .titulo{
        font-size: 30px;
        color: #fff;
        text-align: center;
        background-color: #407EC9;
        margin-top: -10px;
    }
    .flex-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    }
    .flex-container > div {
        width: 25%;
        padding: 30px;
        text-align: center;
    }
    .flex-container-2 {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    }
    .flex-container-2 > div {
        width: 80%;
        padding: 30px;
        text-align: center;
    }
    .flex-container-3 {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    }
    .flex-container-3 > div {
        width: 40%;
        padding: 30px;
        text-align: center;
    }
    .op a{
        display: block;
        cursor: pointer;
        color: #009CDE;
        background-color: #fff;
        border-radius: 10px;
        border: 2px solid #009CDE;
        padding: 20px 0;
        position: relative;
        transition: .5s;
    }
    .op a:hover{
        color: #fff;
        background-color: #009CDE;
    }
    a span{
        color: #fff;
        background-color: #009CDE;
        width: 100%;
        font-size: 24px;
        padding: 5px 10%;
        position: absolute;
        left: 0;
        border-radius: 0 0 6px 6px;
        bottom: 0;  
    }
    a i{
        font-size: 40px;
        margin-bottom: 50px;
    }
</style>

<?php
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
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

        <div class="row mb-4">
            <div class="col-md-12" style="background-color: #f4f4f4;">
                <div class="conte">
                    <div class="titulo">Sindicatos</div>
                    <div class="flex-container">
                      <div class="op">
                          <a href="sindicatospais"><i class="nav-icon fas fa-user-shield"></i><br><span>Sindicatos</span></a>
                      </div>
                      <div class="op">
                          <a href="pliegos"><i class="nav-icon fas fa-file-word"></i><br><span style="font-size: 20px;">Pliegos Petitorios</span></a>
                      </div>
                      <div class="op">
                          <a href="minutas"><i class="nav-icon fas fa-pencil-alt"></i><br><span>Minutas</span></a>
                      </div>
                      <div class="op">
                        <a href="calendario"><i class="nav-icon fas fa-calendar"></i><br><span>Pagos</span></a>
                      </div>
                    </div>
                    <div class="flex-container">
                      <div class="op">
                          <a href="negociaciones"><i class="nav-icon fas fa-calendar"></i><br><span>Negociaciones</span></a>
                      </div>
                      <div class="op">
                          <a href="valuaciones"><i class="nav-icon fas fa-user-check"></i><br><span>Valuaciones</span></a>
                      </div>
                      <div class="op">
                          <a data-toggle="modal" data-target="#modalHistorico"><i class="nav-icon fas fa-history"></i><br><span>Historico</span></a>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo">Demandas</div>
                    <div class="flex-container-2">
                      <div class="op">
                          <a href="demandas"><i class="nav-icon fas fa-hand-paper"></i><br><span>Demandas</span></a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo">Revisiones y Auditorias</div>
                    <div class="flex-container-2">
                      <div class="op">
                          <a href="revisiones"><i class="nav-icon fas fa-user-graduate"></i><br><span style="font-size: 15px; padding: 12px 0;">Revisiones y Auditorias</span></a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo">Multas</div>
                    <div class="flex-container-2">
                      <div class="op">
                          <a href="multas"><i class="nav-icon fas fa-address-card"></i><br><span>Multas</span></a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo">RIT / Comisiones</div>
                    <div class="flex-container-3">
                      <div class="op">
                          <a href="rit"><i class="nav-icon fas fa-angle-double-right"></i><br><span>RIT</span></a>
                      </div>
                      <div class="op">
                          <a class="dropdown-item" href="comisiones"><i class="fa fa-angle-double-right"></i><br><span>Comisiones</span></a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="conte" style="background-color: #f4f4f4;">
                    <div class="titulo">Consecuencias</div>
                    <div class="flex-container-2">
                      <div class="op">
                          <a class="dropdown-item" href="consecuencias"><i class="nav-icon fas fa fa-award"></i><br><span>Consecuencias</span></a>
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