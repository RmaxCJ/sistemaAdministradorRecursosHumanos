<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if($_SESSION['id_perfil']!=1){//si no es administrador toma la informacion de la sesion 
    $paisselect= $_SESSION['pais'];
    $cod_division= $_SESSION['cod_division'];
}else{
     $paisselect= $_POST['paisSelect'];//si es administrador toma la informacion del clic del pais
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[133];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[133];?></li>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#subirrit"><?php echo $textosArray[157];?></button>
            <?php if($_SESSION['id_perfil']==1){?> 
                <button class="btn btn-warning" data-toggle="modal" data-target="#observaciones"><?php echo $textosArray[124];?></button>
            <?php }?>
            </div>
        </div>
        <br>
        <?php
        if($_SESSION['id_perfil']==2)
        {
         $divisiones = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']); 
        }
        else
        {
             $divisiones = ControladorDivisiones::ctrMostrarDivisionesxPais($paisselect); 
        }
         
        ?>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne" style="background-color: #002554 !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: white !important;">
                            <?php echo $textosArray[133];?>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card" >
                            <div class="card-body">
                                <table class="table table-striped tabladatatable dt-responsive" width="100%">
                                    <thead>  
                                    <tr>
                                        <th width="33%" scope="col"><?php echo $textosArray[67];?></th>
                                        
                                        <th width="33%" scope="col"><?php echo $textosArray[12];?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
                                    {
                                        $rit = ControladorRit::ctrMostrarRit($_SESSION['divisiones'],$paisselect);
                                    }
                                    else{
                                        $rit = ControladorRit::ctrMostrarRit($_SESSION['cod_division'],$paisselect);
                                    }
                                    foreach ($rit as $key => $value)
                                    {  
                                      echo'<tr>
                                    <td>'.utf8_encode($value->division).'</td>
                                    
                                    <td>
                        <button title="Historial Rit" class="btn btn-success btn-xs btnHistorialRit" idRit="'.$value->cod_division.'" data-toggle="modal" data-target="#btnHistorialRit_'.$value->cod_division.'">&nbsp;Historial&nbsp;<i class="fa fa-history"></i></button>
                                    </td>
                                    </tr>';
                                    
                                    //////////////////////////////////////////////historial Rit
                                    echo'<div id="btnHistorialRit_'.$value->cod_division.'" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <form role="form" enctype="multipart/form-data" id="formLider_'.$value->cod_division.'" >
                                                    <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #002554; color: white;">
                                                        <h4 class="modal-title">'.$textosArray[250].'  '.utf8_encode($value->division).'</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="box-body">
                                                        <ul>';
                                                        $ritcoddiv = ControladorRit::ctrMostrarArchivoRit($value->cod_division);
                                                        foreach ($ritcoddiv as $key => $valid)
                                                        {   
                                                            if($paisselect=='Nicaragua'){
                                                                echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/rit/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>
                                                                <br><ul><li><label>'.$valid->comentario.'</label></ul></li>
                                                                &nbsp;&nbsp;</li>';

                                                            }else{
                                                                if ($valid === reset($ritcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/rit/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente
                                                                    <br><ul><li><label>'.$valid->comentario.'</label></ul></li>
                                                                    &nbsp;&nbsp;</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/rit/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;
                                                                    <br><ul><li><label>'.$valid->comentario.'</label></ul></li>
                                                                    &nbsp;&nbsp;</li>';
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                                                                                              
                                                
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                                            
                                                    </div>              
                                                    </div>
                                                </form>  
        </div>';
                                    }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($_SESSION['id_perfil']==1){?> 
            <div class="card">
                <div class="card-header" id="headingTwo" style="background-color: #002554 !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: #ffffff !important; ">
                            <?php echo $textosArray[124];?>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body" >
                                    <table class="table table-striped tabladatatable dt-responsive" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="25%" scope="col">#</th>
                                            <th width="10%" scope="col"><?php echo $textosArray[123];?></th>
                                            <th width="5%" scope="col"><?php echo $textosArray[78];?></th>
                                            <th width="5%" scope="col"><?php echo $textosArray[21];?></th>
                                            <th width="5%" scope="col"><?php echo $textosArray[102];?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $obrit = ControladorRit::ctrMostrarObservacionRit();
                                             foreach ($obrit as $key => $value2)
                                             {  
                                               echo'<tr>
                                             <td>'.$value2->id.'</td>
                                             <td>'.$value2->observaciones.'</td>
                                             <td>'.$value2->fecha_alta.'</td>
                                             <td>'.$value2->alcance.'</td>
                                             <td>'.$value2->meta.'</td>
                                             </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php }?>
        </div>

        <!-- Modal subirrit -->
        <div  id="subirrit" name="subirrit" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Subir RIT </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">     
                        <input class="d-none" type="text" id="id_usuario" value="<?php echo $idS;?>">                     
                            <div class="form-group">
                                <span><?php echo $textosArray[67];?> </span><!-------------------------------->
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <select name="cboCod_Division" id="cboCod_Division" class="form-control">
                                    <?php
                                    foreach ($divisiones as $key => $valDXP)
                                    { 
                                        $cod_div=$valDXP->cod_division;
                                        if($cod_div!='2S01' && $cod_div!='2S02' && $cod_div!='2S03' && $cod_div!='2S04' && $cod_div!='2S05'){
                                            echo '<option value="'.$valDXP->cod_division.'">'.utf8_encode($valDXP->division).'</option>';
                                        }
                                    }
                                    
                                    ?>
                                    </select>

                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span><?php echo $textosArray[40];?> </span><!-------------------------------->
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" name="txtcomentario" id="txtcomentario" placeholder="Comentario">
                                </div>
                            </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                <span><?php echo $textosArray[155];?></span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="file" class="form-control input-lg fil" size='10000' name="file" id="file" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                        <input type="text" class="d-none" id="size" >
                                    </div>
                                </div>   <!-- ./ form-gruop-->
                                <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).</div>
                                <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).</div>
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary agregarRit" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- id de tipo de archivo es el 22 -->
        <!-- Modal observaciones -->
        <div  id="observaciones" name="observaciones" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[124];?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">                          
                                <div class="form-group">
                                <span><?php echo $textosArray[273];?> </span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                            <input class="form-control" type="text" name="txtobservacion" id="txtobservacion" placeholder="Observaciones"/>
                                      
                                    </div>
                                </div>   <!-- ./ form-gruop-->
                                <div class="row col-md-12">
                                    <div class="form-group col-md-6">
                                    <span><?php echo $textosArray[21];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                                <input class="form-control" type="number" name="alcance" id="alcance" min="1" max="30" maxlength="2" placeholder="1"/>
                                        
                                        </div>
                                    </div>   <!-- ./ form-gruop-->
                                    <div class="form-group col-md-6">
                                    <span><?php echo $textosArray[102];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                                <input class="form-control" type="number" name="meta" id="meta" min="1" max="30" maxlength="2" placeholder="30"/>
                                        
                                        </div>
                                    </div>   <!-- ./ form-gruop-->
                                </div>

                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary agregarObservacion" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
    </section>
    <!-- /.content -->
</div>
<script>
    $('#file').change(function(event) {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarRit" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo").hide();//
                $( ".agregarRit" ).prop( "disabled", false );
        }
        if(extensiones != ".pdf")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregarRit" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();  
                $( ".agregarRit" ).prop( "disabled", false );           
            }
           
    });    

    $(".agregarObservacion").click(function()
    {  
        var datos = new FormData();
        var funcion      = "agregarObservacionRit";
        var id_usuario   = $("#id_usuario").val();
        var observacion  = $("#txtobservacion").val();
        var alcance      = $("#alcance").val();
        var meta         = $("#meta").val();
        if(observacion!='' && alcance!='' && meta!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            // datos.append("id_usuario", id_usuario);
            datos.append("observacion", observacion);
            datos.append("alcance", alcance);
            datos.append("meta", meta);
            $.ajax({
                url:"ajax/rit.ajax.php",
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
                            window.location = 'rit';
                        }
                    });
                }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Registro Exitoso!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'rit';
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

    $(".agregarRit").click(function()
    {  
        var datos = new FormData();
        var funcion      = "agregarRit";
        var id_usuario   = $("#id_usuario").val();
        var cod_division  = $("#cboCod_Division").val();
        var comentario  = $("#txtcomentario").val();
        var file           = $("#file")[0].files[0];

        if(cod_division!='' && file!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("id_usuario", id_usuario);
            datos.append("cod_division", cod_division);
            datos.append("comentario", comentario);
            datos.append("file", file);

            $.ajax({
                url:"ajax/rit.ajax.php",
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
                            // window.location = 'rit';
                            location.reload();
                        }
                    });
                }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Registro Exitoso!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'rit';
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
        }else{
            Swal.fire({ 
            title: 'Error!',
            text: '¡Llenar Información!',
            icon: 'error',
            confirmButtonText:'Ok'
            });
        }
    });

</script>
<!-- /.content-wrapper --><?php ?>
