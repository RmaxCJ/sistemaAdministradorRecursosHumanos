<?php
// tipoarchivo id 8 CCT original editable
// tipoarchivo id 7 CCT editado para historial

/*$archivo="/var/www/html//relaciones/vistas/archivos/editablesCCT/LERMA/CONVENIO REVISIÓN SALARIAL CCT ROTOPLAS LERMA.docx";

echo $content = shell_exec($archivo);
//
//echo "<pre>";
//print_r($content);
//echo "</pre>";


function parseWord($userDoc)
{
    $fileHandle = fopen($userDoc, "r");
    $line = @fread($fileHandle, filesize($userDoc));
    $lines = explode(chr(0x0D),$line);
    $outtext = "";
    foreach($lines as $thisline)
    {
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE)||(strlen($thisline)==0))
        {
        } else {
            $outtext .= $thisline." ";
        }
    }
    $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
    return $outtext;
}

$fileHandle = fopen($archivo, "r");
$line = @fread($fileHandle, filesize($archivo));
    $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$line);

//$text = parseWord($archivo);
echo $outtext;
*/


?>

<!--     MaterializeCSS -->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>-->
<!---->
<!--<link href="vistas/materialNote-master/dist/materialnote.css" rel="stylesheet" type="text/css">-->
<!--<script src="vistas/materialNote-master/dist/materialnote.js"></script>-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[258];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item"><a href="negociaciones"><?php echo $textosArray[258];?></a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1><?php echo $textosArray[258];?></h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="10%"><?php echo $textosArray[164];?></th>
                                <th scope="col" width="10%"><?php echo $textosArray[241];?></th>
                                <th scope="col" width="24%"  colspan="2"><?php echo $textosArray[259];?></th>
<!--                                <th scope="col" width="12%">Renovación</th>-->
                                <th scope="col" width="10%"><?php echo $textosArray[72];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[260];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[81];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[176];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[67];?></th>
                                <th scope="col" width="16%"><?php echo $textosArray[12];?></th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $negociacionesDia=ControladorNegociaciones::ctrMostrarNegociacionesPorDia($_POST['fechaCalendario']);
//                            echo "<pre>";
//                            print_r($negociacionesDia);
//                            echo "</pre>";

                            foreach ($negociacionesDia as $key => $value)
                            {
//                                echo "<pre>";
//                            print_r($value->anio);
//                            echo "</pre>";
                                $tamaño=strlen($value->sindicato);
                                $tamañoF=$tamaño/3;
                                $tamañoF=$tamañoF*2;

                                echo'<tr>
                              <td>'.$value->tipo_revision.'</td>
                              <td>'.$value->fecha_vencimiento.'</td>
                              <td>'.$value->periodo.'</td>
                              <td>'.$value->renovacion.'</td>
                              <td>'.$value->estatus.'</td>';
                                $ultimaFechaNegociacion=ControladorNegociaciones::ctrUltimaFechaNego($value->IDNeg);
//                                echo "<pre>";
//                                print_r($ultimaFechaNegociacion);
//                                echo "</pre>";



                              echo'<td>'.$ultimaFechaNegociacion[0]->fecha_nueva.'</td>';


                                if ($value->fecha_cierre==null)
                                {
                                    echo '<td></td>';

                                }
                                else
                                {
                                    echo '<td>'.$value->fecha_cierre.'</td>';

                                }
                              echo'<td title="'.utf8_encode($value->sindicato).'" style="font-size: 12px;">'.utf8_encode($value->sindicato).'</td>
                              <td>'.utf8_encode($value->division).'</td>
                              <td>
                                <div class="btn-group">';

//                                echo '<button class="btn btn-danger descargarPDF" id="'.$value->id.'" alt="PDF"><i class="fas fa-download"></i></button>';
                                echo'<button class="btn btn-success " data-toggle="modal" data-target="#archivosEditablesModal_'.$value->idSin.'"><i class="fa fa-file-download"></i></button>';
                                echo'<button class="btn btn-warning" data-toggle="modal" data-target="#cambiarFechaModal_'.$value->idSin.'"><i class="fa fa-calendar"></i></button>';
                                echo'<button class="btn btn-primary" data-toggle="modal" data-target="#subirCCT_'.$value->idSin.'"><i class="fa fa-upload"></i></button>';
                                echo'<button class="btn btn-danger" data-toggle="modal" data-target="#cerrarNego_'.$value->idSin.'"><i class="fa fa-check"></i></button>';
//                                echo'<button class="btn btn-danger btnCerrarNegociacion" idNegociacion="'.$value->IDNeg.'"><i class="fa fa-check"></i></button>';
                                //echo'<button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$value->idSin.'"><i class="fa fa-list"></i></button>';

//                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>';


                                echo '</div></td>

                    </tr>
                    
                    
                          
                      <!-- Modal Cerrar Negociacion -->
                    <div class="modal fade" id="cerrarNego_'.$value->idSin.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[261].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                 <div class="form-group">
                                      <div class="input-group">
                                        <span>'.$textosArray[81].'</span>
                                      </div>
                                        <input type="date" class="form-control input-lg" id="fechaCierre" name="fechaCierre">
                                        <input type="hidden" name="idNegoCierre" id="idNegoCierre" value="'.$value->IDNeg.'">
                                      
                                </div>
                       
                          <div class="modal-footer" >
                          
    
                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                            <button type="button" class="btn btn-success btnCerrarNegociacion" >'.$textosArray[231].'</button>

                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    
                    
                    <!-- Modal Editables Modal -->
                    <div class="modal fade" id="archivosEditablesModal_'.$value->idSin.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[30].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';
                                    $archivos=ControladorNegociaciones::ctrMostrarArchivoporSindicato($value->idSin);
//                                    echo "<pre>";
//                                    print_r($archivos);
//                                    echo "</pre>";
                                foreach ($archivos as $key => $ar)
                                {

//                                    echo'<div class="form-group">
//                      <div class="input-group">
//                          <div class="input-group-text">
//                            <span class="input-group-addon">'.utf8_encode($ar->nombre).'</span>
//                          </div>
//                          <a class="btn btn-primary" download href="/relaciones/vistas/archivos/editablesCCT/'.utf8_encode($ar->archivo).'"><i class="fa fa-download"></i></a>
//
//                      </div>
//                    </div>';
                                    echo'<div class="form-group">
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon">'.utf8_encode($ar->nombre).'</span>
                          </div>
                          
                          
                             <form action="editarCCT" method="post">
                            <input type="hidden" value="'.$ar->idContenido.'" id="idContenido" name="idContenido">
                            <input type="hidden" value="'.utf8_encode($ar->nombre).'" id="nombre" name="nombre">
                            <div style="display: none !important;">
                            <textarea name="contenido" id="contenido" cols="30" rows="10">'.$ar->contenido.'</textarea>
                            </div>
                              <button class="btn btn-primary"  type="submit" formtarget="_blank">'.$textosArray[11].'</button>                      
                            </form>
                            
                      </div>
                    </div>';
//                    echo'<textarea id="summary_body" name="summary_body" required="required" placeholder="Body" rows="15" class="wysiwyg" data-type="summary" data-hash-source="#summary_title" data-upload-url="/media/upload" data-wysiwyg="materialnote">'.$ar->contenido.'</textarea>
//
//                 ';


                                }
                          echo '</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="cambiarFechaModal_'.$value->idSin.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Periodo de Negociacion:'.$value->periodo.'/'.$value->renovacion.' </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <h3>'.$textosArray[262].'</h3>';
                                $fechasBitacora=ControladorNegociaciones::ctrMostrarBitacoraNegociacion($value->IDNeg);
//                                    echo "<pre>";
//                                    print_r($fechasBitacora);
//                                    echo "</pre>";
                                $cont=1;
                                $cantidadFechas= count($fechasBitacora);
                                foreach ($fechasBitacora as $key => $bit)
                                {

                                    echo'<div class="form-group">
                                      <div class="input-group">
                                      <div class="input-group">
                                        <span>'.$textosArray[77].'</span>
                                      </div>
                                      
                                      ';
                                    if ($bit->fecha_nueva=='' || $bit->fecha_nueva==null)
                                    {
                                        echo '<input type="text" class="form-control input-lg" id="fechaOriginal_'.$cont.'" value="'.$bit->fecha_original.'" readonly>';

                                    }
                                    elseif ($bit->fecha_nueva!='' || $bit->fecha_nueva!=null)
                                    {
                                     echo '<input type="text" class="form-control input-lg" id="fechaOriginal_'.$cont.'" value="'.$bit->fecha_nueva.'" readonly>';
                                    }
                                    echo '
                                    <div class="input-group">
                                        <span>'.$textosArray[106].'</span>
                                      </div>
                                      <input type="text" class="form-control input-lg" id="fechaOriginal_'.$cont.'" value="'.$bit->comentarios.'" readonly>
                                    <input type="hidden" name="idUser" id="idUser" value="'.$_SESSION['id'].'">
                                            <input type="hidden" name="idNego" id="idNego" value="'.$value->IDNeg.'">
                                      </div>
                                    </div>
                                   <hr style=" border: 1px solid green !important;border-radius: 5px !important;">

                                    ';
                                    $cont++;

                                }
                                echo '
                                <input type="hidden" id="contFinal" value="'.$cont.'">
                                 
                          <div class="modal-footer" style="background-color: #0D47A1; color: white">
                          <div class="form-group">
                                      <div class="input-group">
                                        <span>'.$textosArray[263].'</span>
                                      </div>
                                        <input type="date" class="form-control input-lg" id="fechaNueva" name="fechaNueva">
    
                                </div>
                                 <div class="form-group">
                                      <div class="input-group">
                                      <span>'.$textosArray[106].'</span>
                                          
                                      </div>
                                          <textarea type="text" class="form-control input-lg" id="motivosCambio" name="motivosCambio"></textarea>
    
                                </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                            <button type="button" class="btn btn-success cambiarFecha" >'.$textosArray[231].'</button>

                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  
                      <!-- Modal -->
                    <div class="modal fade" id="subirCCT_'.$value->idSin.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">CCT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <input type="hidden" name="idUser" id="idUser" value="'.$_SESSION['id'].'">
                          <input type="hidden" name="sindicatoID" id="sindicatoID" value="'.$value->idSin.'">

                          
                            <div class="form-group">
                            <span>'.$textosArray[23].'</span>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                </div>
                                <input type="text" name="añoActual" id="añoActual" class="form-control input-lg"  value="'.date('Y').'" readonly>
                              </div>
                            </div>
                             
                             <div class="form-group">
                                <span>'.$textosArray[263].'</span>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-file-upload"></i></span>
                                      </div>
                                    </div>
                                            <input type="file" class="form-control input-lg " name="file" id="file" size="10000" accept=".pdf">
                                            <input type="text" class="d-none" id="size">                                  
                                            </div>
                                </div>
                          
                          
                            </div>
                          <div class="modal-footer">
                             <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                             <button type="button" class="btn btn-primary agregarCCT" title="Para habilitar debe seleccionar un archivo">'.$textosArray[231].'</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="historialArchivos_'.$value->idSin.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Historial de Archivo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                                $archivos=ControladorNegociaciones::ctrMostrarHistorialCCTporSindicato($value->idSin);
//                                    echo "<pre>";
//                                    print_r($archivos);
//                                    echo "</pre>";
                                foreach ($archivos as $key => $ar)
                                {

                                    echo'<div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($ar->nombre).'</span>
                                              </div>
                                              <a class="btn btn-primary" download href="/relaciones/vistas/archivos/editablesCCT/'.utf8_encode($ar->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($ar->fecha_alta).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

                                                if ($ar->num_empleado=="Externo")
                                                {
                                                    echo'<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="'.$ar->usuario.'">';

                                                }
                                                elseif ($ar->num_empleado!="Externo")
                                                {
                                                    $empleado=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($ar->num_empleado);
                                                    foreach ($empleado as $key => $emp)
                                                    {
                                                        echo '<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="' . $emp->nombre . '">';
                                                    }
                                                }

                                          echo '</div>
                                        </div>
                                        
                                        
                                        ';


                                }
                                echo '</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    ';


                            }
                            ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

    $(".cambiarFecha").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        // alert('hola');
        var datos = new FormData();
        var funcion         ="cambiarFecha";
        var fechaNueva            = $("#fechaNueva").val();
        var idUser            = $("#idUser").val();
        var idNego            = $("#idNego").val();
        var motivosCambio            = $("#motivosCambio").val();
        var contFinal            = $("#contFinal").val();
        contFinal=contFinal-1;
        var fechaAnterior            = $("#fechaOriginal_"+contFinal).val();
        // alert(contFinal);
        // alert(fechaAnterior);
        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#fileOrden").val();

        datos.append("funcion", funcion);
        datos.append("fechaNueva", fechaNueva);//PARA MANDARLO A LA VARIABLE datos
        datos.append("idUser", idUser);
        datos.append("motivosCambio", motivosCambio);
        datos.append("fechaAnterior", fechaAnterior);
        datos.append("idNego", idNego);



        $.ajax({
            url:"ajax/negociaciones.ajax.php",
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
                        text: '¡Fecha cambiada!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            // window.location = 'calendario';
                            location.reload();
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡!',
                        icon: 'warning',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            // window.location = 'calendario';
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




    $(".agregarCCT").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarCCT";
        var año       = $("#añoActual").val();
        var idUser            = $("#idUser").val();
        var sindicatoID            = $("#sindicatoID").val();
        var file         =  document.getElementById("file");
        var archivos= file.files;


            for (i=0;i<archivos.length;i++)
            {
                datos.append('archivo'+i,archivos[i]);
            }


            datos.append("funcion", funcion);
            datos.append("año", año);
            datos.append("idUser", idUser);
            datos.append("sindicatoID", sindicatoID);

            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/cct.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta)
                {
                    console.log(respuesta);
                    if (respuesta=='problemaDocs')
                    {
                        Swal.fire({
                            title: 'Error!',
                            text: '¡Debe seleccionar un Archivo PDF!',
                            icon: 'warning',
                            confirmButtonText:'Entendido'
                        });
                    }
                    else if (respuesta=="finalizado")
                    {
                        Swal.fire({
                            title: 'Success!',
                            text: '¡CCT guardado!',
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
                            text: '¡CCT guardado!',
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
<script type="text/javascript">
    var wysiwyg = $('.wysiwyg');
    var type = wysiwyg.data('type');
    var hash = $(wysiwyg.data('hashSource')).val();
    var upload_url = wysiwyg.data('uploadUrl');
    var wysiwyg_type = wysiwyg.data('wysiwyg') ? wysiwyg.data('wysiwyg') : 'summernote';
    console.log(wysiwyg_type);

    wysiwyg[wysiwyg_type]({
        height: 400,
        focus: false,
        fontNames: ['Arial', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
        fontNamesIgnoreCheck: ['Roboto'],
        toolbar: [
            ['style', ['style']],
            ['fontname', ['fontname']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        onImageUpload: function(files) {
            var file = files[0];
            var data = new FormData();
            data.append('file', file);
            data.append('type', type);
            data.append('hash', hash);
            $.ajax({
                url: upload_url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    var img_node = document.createElement('IMG');
                    img_node.src = data.url;
                    img_node.style = 'width:100%;';
                    wysiwyg[wysiwyg_type]('insertNode', img_node);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        },
        callbacks: {
            onImageUpload: function(files) {
                var file = files[0];
                var data = new FormData();
                data.append('file', file);
                data.append('type', type);
                data.append('hash', hash);
                $.ajax({
                    url: upload_url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data) {
                        var img_node = document.createElement('IMG');
                        img_node.src = data.url;
                        img_node.style = 'width:100%;';
                        wysiwyg[wysiwyg_type]('insertNode', img_node);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + " " + errorThrown);
                    }
                });
            }
        }
    });

    $(".btnCerrarNegociacion").click(function()
    {

        var fechaCierre = $("#fechaCierre").val();
        var idNegoCierre = $("#idNegoCierre").val();
        // var nameUsuario = $(this).attr("usuario");

        var dataForm = new FormData();
        var funcion="cerrarNegociacion";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("idNegoCierre", idNegoCierre);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("fechaCierre", fechaCierre);//PARA MANDARLO A LA VARIABLE datos
        // dataForm.append("nameUsuario", nameUsuario);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¿Estas seguro que deseas cerrar la Negociacion?',
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
                    url:"ajax/negociaciones.ajax.php",
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
                                  location.reload();
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
        })
    });


</script>