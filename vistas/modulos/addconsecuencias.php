<?php $_POST['paisSelect'];?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Consecuencias (Tipo de Amonestación)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Tipos Consecuencias </li>
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
            
               <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarMinuta">Crear Minuta 1</button> -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoConcecuencia">Crear Tipo Amonestación</button>

            </div>
        </div>
        <br>
        <table class="table table-striped tabladatatable dt-responsive " width="100%">
            <thead>
                <tr>
                <th class="d-non" scope="col" width="5%">#</th>
                <th scope="col" width="25%">Pais</th>
                <th scope="col" width="10%">Tipo Amonestación </th>
                <th scope="col" width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $divisiones = ControladorDivisiones::ctrMostrarDivisionesSoloPais();
                $divisionesp = ControladorDivisiones::ctrMostrarDivisionesPais($_POST['paisSelect']);
                $tiposconsecuencias = ControladorConsecuencias::ctrMostrarTiposConsecuencias();
                
                // $consecuenciasamonestaciones = ControladorConsecuencias::ctrMostrarConsecuenciasAmonestaciones();
       
                foreach  ($tiposconsecuencias as $key => $value)
                {   
                    echo'<tr>
                        <td class="">'.$value->id.'</td>
                        <td class="">'.$value->pais.'</td>
                        <td title="" style="text-decoration:none">'.$value->amonestacion.'</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning btn-xs btnEditar" id="" data-toggle="modal" data-target="#modalEditar_'.$value->id.'"><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-xs btnEliminarAmonestacion" id="'.$value->id.'" ><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                    </tr>
                <div id="modalEditar_'.$value->id.'" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form role="form" enctype="multipart/form-data" id="form_'.$value->id.'" >
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #002554; color: white;">
                                    <h4 class="modal-title">Editar </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <span for="">Amonestación </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                </div>
                                            <input type="text" class="form-control input-lg" value="'.$value->pais.'" name="cbopaisE'.$value->id.'" id="cbopaisE'.$value->id.'" maxlength="250" placeholder="Amonestación" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span for="">Amonestación </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                </div>
                                            <input type="text" class="form-control input-lg" value="'.$value->amonestacion.'" name="txtAmonestacionE_'.$value->id.'" id="txtAmonestacionE_'.$value->id.'" maxlength="250" placeholder="Amonestación" required>
                                            </div>
                                        </div>
                                        <span>Consecuencias</span>';
                                        $consecuenciasamonestaciones = ControladorConsecuencias::ctrMostrarConsecuenciasAmonestaciones($value->id);
                                        foreach ($consecuenciasamonestaciones as $key => $valCA)
                                        { 
                                        echo'
                                            
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>  
                                                    <input type="text" class="form-control input-lg" name="consecuencia'.$valCA->id.'" idAC="'.$valCA->id.'" id="consecuencia'.$valCA->id.'" value="'.$valCA->consecuencia.'" placeholder="Consecuencia" >
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check">
                                                        <input class="form-check-input borrarAC" type="checkbox" idC="'.$value->id.'" idCA="'.$valCA->id.'" value="'.$valCA->id.'" id="ckeckdelete'.$valCA->id.'">
                                                        <label class="form-check-label" for="ckeckdelete" title="Al checar esta casilla se borrara el registro de Consecuencia">
                                                            Eliminar
                                                        </label>
                                                    </div>
                                                               
                                                </div>
                                            </div>
                                            <div class="checkdelete'.$valCA->id.'" id="checkdelete'.$valCA->id.'">
                                            </div>';
                                        }           
                              echo '       
                                            <div class="form-group">
                                                <span for="">Consecuencia </span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ConsecuenciaE'.$value->id.'" id="ConsecuenciaE'.$value->id.'" placeholder="Consecuencia" >
                                                    <button class="btn btn-primary AgregarConsecuenciaE" onclick="addConsecuenciaE('.$value->id.')" aria-label="Agregar Consecuencia" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                                <div id="agregarConsecuenciaE'.$value->id.'">
                                                </div>
                                                
                                            
                                            <input type="text" class="d-none" id="arregloConsecuenciaE'.$value->id.'"><!--Json para armar el guardado de acuerdos-->
                                            <input type="text" class="d-none" id="arreglodeleteE'.$value->id.'">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                    <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_'.$value->id.'" id="'.$value->id.'">Guardar</button>
                                </div>              
                            </div>
                        </form>  
                    </div>
                </div>';
                }
                
                ?>
            </tbody>
        </table>
        <!-- Modal Nuevo Agregar -->

        <div id="modalAgregarTipoConcecuencia" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- <form role="form" method="post" enctype="multipart/form-data" > -->
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                        <h4 class="modal-title">Agregar </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                        <div class="box-body">
                        <input type="text" class="d-none" value="<?php echo $_SESSION["id"]; ?>" name="id_usuario" id="id_usuario">   
                            
                                <div class="form-group">
                                    <span for="">Código División</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                    
                                    <select class="form-control chosen-selec input-xl" name="cbo_Pais" id="cbo_Pais">
                                    <option value="">Seleccione País</option>
                                    <?php
                                        foreach ($divisiones as $key => $valD)
                                        { 
                                            // if($valD->pais=='mexico' OR $valD->pais=='argentina'){
                                            echo'<option value="'.$valD->pais.'">'.utf8_encode($valD->pais).'</option>';
                                            // }
                                        }
                                    ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <span for="">Amonestación </span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                    <input type="text" class="form-control input-lg" name="txtAmonestacion" id="txtAmonestacion" maxlength="250" placeholder="Amonestación" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span for="">Consecuencia </span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" name="Consecuencia" id="Consecuencia" placeholder="Consecuencia" >
                                        <button class="btn btn-primary AgregarConsecuencia" aria-label="Agregar Consecuencia" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                    <div id="agregarConsecuencia">
                                    </div>
                                
                                <input type="text" class="d-none" id="arregloConsecuencia"><!--Json para armar el guardado de acuerdos-->
                           
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary AgregarAmonestacion" >Guardar</button>
                        </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- fin modal agregar -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(document).on("change", ".borrarAC", function() {   
        var id = $(this).attr("idCA");
        var idC = $(this).attr("idC");

        // var id_acuerdoG = $(this).attr("id_acuerdo");//buscar el atributo id que es el id_acuerdo para q sea unico
        if( $("#ckeckdelete"+id).prop('checked') ) {
        // alert('is checked');
        var idACDel = "<input class='d-none' id='idACG_"+id+"'  type='text' name='arrayIDACdel"+idC+"[]' value='"+ id +'~'+"' />";//se crea  la variable para agregarlos al div correspondiente en la clase correspondiente
            $(".checkdelete"+id).append(idACDel);
            arraydelete2(id,idC);
        }else{
            // alert('not checked');
            $("#idACG_"+id+"").remove();//eliminacion del elemento al deschecar check

            // borrarAP(id_acuerdoG);
            arraydelete2(id,idC);

        }  
    });
    function arraydelete2(id,idC){
    var arraydelete = '';
    
    var acuCount2 = document.getElementsByName("arrayIDACdel"+idC+"[]").length;
    for(i=0;i<acuCount2;i++){
         arraydelete =arraydelete+$("input[name*='arrayIDACdel"+idC+"']")[i].value;
        $('#arreglodeleteE'+idC).val(" "+arraydelete+" "); //formatojson
    }
    if(acuCount2==0){
        $('#arreglodeleteE'+idC).val(""); //formatojson
    }
}

    $(".AgregarAmonestacion").click(function()
    {   
        var datos = new FormData();
        var funcion             ="agregarAddConsecuencias";
        var pais                = $("#cbo_Pais").val();
        var amonestacion        = $("#txtAmonestacion").val();
        var arregloConsecuencia = $("#arregloConsecuencia").val();
        
        if(pais!='' && amonestacion!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("pais", pais);
            datos.append("amonestacion", amonestacion);
            datos.append("arregloConsecuencia", arregloConsecuencia);
            
            $.ajax({
                url:"ajax/consecuencias.ajax.php",
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
                        text: '¡Registro Exitoso!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'addconsecuencias';
                        }
                    });
                }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Verificar caracteres en Registro !',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'addconsecuencias';
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
        }else{
            Swal.fire({ 
            title: 'Error!',
            text: '¡Llenar Información!',
            icon: 'error',
            confirmButtonText:'Ok'
            });
        }
    });
    $(".guardarEdicion").click(function()
    {//me quede en procesar lainformacion para guardar
        var idForm = $(this).attr("idForm");//tomar el atributo
        var id = $(this).attr("id");//tomar el id 
        var datos = new FormData();
        var funcion              ="editarAddConsecuencias";
        var pais                 = $("#cbopaisE"+id).val();
        var amonestacion         = $("#txtAmonestacionE_"+id).val();
        var arregloConsecuenciaE = $("#arregloConsecuenciaE"+id).val();
        var arreglodeleteE       = $("#arreglodeleteE"+id).val();

        var dataForm = new FormData();
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("pais", pais);
        dataForm.append("amonestacion", amonestacion);
        dataForm.append("arregloConsecuencia", arregloConsecuenciaE);
        dataForm.append("arraycondel", arreglodeleteE);
        dataForm.append("id", id);

        $.ajax({
            url:"ajax/consecuencias.ajax.php",
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
                        text: '¡Registro Exitoso!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'addconsecuencias';
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡Registro Exitoso!',
                        icon: 'warning',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'addconsecuencias';
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
    $(".btnEliminarAmonestacion").click(function()
    {

        var id = $(this).attr("id");
        var dataForm = new FormData();
        var funcion="eliminarEliminarAmonestacion";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¡Estas seguro que deseas eliminar el la monestación?',
            text: "Si no es asi puedes presionar el boton cancelar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar Amonestación'
        }).then((result) => {
            if (result.value) {
                // window.location = "usuarios";

                $.ajax({
                    url:"ajax/consecuencias.ajax.php",
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
                                    window.location = 'addconsecuencias';
                                }
                            });
                        }
                        else
                        {
                            Swal.fire({
                                title: 'Warning!',
                                text: '¡Eliminado de manera exitosa!',
                                icon: 'warning',
                                confirmButtonText:'Ok'
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'addconsecuencias';
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

////////////////////////////////////////////////////////////////////Temas
$(".AgregarConsecuencia").click(addConsecuencia); //agregar Consecuencia
////////////////////////////////////////////////////////////////////Temas
var contadorC = 0;//variable para remover
function addConsecuencia() {
        contadorC += 1;//contador sumando
        // var idremove = "$('#temas_"+contadorC+"')";
        var Consecuencia     = $('#Consecuencia').val();        
        if (Consecuencia != "") { //checar si vienen diferende de vacia
            var infoT = "<div class='form-group' id='Consecuencia"+contadorC+"'>"+ 
                            "<div class='input-group'>"+
                                "<div class='input-group-text'>"+
                                    "<span class='input-group-addon'><i class='fa fa-file'></i></span>"+
                               "</div>"+
                                "<input class='d-none' type='text' name='jsonTemas[]' value='"+ Consecuencia +'~'+"'/>"+
                                //"<input class='form-control d-non' name='tema[]' id='' type='text'  value='" + tema + "' autofocus readonly/>&nbsp;"+
                                "<input class='form-control' name='' id='' type='text'  value='" + Consecuencia + "' autofocus readonly/>&nbsp;"+
                                "<button class='btn btn-primary' onclick='borrarT("+contadorC+")'>Eliminar</button>"+     
                            "</div>"+
                        "</div>";
           
            $("#agregarConsecuencia").append(infoT);
            reset_camposT(); //funcion resetear campos
            // $('#llenarcamposacuerdos').hide();
            jasonTemas();
        } else {
            // $('#llenarcamposacuerdos').show();
        }
}

function reset_camposT() { //reseteo de campos
    $("#Consecuencia").val("");
}

function jasonTemas(){
    var jsonTemas = '';
    var asiCount = document.getElementsByName("jsonTemas[]").length;
    for(i=0;i<asiCount;i++){
         jsonTemas =jsonTemas+$("input[name*='jsonTemas']")[i].value;
        $('#arregloConsecuencia').val(" "+jsonTemas+" "); //formatojson
    }
    if(asiCount==0){
        $('#arregloConsecuencia').val(""); //formatojson
    }
}
function borrarT(contadorC) { //para borrar las mismas filas
    $("#Consecuencia"+contadorC).remove();//se toma el id dinamico creado para poder eliminar el elemento
    jasonTemas();    
}

//////////////////////////////////////////////////////////////////////editable
var contadorEC = 0;//variable para remover para la segunda carga de varios archivos
function addConsecuenciaE(idAC) {
        contadorEC += 1;//contador sumando
        // var idremove = "$('#temas_"+contadorC+"')";
        var Consecuencia     = $('#ConsecuenciaE'+idAC).val();        
        if (Consecuencia != "") { //checar si vienen diferende de vacia
            var infoT = "<div class='form-group' id='ConsecuenciaE"+contadorEC+idAC+"'>"+
                            "<div class='input-group'>"+
                                "<div class='input-group-text'>"+
                                    "<span class='input-group-addon'><i class='fa fa-file'></i></span>"+
                               "</div>"+
                                "<input class='d-none' type='text' name='jsonTemasE[]' value='"+ Consecuencia +'~'+"'/>"+
                                //"<input class='form-control d-non' name='tema[]' id='' type='text'  value='" + tema + "' autofocus readonly/>&nbsp;"+
                                "<input class='form-control' name='' id='' type='text'  value='" + Consecuencia + "' autofocus readonly/>&nbsp;"+
                                "<button class='btn btn-primary' onclick='borrarET("+contadorEC+","+idAC+")'>Eliminar</button>"+     
                            "</div>"+
                        "</div>";
           
            $("#agregarConsecuenciaE"+idAC).append(infoT);
            reset_camposET(idAC); //funcion resetear campos
            // $('#llenarcamposacuerdos').hide();
            jasonTemasE(idAC);
        } else {
            // $('#llenarcamposacuerdos').show();
        }
}

function reset_camposET(idAC) { //reseteo de campos
    $("#ConsecuenciaE"+idAC).val("");
}

function jasonTemasE(idAC){
    var jsonTemasE = '';
    var asiCount = document.getElementsByName("jsonTemasE[]").length;
    for(i=0;i<asiCount;i++){
         jsonTemasE =jsonTemasE+$("input[name*='jsonTemasE']")[i].value;
        $('#arregloConsecuenciaE'+idAC).val(" "+jsonTemasE+" "); //formatojson
    }
    if(asiCount==0){
        $('#arregloConsecuenciaE'+idAC).val(""); //formatojson
    }
}
function borrarET(contadorC,idAC) { //para borrar las mismas filas
    $("#ConsecuenciaE"+contadorC+idAC).remove();//se toma el id dinamico creado para poder eliminar el elemento
    jasonTemasE(idAC);    
}

</script>

