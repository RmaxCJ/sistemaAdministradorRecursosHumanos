<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[257];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[257];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card" id='calendar' width="100%" style="background-color: #E1ECF6 !important; color: black !important;" >


            <?php
            if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
            {
                $negociaciones= ControladorNegociaciones::ctrMostrarNegociacionesCalendario($_SESSION['divisiones']);

            }
            else
            {
                $negociaciones= ControladorNegociaciones::ctrMostrarNegociacionesCalendario("");

            }
//                    echo "<pre>";
//                   print_r($negociaciones);
//                    echo "</pre>";

                        $titleUTF8Array=array();
                      foreach ($negociaciones as $key => $value)
                      {
//                          echo "id->".$value->id;
//                          echo "<br>";
//                          echo "start->".$value->start;
//                          echo "<br>";
//                          echo "title->".$value->title;
                          $titleUTF8=utf8_encode($value->title);
                          array_push($titleUTF8Array,$titleUTF8 );

//                          echo "<br>";

                      }



//            echo "<pre style='background-color: red'>";
//            print_r($titleUTF8Array);
//            print_r(count($titleUTF8Array));
//            echo "</pre>";

                        for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
                        {
                            $negociaciones[$i]->title=$titleUTF8Array[$i];
//                            echo $i;
                        }
//            echo "<pre style='background-color: greenyellow'>";
//            print_r($negociaciones);
//            echo "</pre>";


            ?>

            <style>
                #content tr td {
                    border-top: 1px solid #e7e7e7;
                    padding: 6px 24px;
                }
                #content .fc tr td{
                    padding:0px;
                }
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

<!--            <div id='wrap'>-->

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

<!--                <div id='calendar-wrap'>-->
<!--                    <div id='calendar' ></div>-->
<!--                </div>-->

<!--            </div>-->
        </div><!-- CARD  -->
        <br><br><br>
        <div class="divider"> </div>
    </section>
    <form style="display: none" action="cctnegociacion" method="POST" id="formCCT">
        <input type="hidden" id="fechaCalendario" name="fechaCalendario" value=""/>

    </form>
    <!-- /.content -->
</div>
<script>

     // var obj2_2=JSON.stringify(obj2);
     // console.log(obj2_2);
    var obj=<?php echo json_encode($negociaciones)?>;
    console.log(obj);
    let obj2=JSON.stringify(obj);
    console.log(obj2);



    document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');
        var initialLocaleCode = 'es';
        var calendar = new FullCalendar.Calendar(calendarEl,
            {
                // contentHeight: 'auto',
                // aspectRation: 3,
                // aspectRatio: 3,
                eventAfterRender: function(event, element, view) {
                    $(element).css('width','100%');
                },
                themeSystem: 'bootstrap',
                themeName: 'solar',
                dateClick: function(info)
                {
                    // alert('Date: ' + info.dateStr);
                    // alert('Resource ID: ' + info.resource.id);
                    // window.location.href="pagos?fecha="+ info.dateStr;
                    $("#fechaCalendario").val(info.dateStr);
                    $("#formCCT").submit();


                },
                events:obj,
                // events:
                //     [
                //         {
                //             "title": "Event 1",
                //             "start": "2021-01-05T09:00:00",
                //             "end": "2021-01-05T18:00:00"
                //         },
                //         {
                //             "title": "Event 2",
                //             "start": "2021-01-11",
                //             "end": "2021-01-13"
                //         },
                //         {
                //             title: 'Test',
                //             start: '2021-01-22',
                //             url: 'http://google.com/'
                //         }
                //     ],

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listYear'
                },
                views: {
                    listYear: { buttonText: 'Año' }
                },
                eventColor: '#0F3DA1',
                // editable: true,
                droppable: true, // this allows things to be dropped onto the calendar
                locale: initialLocaleCode,//para cambiar el idioma
                drop: function(arg)
                {
                    // is the "remove after drop" checkbox checked?
                    if (document.getElementById('drop-remove').checked)
                    {
                        // if so, remove the element from the "Draggable Events" list
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                }
            });
        calendar.render();

    });

</script>
<!-- /.content-wrapper --><?php
