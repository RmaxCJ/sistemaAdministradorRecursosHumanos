<style>

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[238];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[238];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoPago"><?php echo $textosArray[239];?></button>

            </div>
        </div>
        <br>


        <!-- Modal Nuevo Pago -->

        <div id="modalNuevoPago" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <form role="form" method="post" enctype="multipart/form-data" >
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[239];?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <input type="text" class="d-none" value="<?php echo $_SESSION["id"]; ?>" name="id_usuario" id="id_usuario">

                                <div class=" row col-md-12">
                                    <div class="form-group col-md-6">
                                        <span for=""><?php echo $textosArray[48];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg" name="Concepto" id="Concepto" placeholder="<?php echo $textosArray[48];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <span for=""><?php echo $textosArray[240];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                            </div>
                                            <input type="number" class="form-control input-lg" name="monto" id="monto" placeholder="<?php echo $textosArray[240];?>"  min="1" max="10000000" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">

                                    <!--datos para la tabla proveedores-->
                                    <div class="form-group col-md-6">
                                        <span for=""><?php echo $textosArray[241];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control input-lg" name="fecha_vencimiento" id="fecha_vencimiento">
                                            <input type="hidden" name="estatus" id="estatus" value="Pendiente">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <span for=""><?php echo $textosArray[199];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select class="form-control input-lg" name="sindicato" id="sindicato" required>
                                                <option value=""><?php echo $textosArray[214];?></option>
                                                <?php
                                                $sindicatos = ControladorSindicatos::ctrMostrarSindicatos();
                                                $divisiones = ControladorDivisiones::ctrMostrarDivisiones();

                                                foreach ($sindicatos as $key => $valS)
                                                {
                                                    $tamaño=strlen($valS->sindicato);
                                                    $tamañoF=$tamaño/3;
                                                    $tamañoF=$tamañoF*2;

                                                    $id = $valS->id;
                                                    $id = $valS->id_perfil;
                                                    $cod_division = $valS->cod_division;

                                                    foreach ($divisiones as $key => $valD)//Del controlador divisiones  realizo la busqueda
                                                    {
                                                        $coddivision=$valD->cod_division;//de la consulta de divisiones

                                                        $divisionname="";
                                                        if($coddivision==$cod_division)
                                                        {
                                                            $divisionname = utf8_encode($valD->division);
                                                            echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).'...  <---> '. $divisionname.'</option>';
                                                        }
                                                    }

                                                    // echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).'-'. $cod_division.'</option>';

                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>


                            </div>

                             <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                                <button type="button" class="btn btn-primary agregarNuevoPago" ><?php echo $textosArray[89];?></button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>

        <!-- fin modal agregar -->

        <div class="card" id='calendar' style="background-color: #E1ECF6 !important; color: black !important;" >


        <?php

        if ($_SESSION['id_perfil']==7 || $_SESSION['id_perfil']==2)
        {
            $pagos= ControladorPagos::ctrMostrarPagosCalendario($_SESSION['divisiones']);

        }
        else{
            $pagos= ControladorPagos::ctrMostrarPagosCalendario("");

        }
//        $pagos= ControladorPagos::ctrMostrarPagosCalendario();
//        echo "<pre>";
//       print_r($pagos);
//        echo "</pre>";

        $titleUTF8Array=array();
        foreach ($pagos as $key => $value)
        {
//            echo "id->".$value->id;
//            echo "<br>";
//            echo "start->".$value->start;
//            echo "<br>";
//            echo "title->".$value->title;
            $titleUTF8=utf8_encode($value->title);
            array_push($titleUTF8Array,$titleUTF8 );

//            echo "<br>";

        }



//        echo "<pre style='background-color: red'>";
//        print_r($titleUTF8Array);
//        print_r(count($titleUTF8Array));
//        echo "</pre>";

        for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
        {
            $pagos[$i]->title=$titleUTF8Array[$i];
//                            echo $i;
        }
//        echo "<pre style='background-color: greenyellow'>";
//        print_r($pagos);
//        echo "</pre>";


        ?>


<style>

    #external-events {
        position: fixed;
        left: 20px;
        top: 200px;
        width: 150px;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    #external-events .fc-event {
        margin: 3px 0;
        cursor: move;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    /* #calendar-wrap {
      margin-left: 200px;
    } */

    #calendar {
        max-width: 1200px;
        margin: 0 auto;
    }

</style>

<!--<div id='wrap'>-->

<!--    <div id='external-events'>-->
<!--        <h4>Eventos</h4>-->

<!--        <div id='external-events-list'>-->
<!--            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>-->
<!--            <div class='fc-event-main'>Mi evento 1</div>-->
<!--            </div>-->
<!--            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>-->
<!--            <div class='fc-event-main'>Mi evento 2</div>-->
<!--            </div>-->
<!--            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>-->
<!--            <div class='fc-event-main'>Mi evento 3</div>-->
<!--            </div>-->
<!--            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>-->
<!--            <div class='fc-event-main'>Mi evento 4</div>-->
<!--            </div>-->
<!--            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>-->
<!--            <div class='fc-event-main'>Mi evento 5</div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <p>-->
<!--            <input type='checkbox' id='drop-remove' />-->
<!--            <label for='drop-remove'>Remover</label>-->
<!--        </p>-->
<!--    </div>-->

<!--        <div id='calendar-wrap'>-->
<!--            <div id='calendar'></div>-->
<!--        </div>-->

<!--</div>-->
        </div><!-- CARD  -->
        <br><br><br>
    </section>
    <form style="display: none" action="pagos" method="POST" id="formPagos">
        <input type="hidden" id="fechaCalendario" name="fechaCalendario" value=""/>

    </form>
    <!-- /.content -->
</div>
<script>

    // var obj2_2=JSON.stringify(obj2);
    // console.log(obj2_2);
    var obj=<?php echo json_encode($pagos)?>;
    console.log(obj);
    let obj2=JSON.stringify(obj);
    console.log(obj2);



  document.addEventListener('DOMContentLoaded', function() {


    var calendarEl = document.getElementById('calendar');
    var initialLocaleCode = 'es';
    var calendar = new FullCalendar.Calendar(calendarEl,
    {
        eventAfterRender: function(event, element, view) {
            $(element).css('width','50px');
        },
        themeSystem: 'bootstrap',
        themeName: 'litera',
        dateClick: function(info)
        {
            // alert('Date: ' + info.dateStr);
            // alert('Resource ID: ' + info.resource.id);
            // window.location.href="pagos?fecha="+ info.dateStr;
            $("#fechaCalendario").val(info.dateStr);
            $("#formPagos").submit();


        },
        events:obj, // imprime null por los acentos
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listYear'
      },
        // aspectRatio: 1.5,
        views: {
            listYear: { buttonText: 'Año' }
        },
        eventColor: '#009CDE',
        // editable: true,
        // resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
      // droppable: true, // this allows things to be dropped onto the calendar
      locale: initialLocaleCode,//para cambiar el idioma
      // drop: function(arg)
      // {
      //   // is the "remove after drop" checkbox checked?
      //   if (document.getElementById('drop-remove').checked)
      //   {
      //     // if so, remove the element from the "Draggable Events" list
      //     arg.draggedEl.parentNode.removeChild(arg.draggedEl);
      //   }
      // }
    });
    calendar.render();

  });

</script>

<script>
    $(".agregarNuevoPago").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');





        var datos = new FormData();
        var funcion         ="agregarNuevoPago";
        var Concepto       = $("#Concepto").val();
        var monto            = $("#monto").val();
        var fecha_vencimiento            = $("#fecha_vencimiento").val();
        var estatus            = $("#estatus").val();
        var sindicato            = $("#sindicato").val();

        //var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#file").val();

        datos.append("funcion", funcion);
        datos.append("Concepto", Concepto);
        datos.append("monto", monto);//PARA MANDARLO A LA VARIABLE datos
        datos.append("fecha_vencimiento", fecha_vencimiento);
        datos.append("estatus", estatus);
        datos.append("sindicato", sindicato);
        //datos.append("funcion", jsonPeticiones);


        $.ajax({
            url:"ajax/pagos.ajax.php",
            method: "POST",
            data: datos,
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
                        text: '¡Pago guardado!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            location.reload();
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡Pago guardado!',
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

        }).done(function ()
        {
            $('.succes').show();
        });
    });
</script>
<!-- /.content-wrapper -->
