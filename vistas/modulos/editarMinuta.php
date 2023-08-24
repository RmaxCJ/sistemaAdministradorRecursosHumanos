<?php 
// print_r($_POST);
if (isset($_POST['id_minuta'])) {
    $id_minuta = $_POST['id_minuta'];
};
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar Minuta # <?php echo $id_minuta;?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Minutas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="accordionedit">
            <div class="card" >
                <div class="card-header collapseMinutasEdit" id="headingOne" style="background-color: #002554; color: white;">
                    <h5 class="mb-0">
                        <span class="btn btn-link collapseMinutasEdit" style="color: white;" data-toggle="collapse" data-target="#collapseMinutasEdit" aria-expanded="true" aria-controls="collapseMinutasEdit" style="color: black !important;">
                            Minutas
                        </span>
                    </h5>
                </div>
                <?php
   
                $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
                $sindicatos = ControladorSindicatos::ctrMostrarSindicatos();
                $minutasid = ControladorMinutas::ctrMostrarMinutasID($id_minuta);
                $minutasacuerdosid = ControladorMinutas::ctrMostrarAcuerdosMinutasID($id_minuta);
                //        echo "<pre>";
                //  print_r($minutasacuerdosid);
                //  echo "</pre>";
                // //  echo count($minutas);
                foreach ($minutasid as $key => $valmid)
                {
                 $idu             = $valmid->idu;
                 $id_perfil       = $valmid->id_perfil;
                 $usuario         = $valmid->usuario;
                 $id_sindicato    = $valmid->id_sindicato;
                 $sindicato       = $valmid->sindicato;
                 $nombre_corto    = $valmid->nombre_corto;
                 $idm             = $valmid->idm;
                 $estatus         = $valmid->estatus;
                 $tema            = $valmid->tema;
                 $generales       = $valmid->generales;
                 $nombre_asistente= $valmid->nombre_asistente;
                 $id_archivo      = $valmid->id_archivo;
                }
                ?>
                <div id="collapseMinutasEdit" class="collapse " aria-labelledby="headingOne" data-parent="#accordionedit">
                    <div class="card-body">
                    <input type="texto" class="d-none" id="id_minuta" value="<?php  echo $idm; ?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="cbo_sindicato" id="cbo_sindicato" required>
                                        <option value="">Seleccionar sindicato</option>';
                                      <?php  foreach ($sindicatos as $key => $valD)             
                                            {
                                                $selected="";
                                                $id_sind=$valD->id;//de la consulta de sindicatos
                                                $id_sindicato=$valmid->id_sindicato;//de la consulta de minutas
                                                
                                                if($id_sind==$id_sindicato){$selected = 'Selected';}

                                            echo'<option value="'.$valD->id.'"'  .$selected. '>'.$valD->id. ' - ' .utf8_encode($valD->sindicato).'</option>';
                                            }
                                        ?>        
                                    </select>
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                    </div>
                                    <textarea class="form-control input-lg" type="text" name="txtTema" id="txtTema"  maxlength="150" placeholder="Tema" required><?php echo $tema; ?></textarea>
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div> 
                                    <select class="form-control chosen-selec input-lg" name="cboEstatus" id="cboEstatus" required>
                                        <option value="">Seleccione Estatus</option>

                                    <?php  if($estatus=="A"){ ?>
                                            <option value="">Seleccione Estatus</option>
                                            <option value="A" Selected>Activo</option>
                                            <option value="I" >Inactivo</option>
                                        <?php }else if($estatus=="I"){php?>
                                                <option value="">Seleccione Estatus</option>
                                                <option value="A" >Activo</option>
                                                <option value="I" Selected>Inactivo</option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="cboUsuario" id="cboUsuario" required>
                                        <option value="">Seleccionar Usuario</option>';
                                        <?php foreach ($usuariossencillos as $key => $valU)             
                                            {
                                                $selected="";
                                                $id_usu=$valU->id;//de la consulta de sindicatos
                                                $id_perfil=$valU->id_perfil;//de la consulta de sindicatos
                                                
                                                if($id_usu==$idu){$selected = 'Selected';}
                                                    if($id_perfil==3){
                                                    echo'<option value="'.$valU->id.'"'  .$selected. '>'.$valU->id. ' - ' .utf8_encode($valU->usuario).'</option>';
                                                    }
                                                }
                                            ?>
                                    </select>

                                    </select>
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                    </div>
                                    <textarea class="form-control input-lg" name="txtGenerales" id="txtGenerales" placeholder="Generales" required><?php echo $generales; ?></textarea>

                                </div>
                            </div>   <!-- ./ form-gruop-->
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header collapseAsistentesEdit" style="background-color: #002554; color: white;" id="headingTwo" style="background-color: #a6adb1 !important; ">
                    <h5 class="mb-0">
                        <span class="btn btn-link collapsed collapseAsistentesEdit" style="color: white;" data-toggle="collapse" data-target="#collapseAsistentesEdit" aria-expanded="false" aria-controls="collapseAsistentesEdit" style="color: black !important;">
                            Asistentes Minutas
                        </span>
                    </h5>
                </div>
                <div id="collapseAsistentesEdit" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionedit">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" value="<?php echo $nombre_asistente;?>" name="txtNombreAsistente" id="txtNombreAsistente" maxlength="75" placeholder="Nombre Asistente" required>
                            </div>
                        </div><!-- ./ form-gruop-->
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header collapseAcuerdosEdit" style="background-color: #002554; color: white;" id="headingAcuerdos" style="background-color: #a6adb1 !important; ">
                    <h5 class="mb-0">
                        <span class="btn btn-link collapsed collapseAcuerdosEdit" style="color: white;" data-toggle="collapse" data-target="#collapseAcuerdosEdit" aria-expanded="false" aria-controls="collapseAcuerdosEdit" style="color: black !important;">
                            Acuerdos Minutas
                        </span>
                    </h5>
                </div>
                <div id="collapseAcuerdosEdit" class="collapse" aria-labelledby="headingAcuerdos" data-parent="#accordionedit">
                    <div class="card-body">

                    <table class="table table-bordered" width="100%">
                        <thead style="background-color:#002554; color:white; !important;">
                        <tr>
                            <th width="23%">Acuerdo</th>
                            <th width="23%">Fecha Compromiso</th>
                            <th width="23%">Responsable</th>
                            <th width="23%">Comentarios</th>
                            <th width="8%">Agregar</th>
                        </tr>
                        </thead>
                        <tbody id="tablaagregaracuerdos">
                        <tr>
                            <td>
                                <textarea type="text" class="form-control input-lg" name="Acuerdo" id="Acuerdo" placeholder="Acuerdo" required></textarea>
                            </td>
                            <td>
                                <input type="date" class="form-control input-lg" name="FechaCompromiso" id="FechaCompromiso" required>
                            </td>
                            <td>
                                <input type="text" class="form-control input-lg" name="Responsable" id="Responsable" maxlength="75" placeholder="Responsable" required>
                            </td>
                            <td>
                                <textarea class="form-control input-lg" name="txtComentarios" id="Comentarios" placeholder="Comentarios" required></textarea>
                            </td class="justify-content-center align-items-center">
                            <td>
                                <button class="btn btn-primary Agregaracuerdos" aria-label="Agregar Contacto" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        </tbody>
                        <?php 
                    foreach ($minutasacuerdosid as $key => $valacmid)
                    {   
                        echo '<tr id="">
                                <td>
                                    <textarea type="text" class="form-control input-lg" name="" id="Acuerdo_'.$valacmid->id.'" placeholder="Acuerdo" required>'.$valacmid->acuerdo.'</textarea>
                                </td>
                                <td>
                                    <input type="date" class="form-control input-lg" name="" value="'.$valacmid->fecha_compromiso.'" id="FechaCompromiso_'.$valacmid->id.'" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-lg" name="" value="'.$valacmid->responsable.'" id="Responsable_'.$valacmid->id.'" maxlength="75" placeholder="Responsable" required>
                                </td>
                                <td>
                                    <textarea class="form-control input-lg" name="" id="Comentarios_'.$valacmid->id.'" placeholder="Comentarios" required>'.$valacmid->comentarios.'</textarea>
                                </td class="justify-content-center align-items-center">
                                <td >
                                    <center><!-------------check box para editar datos------------------>
                                    <p>Editar</p>
                                    <input class="editacuerdo" title="Al marcar esta casilla el registro se Editara  cuando guarde los cambios" type="checkbox" name="chkUpdate[]" id="chkUpdate" idAcuerdo="'.$valacmid->id.'"></center>
                                    <!--button class="btn btn-primary Agregaracuerdos" aria-label="Agregar Contacto" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button-->
                                </td>
                            </tr>'; 
                    }
                ?>    
                    </table>
                    <input type="text" class="d-non" id="jsonAcuerdos"><!--Json para armar el guardado de acuerdos-->
                    <input type="text" class="d-non" id="jsonAcuerdosEdit"><!--Json para armar el guardado de acuerdos-->

                    </div>
                   
                </div>
            </div>
            <div class="card">
                <div class="card-header collapseArchivosEdit" style="background-color: #002554; color: white;" id="headingArchivos" style="background-color: #a6adb1 !important;">
                    <h5 class="mb-0">
                        <span class="btn btn-link collapsed collapseArchivos" style="color: white;" data-toggle="collapse" data-target="#collapseArchivosEdit" aria-expanded="false" aria-controls="collapseArchivosEdit" style="color: black !important;">
                            Archivos Minutas
                        </span>
                    </h5>
                </div>
                <div id="collapseArchivosEdit" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordionedit">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="file" class="form-control input-lg" name="editarfile" id="editarfile">

                                </div>
                            </div>   <!-- ./ form-gruop-->
                    </div>
                </div>
            </div>
            
        </div>
        <div class="float-right">
        <button type="button" class="btn btn-primary agregarMinutasedit"  id_minuta="<?php echo $idm;?>">Guardar</button>
        </duv>

    </section>
    <!-- /.content -->
</div>
<script>
$(document).ready (function ()
{
    $(".Agregaracuerdos").click(addAcuerdo); //agregar sub tabla
    $(".editacuerdo").click(addAcuerdoEditar); //agregar el input en arreglo
    
    $(".agregarMinutasedit").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base] 
        var id_minuta = $(this).attr("id_minuta");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="editarMinutas";
        var Sindicato       = $("#cbo_sindicato").val();
        var Tema            = $("#txtTema").val();
        var Estatus         = $("#cboEstatus").val();
        var Usuario         = $("#cboUsuario").val();
        var Generales        = $("#txtGenerales").val();
        var NombreAsistente = $("#txtNombreAsistente").val();
        // var Acuerdo         = $("#txtAcuerdo").val();
        // var FCompromiso     = $("#txtFechaCompromiso").val();
        // var Responsable     = $("#txtResponsable").val();
        // var Comentarios     = $("#txtComentarios").val();
        var jsonAcuerdos = $("#jsonAcuerdos").val(); 
        var jsonAcuerdosEdit = $("#jsonAcuerdosEdit").val();
         

        
        var file            = $("#file").val();
        
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("Sindicato", Sindicato);
        datos.append("Tema", Tema);
        datos.append("Estatus", Estatus);
        datos.append("Usuario", Usuario);
        datos.append("Generales", Generales);
        datos.append("NombreAsistente", NombreAsistente);
        datos.append("jsonAcuerdos", jsonAcuerdos);
        datos.append("jsonAcuerdosEdit", jsonAcuerdos);
        
        // datos.append("Acuerdo", Acuerdo);
        // datos.append("FCompromiso", FCompromiso);
        // datos.append("Responsable", Responsable);
        // datos.append("Comentarios", Comentarios);
        datos.append("file", file);
        datos.append("id_minuta", id_minuta);
        
        $.ajax({
            url:"ajax/minutas.ajax.php",
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
                          window.location = 'minutas';
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
                              window.location = 'minutas';
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
});

function addAcuerdoEditar() {
        contador += 1;//contador sumando
        var id_minuta         = $('#id_minuta').val();
        var idAc = $(this).attr("idAcuerdo");//tomar el id 
        var Acuerdo         = $("#Acuerdo_"+idAc+"").val();
        var FechaCompromiso = $("#FechaCompromiso_"+idAc+"").val();
        var Responsable     = $("#Responsable_"+idAc+"").val();
        var Comentarios     = $("#Comentarios_"+idAc+"").val();
       
            var info ="<input class='d-none' type='text' name='jsonAcuEdit[]' value='"+ idAc +"/"+ id_minuta +"/"+ Acuerdo +"/"+ FechaCompromiso +'/' + Responsable + '/'+ Comentarios +'~'+"'/>";
            $("#tablaagregaracuerdos").append(info);
            jasonAcuerdosEdit();

}
var contador = 0;//variable para remover
function addAcuerdo() {
        contador += 1;//contador sumando
        var idremove = "$('#acuerdo_"+contador+"')";
        var id_minuta         = $('#id_minuta').val();
        var Acuerdo         = $('#Acuerdo').val();
        var FechaCompromiso = $('#FechaCompromiso').val();
        var Responsable     = $('#Responsable').val();
        var Comentarios     = $('#Comentarios').val();
        if (Acuerdo != "" && FechaCompromiso != "" && Responsable != "") { //checar si vienen diferende de vacia
            var info = "<tr name='' id='acuerdo_"+contador+"'>"+
                            // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'{"acuerdo":'+ Acuerdo +","+'"FechaCompromiso":'+ FechaCompromiso +','+'"Responsable":'+ Responsable +','+'"Comentarios":'+ Comentarios +'},'+"'/></td>"+
                            // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'array('+'"'+ Acuerdo +'"'+","+'"'+ FechaCompromiso +'"' + ','+ '"'+ Responsable + '"'+ ','+ '"'+ Comentarios + '"'+ '),'+"'/></td>"+
                            "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+ id_minuta +"/"+ Acuerdo +"/"+ FechaCompromiso +'/' + Responsable + '/'+ Comentarios +'~'+"'/></td>"+
                            "<td><input class='form-control' name='' id='' type='text'  value='" + Acuerdo + "' autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='' id='' value='" + FechaCompromiso + "'  autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='' id='' value='" + Responsable + "'  autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='' id='' value='" + Comentarios + "'  autofocus readonly/></td>"+
                            "<td align='center'><button class='btn btn-primary' onclick="+idremove+".remove();' >Eliminar</button></td>"+
                        "</tr>";
            $("#tablaagregaracuerdos").append(info);
            // calcular();
            reset_campos(); //funcion resetear campos
            $('#llenarcamposacuerdos').hide();
            jasonAcuerdos();
        } else {
            $('#llenarcamposacuerdos').show();
        }
}

function reset_campos() { //reseteo de campos
    $("#Acuerdo").val("");
    $("#FechaCompromiso").val("");
    $("#Responsable").val("");
    $("#Comentarios").val("");
    //$('#cboIva').prop('selectedIndex', 0);//para regresar al index en cero o vacio
}

function jasonAcuerdos(){
    var jsonIngredien = '';
    var ingCount = document.getElementsByName("jsonAcu[]").length;
    for(i=0;i<ingCount;i++){
         jsonIngredien =jsonIngredien+$("input[name*='jsonAcu']")[i].value;
        $('#jsonAcuerdos').val(" "+jsonIngredien+" "); //formatojson
    }
}
function jasonAcuerdosEdit(){
    var jsonIngredien = '';
    var ingCount = document.getElementsByName("jsonAcuEdit[]").length;
    for(i=0;i<ingCount;i++){
         jsonIngredien =jsonIngredien+$("input[name*='jsonAcuEdit']")[i].value;
        $('#jsonAcuerdosEdit').val(" "+jsonIngredien+" "); //formatojson
    }
}
</script>
<!-- /.content-wrapper --><?php


                        