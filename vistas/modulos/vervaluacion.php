<?php 
// echo var_dump($_REQUEST);
 if (@isset($_REQUEST)) {
     @$idV                             = $_REQUEST["idV"];
     @$cod_division                    = $_REQUEST["cod_division"];
     @$division                        = $_REQUEST["division"]; //
     @$subdivision                     = $_REQUEST["subdivision"];
     @$anio                            = $_REQUEST["anio"];
     @$prop_neg                        = $_REQUEST["prop_neg"];
     @$prest_fijas_agui_sal_fijo       = $_REQUEST["prest_fijas_agui_sal_fijo"]; //
     @$prest_fijas_prima_vac_sal_fijo  = $_REQUEST["prest_fijas_prima_vac_sal_fijo"];
     @$prest_fijas_fond_ahorro_sal_fi  = $_REQUEST["prest_fijas_fond_ahorro_sal_fi"];
     @$prest_var_bono_prod             = $_REQUEST["prest_var_bono_prod"];
     @$otros_gastos_rev_cct            = $_REQUEST["otros_gastos_rev_cct"]; //
     @$otros_gastos_iguala_sind        = $_REQUEST["otros_gastos_iguala_sind"];
     @$otros_gastos_fom_dep_bolsas     = $_REQUEST["otros_gastos_fom_dep_bolsas"];     
} 
// echo $op;
?>
<input type="text" class="d-none" id="" value="<?php echo $op; ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Valuaciones </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="valuaciones">Valuaciones</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="box">

            <!-- <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalGenerarValuacion">Generar Valuacion</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalSubirExcelValuacionPlantilla">Subir Plantilla</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalSubirExcelTabuladores">Subir Tabuladorees</button>
                <br><br>
            </div> -->
        </div>

        <?php
        $sindicatos = ControladorSindicatos::ctrMostrarSindicatos();
        $divisiones = ControladorDivisiones::ctrMostrarDivisiones();
        $pv_divisiones = ControladorValuaciones::ctrMostrarValuacionesDivisiones();

        ?>
        <div class="row container-fluid">
            <div class="col-md-12">
                <div id="collapseValuacion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <span>División *</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    </div>
                                    <input type="text" class="form-control d-none" value="<?php echo $cod_division; ?>" id="cboCodDivision" readonly>
                                    <input type="text" class="form-control" value="<?php echo $division; ?>" id="" readonly>
                                    
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group col-md-4">
                                <span>Subdivisión de Personal *</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $subdivision; ?>" id="cboSubDivPersonal" readonly> 
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group col-md-4">
                                <span>Año *</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $anio; ?>" id="cboanio" readonly> 
                                </div>
                            </div><!-- ./ form-gruop-->
                            <!-- <div class="form-group col-md-2">
                                <span>Buscar</span>
                                <div class="input-group">                                                      
                                            <button class="btn btn-success" id="BuscarPlantilla" onclick="BuscarPlantilla()"><i class="fa fa-search"></i>&nbsp;Buscar plantilla</button>
                                </div>
                            </div> -->
                            <!-- ./ form-gruop-->
                        </div>
                        <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
                        <div class=" col-md-12 d-flex justify-content-md-center">
                            <table class="table table-bordered  table-sm " width="100%">
                                <thead style="background-color:#002554; color:white; !important;">
                                <tr>
                                    <th width="33%"><p>Condición Actual 2020</p></th>
                                    <th width="33%"><p>Propuesta Negociación</p></th>
                                    <th width="33%"><p>Condición 2021</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="d-flex justify-content-md-center" id="HC1"></td>
                                    <td><input class="form-control" type="text" id="prop_neg" value="<?php echo $prop_neg; ?>" readonly></td>
                                    <td class="d-flex justify-content-md-center" id="HC2"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="container-fluid">
                            <!-- <h2></h2>
                            <br> -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" >
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#valuacion1" id="valuacion_1">Valuación 2020</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#valuacion2" >Valuacion 2021</a><!--onclick="Resultado()"-->
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#costeo" >Costeo</a><!--onclick="aguinaldo_dias_propuesta()"-->
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#totales">Totales</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div id="valuacion1" class="container-fluid tab-pane"><br>
                                <h5>Valuación 2020</h5>
                                <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                                    <div class="row col-md-12">
                                        <table class="table table-bordered table-sm  table-striped table-hover" width="100%">
                                        <!-- style="background-color:#002554; color:white; !important;" -->
                                            <thead >
                                            <tr>
                                                <th width="4%" style="font-size: 14px;"><p>Categoria</p></th>
                                                <th width="10%" style="font-size: 14px;"><p>Posición</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>No. Trabajadores</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Diario</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>SBC</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>costo total por posición mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Variable Promedio Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Carga Social Promedio Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de Aguinaldo en días</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de Prima Vacacional %</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de dias Vacaciones</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>% de fondo de ahorro</p></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            </tr>
                                            </tbody>
                                            <tbody id="tablaagregardatos">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row col-md-12 d-flex justify-content-md-center">
                                        <table class="table table-bordered table-sm col-md-6 table-striped table-hover" width="100%">
                                            <tbody >
                                                <tr><td width="60%">Total HC </td>                                                <td  width="40%" id="HC3"></td></tr>
                                                <tr><td width="60%">Salario Fijo Promedio Diario</td>                             <td width="40%" id="salario_diario"></td></tr>
                                                <tr><td width="60%">Salario Fijo Promedio Mensual</td>                            <td width="40%" id="salario_fijo_promedio_mensual"></td></tr>
                                                <tr><td width="60%">Salario Base de Cotización Promedio</td>                      <td width="40%" id="salario_SBC"></td></tr>
                                                <tr><td width="60%">Salario Variable Promedio Mensual (Bono de productividad)</td><td width="40%" id="costo_tot_pos_m"></td></tr>
                                                <tr><td width="60%">Total Carga SocialPromedio Mensual 2020</td>                  <td width="40%" id="carga_soc_prom_m"></td></tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="table table-bordered table-sm col-md-6 table-striped table-hover " width="100%">
                                            <tbody>
                                                <tr><td width="60%">Total Costo Anual 2020</td>                         <td width="40%" id="cost_tot_posc_a"></td>
                                                <td class="d-none"><input type="text"  id="total_costo_anual"></td></tr>
                                                <tr><td width="60%">Total Costo Anual Salario Variable 2020</td>        <td width="40%" id="cost_tot_posc_a_v"></td></tr>
                                                <tr><td width="60%">Total Costo Anual Salario Fijo + Variable 2020</td> <td width="40%" id="cot_tot_anual_fijo_y_variable"></td></tr>
                                                <tr><td width="60%">Total Carga Social 2020</td>                        <td width="40%" id="cot_tot_anual_carga_soc"></td>
                                                <td class="d-none"><input id="total_carga_social_val"></td></tr>
                                                <tr>
                                                    <td width="60%">Promedio Aguinaldo en días</td>                  
                                                    <td width="40%" id="prom_Agui_dias"></td>
                                                    <td width="40%" ><input type="text" class="d-none" id="prom_Agui_dias_2" value="<?php echo $prest_fijas_agui_sal_fijo; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="60%">Promedio prima vacacional en %</td>
                                                    <td width="40%" id="prima_vacacional_a"></td>
                                                    <td class="d-none"><input id="prima_vacacional_a_val"></td>
                                                    <td width="40%" ><input type="text" class="d-none" id="prima_vacacional_a_val_2" value="<?php echo $prest_fijas_prima_vac_sal_fijo; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="60%">Promedio vacaciones en días</td>
                                                    <td width="40%" id="prom_vacaciones_dias_a"></td>
                                                    <td class="d-none"><input id="prom_vacaciones_dias_a_val"></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td width="60%">Porcentaje Fondo de Ahorro</td>
                                                    <td width="40%" id="prom_fondo_ahorro_a"></td>
                                                    <td width="40%" ><input type="text" class="d-none" id="prom_fondo_ahorro_a_2" value="<?php echo $prest_fijas_fond_ahorro_sal_fi; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" ><input type="text" class="d-none" id="prest_variables_propuesta_2" value="<?php echo $prest_var_bono_prod; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                            </div>
                                <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                                
                                </div>
                                <div id="valuacion2" class="container-fluid tab-pane fade"><br>
                                    <!--div class="row"><h5>Valuación 2021</h5></div-->
                                    <!-- <div class="float-right"><button class="btn btn-primary float-left" onclick="Resultado()">Calcular</button><br><br></div><br> -->
                                    <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                                    <div class="row col-md-12">
                                        <table class="table table-bordered table-sm  table-striped table-hover" id="tabla2" width="100%">
                                        <!-- style="background-color:#002554; color:white; !important;" -->
                                            <thead >
                                            <tr>
                                                <th width="4%" style="font-size: 14px;"><p>Categoria</p></th>
                                                <th width="10%" style="font-size: 14px;"><p>Posición</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>No. Trabajadores</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Diario</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>SBC</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>costo total por posición mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Salario Variable Promedio Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Carga Social Promedio Mensual</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de Aguinaldo en días</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de Prima Vacacional %</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>Promedio de dias Vacaciones</p></th>
                                                <th width="7%" style="font-size: 14px;"><p>% de fondo de ahorro</p></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            </tr>
                                            </tbody>
                                            <tbody id="tablaagregardatos_2">
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <button id="" onclick="resultado();"> Recorrer tabla</button> -->
                                    <div class="row col-md-12 d-flex justify-content-md-center">
                                        <table class="table table-bordered table-sm col-md-6 table-striped table-hover" width="100%">
                                            <tbody >
                                                <tr><td width="60%">Total HC </td>                                                <td width="40%" id="HC3_2"></td></tr>
                                                <tr><td width="60%">Salario Fijo Promedio Diario</td>                             <td width="40%" id="salario_diario_2"></td></tr>
                                                <tr><td width="60%">Salario Fijo Promedio Mensual</td>                            <td width="40%" id="salario_fijo_promedio_mensual_2"></td></tr>
                                                <tr><td width="60%">Salario Base de Cotización Promedio</td>                      <td width="40%" id="salario_SBC_2"></td></tr>
                                                <tr><td width="60%">Salario Variable Promedio Mensual (Bono de productividad)</td><td width="40%" id="costo_tot_pos_m_2"></td></tr>
                                                <tr><td width="60%">Total Carga SocialPromedio Mensual 2020</td>                  <td width="40%" id="carga_soc_prom_m_2"></td></tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="table table-bordered table-sm col-md-6 table-striped table-hover " width="100%">
                                            <tbody>
                                                <tr><td width="60%">Total Costo Anual 2021</td>                         <td width="40%" id="cost_tot_posc_a_2"></td></tr>
                                                <tr><td width="60%">Total Costo Anual Salario Variable 2020</td>        <td width="40%" id="cost_tot_posc_a_v_2"></td></tr>
                                                <tr><td width="60%">Total Costo Anual Salario Fijo + Variable 2020</td> <td width="40%" id="cot_tot_anual_fijo_y_variable_2"></td></tr>
                                                <tr><td width="60%">Total Carga Social 2021</td>                        <td width="40%" id="cot_tot_anual_carga_soc_2"></td></tr>
                                                <!-- <tr><td width="60%">Promedio Aguinaldo en días</td>                     <td width="40%" id="prom_Agui_dias_2"></td></tr>
                                                <tr><td width="60%">Promedio prima vacacional en %</td>                 <td width="40%" id="prima_vacacional_a_2"></td></tr>
                                                <tr><td width="60%">Promedio vacaciones en días</td>                    <td width="40%" id="prom_vacaciones_dias_a_2"></td></tr>
                                                <tr><td width="60%">Porcentaje Fondo de Ahorro</td>                     <td width="40%" id="prom_fondo_ahorro_a_2"></td></tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                                <div id="costeo" class="container-fluid tab-pane fade"><br>                                                    
                                    <table class="table table-bordered table-sm col-md-12 table-striped table-hover" id="salario" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="9" style="background-color: #990000; color: white;">1.- SALARIO</td>
                                            </tr>
                                            <tr class="text-center">
                                                <th title="">Concepto</th>
                                                <th title="Condición Actual 2020">Condición Actual</th>
                                                <th title="Condición 2021">Condición 2021 </th>
                                                <th title="%">%</th>
                                                <th title="Incremento en $ sobre costo actual">Incremento en $...</th>
                                                <th title="Incremento sobre costo total actual">Incremento sobre...</th>
                                                <th title="% de incremento nomina actual">% de incremento...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo Anual">Proporcion S/cost...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo + Variable Anual">Proporcion sobre ...</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td width="15%" id="">Fijo Anual</td>
                                                <td class="d-none"><input  id="fijo_anual_val"></td><!--input de fijo anual-->
                                                <td width="11%" id="fijo_anual"></td>
                                                <td width="11%" id="fijo_anual_2"></td>
                                                <td width="7%" id="propuesta_fijo_anual"></td>
                                                <td width="11%" id="incre_en_sobre_costo_actual"></td>
                                                <td width="11%" id="incre_sobre_cost_tot_act"></td>
                                                <td width="11%" id="porce_increm_nomi_actual"></td>
                                                <td width="11%" id="prop_sobre_costo_total_CCT"></td>
                                                <td width="11%" id="prop_sb_cost_fijomasvar"></td>
                                            </tr>
                                            <tr>
                                                <td width="15%" id="">Variable Anual</td>
                                                <td width="11%" id="variable_anual"></td>
                                                <td width="11%" id="variable_anual_2"></td>
                                                <td width="7%" id="propuesta_fijo_anual_2"></td>
                                                <td width="11%" id="incre_en_sobre_costo_actual_2"></td>
                                                <td width="11%" id="incre_sobre_cost_tot_act_2"></td>
                                                <td width="11%" id="porce_increm_nomi_actual_2"></td>
                                                <td width="11%" id="prop_sobre_costo_total_CCT_2"></td>
                                                <td width="11%" id="prop_sb_cost_fijomasvar_2"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td width="15%" style="color: #990000; " id="">Salario Fijo + Variable</td>
                                                <td width="11%" style="color: #990000; " id="fijo_a_mas_variable_a"></td>
                                                <td width="11%" style="color: #990000; " id="fijo_a_mas_variable_a_2"></td>
                                                <td width="7%" id=""></td>
                                                <td width="11%" id=""></td>
                                                <td width="11%" id=""></td>
                                                <td width="11%" id=""></td>
                                                <td width="11%" id=""></td>
                                                <td width="11%" id=""></td>
                                            </tr>
                                            <tr><td><input type="text" class="form-control d-none" name="" id="fijo_a_mas_variable_a_val"></td></tr>
                                            
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered table-sm col-md-12 table-striped table-hover" id="prestaciones_fijas" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="13" style="background-color: #990000; color: white;">2. PRESTACIONES FIJAS	</td>
                                            </tr>
                                            <tr class="text-center">
                                                <th title=""></th>
                                                <th title="">Concepto</th>
                                                <th title="">Actual</th>
                                                <th title="">Condición Actual</th>
                                                <th title="">Dias Propuesta</th>
                                                <th title="">% Propuesta</th>
                                                <th title="Condición 2021">Condición 2021 </th>
                                                <th title="%">%</th>
                                                <th title="Incremento en $ sobre costo actual">Incremento en $...</th>
                                                <th title="Incremento sobre costo total actual">Incremento sobre...</th>
                                                <th title="% de incremento nomina actual">% de incremento...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo Anual">Proporcion S/cost...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo + Variable Anual">Proporcion sobre ...</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td width="10%" id="">Aguinaldo/Salario Fijo</td>
                                                <td width="7%" id="dias_agui"></td>
                                                <td width="7%" id="dias_aguinaldo_actual"></td>
                                                <td width="7%" id="dias_agui_actual"></td>
                                                <td width="7%" id=""><input type="number" class="form-control" value="<?php echo $prest_fijas_agui_sal_fijo; ?>" id="aguinaldo_dias_propuesta" name="aguinaldo_dias_propuesta" min="1" max="100" readonly></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id="agu_sal_fijo"></td>
                                                <td width="7%" id="porc_agu_propuesta"></td>
                                                <td width="7%" id="incre_en_agu_sal_fijo"></td>
                                                <td width="7%" id="incre_sobre_cost_to_ac"></td>
                                                <td width="7%" id="porc_incr_nomin_agui_sal_fijo"></td>
                                                <td width="7%" id="prop_sob_cos_act_agu_sal_fij"></td>
                                                <td width="7%" id="prop_sob_cost_cct_agui_sal_fij"></td>
                                            </tr>
                                            <tr>
                                                <td width="17%" id="">Prima Vacacional/Salario Fijo</td>
                                                <td width="7%" id="prima_vacacional_actual"></td>
                                                <td width="7%" id="prima_vacacional_actual2"></td>
                                                <td width="7%" id="prim_vac_sal_fi_act"></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""><input type="number" class="form-control" value="<?php echo $prest_fijas_prima_vac_sal_fijo; ?>" id="prim_vac_dia_prop_porc" name="prim_vac_dia_prop_porc" min="1" max="100" readonly></td>
                                                <td width="7%" id="cond_con_propues_sal_fijo"></td>
                                                <td width="7%" id="porc_prim_vac_sal_fijo"></td>
                                                <td width="7%" id="incre_en_sob_costo_prima_vac"></td>
                                                <td width="7%" id="inc_sob_cost_tot_act_prim_vac_sal"></td>
                                                <td width="7%" id="porc_de_incre_nom_prim_vac_sal_fij"></td>
                                                <td width="7%" id="pro_sob_cost_act_cct_prima_cav"></td>
                                                <td width="7%" id="pro_sob_cos_tot_cct_prima_vac"></td>
                                            </tr>
                                            <tr>
                                                <td width="17%" id="">Fondo de Ahorro/Salario Fijo</td>
                                                <td width="7%" id="porcentaje_fondo_ahorro_actual"></td>
                                                <td width="7%" id="porcentaje_fondo_ahorro_actual2"></td>
                                                <td width="7%" id="fon_aho_sal_fi_act_por_sub_fij_nual"></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""><input type="number" class="form-control" value="<?php echo $prest_fijas_fond_ahorro_sal_fi; ?>" id="fond_ahorro_prropuesta" name="fond_ahorro_prropuesta" min="1" max="100" readonly></td>
                                                <td width="7%" id="cond_fond_ahorro_sal_fijo"></td>
                                                <td width="7%" id="porc_fondo_ahorro_sal_fijo"></td>
                                                <td width="7%" id="incr_en_sobre_cost_act_fond_ahorr"></td>
                                                <td width="7%" id="incr_sobr_cost_tot_act_fond_ahor"></td>
                                                <td width="7%" id="porc_incre_nom_actual_fond_ahorro"></td>
                                                <td width="7%" id="prop_sob_cost_tot_cct_fon_ahorro"></td>
                                                <td width="7%" id="prop_sob_cost_tot_cct_fijo_fond_ahorro"></td>
                                            </tr>
                                            <tr>
                                                <td width="17%" id=""></td>
                                                <td width="7%" id="">Vacaciones promedio</td>
                                                <td width="7%" id="prom_vacaciones_dias_actual"></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                            </tr>
                                            <tr>
                                                <td width="17%" id=""></td><td width="7%" id="">Subtotal</td><td width="7%" id=""></td><td width="7%" id="subtotal_prest_fijas"></td>
                                                <td width="7%" id=""></td><td width="7%" id=""></td><td width="7%" id="sub_tot_cond"></td><td width="7%" id="sub_tot_porc"></td>
                                                <td width="7%" id="sub_tot_incr_en"></td><td width="7%" id="sub_tot_inc_sob_cost_to_act"></td><td width="7%" id="sub_tot_inc_sob_nomina"></td><td width="7%" id="sub_tot_prop_sob_cost_cct"></td>
                                                <td width="7%" id="sub_tot_prop_sob_cost_cct_fijo_mas_var"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered table-sm col-md-12 table-striped table-hover" id="prestaciones_variables" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="13" style="background-color: #990000; color: white;">3. PRESTACIONES VARIABLES	</td>
                                            </tr>
                                            <tr class="text-center">
                                                <th title=""></th>
                                                <th title="">Concepto</th>
                                                <th title="">Actual</th>
                                                <th title="">Condición Actual</th>
                                                <th title="">Dias Propuesta</th>
                                                <th title="">% Propuesta</th>
                                                <th title="Condición 2021">Condición 2021 </th>
                                                <th title="%">%</th>
                                                <th title="Incremento en $ sobre costo actual">Incremento en $...</th>
                                                <th title="Incremento sobre costo total actual">Incremento sobre...</th>
                                                <th title="% de incremento nomina actual">% de incremento...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo Anual">Proporcion S/cost...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo + Variable Anual">Proporcion sobre ...</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td width="10%" id="">Bono de Productividad</td>
                                                <td width="7%" id="">Salario Fijo Anual</td>
                                                <td width="7%" id="prest_fij_sal_fijo_anual_porc"></td>
                                                <td width="7%" id="cond_act_pres_var"></td>
                                                <td width="7%" id="">0</td>
                                                <td width="7%" id=""><input type="number" class="form-control" value="<?php echo $prest_var_bono_prod; ?>" id="prest_variables_propuesta" min="1" max="100" readonly></td>
                                                <td width="7%" id="condi_prest_var"></td>
                                                <td width="7%" id="porc_prest_variables"></td>
                                                <td width="7%" id="inc_en_prest_variables"></td>
                                                <td width="7%" id="incre_sobre_prest_variables"></td>
                                                <td width="7%" id="porc_increm_nom_actual_prest_variables"></td>
                                                <td width="7%" id="pro_sobr_cost_tot_prest_variables"></td>
                                                <td width="7%" id="pro_sobr_cost_tot_mas_var_prest_variables"></td>
                                            </tr>
                                            <tr>
                                                <td width="10%" id=""></td>
                                                <td width="7%" id="">Subtotal</td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id="cond_act_pres_var_2"></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id=""></td>
                                                <td width="7%" id="condi_prest_var_2"></td>
                                                <td width="7%" id="porc_prest_variables_2"></td>
                                                <td width="7%" id="inc_en_prest_variables_2"></td>
                                                <td width="7%" id="incre_sobre_prest_variables_2"></td>
                                                <td width="7%" id="porc_increm_nom_actual_prest_variables_2"></td>
                                                <td width="7%" id="pro_sobr_cost_tot_prest_variables_2"></td>
                                                <td width="7%" id="pro_sobr_cost_tot_mas_var_prest_variables_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                            <table class="table table-bordered table-sm col-md-12 table-striped table-hover" id="beneficios" width="100%">
                                                <thead>
                                                    <tr class="text-center">
                                                        <td colspan="13" style="background-color: #990000; color: white;">4. BENEFICIOS	</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <th title="" colspan="2"></th>
                                                        <th title="">Condiciones actuales</th>
                                                        <th title="">Condiciones actuales</th>
                                                        <th title="">Propuesta 2021	</th>
                                                        <th title="Condición 2021">Propuesta 2021 </th>
                                                        <th title="" colspan="6"></th>

                                                    </tr>
                                                    <tr class="text-center">

                                                        <th title="">Concepto</th>
                                                        <th title="Numero de Trabajadores"># de Trabajadores</th>
                                                        <th title="Monto de Pago por colaborador">Monto de Pago por colaborador</th>
                                                        <th title="Monto Total por Concepto">Monto Total por Concepto</th>
                                                        <th title="Monto de Pago por colaborador">Monto de Pago por colaborador</th>
                                                        <th title="Monto Total por Concepto">Monto Total por Concepto</th>
                                                        <th width="5%" title="%">%</th>
                                                        <th title="Incremento en $ sobre costo actual">Incremento en $...</th>
                                                        <th title="Incremento sobre costo total actual">Incremento sobre...</th>
                                                        <th title="% de incremento nomina actual">% de incremento...</th>
                                                        <th title="Proporcion sobre el costo total del CCT Fijo Anual">Proporcion S/cost...</th>
                                                        <th title="Proporcion sobre el costo total del CCT Fijo + Variable Anual">Proporcion sobre ...</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <script type="text/javascript">
                                                    function addCommas(nStr){
                                                        nStr += '';
                                                        x = nStr.split('.');
                                                        x1 = x[0];
                                                        x2 = x.length > 1 ? '.' + x[1] : '';
                                                        var rgx = /(\d+)(\d{3})/;
                                                        while (rgx.test(x1)) {
                                                            x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                                        }
                                                        return x1 + x2;
                                                    }
                                                    function CBeneficiosActual(num){
                                                        var b = $("#B-"+num).val();
                                                        var c = $("#C-"+num).val();
                                                        var sumatotalesD = 0;
                                                        if(b!='' && c!=''){
                                                            var monttotconcep=b*c;
                                                            $("#D-"+num).text(monttotconcep.toFixed(2));//
                                                            for (var i=1; i<9; i++) {//for para la suma de la columna D
                                                                var dsum = $("#D-"+i).text();
                                                                if(dsum!='0.00' && dsum!=""){
                                                                    sumatotalesD = parseFloat(sumatotalesD)+parseFloat($("#D-"+i).text());
                                                                    $("#D-9").text('$ '+addCommas(sumatotalesD.toFixed(2)));            
                                                                    // console.log('intento ' + i);
                                                                }
                                                            }
                                                            // $("#D-9").text(totd);
                                                        }else{
                                                            $("#D-"+num).text('0.00');//
                                                        }
                                                    }
                                                    function CPagoColaborador(num){
                                                        var b = $("#B-"+num).val();
                                                        var e=$("#E-"+num).val();
                                                        var fijoanual = $("#fijo_anual_val").val();//fijo anuall
                                                        if(b!='' && e!=''){
                                                        var monttotconcep2=b*e;
                                                        $("#F-"+num).text(monttotconcep2.toFixed(2));//
                                                        var sumatotalesF = 0;//////////////////////////////////////////////////////for totalesF
                                                            for (var i=1; i<9; i++) {//for para la suma de la columna D
                                                                var fsum = $("#F-"+i).text();
                                                                if(fsum!='0.00' && fsum!=""){
                                                                    sumatotalesF = parseFloat(sumatotalesF)+parseFloat($("#F-"+i).text());
                                                                    $("#F-9").text('$ '+addCommas(sumatotalesF.toFixed(2)));     
                                                                    // $("#F-9").text(sumatotalesF);            
                                                                    // console.log('intento ' + i);
                                                                    var dtot_ = $("#D-9").text();
                                                                    var dtot=dtot_.substring(2).replace(/,/g, '');//
                                                                    $("#G-9").text((((sumatotalesF/dtot)-1)*100).toFixed(2));
                                                                    $("#H-9").text((sumatotalesF-dtot).toFixed(2));
                                                                    $("#I-9").text((((sumatotalesF/dtot)-1)*100).toFixed(2));
                                                                    $("#J-9").text(((sumatotalesF/fijoanual)*100).toFixed(2));
                                                                }
                                                            }
                                                            var sumatotalesK = 0;//////////////////////////////////////////////////////for totalesK
                                                            for (var i=1; i<9; i++) {//for para la suma de la columna D
                                                                var ksum = $("#F-"+i).text();
                                                                if(ksum!='0.00' && ksum!=""){
                                                                    sumatotalesK = parseFloat(sumatotalesK)+parseFloat($("#K-"+i).text());
                                                                    $("#K-9").text(sumatotalesK);            
                                                                    // console.log('intento ' + i);               
                                                                }
                                                            }
                                                            var sumatotalesL = 0;//////////////////////////////////////////////////////for totalesL
                                                            for (var i=1; i<9; i++) {//for para la suma de la columna D
                                                                var lsum = $("#F-"+i).text();
                                                                if(lsum!='0.00' && lsum!=""){
                                                                    sumatotalesL = parseFloat(sumatotalesL)+parseFloat($("#L-"+i).text());
                                                                    $("#L-9").text(sumatotalesL);            
                                                                    // console.log('intento ' + i);               
                                                                }
                                                            }
                                                        var d = $("#D-"+num).text();//
                                                        var g = ((monttotconcep2/d)-1)*100;
                                                        $("#G-"+num).text(Math.round(g)+'.00 %');
                                                        var h = monttotconcep2-d;
                                                        $("#H-"+num).text(h);
                                                        var i = (h/d)*100;
                                                        $("#I-"+num).text(i.toFixed(2));
                                                        //  var fijoanual = $("#fijo_anual_val").val();//fijo anuall
                                                        var j = (monttotconcep2/fijoanual)*100;
                                                        $("#J-"+num).text(j.toFixed(2));
                                                        var k =(h/fijoanual)*100;
                                                        $("#K-"+num).text(k.toFixed(2));
                                                        var fijomvar=$("#fijo_a_mas_variable_a_val").val();
                                                        var l = (h/fijomvar)*100;
                                                        $("#L-"+num).text(l.toFixed(2));
                                                        }else{
                                                            $("#F-"+num).text('0.00');//
                                                        }
                                                    }
                                                </script>
                                                    <?php
                                                            $bv=ControladorValuaciones::ctrBuscarBeneficios($idV);
                                                            //    echo "<pre>";
                                                            //    print_r($bv);
                                                            //    echo "</pre>";
                                                            $count1=0;
                                                            $total1=0;
                                                            $total2=0;
                                                            foreach ($bv as $key => $valbv)
                                                            {
                                                                // $count++;
                                                                $count = $valbv->id_beneficio;
                                                                $texto='';
                                                                if($count==1){$texto='Canasta Navideña más de 6 meses';}
                                                                else   if($count==2){$texto='Canasta Navideña menos de 6 meses';}
                                                                else   if($count==3){$texto='Ayuda Nacimiento';}
                                                                else   if($count==4){$texto='Ayuda Matrimonio';}
                                                                else   if($count==5){$texto='Ayuda por Defunción';}
                                                                else  if($count==6){$texto='>Ayuda Escolar';}
                                                                else  if($count==7){$texto='Ayuda de Transporte';}
                                                                else  if($count==8){$texto='Ayuda Compra de lentes';}
                                                                 
                                                            echo'<tr>
                                                                    <td width="%" id="A-'.$count.'">'.$texto.'</td>
                                                                    <td width="%" id=""><input type="text" class="form-control addBeneficio" value="'.$valbv->no_trabajadores.'" num="'.$count.'"  name="" id="B-'.$count.'"  readonly></td>
                                                                    <td width="%" id=""><input type="text" class="form-control addBeneficio" value="'.$valbv->monto_x_colaborador.'" num="'.$count.'"  name="" id="C-'.$count.'" readonly></td>
                                                                    <td width="%" id="D-'.$count.'"></td>
                                                                    <td width="%" id=""><input type="text" class="form-control addBeneficio" value="'.$valbv->prop_monto_x_colaborador.'" num="'.$count.'" name="" id="E-'.$count.'" readonly></td>
                                                                    <td width="%" id="F-'.$count.'"></td>
                                                                    <td width="%" id="G-'.$count.'"></td>
                                                                    <td width="%" id="H-'.$count.'"></td>
                                                                    <td width="%" id="I-'.$count.'"></td>
                                                                    <td width="%" id="J-'.$count.'"></td>
                                                                    <td width="%" id="K-'.$count.'"></td>
                                                                    <td width="%" id="L-'.$count.'"></td>
                                                                </tr>';  
                                                                
                                                                $total1 =  $total1+ ($valbv->no_trabajadores*$valbv->monto_x_colaborador);
                                                                $total2 =  $total1+ ($valbv->no_trabajadores*$valbv->prop_monto_x_colaborador);
                                                                
                                                                // onLoad="CBeneficiosActual('.$count.')"
                                                                echo '<script type="text/javascript">
                                                                        CBeneficiosActual('.$count.');
                                                                        CPagoColaborador('.$count.');
                                                                    </script>'; 

                                                            }
                                                            
                                                    ?>
                                                                        <tr>
                                                                            <td colspan="2"></td>
                                                                            <td width="%" id="">Subtotal</td>
                                                                            <td width="%" id="D-9"><?php echo $total1;?></td>
                                                                            <td width="%" id="E-9"></td>
                                                                            <td width="%" id="F-9"><?php echo $total2;?></td>
                                                                            <td width="%" id="G-9"></td>
                                                                            <td width="%" id="H-9"></td>
                                                                            <td width="%" id="I-9"></td>
                                                                            <td width="%" id="J-9"></td>
                                                                            <td width="%" id="K-9"></td>
                                                                            <td width="%" id="L-9"></td>
                                                                        </tr>
                                                </tbody>
                                                <!-- <input type="text" value="<?php echo $count; ?>"> -->

                                            </table>
                                            <div class="abeneficios"></div>
                                            <input type="text" class="form-control" class="d-none" id="arrayBeneficios">
                                    <table class="table table-bordered table-sm col-md-12 table-striped table-hover" id="inpuestos_de_seguridad_social" width="100%">
                                        <thead>
                                            <tr class="text-center">
                                                <td colspan="13" style="background-color: #990000; color: white;">5. IMPUESTOS DE SEGURIDAD SOCIAL</td>
                                            </tr>
                                            <tr class="text-center">
                                                <th title="">Costo Total Carga Social</th>
                                                <th title="">Concepto</th>
                                                <th title="">Actual</th>
                                                <th title="">Condición Actual</th>
                                                <th title="">Dias Propuesta</th>
                                                <th title="">% Propuesta</th>
                                                <th title="Condición 2021">Condición 2021 </th>
                                                <th title="%">%</th>
                                                <th title="Incremento en $ sobre costo actual">Incremento en $...</th>
                                                <th title="Incremento sobre costo total actual">Incremento sobre...</th>
                                                <th title="% de incremento nomina actual">% de incremento...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo Anual">Proporcion S/cost...</th>
                                                <th title="Proporcion sobre el costo total del CCT Fijo + Variable Anual">Proporcion sobre ...</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td width="8%" id="">Costo Total Carga Social</td>
                                                <td width="8%" id="">Costo Anual Seguridad Social e ISN</td>
                                                <td width="8%" id=""></td>
                                                <td width="8%" id="total_carga_social_seg_social"></td>
                                                <td width="8%" id=""></td>
                                                <td width="8%" id="prop_neg_imp_seg_soc"></td>
                                                <td width="8%" id="carga_soc_imp_seg_soc"></td>
                                                <td width="8%" id="inc_en_sob_cost_act_imp_seg_soc"></td>
                                                <td width="8%" id="inc_sob_cost_act_imp_seg_soc"></td>
                                                <td width="8%" id="inc_en_imp_seg_soc"></td>
                                                <td width="8%" id="inc_sob_imp_seg_soc"></td>
                                                <td width="8%" id="inc_nom_act_imp_seg_soc"></td>
                                                <td width="8%" id="prop_sob_cct_imp_seg_soc"></td>
                                                
                                            </tr>
                                            <tr>
                                                <td width="8%" id="">Subtotal</td>
                                                <td width="8%" id=""></td>
                                                <td width="8%" id=""></td>
                                                <td width="8%" id="total_carga_social_seg_social_2"></td>
                                                <td width="8%" id=""></td>
                                                <td width="8%" id="prop_neg_imp_seg_soc_2"></td>
                                                <td width="8%" id="carga_soc_imp_seg_soc_2"></td>
                                                <td width="8%" id="inc_en_sob_cost_act_imp_seg_soc_2"></td>
                                                <td width="8%" id="inc_sob_cost_act_imp_seg_soc_2"></td>
                                                <td width="8%" id="inc_en_imp_seg_soc_2"></td>
                                                <td width="8%" id="inc_sob_imp_seg_soc_2"></td>
                                                <td width="8%" id="inc_nom_act_imp_seg_soc_2"></td>
                                                <td width="8%" id="prop_sob_cct_imp_seg_soc_2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO   totales   OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO-->
                                <div id="totales" class="container-fluid tab-pane"><br>
                                    <!-- <div class="float-right"><button class="btn btn-primary float-left" onclick="CalcularTotales()">Totales</button><br><br></div><br> -->

                                    <div class="row container-fluid col-md-12 d-flex justify-content-md-center">
                                        <table class="table table-bordered table-sm col-md-4 table-striped table-hover" width="100%">
                                            <thead>
                                                <tr class="text-center" style="height: 30px;">
                                                    <th title="" style="background-color: #990000; color: white;">RESUMEN DE COSTOS</th>
                                                    <th title="" style="background-color: #0070C0; color: white;">Concepto</th>
                                                    <th title="" style="background-color: #0070C0; color: white;">Condición Actual 2020</th> 
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr class="text-center" style="height: 30px;">
                                                    <td width="%">Totales</td>    
                                                    <td  width="%" id="">Salarios</td>
                                                    <td  width="%" id="totalsalfijo"></td>
                                                </tr>
                                                <tr class="text-center" style="height: 30px;">
                                                    <td width="%">Totales</td>    
                                                    <td title="Prestaciones Fijas, Variables y Beneficios" width="%" id="">Prestaciones Fijas...	</td>
                                                    <td  width="%" id="pres_fijas_var_ben_suma"></td>
                                                </tr>
                                                <tr class="text-center" style="height: 30px;">
                                                    <td width="%">Totales</td>    
                                                    <td  width="%" id="">Carga Social</td>
                                                    <td  width="%" id="car_soc_tot"></td>
                                                </tr>
                                                <tr class="text-center" style="height: 30px;">
                                                    <td width="%">Totales</td>    
                                                    <td  width="%" id="">Costo de Nomina</td>
                                                    <td  width="%" id="cost_nom_totales"></td>
                                                </tr>  
                                            </tbody>
                                        </table>
                                        <!-- <div class="col-md-1"></div> -->
                                        <table class="table table-bordered table-sm col-md-8 table-striped table-hover " width="100%">
                                            <thead>
                                                <tr class="text-center" style="height: 30px;">
                                                    <th title="" style="background-color: #0070C0; color: white;">Condición 2021</th>
                                                    <th title="" style="background-color: #0070C0; color: white;">%</th>
                                                    <th title="Incremento en $ sobre costo actual" style="background-color: #0070C0; color: white;">Incremento en $...</th>
                                                    <th title="Incremento sobre costo total actual" style="background-color: #0070C0; color: white;">Incremento sobre...</th>
                                                    <th title="% de incremento nomina actual vs condición 2021" style="background-color: #0070C0; color: white;">% de incremento...</th>
                                                    <th title="Proporcion sobre el costo total del CCT Fijo Anual" style="background-color: #0070C0; color: white;">Proporcion sobre...</th>
                                                    <th title="Proporcion sobre el costo total del CCTFijo+Variable Anual" style="background-color: #0070C0; color: white;">Proporcion sobre.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="height: 30px;">
                                                    <td width="%" id="AT2-1"></td>                         
                                                    <td width="%" id="BT2-1"></td>
                                                    <td width="%" id="CT2-1"></td>
                                                    <td width="%" id="DT2-1"></td>                         
                                                    <td width="%" id="ET2-1"></td>
                                                    <td width="%" id="FT2-1"></td>
                                                    <td width="%" id="GT2-1"></td> 
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td width="%" id="AT2-2"></td>                         
                                                    <td width="%" id="BT2-2"></td>
                                                    <td width="%" id="CT2-2"></td>
                                                    <td width="%" id="DT2-2"></td>                         
                                                    <td width="%" id="ET2-2"></td>
                                                    <td width="%" id="FT2-2"></td>
                                                    <td width="%" id="GT2-2"></td> 
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td width="%" id="AT2-3"></td>                         
                                                    <td width="%" id="BT2-3"></td>
                                                    <td width="%" id="CT2-3"></td>
                                                    <td width="%" id="DT2-3"></td>                         
                                                    <td width="%" id="ET2-3"></td>
                                                    <td width="%" id="FT2-3"></td>
                                                    <td width="%" id="GT2-3"></td> 
                                                </tr>
                                                <tr style="height: 30px;">
                                                    <td width="%" id="AT2-4"></td>                         
                                                    <td width="%" id="BT2-4"></td>
                                                    <td width="%" id="CT2-4"></td>
                                                    <td width="%" id="DT2-4"></td>                         
                                                    <td width="%" id="ET2-4"></td>
                                                    <td width="%" id="FT2-4"></td>
                                                    <td width="%" id="GT2-4"></td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row container-fluid col-md-12 d-flex justify-content-md-center">
                                        <table class="table table-bordered table-sm col-md-4 table-striped table-hover" id="inpuestos_de_seguridad_social" width="100%">
                                            <thead>
                                                <tr class="text-center" style="height: 50px;">
                                                    <td colspan="13" style=" background-color: #990000; color: white;" id="otrosgastos1">OTROS GASTOS<br>&nbsp;</td>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr style="height: 55px;">
                                                    <td width="8%" id="">Pago Sindicato x revisión de CCT</td>
                                                    <td width="8%" ><input type="text" class="form-control input-sm" value="<?php echo $otros_gastos_rev_cct; ?>"  name="" id="BT3-1" readonly></td>   <!--onkeyup="TotalOtrosGastos()"-->
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="8%" id="">Iguala Anual a sindicato</td>        
                                                    <td width="8%" ><input type="text" class="form-control input-sm" value="<?php echo $otros_gastos_iguala_sind; ?>"  name="" id="BT3-2" readonly></td>
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="8%" id="">Otros Gastos (Fomentos Deportivos, Bolsas a repartir)</td>
                                                    <td width="8%" ><input type="text" class="form-control input-sm" value="<?php echo $otros_gastos_fom_dep_bolsas; ?>"  name="" id="BT3-3" readonly></td>
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="8%" id="">Costo total sindicato</td>
                                                    <td width="8%" id="BT3-4"></td>   
                                                </tr>
                                                <tr>
                                                    <td width="8%" style="background-color: #990000; color: white;" id="">COSTO TOTAL 2020</td>     
                                                    <td width="8%" id="BT3-5" style="background-color: #002060; color: white;"></td>   
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- <div class="col-md-1"></div> -->
                                        <table class="table table-bordered table-sm col-md-8 table-striped table-hover" id="inpuestos_de_seguridad_social" width="100%">
                                            <thead>
                                                <tr class="text-center" style="height: 50px;">
                                                    <td  width="8%" style="background-color: #990000; color: white;" id="otrosgastos2">OTROS GASTOS</td>
                                                    <th title="" style="background-color: #0070C0; color: white;">Condición 2021</th>
                                                    <th title="" style="background-color: #0070C0; color: white;">%</th>
                                                    <th title="Incremento en $ sobre costo actual" style="background-color: #0070C0; color: white;">Incremento en $...</th>
                                                    <th title="Incremento sobre costo total actual" style="background-color: #0070C0; color: white;">Incremento sobre...</th>
                                                    <th title="% de incremento nomina actual vs condición 2021" style="background-color: #0070C0; color: white;">% de incremento...</th>
                                                    <th title="Proporcion sobre el costo total del CCT Fijo Anual" style="background-color: #0070C0; color: white;">Proporcion sobre...</th>
                                                    <th title="Proporcion sobre el costo total del CCTFijo+Variable Anual" style="background-color: #0070C0; color: white;">Proporcion sobre.</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr style="height: 55px;">
                                                    <td width="20%" id="">Pago Sindicato x revisión de CCT</td>
                                                    <td width="8%" id="BT4-1"></td>  
                                                    <td width="8%" id="CT4-1"></td>  
                                                    <td width="8%" id="DT4-1"></td>  
                                                    <td width="8%" id="ET4-1"></td>   
                                                    <td width="8%" id="FT4-1"></td>  
                                                    <td width="8%" id="GT4-1"></td>
                                                    <td width="8%" id="HT4-1"></td>  
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="20%" id="">Iguala Anual a Sindicato</td>
                                                    <td width="8%" id="BT4-2"></td>
                                                    <td width="8%" id="CT4-2"></td>  
                                                    <td width="8%" id="DT4-2"></td>  
                                                    <td width="8%" id="ET4-2"></td>  
                                                    <td width="8%" id="FT4-2"></td>   
                                                    <td width="8%" id="GT4-2"></td>  
                                                    <td width="8%" id="HT4-2"></td>     
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="20%" id="">Otros Gastos (Fomentos Deportivos, Bolsas a repartir)</td>
                                                    <td width="8%" id="BT4-3"></td>
                                                    <td width="8%" id="CT4-3"></td>  
                                                    <td width="8%" id="DT4-3"></td>  
                                                    <td width="8%" id="ET4-3"></td>  
                                                    <td width="8%" id="FT4-3"></td>   
                                                    <td width="8%" id="GT4-3"></td>  
                                                    <td width="8%" id="HT4-3"></td>     
                                                </tr>
                                                <tr style="height: 55px;">
                                                    <td width="20%" id="">Costo total sindicato</td>
                                                    <td width="8%" id="BT4-4"></td>
                                                    <td width="8%" id="CT4-4"></td>  
                                                    <td width="8%" id="DT4-4"></td>  
                                                    <td width="8%" id="ET4-4"></td>  
                                                    <td width="8%" id="FT4-4"></td>   
                                                    <td width="8%" id="GT4-4"></td>  
                                                    <td width="8%" id="HT4-4"></td>     
                                                </tr>
                                                <tr>
                                                    <td width="20%" style="background-color: #990000; color: white;" id="">COSTO TOTAL 2021</td>     
                                                    <td width="8%" id="BT4-5" style="background-color: #002060; color: white;"></td>
                                                    <td width="8%" id="CT4-5" style="background-color: #002060; color: white;"></td>  
                                                    <td width="8%" id="DT4-5" style="background-color: #002060; color: white;"></td>  
                                                    <td width="8%" id="ET4-5" style="background-color: #002060; color: white;"></td>  
                                                    <td width="8%" id="FT4-5" style="background-color: #002060; color: white;"></td>   
                                                    <td width="8%" id="GT4-5" style="background-color: #002060; color: white;"></td>  
                                                    <td width="8%" id="HT4-5" style="background-color: #002060; color: white;"></td>     
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
                            </div>
                        </div>

                        <div class="row col-md-12 d-none">
                            <table class="table table-bordered table-sm" width="100%">
                            <!-- style="background-color:#002554; color:white; !important;" -->
                                <thead >
                                <tr>
                                    <th width="9%" style="font-size: 14px;"><p>Concepto</p></th>
                                    <th width="9%" style="font-size: 14px;"><p>Actual 2020</p></th>
                                    <th width="9%" style="font-size: 14px;"><p>Condición Actual 2021</p></th>
                                    <!-- <th width="9%" style="font-size: 14px;"><p>Propuesta Negociación</p></th> -->
                                    <th width="9%" style="font-size: 14px;"><p>Condición</p></th>
                                    <th width="9%" title="" style="font-size: 14px;">%</th>
                                    <th width="9%" title="Incremento en $ sobre costo actual" style="font-size: 14px;"><p>Incremento en $</p></th>
                                    <th width="9%" title="Incremento en $ sobre costo actual Incremento sobre costo total actual" style="font-size: 14px;"><p>Incremento en $</p></th>
                                    <th width="9%" title="% de incremento nomina actual" style="font-size: 14px;"><p>% de incremento nomina</p></th>
                                    <th width="9%" title="Proporcion sobre el costo total del CCT Fijo Anual" style="font-size: 14px;"><p>Proporcion sobre el</p></th>
                                    <th width="9%" title="Proporcion sobre el costo total del CCT Fijo + Variable Anual" style="font-size: 14px;"><p>Proporcion sobre el  </p></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                </tr>
                                </tbody>
                                <tbody id="">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

  
<script>
 $(document).ready(function() {
    BuscarPlantilla();

    setTimeout(llenartabla2,2000);
 
    setTimeout(Resultado,3500);
    
    setTimeout(CalcularTotales,4000);

    setTimeout(aguinaldo_dias_propuesta,4500);

    setTimeout(prim_vac_dia_prop_porc,5000);

    setTimeout(fond_ahorro_prropuesta,5500);

    setTimeout(prest_variables_propuesta,6000);

    setTimeout(CalcularTotales,7000);

    setTimeout(TotalOtrosGastos,7500);

    

 });


  

    function BuscarPlantilla(){
        var cboCodDivision = $("#cboCodDivision").val();
        var cboSubDivPersonal = $("#cboSubDivPersonal").val();
        var anio = $("#cboanio").val();

        $("#otrosgastos1").text('OTROS GASTOS '+anio);
        var sig_anio= parseInt(anio)+1;
        $("#otrosgastos2").text('OTROS GASTOS '+sig_anio);


        var datos = new FormData();
        var funcion ="BuscarDatos";
      
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("cod_division", cboCodDivision);
        datos.append("subdivision", cboSubDivPersonal);
        datos.append("anio", anio); 
        $.ajax({//regresa la informacion en forma de tabla para poder procesarla si se requiere usar algun acuerdo pasado
            url:"ajax/valuaciones.ajax.php", method: "POST", data: datos, async: true, cache: false, contentType: false, processData: false, dataType: "json",
            success: function(respuesta)
            {
              if(respuesta!=null)
              {
                console.log(respuesta);
                // var stringHTML='<option value="">Seleccione una División de Personal</option>';
                // var sumano_empleado='';
                var count=0;
                var count2=0;
                var suma_no_emp=0;
                var promedio_salario_diario=0;
                var salario_fijo_promedio_mensual=0;
                var salario_SBC=0;
                var costo_tot_pos_m=0;
                var carga_soc_prom_m=0;
                ///////////////29/06/2021 agregado por francisco rosales
                var sdr=0;
                var sbcr=0;
                ////////////////////////////
                ////////////////////////////
                var costo_total_posicion_a=0;
                var vacaciones_dias_a=0;
                var prom_aguinaldo_dias_a=0;
                var prima_vacacional_a=0;
                var prom_fondo_ahorro_a=0;
                respuesta.forEach((obj, i) =>
                {
                    
                    count += 1; //contador de filas para operacioens
                    suma_no_emp+=obj['no_empleado']; //suma de los empleados 
                    
                    stringHTML+='<tr>';
                    stringHTML+='<td>'+obj['categoria']+'</td>';//categorias
                    stringHTML+='<td>'+obj['nombre_posicion']+'</td>';//NOMBRE DE LA POSICION
                    stringHTML+='<td>'+obj['no_empleado']+'</td>';//numero de empleados de la posicion
                    
                    var salario_diario=obj['sal_diarioXno_emp'];//PARA EL SALARIO DIARIO es la suma de todos los salrios de la posicion entre el no de empleados de la posicion
                    promedio_salario_diario+=salario_diario; //suma de salrios diarios
                    ////////////////////////29/06/2021 para la suma correcta agregado por Francisco rosales
                    if(obj['no_empleado']!=0){
                        var sd = (obj['no_empleado']*obj['sal_diarioXno_emp']);
                         sdr += sd;//salariio diario por num de empleados que existen
                         var sbcrr = (obj['no_empleado']*obj['sbc']);
                         sbcr += sbcrr;
                    }else{
                        sd='';
                    }
                    ////////////////////////
                    stringHTML+='<td>$ '+addCommas(salario_diario.toFixed(2))+'</td>';
                    
                    var sbc=obj['sbc'];//PARA EL SALARIO BASE DE COTIZACION CBC
                    salario_SBC+=sbc;
                    stringHTML+='<td>$ '+addCommas(sbc.toFixed(2))+'</td>';

                    var salario_mensual=(salario_diario*30.4);//PARA EL SALARIO MENSUAL
                    
                    if(sbc!=0.000000){
                    count2 += 1; 
                    salario_fijo_promedio_mensual+=salario_mensual; //suma de salrios diarios
                    stringHTML+='<td>$ '+addCommas(salario_mensual.toFixed(2))+'</td>';
                    }else {count2 += 0;  stringHTML+='<td>0</td>';}

                   if(sbc!=0.000000){ 
                    var costo_total_posicion=(salario_mensual*obj['no_empleado']);//COSTOTOTAL PO POSICION mensual
                    costo_total_posicion_a+=costo_total_posicion;
                    stringHTML+='<td>$ '+addCommas(costo_total_posicion.toFixed(2))+'</td>';
                    }else {stringHTML+='<td>0</td>';}

                    var bono_productividad=obj['bono_productividad'];//Salario Variable Promedio Mensual
                    costo_tot_pos_m+=bono_productividad;
                    stringHTML+='<td>$ '+addCommas(bono_productividad.toFixed(2))+'</td>';
                   
                    var total_carga=obj['total_carga'];//Carga Social Promedio Mensual
                    carga_soc_prom_m+=total_carga;
                    stringHTML+='<td>$ '+addCommas(total_carga.toFixed(2))+'</td>';

                    if(sbc!=0.000000){ 
                    var dias_aguinaldo_promedio=obj['dias_aguinaldo']/obj['no_empleado'];//PARA EL promedio de dias de aguinaldo
                    prom_aguinaldo_dias_a+=dias_aguinaldo_promedio;
                    stringHTML+='<td>'+Math.round(dias_aguinaldo_promedio)+'</td>';
                    }else {stringHTML+='<td>0</td>';}

                    var prima_vacacional=Math.round(obj['prima_vacacional_actual']);//Promedio prima vacacional en %
                    // alert(prima_vacacional);
                    prima_vacacional_a+=prima_vacacional;
                    stringHTML+='<td> '+prima_vacacional+' %</td>';
                
                    // alert(vacaciones_dias_actual);
                    if(sbc!=0.000000){
                    
                    var vacaciones_dias_actual=obj['vacaciones_dias_actual']/obj['no_empleado'];//Promedio de dias Vacaciones
                    // alert(vacaciones_dias_actual);
                    vacaciones_dias_a+=parseFloat(vacaciones_dias_actual.toFixed(2));//se hace la sumatoria con solo dos decimales xq asi viene de la palntilla
                    // alert(vacaciones_dias_a);
                    // alert(Math.round(vacaciones_dias_actual));
                    stringHTML+='<td>'+Math.round(vacaciones_dias_actual)+' %</td>';
                    // stringHTML+='<td>'+vacaciones_dias_actual+' %</td>';
                    }else {stringHTML+='<td>0</td>';}
                    
                    
                    var fondo_ahorro_actual=obj['fondo_ahorro_actual'];//Porcentaje Fondo de Ahorro
                    prom_fondo_ahorro_a+=fondo_ahorro_actual;
                    stringHTML+='<td>'+Math.round(fondo_ahorro_actual)+' %</td>';//Porcentaje Fondo de Ahorro

                });
                    //para el HC 2020 y 2021
                    $("#HC1").html(suma_no_emp);//numero de empleados
                    $("#HC2").html(suma_no_emp);
                    $("#HC3").html(suma_no_emp);
                    $("#HC3_2").html(suma_no_emp);
                    //para la primera tabla de valores diario y mensual 2020
                    // var p_s_d=promedio_salario_diario/count;         $("#salario_diario").html('$ '+addCommas(p_s_d.toFixed(2)));//Salario Fijo Promedio Diario
                    //29/06/2021agregado por francisco rosales /////////////////////////////////////////////////////////////////////////////////////////////////////////
                    var p_s_d=sdr/suma_no_emp;         $("#salario_diario").html('$ '+addCommas(p_s_d.toFixed(2)));//Salario Fijo Promedio Diario
                    var s_f_p_m=salario_fijo_promedio_mensual/count2; $("#salario_fijo_promedio_mensual").html('$ '+addCommas(s_f_p_m.toFixed(2)));//Salario Fijo Promedio Mensual
                    // var s_sbc=salario_SBC/count2;                     $("#salario_SBC").html('$ '+addCommas(s_sbc.toFixed(2)));//Salario Base de Cotización Promedio
                    var s_sbc=sbcr/suma_no_emp;                     $("#salario_SBC").html('$ '+addCommas(s_sbc.toFixed(2)));//Salario Base de Cotización Promedio
                    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    var c_t_p_m=costo_tot_pos_m.toFixed(2)/count2;               $("#costo_tot_pos_m").html('$ '+addCommas(c_t_p_m.toFixed(2)));//Salario Variable Promedio Mensual (Bono de productividad)
                    var c_s_p_m=carga_soc_prom_m/count2;              $("#carga_soc_prom_m").html('$ '+addCommas(c_s_p_m.toFixed(2)));//Total Carga SocialPromedio Mensual 2020
                    //segunda tabla anual
                    var c_t_p_a=costo_total_posicion_a*12;          $("#cost_tot_posc_a").html('$ '+addCommas(c_t_p_a.toFixed(2)));//Total Costo Anual 2020
                    // c_s_p_m
                    $("#total_costo_anual").val(c_t_p_a);
                   
                    $("#fijo_anual").html('$ '+addCommas(c_t_p_a.toFixed(2)));//Total Costo Anual 2020//para costeo
                    $("#fijo_anual_val").val(c_t_p_a);                   


                    // alert(c_t_p_m.toFixed(2));
                    // alert(suma_no_emp);
                    var t_c_a_s_f_v=c_t_p_m.toFixed(2)*suma_no_emp*12;         
                    $("#cost_tot_posc_a_v").html('$ '+addCommas(t_c_a_s_f_v.toFixed(2)));//Total Costo Anual Salario Variable 2020
                    
                    $("#variable_anual").html('$ '+addCommas(t_c_a_s_f_v.toFixed(2)));//Total Costo Anual 2020//para costeo

                    var t_c_a_s_f_variable=c_t_p_a+t_c_a_s_f_v;     $("#cot_tot_anual_fijo_y_variable").html('$ '+addCommas(t_c_a_s_f_variable.toFixed(2)));//Total Costo Anual Salario Fijo + Variable 2020
                    var t_c_s_a=c_s_p_m*suma_no_emp*12;             $("#cot_tot_anual_carga_soc").html('$ '+addCommas(t_c_s_a.toFixed(2)));//Total Carga Social 2020
                    var p_a_d=prom_aguinaldo_dias_a/count2;         $("#prom_Agui_dias").html(Math.round(p_a_d));//Promedio Aguinaldo en días
                    var p_v_a=prima_vacacional_a/count2;            $("#prima_vacacional_a").html(Math.round(p_v_a)+" %");//Promedio prima vacacional en %
                    $("#prima_vacacional_a_val").val(p_v_a);
                    var p_v_d_a=vacaciones_dias_a/count2;           $("#prom_vacaciones_dias_a").html(Math.round(p_v_d_a));//Promedio vacaciones en días
                    $("#total_carga_social_val").val(t_c_s_a.toFixed(5));// Total Carga Social 2020
                    $("#prom_vacaciones_dias_a_val").val(p_v_d_a.toFixed(5));
                    // alert(vacaciones_dias_a);
                    // alert(p_v_d_a);
                    //
                    var p_f_a_a=prom_fondo_ahorro_a/count2;         $("#prom_fondo_ahorro_a").html(Math.round(p_f_a_a)+" %");//Porcentaje Fondo de Ahorro
                    // alert(p_v_d_a);
                    $("#tablaagregardatos").html(stringHTML);
                    // /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    // //para la primera tabla de valores diario y mensual 2021
                    // var p_s_d=promedio_salario_diario/count;         $("#salario_diario_2").html('$ '+p_s_d.toFixed(2));//Salario Fijo Promedio Diario
                    // var s_f_p_m=salario_fijo_promedio_mensual/count2; $("#salario_fijo_promedio_mensual_2").html('$ '+s_f_p_m.toFixed(2));//Salario Fijo Promedio Mensual
                    // var s_sbc=salario_SBC/count2;                     $("#salario_SBC_2").html('$ '+s_sbc.toFixed(2));//Salario Base de Cotización Promedio
                    // var c_t_p_m=costo_tot_pos_m/count2;               $("#costo_tot_pos_m_2").html('$ '+c_t_p_m.toFixed(2));//Salario Variable Promedio Mensual (Bono de productividad)
                    // var c_s_p_m=carga_soc_prom_m/count2;              $("#carga_soc_prom_m_2").html('$ '+c_s_p_m.toFixed(2));//Total Carga SocialPromedio Mensual 2020
                    // //segunda tabla anual
                    // var c_t_p_a=costo_total_posicion_a*12;          $("#cost_tot_posc_a_2").html('$ '+c_t_p_a.toFixed(2));//Total Costo Anual 2020
                    // var t_c_a_s_f_v=c_t_p_m*suma_no_emp*12;         $("#cost_tot_posc_a_v_2").html('$ '+t_c_a_s_f_v.toFixed(2));//Total Costo Anual Salario Variable 2020
                    // var t_c_a_s_f_variable=c_t_p_a+t_c_a_s_f_v;     $("#cot_tot_anual_fijo_y_variable_2").html('$ '+t_c_a_s_f_variable.toFixed(2));//Total Costo Anual Salario Fijo + Variable 2020
                    // var t_c_s_a=c_s_p_m*suma_no_emp*12;             $("#cot_tot_anual_carga_soc_2").html('$ '+t_c_s_a.toFixed(2));//Total Carga Social 2020
                    // // var p_a_d=prom_aguinaldo_dias_a/count2;         $("#prom_Agui_dias_2").html(Math.round(p_a_d));//Promedio Aguinaldo en días
                    // // var p_v_a=prima_vacacional_a/count2;            $("#prima_vacacional_a_2").html(Math.round(p_v_a)+" %");//Promedio prima vacacional en %
                    // // var p_v_d_a=vacaciones_dias_a/count2;           $("#prom_vacaciones_dias_a_2").html(Math.round(p_v_d_a));//Promedio vacaciones en días
                    // // var p_f_a_a=prom_fondo_ahorro_a/count2;         $("#prom_fondo_ahorro_a_2").html(Math.round(p_f_a_a)+" %");//Porcentaje Fondo de Ahorro
                    // // alert(p_v_d_a);

                    // $("#tablaagregardatos_2").html(stringHTML);//para la 2021 o 2
                    $('.tabladata').DataTable();
                    // alert(prima_vacacional_a);
                    // alert(count2);
                    // alert(p_v_a);
              }
              else{
                console.log(respuesta);
                var stringHTML="";
                stringHTML+='<h3>Sin Datos</h3>';
        
                $("#tablaagregardatos").html(stringHTML);
                
              }
            },
            error : function(respuesta)
            {
                console.log("Error",respuesta);
            }
        }).done(function ()
        {   
            $('.tabladatatableAjax').DataTable();
        });
        $("#valuacion1").addClass('active'); //para activar el primer tab
        // $("#valuacion_1").addClass('active'); //para activar el primer tab
        // });
    }
    // $("#prop_neg").keyup(function(){
    //     llenartabla2();
    // });
    function llenartabla2(){ //para llenar la segnda tabla y prepararla  para ejecutar las operaciones
        // $( "#tablaagregardatos_2" ).empty();
            var cboCodDivision = $("#cboCodDivision").val();
            var cboSubDivPersonal = $("#cboSubDivPersonal").val();
            var anio = $("#cboanio").val();
            var datos = new FormData();
            var funcion ="BuscarDatos";
        
            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("cod_division", cboCodDivision);
            datos.append("subdivision", cboSubDivPersonal);
            datos.append("anio", anio);
            $.ajax({//regresa la informacion en forma de tabla para poder procesarla si se requiere usar algun acuerdo pasado
                url:"ajax/valuaciones.ajax.php", method: "POST", data: datos, async: true, cache: false, contentType: false, processData: false, dataType: "json",
                success: function(respuesta)
                {
                if(respuesta!=null)
                {
                    console.log(respuesta);
                    // var stringHTML='<option value="">Seleccione una División de Personal</option>';
                    // var sumano_empleado='';
                    var count=0;
                    var count2=0;
                    var suma_no_emp=0;
                    var promedio_salario_diario=0;
                    var salario_fijo_promedio_mensual=0;
                    var salario_SBC=0;
                    var costo_tot_pos_m=0;
                    var carga_soc_prom_m=0;
                    ///////////////29/06/2021 agregado por francisco rosales
                    var sdr=0;
                    var sbcr=0;
                    ////////////////////////////
                    var costo_total_posicion_a=0;
                    var vacaciones_dias_a=0;
                    var prom_aguinaldo_dias_a=0;
                    var prima_vacacional_a=0;
                    var prom_fondo_ahorro_a=0;
                    respuesta.forEach((obj, i) =>
                    {
                        
                        count += 1; //contador de filas para operacioens
                        suma_no_emp+=obj['no_empleado']; //suma de los empleados 
                        
                        stringHTML+='<tr>';
                        stringHTML+='<td>'+obj['categoria']+'</td>';//categorias
                        stringHTML+='<td>'+obj['nombre_posicion']+'</td>';//NOMBRE DE LA POSICION
                        stringHTML+='<td>'+obj['no_empleado']+'</td>';//numero de empleados de la posicion
                        
                        var salario_diario=obj['sal_diarioXno_emp'];//PARA EL SALARIO DIARIO es la suma de todos los salrios de la posicion entre el no de empleados de la posicion
                        promedio_salario_diario+=salario_diario; //suma de salrios diarios
                        ////////////////////////29/06/2021 para la suma correcta agregado por Francisco rosales
                        if(obj['no_empleado']!=0){
                            var sd = (obj['no_empleado']*obj['sal_diarioXno_emp']);
                            sdr += sd;//salariio diario por num de empleados que existen
                            var sbcrr = (obj['no_empleado']*obj['sbc']);
                            sbcr += sbcrr;
                        }else{
                            sd='';
                        }
                        ////////////////////////
                        stringHTML+='<td>$ '+addCommas(salario_diario.toFixed(2))+'</td>';
                        
                        var sbc=obj['sbc'];//PARA EL SALARIO BASE DE COTIZACION CBC
                        salario_SBC+=sbc;
                        stringHTML+='<td>$ '+addCommas(sbc.toFixed(2))+'</td>';

                        var salario_mensual=(salario_diario*30.4);//PARA EL SALARIO MENSUAL
                        
                        if(sbc!=0.000000){
                        count2 += 1; 
                        salario_fijo_promedio_mensual+=salario_mensual; //suma de salrios diarios
                        stringHTML+='<td>$ '+addCommas(salario_mensual.toFixed(2))+'</td>';
                        }else {count2 += 0;  stringHTML+='<td>0</td>';}

                    if(sbc!=0.000000){ 
                        var costo_total_posicion=(salario_mensual*obj['no_empleado']);//COSTOTOTAL PO POSICION mensual
                        costo_total_posicion_a+=costo_total_posicion;
                        stringHTML+='<td>$ '+addCommas(costo_total_posicion.toFixed(2))+'</td>';
                        }else {stringHTML+='<td>0</td>';}

                        var bono_productividad=obj['bono_productividad'];//Salario Variable Promedio Mensual
                        costo_tot_pos_m+=bono_productividad;
                        stringHTML+='<td>$ '+addCommas(bono_productividad.toFixed(2))+'</td>';
                    
                        var total_carga=obj['total_carga'];//Carga Social Promedio Mensual
                        carga_soc_prom_m+=total_carga;
                        stringHTML+='<td>$ '+addCommas(total_carga.toFixed(2))+'</td>';

                        if(sbc!=0.000000){ 
                        var dias_aguinaldo_promedio=obj['dias_aguinaldo']/obj['no_empleado'];//PARA EL promedio de dias de aguinaldo
                        prom_aguinaldo_dias_a+=dias_aguinaldo_promedio;
                        stringHTML+='<td>'+Math.round(dias_aguinaldo_promedio)+'</td>';
                        }else {stringHTML+='<td>0</td>';}

                        var prima_vacacional=obj['prima_vacacional_actual'];//Promedio prima vacacional en %
                        prima_vacacional_a+=prima_vacacional;
                        stringHTML+='<td>'+Math.round(prima_vacacional)+' </td>';
                    
                        // alert(vacaciones_dias_actual);
                        if(sbc!=0.000000){
                        
                        var vacaciones_dias_actual=obj['vacaciones_dias_actual']/obj['no_empleado'];//Promedio de dias Vacaciones
                        // alert(vacaciones_dias_actual);
                        vacaciones_dias_a+=vacaciones_dias_actual;
                        // alert(Math.round(vacaciones_dias_actual));
                        stringHTML+='<td>'+Math.round(vacaciones_dias_actual)+' %</td>';
                        }else {stringHTML+='<td>0</td>';}
                        
                        
                        var fondo_ahorro_actual=obj['fondo_ahorro_actual'];//Porcentaje Fondo de Ahorro
                        prom_fondo_ahorro_a+=fondo_ahorro_actual;
                        stringHTML+='<td>'+Math.round(fondo_ahorro_actual)+' %</td>';//Porcentaje Fondo de Ahorro

                    });
                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        //para la primera tabla de valores diario y mensual 2021
                        // var p_s_d=promedio_salario_diario/count;         $("#salario_diario_2").html('$ '+p_s_d.toFixed(2));//Salario Fijo Promedio Diario

                        /////////////////////////////////////////////////////////////////////////////////////////////////////francisco rosales 29/06/2021
                        var p_s_d=sdr/suma_no_emp;         $("#salario_diario_2").html('$ '+p_s_d.toFixed(2));//Salario Fijo Promedio Diario
                        var s_f_p_m=salario_fijo_promedio_mensual/count2; $("#salario_fijo_promedio_mensual_2").html('$ '+s_f_p_m.toFixed(2));//Salario Fijo Promedio Mensual
                        // var s_sbc=salario_SBC/count2;                     $("#salario_SBC_2").html('$ '+s_sbc.toFixed(2));//Salario Base de Cotización Promedio
                        var s_sbc=sbcr/suma_no_emp;                     $("#salario_SBC_2").html('$ '+s_sbc.toFixed(2));//Salario Base de Cotización Promedio
                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        var c_t_p_m=costo_tot_pos_m/count2;               $("#costo_tot_pos_m_2").html('$ '+c_t_p_m.toFixed(2));//Salario Variable Promedio Mensual (Bono de productividad)
                        var c_s_p_m=carga_soc_prom_m/count2;              $("#carga_soc_prom_m_2").html('$ '+c_s_p_m.toFixed(2));//Total Carga SocialPromedio Mensual 2020
                        //segunda tabla anual
                        var c_t_p_a=costo_total_posicion_a*12;          $("#cost_tot_posc_a_2").html('$ '+c_t_p_a.toFixed(2));//Total Costo Anual 2020
                        var t_c_a_s_f_v=c_t_p_m*suma_no_emp*12;         $("#cost_tot_posc_a_v_2").html('$ '+t_c_a_s_f_v.toFixed(2));//Total Costo Anual Salario Variable 2020
                        var t_c_a_s_f_variable=c_t_p_a+t_c_a_s_f_v;     $("#cot_tot_anual_fijo_y_variable_2").html('$ '+t_c_a_s_f_variable.toFixed(2));//Total Costo Anual Salario Fijo + Variable 2020
                        var t_c_s_a=c_s_p_m*suma_no_emp*12;             $("#cot_tot_anual_carga_soc_2").html('$ '+t_c_s_a.toFixed(2));//Total Carga Social 2020

                        $("#tablaagregardatos_2").html(stringHTML);//para la 2021 o 2
                        // $('.tabladata').DataTable();
                }
                else{
                    console.log(respuesta);
                    var stringHTML="";
                    stringHTML+='<h3>Sin Datos</h3>';
            
                    // $("#tablaagregardatos").html(stringHTML);
                }
                },
                error : function(respuesta)
                {
                    console.log("Error",respuesta);
                }
            }).done(function ()
            {   
                $('.tabladatatableAjax').DataTable();
            });
        
    }
    function Resultado(){
        // llenartabla2();
        var prop_neg = $("#prop_neg").val();
            var filas = $("#tablaagregardatos_2").find("tr"); //devulve las filas del body de tu tabla segun el ejemplo que brindaste
            // var filas2 = $("#tablaagregardatos_2").find("input"); //devulve las filas del body de tu tabla segun el ejemplo que brindaste
            var resultado = "";
            var celda_3=0, celda_4=0, celda_5=0, celda_6=0, celda_7=0, celda_8=0, celda_9=0, celda_10=0, celda_11=0, celda_12=0;
            var celdai_3=0;
        for(i=0; i<filas.length; i++){ //Recorre las filas 1 a 1

            var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila
            celda3 = $(celdas[3]).text(); var c3 = celda3.replace('$', '').replace(/,/g, ''); 
            celda4 = $(celdas[4]).text();  var c4 = celda4.replace('$', '').replace(/,/g, ''); 
            celda5 = $(celdas[5]).text();  var c5 = celda5.replace('$', '').replace(/,/g, ''); 
            celda6 = $(celdas[6]).text();  var c6 = celda6.replace('$', '').replace(/,/g, ''); 
            celda7 = $(celdas[7]).text(); var c7 = celda7.replace('$', '').replace(/,/g, ''); 
            celda8 = $(celdas[8]).text();  var c8 = celda8.replace('$', '').replace(/,/g, ''); 
            celda9 = $(celdas[9]).text();  
            celda10 = $(celdas[10]).text();
            celda11 = $(celdas[11]).text();  var c11 = celda11.replace(' %', '');; 
            celda12 = $(celdas[12]).text(); var c12 = celda12.replace(' %', '');; 
            
            celda_3=prop_neg*c3/100; suma3=parseFloat(celda_3)+parseFloat(c3); $(celdas[3]).text('$ '+addCommas(suma3.toFixed(2)));
            celda_4=prop_neg*c4/100; suma4=parseFloat(celda_4)+parseFloat(c4); $(celdas[4]).text('$ '+addCommas(suma4.toFixed(2)));
            celda_5=prop_neg*c5/100; suma5=parseFloat(celda_5)+parseFloat(c5); $(celdas[5]).text('$ '+addCommas(suma5.toFixed(2)));
            celda_6=prop_neg*c6/100; suma6=parseFloat(celda_6)+parseFloat(c6); $(celdas[6]).text('$ '+addCommas(suma6.toFixed(2)));
            celda_7=prop_neg*c7/100; suma7=parseFloat(celda_7)+parseFloat(c7); $(celdas[7]).text('$ '+addCommas(suma7.toFixed(2)));
            celda_8=prop_neg*c8/100; suma8=parseFloat(celda_8)+parseFloat(c8); $(celdas[8]).text('$ '+addCommas(suma8.toFixed(2)));
            // celda_9=prop_neg*celda9/100; suma9=parseFloat(celda_9)+parseFloat(celda9); $(celdas[9]).text('$ '+addCommas(suma9.toFixed(2)));///porcentaje se queda con olo q trae anterior
            // celda_10=prop_neg*celda10/100; suma10=parseFloat(celda_10)+parseFloat(celda10); $(celdas[10]).text(Math.round(suma10));// porcentaje///porcentaje se queda con olo q trae
            // celda_11=prop_neg*c11/100; suma11=parseFloat(celda_11)+parseFloat(c11); $(celdas[11]).text(suma11.toFixed(2)+' %');///porcentaje se queda con olo q trae
            // celda_12=prop_neg*c12/100; suma12=parseFloat(celda_12)+parseFloat(c12); $(celdas[12]).text(Math.round(suma12)+' %');///porcentaje se queda con olo q trae
            // celda_12=prop_neg*c12/100; suma12=parseFloat(celda_12)+parseFloat(c12); $(celdas[12]).text(celda_12+' %');///porcentaje

            // resultado+= suma+' - '+celda4+' - '+celda5+' - '+celda6+' - '+celd7+' - '+celda8+' - '+celda9+' - '+celda10+' - '+celda11+' - '+celda12;
        }
        ///OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOya calculados por la propuesta de negociación
            var salario_diario_2 =$("#salario_diario_2").text(); //1 Salario Fijo Promedio Diario
            var res2 = salario_diario_2.substring(2);  porc2=res2*prop_neg/100; suma_2=parseFloat(porc2)+parseFloat(res2); $("#salario_diario_2").text('$ '+addCommas(suma_2.toFixed(2)));

            var salario_fijo_promedio_mensual_2 =$("#salario_fijo_promedio_mensual_2").text(); //2Salario Fijo Promedio Mensual
            var res3 = salario_fijo_promedio_mensual_2.substring(2);  porc3=res3*prop_neg/100; suma_3=parseFloat(porc3)+parseFloat(res3); $("#salario_fijo_promedio_mensual_2").text('$ '+addCommas(suma_3.toFixed(2)));

            var salario_SBC_2 =$("#salario_SBC_2").text(); //3 Salario Base de Cotización Promedio
            var res4 = salario_SBC_2.substring(2);  porc4=res4*prop_neg/100; suma_4=parseFloat(porc4)+parseFloat(res4); $("#salario_SBC_2").text(addCommas('$ '+suma_4.toFixed(2)));

            var costo_tot_pos_m_2 =$("#costo_tot_pos_m_2").text(); //4 Salario Variable Promedio Mensual (Bono de productividad)
            var res5 = costo_tot_pos_m_2.substring(2);  porc5=res5*prop_neg/100; suma_5=parseFloat(porc5)+parseFloat(res5); $("#costo_tot_pos_m_2").text('$ '+addCommas(suma_5.toFixed(2)));

            var carga_soc_prom_m_2 =$("#carga_soc_prom_m_2").text();//5 Total Carga SocialPromedio Mensual 2020
            var res6 = carga_soc_prom_m_2.substring(2);  porc6=res6*prop_neg/100; suma_6=parseFloat(porc6)+parseFloat(res6); $("#carga_soc_prom_m_2").text('$ '+addCommas(suma_6.toFixed(2)));

            var cost_tot_posc_a_2 =$("#cost_tot_posc_a_2").text();//6 Total Costo Anual 2021 2020

            var res7 = cost_tot_posc_a_2.substring(2); porc7=res7*prop_neg/100; suma_7=parseFloat(porc7.toFixed(2))+parseFloat(res7); $("#cost_tot_posc_a_2").text('$ '+addCommas(suma_7.toFixed(2)));

            var cost_tot_posc_a_v_2 =$("#cost_tot_posc_a_v_2").text();//7 Total Costo Anual Salario Variable 2020
            var res8 = cost_tot_posc_a_v_2.substring(2);  porc8=res8*prop_neg/100; suma_8=parseFloat(porc8)+parseFloat(res8); $("#cost_tot_posc_a_v_2").text('$ '+addCommas(suma_8.toFixed(2)));

            var cot_tot_anual_fijo_y_variable_2 =$("#cot_tot_anual_fijo_y_variable_2").text();//8 Total Costo Anual Salario Fijo + Variable 2020
            var res9 = cot_tot_anual_fijo_y_variable_2.substring(2);  porc9=res9*prop_neg/100; suma_9=parseFloat(porc9)+parseFloat(res9); $("#cot_tot_anual_fijo_y_variable_2").text('$ '+addCommas(suma_9.toFixed(2)));

            var cot_tot_anual_carga_soc_2 =$("#cot_tot_anual_carga_soc_2").text();//9 Total Carga Social 2021
            var res10 = cot_tot_anual_carga_soc_2.substring(2);  porc10=res10*prop_neg/100; suma_10=parseFloat(porc10)+parseFloat(res10); $("#cot_tot_anual_carga_soc_2").text('$ '+addCommas(suma_10.toFixed(2)));
            ///////////////////////////////////////////////////////////para costeo
            $("#fijo_anual_2").text('$ '+addCommas(suma_7.toFixed(2)));//costeo/salario/condicion 2021 fijo anual
            // var fij_anual=$("#fijo_anual").text();//ifjo_anual
            // var subfij_anu=fij_anual.substring(2).replace(/,/g, '');//----------------------------------------------------------------------- fijo anual
            var subfij_anu=$("#fijo_anual_val").val();//ifjo_anual
            // alert(subfij_anu);
            var resta=suma_7-subfij_anu;
            // $("#variable_anual_2").text('$ '+addCommas(suma_8.toFixed(2)));//costeo/salario/variable Anual------------>se llena abajo con Prestaciones variables
            var variabl_anual=$("#variable_anual").text();//tomo el valor de variable_anual
            var subvar_anu=variabl_anual.substring(2).replace(/,/g, '');//------------------------------------------------------------------variable anual
            var resta2=suma_8-subvar_anu;

            var porc_fijo_anual=suma_7.toFixed(2)/subfij_anu; 
            // alert(porc_fijo_anual);
            var porc_fijo_anual2=porc_fijo_anual-1;
            var porc_fijo_anual22=porc_fijo_anual2*100;  

            // alert(porc_fijo_anual2);
            $("#propuesta_fijo_anual").text(porc_fijo_anual22.toFixed(2));//Costeo/salario  ///--->propuesta_fijo_anual

            var divprop_porcentaje=subvar_anu/suma_8;
            var prop_neg_var_anual=divprop_porcentaje-1;
            //$("#propuesta_fijo_anual_2").text();//Costeo/salario %variable anual             condicion2021------Variable anual--------------se llena en prestaciones variables

            $("#incre_en_sobre_costo_actual").text('$ '+addCommas(resta.toFixed(2)));//Costeo/salario Incremento en $ sobre costo actual
            // $("#incre_en_sobre_costo_actual_2").text('$ '+addCommas(resta2.toFixed(2)));//Costeo/salario Incremento en $ sobre costo actual_2---------se llena en prestaciones variables

            var incre_sobre_costo_act=resta/subfij_anu;
            // alert(incre_sobre_costo_act);
            var porcen=incre_sobre_costo_act*100;
            $("#incre_sobre_cost_tot_act").text(porcen.toFixed(2));//Costeo/salario/Incremento sobre costo total actual

            // var  incre_sobre_costo_act_2=resta/subvar_anu;

            // var porcen2= incre_sobre_costo_act_2*100;
            // $("#incre_sobre_cost_tot_act_2").text(porcen2.toFixed(2));//Costeo/salario/Incremento sobre costo total actual2

            // alert(subfij_anu);
            // alert(suma_7);
            var incre_sobre_costo_act=suma_7/subfij_anu;//% de incremento nomina actual
            // alert(incre_sobre_costo_act);
            var porcen_nom= incre_sobre_costo_act*100;
            $("#porce_increm_nomi_actual").text(porcen_nom.toFixed(2));

            // var incre_sobre_costo_act_2=subvar_anu/suma_8;//% de incremento nomina actual--------------- se llena en prestaciones variables
            // var porcen_nom_2= incre_sobre_costo_act_2*100;
            // $("#porce_increm_nomi_actual_2").text(porcen_nom_2.toFixed(1));

            // alert(resta);
            // alert(subfij_anu);
            var prop_sob_cost_CCT=resta/subfij_anu;//Proporcion sobre el costo total del CCT Fijo Anual
            var porcen_sob_co_CC= prop_sob_cost_CCT*100;

            $("#prop_sobre_costo_total_CCT").text(porcen_sob_co_CC.toFixed(2));//-----------------------se llena en 

            // var prop_sob_cost_CCT_2=resta/subfij_anu;//Proporcion sobre el costo total del CCT Fijo Anual2
            // var porcen_sob_co_CC_2= prop_sob_cost_CCT_2*100;
            // $("#prop_sobre_costo_total_CCT_2").text(porcen_sob_co_CC_2.toFixed(1));/////////////////------>se llena en prestaciones variables

            var fijomasvariable=parseFloat(subfij_anu)+parseFloat(subvar_anu);
            $("#fijo_a_mas_variable_a_val").val(fijomasvariable);
            $("#fijo_a_mas_variable_a").text('$ '+addCommas(fijomasvariable.toFixed(2)));

            // var fijomasvariable_2=parseFloat(suma_7)+parseFloat(suma_8);
            // $("#fijo_a_mas_variable_a_2").text('$ '+addCommas(fijomasvariable_2.toFixed(2)));------------>se llena en Prestaciones Variables

            // alert(resta);
            // alert(fijomasvariable);
            var prop_sb_cost_fijomasvar=parseFloat(resta)/parseFloat(fijomasvariable);
            $("#prop_sb_cost_fijomasvar").text(prop_sb_cost_fijomasvar.toFixed(2));//Costeo/salario Proporcion sobre el costo total del CCT Fijo + Variable Anual 
            // var prop_sb_cost_fijomasvar_2=parseFloat(resta2)/parseFloat(fijomasvariable_2);//---------->sellena en salario variable
            // $("#prop_sb_cost_fijomasvar_2").text(prop_sb_cost_fijomasvar_2.toFixed(2));//Costeo/salario Proporcion sobre el costo total del CCT Fijo + Variable Anual_2
            //////////////////////////////------------------------------------------------------------------------------------------------------------------------------------2.-Prestaciones fijas

            // var p_v_en_dias= $("#prom_vacaciones_dias_a").text();///////////////----------------->vacaciones promedio
            var p_v_en_dias= $("#prom_vacaciones_dias_a_val").val();


            var dias_aguinaldo_actual=$("#prom_Agui_dias").text();//dias_aguinaldo_actual
            var dias_aguinaldo_actual_2=$("#prom_Agui_dias_2").val();//dias_aguinaldo_actual
            $("#dias_aguinaldo_actual").text(dias_aguinaldo_actual);//actual en dias
            $("#dias_agui").text(dias_aguinaldo_actual+' dias de aguinaldo');
            var cond_actual_div=parseFloat(subfij_anu)/365;//condicion actual ahionaldo
            var res_condac_x_fij_anual=parseFloat(cond_actual_div)*parseFloat(dias_aguinaldo_actual);//-----------------actual aguinaldo
            $("#dias_agui_actual").text('$ '+addCommas(res_condac_x_fij_anual.toFixed(2)));
            $("#aguinaldo_dias_propuesta").val(dias_aguinaldo_actual_2);//----------------------------------------------para propuesta   viene del guardado
            var fijo_anual_2=$("#fijo_anual_2").text();
            var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual
            var agu_sal_fijo=(fijo_anual_22/365)*dias_aguinaldo_actual;//--------------------->muestra propuesta año sig
            $("#agu_sal_fijo").text('$ '+addCommas(agu_sal_fijo.toFixed(2)));

            var porc_agu_propuesta = (agu_sal_fijo.toFixed(2)/res_condac_x_fij_anual.toFixed(2))-1;
            var porc_agu_propuesta2 = porc_agu_propuesta*100;
            $("#porc_agu_propuesta").text(porc_agu_propuesta2.toFixed(2)+' %');

            var incre_en_agu_sal_fijo = agu_sal_fijo-res_condac_x_fij_anual;
            $("#incre_en_agu_sal_fijo").text('$ '+addCommas(incre_en_agu_sal_fijo.toFixed(2)));


            var incre_sobre_cost_to_ac= (incre_en_agu_sal_fijo/res_condac_x_fij_anual)*100;
            $("#incre_sobre_cost_to_ac").text(incre_sobre_cost_to_ac.toFixed(2)+' %');

            var porc_incr_nomin_agui_sal_fijo=(agu_sal_fijo/subfij_anu)*100;
            $("#porc_incr_nomin_agui_sal_fijo").text(porc_incr_nomin_agui_sal_fijo.toFixed(2)+' %');

            var prop_sob_cos_act_agu_sal_fij=(incre_en_agu_sal_fijo/subfij_anu)*100;
            $("#prop_sob_cos_act_agu_sal_fij").text(prop_sob_cos_act_agu_sal_fij.toFixed(2));

            var prop_sob_cost_cct_agui_sal_fij=(incre_en_agu_sal_fijo/fijomasvariable)*100;
            $("#prop_sob_cost_cct_agui_sal_fij").text(prop_sob_cost_cct_agui_sal_fij.toFixed(2));


            //////////////////////////////////////////////////////////////////////////////////
            // var p_v_a= $("#prima_vacacional_a").text();//prima vacacionalactual
            var p_v_a= $("#prima_vacacional_a_val").val();//------------------------------------------->prima vacacionalactual
            var p_v_a_2= $("#prima_vacacional_a_val_2").val();//------------------------------------------->prima vacacionalactual
            // alert(p_v_a);

            $("#prima_vacacional_actual").text(Math.round(p_v_a));
            
            var p_v_a2 =p_v_a.replace(' %', '');
            var p_v_a2_porcentaje= p_v_a2*0.01;
            $("#prima_vacacional_actual2").text(p_v_a2_porcentaje.toFixed(2));
            $("#prim_vac_dia_prop_porc").val(p_v_a_2);//para el input de dias de propuesta de prima vacacional viene de la base de datos


            // var p_v_en_d= $("#prom_vacaciones_dias_a").text();
            var p_v_en_d= $("#prom_vacaciones_dias_a_val").val();
            var con_actual_prima_vacacional=subfij_anu/365;
            var con_actual_prima_vacacional2=con_actual_prima_vacacional*p_v_a2_porcentaje;//->0.48
            var con_actual_prima_vacacional3=con_actual_prima_vacacional2*p_v_en_d;//-12>
            // alert(con_actual_prima_vacacional3);
            $("#prim_vac_sal_fi_act").text('$ '+addCommas(con_actual_prima_vacacional3.toFixed(2)));


            var p_f_a_a= $("#prom_fondo_ahorro_a").text();//Fondo de ahorro - Salario fijo
            var p_f_a_a_2= $("#prom_fondo_ahorro_a_2").val();//Fondo de ahorro - Salario fijo
            
            $("#porcentaje_fondo_ahorro_actual").text(p_f_a_a+' Salario Anual');
            var p_f_a_a2 =p_f_a_a.replace(' %', '');////////////////////////////////////prima vacacional 13
            var p_f_a_a3 = p_f_a_a2*0.01;
            $("#porcentaje_fondo_ahorro_actual2").text(p_f_a_a);
            $("#fond_ahorro_prropuesta").val(p_f_a_a_2); 



            var cond_con_propues_sal_fijo = ((fijo_anual_22/365)*p_v_en_dias)*p_v_a2_porcentaje.toFixed(2);
            $("#cond_con_propues_sal_fijo").text('$ '+addCommas(cond_con_propues_sal_fijo.toFixed(2)));

            var porc_prim_vac_sal_fijo =((cond_con_propues_sal_fijo/con_actual_prima_vacacional3)-1)*100;
            $("#porc_prim_vac_sal_fijo").text(porc_prim_vac_sal_fijo.toFixed(2)+' %');

            var incre_en_sob_costo_prima_vac =cond_con_propues_sal_fijo-con_actual_prima_vacacional3;
            $("#incre_en_sob_costo_prima_vac").text('$ '+incre_en_sob_costo_prima_vac.toFixed(2));

            var inc_sob_cost_tot_act_prim_vac_sal=(incre_en_sob_costo_prima_vac/con_actual_prima_vacacional3)*100;
            $("#inc_sob_cost_tot_act_prim_vac_sal").text(inc_sob_cost_tot_act_prim_vac_sal.toFixed(2)+' %');

            var porc_de_incre_nom_prim_vac_sal_fij=(cond_con_propues_sal_fijo/subfij_anu)*100;
            $("#porc_de_incre_nom_prim_vac_sal_fij").text(porc_de_incre_nom_prim_vac_sal_fij.toFixed(2)+' %');

            var pro_sob_cost_act_cct_prima_cav=(incre_en_sob_costo_prima_vac/subfij_anu)*100;
            $("#pro_sob_cost_act_cct_prima_cav").text(pro_sob_cost_act_cct_prima_cav.toFixed(2));

            var pro_sob_cos_tot_cct_prima_vac =(incre_en_sob_costo_prima_vac/fijomasvariable)*100;
            $("#pro_sob_cos_tot_cct_prima_vac").text(pro_sob_cos_tot_cct_prima_vac.toFixed(2));
            //////////////////////////////////////////////////////////






            $("#prom_vacaciones_dias_actual").text(Math.round(p_v_en_dias));
            var fon_ahorro_sal_fijo_actual=subfij_anu*p_f_a_a3;
            // alert(fon_ahorro_sal_fijo_actual);
            $("#fon_aho_sal_fi_act_por_sub_fij_nual").text('$ '+addCommas(fon_ahorro_sal_fijo_actual.toFixed(2)));

            var cond_fond_ahorro_sal_fijo = fijo_anual_22*p_f_a_a3;
            $("#cond_fond_ahorro_sal_fijo").text("$ "+ addCommas(cond_fond_ahorro_sal_fijo.toFixed(2)));

            var porc_fondo_ahorro_sal_fijo= ((cond_fond_ahorro_sal_fijo/fon_ahorro_sal_fijo_actual)-1)*100;
            $("#porc_fondo_ahorro_sal_fijo").text(porc_fondo_ahorro_sal_fijo.toFixed(2)+' %');

            var incr_en_sobre_cost_act_fond_ahorr =cond_fond_ahorro_sal_fijo-fon_ahorro_sal_fijo_actual;
            $("#incr_en_sobre_cost_act_fond_ahorr").text("$ "+addCommas(incr_en_sobre_cost_act_fond_ahorr.toFixed(2)));

            var incr_sobr_cost_tot_act_fond_ahor= (incr_en_sobre_cost_act_fond_ahorr/fon_ahorro_sal_fijo_actual)*100;
            $("#incr_sobr_cost_tot_act_fond_ahor").text(incr_sobr_cost_tot_act_fond_ahor.toFixed(2)+" %");
            var fijoanual = $("#fijo_anual_val").val();//------------------------------------------------------------------------------------------fijo anuall

            var porc_incre_nom_actual_fond_ahorro= (cond_fond_ahorro_sal_fijo/fijoanual)*100;
            $("#porc_incre_nom_actual_fond_ahorro").text(porc_incre_nom_actual_fond_ahorro.toFixed(2));

            var prop_sob_cost_tot_cct_fon_ahorro=(incr_en_sobre_cost_act_fond_ahorr/fijoanual)*100;
            $("#prop_sob_cost_tot_cct_fon_ahorro").text(prop_sob_cost_tot_cct_fon_ahorro.toFixed(2));

            var prop_sob_cost_tot_cct_fijo_fond_ahorro= (incr_en_sobre_cost_act_fond_ahorr/fijomasvariable)*100;
            $("#prop_sob_cost_tot_cct_fijo_fond_ahorro").text(prop_sob_cost_tot_cct_fijo_fond_ahorro.toFixed(2));
            //------------------------------------------------------->subtotal prestacionesFijas
            var subtotal_prest_vari=res_condac_x_fij_anual+con_actual_prima_vacacional3+fon_ahorro_sal_fijo_actual;
            $("#subtotal_prest_fijas").text('$ '+addCommas(subtotal_prest_vari.toFixed(2)));

            var sub_tot_cond=agu_sal_fijo+cond_con_propues_sal_fijo+cond_fond_ahorro_sal_fijo;
            $("#sub_tot_cond").text("$ "+addCommas(sub_tot_cond.toFixed(2)));

            var sub_tot_porc=((sub_tot_cond/subtotal_prest_vari)-1)*100;
            $("#sub_tot_porc").text(sub_tot_porc.toFixed(2)+" %");

            var sub_tot_incr_en=sub_tot_cond-subtotal_prest_vari;
            $("#sub_tot_incr_en").text("$ "+addCommas(sub_tot_incr_en.toFixed(2)));

            var sub_tot_inc_sob_cost_to_act=(sub_tot_incr_en/subtotal_prest_vari)*100;
            $("#sub_tot_inc_sob_cost_to_act").text(sub_tot_inc_sob_cost_to_act.toFixed(2)+" %");

            // alert(sub_tot_cond);
            // alert(subfij_anu); 
            var sub_tot_inc_sob_nomina= (sub_tot_cond/subfij_anu)*100;

            $("#sub_tot_inc_sob_nomina").text(sub_tot_inc_sob_nomina.toFixed(2)+" %");

            var sub_tot_prop_sob_cost_cct= prop_sob_cos_act_agu_sal_fij+pro_sob_cost_act_cct_prima_cav+prop_sob_cost_tot_cct_fon_ahorro;
            $("#sub_tot_prop_sob_cost_cct").text(sub_tot_prop_sob_cost_cct.toFixed(2));

            var sub_tot_prop_sob_cost_cct_fijo_mas_var= prop_sob_cost_cct_agui_sal_fij+pro_sob_cos_tot_cct_prima_vac+prop_sob_cost_tot_cct_fijo_fond_ahorro;
            $("#sub_tot_prop_sob_cost_cct_fijo_mas_var").text(sub_tot_prop_sob_cost_cct_fijo_mas_var.toFixed(2));



            ///////////////////////////////////////------------------------------------------------------------------------------------------------------------------>/Prestaciones variables

            var sal_fijo_anual_por_1= subvar_anu*100;//actual Prestaciones variables en porcentaje 
            var sal_fijo_anual_por_2=sal_fijo_anual_por_1/subfij_anu;//prestaciones variables salario fijo anual  -> sal_fijo_anual_por_2------------------------------
            $("#prest_fij_sal_fijo_anual_porc").text(Math.round(sal_fijo_anual_por_2)+' %');

            var cond_act_pres_var_porcentaje= sal_fijo_anual_por_2*0.01;//para pasarlo a decimales 
            var cond_act_pres_var= subfij_anu*cond_act_pres_var_porcentaje;//-----------------------------------------------------------operacion
            $("#cond_act_pres_var").text('$ '+addCommas(cond_act_pres_var));//-----------------------------------------------------------operacion
            $("#cond_act_pres_var_2").text('$ '+addCommas(cond_act_pres_var));//para subtotal

            // $("#prest_variables_propuesta").val(Math.round(sal_fijo_anual_por_2));//--------------------------------------input prestaciones variables ´
            var prest_variables_propuesta_2 = $("#prest_variables_propuesta_2").val();//--------------------------------------input prestaciones variables 

            $("#prest_variables_propuesta").val(prest_variables_propuesta_2);//--------------------------------------input prestaciones variables 

            var aporciento=Math.round(sal_fijo_anual_por_2)*0.01;//el 85 se pasa a 0.85
            // alert(aporciento);
            var cond_pres_sal_fijo_anual =suma_7*aporciento;//valor correcto se vaa condicion 2021 de prestaciones variables
            $("#condi_prest_var").text('$ '+addCommas(cond_pres_sal_fijo_anual.toFixed(2)));
            $("#condi_prest_var_2").text('$ '+addCommas(cond_pres_sal_fijo_anual.toFixed(2)));

            var porc_prest_variables_1 = cond_pres_sal_fijo_anual/cond_act_pres_var;//Porcentaje de prestaciones de variable
            var porc_prest_variables_2 = porc_prest_variables_1-1;
            var porc_prest_variables_3 = porc_prest_variables_2*100;
            $("#porc_prest_variables").text(porc_prest_variables_3.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#porc_prest_variables").text(porc_prest_variables_3.toFixed(2)+' %');//-----------------------------------------------------------operacion
            var inc_en_prest_variables = cond_pres_sal_fijo_anual-cond_act_pres_var;
            $("#inc_en_prest_variables").text('$ '+addCommas(inc_en_prest_variables.toFixed(2)));//-----------------------------------------------------------operacion
            $("#inc_en_prest_variables_2").text('$ '+addCommas(inc_en_prest_variables.toFixed(2)));//-----------------------------------------------------------operacion
            var incre_sobre_prest_variables_1=inc_en_prest_variables/cond_act_pres_var;
            var incre_sobre_prest_variables_2=incre_sobre_prest_variables_1*100;
            $("#incre_sobre_prest_variables").text(incre_sobre_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#incre_sobre_prest_variables_2").text(incre_sobre_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            var porc_increm_nom_actual_prest_variables_1=cond_pres_sal_fijo_anual/subfij_anu;
            var porc_increm_nom_actual_prest_variables_2=porc_increm_nom_actual_prest_variables_1*100;
            $("#porc_increm_nom_actual_prest_variables").text(porc_increm_nom_actual_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#porc_increm_nom_actual_prest_variables_2").text(porc_increm_nom_actual_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            var pro_sobr_cost_tot_prest_variables_1=inc_en_prest_variables/subfij_anu;
            var pro_sobr_cost_tot_prest_variables_2=pro_sobr_cost_tot_prest_variables_1*100;
            $("#pro_sobr_cost_tot_prest_variables").text(pro_sobr_cost_tot_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#pro_sobr_cost_tot_prest_variables_2").text(pro_sobr_cost_tot_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            var pro_sobr_cost_tot_mas_var_prest_variables_1=inc_en_prest_variables/fijomasvariable;
            var pro_sobr_cost_tot_mas_var_prest_variables_2=pro_sobr_cost_tot_mas_var_prest_variables_1*100;
            $("#pro_sobr_cost_tot_mas_var_prest_variables").text(pro_sobr_cost_tot_mas_var_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#pro_sobr_cost_tot_mas_var_prest_variables_2").text(pro_sobr_cost_tot_mas_var_prest_variables_2.toFixed(2)+' %');//-----------------------------------------------------------operacion
            $("#variable_anual_2").text('$ '+addCommas(cond_pres_sal_fijo_anual.toFixed(2)));//------------------------------------->de condicion 2021 salario
            var suma_fijo_mas_var_con=suma_7+cond_pres_sal_fijo_anual;
            $("#fijo_a_mas_variable_a_2").text('$ '+addCommas(suma_fijo_mas_var_con.toFixed(2)));
            // me quede en llenar la segunda fila de salario
            // alert(cond_pres_sal_fijo_anual.toFixed(2));//condicion actual 2020
            // alert(subvar_anu);
            var porc_var_anual = cond_pres_sal_fijo_anual.toFixed(2)-subvar_anu;//incremento en $ sobre costo anual
            // alert(porc_var_anual);

            $("#incre_en_sobre_costo_actual_2").text('$ '+addCommas(porc_var_anual.toFixed(2)));//-------desalario
            // alert(porc_var_anual);
            // alert(fijomasvariable);
            var prop_sb_cost_fijomasvar_2=parseFloat(porc_var_anual)/parseFloat(fijomasvariable);//---------->sellena en salario variable// prestaciones variables
            $("#prop_sb_cost_fijomasvar_2").text(prop_sb_cost_fijomasvar_2.toFixed(2));//Costeo/salario Proporcion sobre el costo total del CCT Fijo + Variable Anual_2


            var  incre_sobre_costo_act_2=porc_var_anual/subvar_anu;
            // alert(incre_sobre_costo_act_2);
            var porcen2= incre_sobre_costo_act_2*100;
            $("#incre_sobre_cost_tot_act_2").text(porcen2.toFixed(2));//Costeo/salario/Incremento sobre costo total actual2


            var propuesta_fijo_anua_2=cond_pres_sal_fijo_anual.toFixed(2)/subvar_anu; 
            var propuesta_fijo_anua_22=(propuesta_fijo_anua_2-1)*100;
            // alert(propuesta_fijo_anua_22.toFixed(2));
            $("#propuesta_fijo_anual_2").text(propuesta_fijo_anua_22.toFixed(2));//->de salario
            // var porc_var_anual.toFixed(2)/

            // alert(cond_pres_sal_fijo_anual);//-------condicion 2021 variable anual
            // alert(subfij_anu);//-------Fijo anual
            var incre_sobre_costo_act_2=cond_pres_sal_fijo_anual/subfij_anu;//% de incremento nomina actual
            // alert(incre_sobre_costo_act_2);
            var porcen_nom_2= incre_sobre_costo_act_2*100;
            $("#porce_increm_nomi_actual_2").text(porcen_nom_2.toFixed(2));

            // alert(porc_var_anual);
            // alert(subfij_anu);
            var porcen_sob_co_CC_2=porc_var_anual/subfij_anu;//------------proprocion S/costo total del cct
            var porcen_sob_co_CC_22=porcen_sob_co_CC_2*100;
            $("#prop_sobre_costo_total_CCT_2").text(porcen_sob_co_CC_22.toFixed(2));

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////5. IMPUESTOS DE SEGURIDAD SOCIAL

            var total_carga_social_imp_seg_soc_=$("#total_carga_social_val").val();
            var total_carga_social_imp_seg_soc=parseFloat(total_carga_social_imp_seg_soc_).toFixed(2);
            $("#total_carga_social_seg_social").text('$ '+addCommas(total_carga_social_imp_seg_soc));
            var prop_neg = $("#prop_neg").val();
            $("#prop_neg_imp_seg_soc").text(prop_neg);
            $("#carga_soc_imp_seg_soc").text('$ '+addCommas(suma_10.toFixed(2)));
            $("#inc_sob_cost_act_imp_seg_soc").text((suma_10-total_carga_social_imp_seg_soc).toFixed(2));
            $("#inc_en_sob_cost_act_imp_seg_soc").text((((suma_10-total_carga_social_imp_seg_soc)/total_carga_social_imp_seg_soc)*100).toFixed(2));
            //  (suma_10-total_carga_social_imp_seg_soc)
            $("#inc_en_imp_seg_soc").text((((suma_10-total_carga_social_imp_seg_soc)/total_carga_social_imp_seg_soc)*100).toFixed(2));
            var fijoanual = $("#fijo_anual_val").val();//fijo anual
            $("#inc_sob_imp_seg_soc").text(((suma_10/fijoanual)*100).toFixed(2));
            $("#inc_nom_act_imp_seg_soc").text((((suma_10-total_carga_social_imp_seg_soc)/fijoanual)*100).toFixed(2));
            var fijomvar=$("#fijo_a_mas_variable_a_val").val();
            $("#prop_sob_cct_imp_seg_soc").text(((suma_10-total_carga_social_imp_seg_soc)/fijomvar).toFixed(2));
            
            $("#total_carga_social_seg_social_2").text('$ '+addCommas(total_carga_social_imp_seg_soc));
            $("#prop_neg_imp_seg_soc_2").text(prop_neg);
            $("#carga_soc_imp_seg_soc_2").text('$ '+addCommas(suma_10.toFixed(2)));
            $("#inc_sob_cost_act_imp_seg_soc_2").text((suma_10-total_carga_social_imp_seg_soc).toFixed(2));
            $("#inc_en_sob_cost_act_imp_seg_soc_2").text((((suma_10-total_carga_social_imp_seg_soc)/total_carga_social_imp_seg_soc)*100).toFixed(2));
            $("#inc_en_imp_seg_soc_2").text((((suma_10-total_carga_social_imp_seg_soc)/total_carga_social_imp_seg_soc)*100).toFixed(2));
            $("#inc_sob_imp_seg_soc_2").text(((suma_10/fijoanual)*100).toFixed(2));
            $("#inc_nom_act_imp_seg_soc_2").text((((suma_10-total_carga_social_imp_seg_soc)/fijoanual)*100).toFixed(2));
            $("#prop_sob_cct_imp_seg_soc_2").text(((suma_10-total_carga_social_imp_seg_soc)/fijomvar).toFixed(2));
            //--------------------------------------------------------------TOTALES-------------------------------------------------
            
            

    };

   
    function aguinaldo_dias_propuesta(){
        var aguinaldo_dias_propuesta = $('#aguinaldo_dias_propuesta').val();
        // alert(aguinaldo_dias_propuesta);
        var fijo_anual_2=$("#fijo_anual_2").text();
        var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual
        var agu_sal_fijo=(fijo_anual_22/365)*aguinaldo_dias_propuesta;//--------------------->muestra propuesta año sig
        $("#agu_sal_fijo").text('$ '+addCommas(agu_sal_fijo.toFixed(2))); 

        var res_condac_x_fij_anual = $("#dias_agui_actual").text();
        var res_condac_x_fij_anual_2 = res_condac_x_fij_anual.substring(2).replace(/,/g, '');
        $("#porc_agu_propuesta").text((((agu_sal_fijo/res_condac_x_fij_anual_2)-1)*100).toFixed(2)+' %');
        var incre_en_agu_sal_fijo = agu_sal_fijo-res_condac_x_fij_anual_2;
        $("#incre_en_agu_sal_fijo").text('$ '+addCommas((agu_sal_fijo-res_condac_x_fij_anual_2).toFixed(2)));
        $("#incre_sobre_cost_to_ac").text(((incre_en_agu_sal_fijo/res_condac_x_fij_anual_2)*100).toFixed(2)+' %');
        var fijoanual = $("#fijo_anual_val").val();//----------------------------------------------------------------------------fijo anuall
        var porc_incr_nomin_agui_sal_fijo=(agu_sal_fijo/fijoanual)*100;
        $("#porc_incr_nomin_agui_sal_fijo").text(((agu_sal_fijo/fijoanual)*100).toFixed(2)+' %');
        $("#prop_sob_cos_act_agu_sal_fij").text(((incre_en_agu_sal_fijo/fijoanual)*100).toFixed(2))
        var fijomvar=$("#fijo_a_mas_variable_a_val").val();
        $("#prop_sob_cost_cct_agui_sal_fij").text(((incre_en_agu_sal_fijo/fijomvar)*100).toFixed(2));
        //para subtotales de salario 
        var cond_con_propues_sal_fijo = $("#cond_con_propues_sal_fijo").text();
        var cond_con_propues_sal_fijo_2 = cond_con_propues_sal_fijo.substring(2).replace(/,/g, '');
        var cond_fond_ahorro_sal_fijo = $("#cond_fond_ahorro_sal_fijo").text();
        var cond_fond_ahorro_sal_fijo_2 = cond_fond_ahorro_sal_fijo.substring(2).replace(/,/g, '');
        var subto_prestfij = parseFloat(agu_sal_fijo)+parseFloat(cond_con_propues_sal_fijo_2)+parseFloat(cond_fond_ahorro_sal_fijo_2);
        //subtot prestfoja proporcion
        $("#sub_tot_cond").text('$ '+addCommas(subto_prestfij.toFixed(2)));
        var val1 = (incre_en_agu_sal_fijo/fijoanual)*100;
        var val2 = $("#pro_sob_cost_act_cct_prima_cav").text();
        var val3 = $("#prop_sob_cost_tot_cct_fon_ahorro").text();
        var subtoprops = val1+parseFloat(val2)+parseFloat(val3);
        $("#sub_tot_prop_sob_cost_cct").text(subtoprops.toFixed(2));
        //subtot proporciosob
        var val11 = (incre_en_agu_sal_fijo/fijomvar)*100;
        var val22 = $("#pro_sob_cos_tot_cct_prima_vac").text();
        var val33 = $("#prop_sob_cost_tot_cct_fijo_fond_ahorro").text();
        //
        var subtoprop = val11+parseFloat(val22)+parseFloat(val33);
        $("#sub_tot_prop_sob_cost_cct_fijo_mas_var").text(subtoprop.toFixed(2));
        var subtotal_prest_fijas=$("#subtotal_prest_fijas").text();
        var subtotal_prest_fijas2=subtotal_prest_fijas.substring(2).replace(/,/g, '');
        $("#sub_tot_porc").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_incr_en").text((subto_prestfij-subtotal_prest_fijas2).toFixed(2));
        $("#sub_tot_inc_sob_cost_to_act").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_inc_sob_nomina").text(((subto_prestfij/fijoanual)*100).toFixed(2));  
    }
 

    function prim_vac_dia_prop_porc(){
            var prim_vac_dia_prop_porc = $('#prim_vac_dia_prop_porc').val();/////////////////////////porcentage variable
            var prim_vac_dia_prop_porc2=prim_vac_dia_prop_porc*0.01;
            // var vac_prom_pret_fij = $("#prom_vacaciones_dias_a_val").val();///////////////////dias actual
            var fijo_anual_2=$("#fijo_anual_2").text();
            var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual

            var p_v_en_d= $("#prom_vacaciones_dias_a_val").val();

            var cond_con_propues_sal_fijo = (((fijo_anual_22/365)*p_v_en_d)*prim_vac_dia_prop_porc2).toFixed(2);
            $("#cond_con_propues_sal_fijo").text('$ '+addCommas((((fijo_anual_22/365)*p_v_en_d)*prim_vac_dia_prop_porc2).toFixed(2)));
            var prim_vac_sal_fi_act=$("#prim_vac_sal_fi_act").text();
            var prim_vac_sal_fi_act2=prim_vac_sal_fi_act.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual
            var porc_prim_vac_sal_fijo = (((cond_con_propues_sal_fijo/prim_vac_sal_fi_act2)-1)*100);
            $("#porc_prim_vac_sal_fijo").text(porc_prim_vac_sal_fijo.toFixed(2));
            var incre_en_sob_costo_prima_vac=cond_con_propues_sal_fijo-prim_vac_sal_fi_act2;
            $("#incre_en_sob_costo_prima_vac").text('$ '+addCommas(incre_en_sob_costo_prima_vac.toFixed(2)));

            $("#inc_sob_cost_tot_act_prim_vac_sal").text(((incre_en_sob_costo_prima_vac/prim_vac_sal_fi_act2)*100).toFixed(2));
            
            var fijoanual = $("#fijo_anual_val").val();//fijo anual
            var porc_de_incre_nom_prim_vac_sal_fij=((cond_con_propues_sal_fijo/fijoanual)*100);
            
            $("#porc_de_incre_nom_prim_vac_sal_fij").text(porc_de_incre_nom_prim_vac_sal_fij.toFixed(2)+' %');

            var pro_sob_cost_act_cct_prima_cav = (incre_en_sob_costo_prima_vac/fijoanual)*100;
            $("#pro_sob_cost_act_cct_prima_cav").text(pro_sob_cost_act_cct_prima_cav.toFixed(2)+' %');
            var fijomvar=$("#fijo_a_mas_variable_a_val").val();

            var pro_sob_cos_tot_cct_prima_vac = (incre_en_sob_costo_prima_vac/fijomvar)*100;
            $("#pro_sob_cos_tot_cct_prima_vac").text(pro_sob_cos_tot_cct_prima_vac.toFixed(2)+' %');

                //para subtotales de salario 

        var cond_con_propues_sal_fijo = $("#cond_con_propues_sal_fijo").text();
        var cond_con_propues_sal_fijo_2 = cond_con_propues_sal_fijo.substring(2).replace(/,/g, '');
        var agu_sal_fijo_1 = $("#agu_sal_fijo").text();
        var agu_sal_fijo = agu_sal_fijo_1.substring(2).replace(/,/g, '');
        var cond_fond_ahorro_sal_fijo = $("#cond_fond_ahorro_sal_fijo").text();
        var cond_fond_ahorro_sal_fijo_2 = cond_fond_ahorro_sal_fijo.substring(2).replace(/,/g, '');
        var subto_prestfij = parseFloat(agu_sal_fijo)+parseFloat(cond_con_propues_sal_fijo_2)+parseFloat(cond_fond_ahorro_sal_fijo_2);
        //subtot prestfoja proporcion
        $("#sub_tot_cond").text('$ '+addCommas(subto_prestfij.toFixed(2)));
        var incre_en_agu_sal_fijo_ = $("#incre_en_agu_sal_fijo").text();
        var incre_en_agu_sal_fijo = incre_en_agu_sal_fijo_.substring(2).replace(/,/g, '');
        var val1 = (incre_en_agu_sal_fijo/fijoanual)*100;
        var val2 = $("#pro_sob_cost_act_cct_prima_cav").text();
        var val3 = $("#prop_sob_cost_tot_cct_fon_ahorro").text();
        var subtoprops = val1+parseFloat(val2)+parseFloat(val3);
        $("#sub_tot_prop_sob_cost_cct").text(subtoprops.toFixed(2));
        //subtot proporciosob
        var val11 = (incre_en_agu_sal_fijo/fijomvar)*100;
        var val22 = $("#pro_sob_cos_tot_cct_prima_vac").text();
        var val33 = $("#prop_sob_cost_tot_cct_fijo_fond_ahorro").text();
        //
        var subtoprop = val11+parseFloat(val22)+parseFloat(val33);
        $("#sub_tot_prop_sob_cost_cct_fijo_mas_var").text(subtoprop.toFixed(2));
        var subtotal_prest_fijas=$("#subtotal_prest_fijas").text();
        var subtotal_prest_fijas2=subtotal_prest_fijas.substring(2).replace(/,/g, '');
        $("#sub_tot_porc").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_incr_en").text((subto_prestfij-subtotal_prest_fijas2).toFixed(2));
        $("#sub_tot_inc_sob_cost_to_act").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_inc_sob_nomina").text(((subto_prestfij/fijoanual)*100).toFixed(2)); 

        

    }
    function fond_ahorro_prropuesta(){
        var fond_ahorro_prropuesta_ = $('#fond_ahorro_prropuesta').val();
        var fond_ahorro_prropuesta = fond_ahorro_prropuesta_*0.01;
        // alert(fond_ahorro_prropuesta);
        var fijoanual = $("#fijo_anual_val").val();//--------------------------------------------------------------fijo anual
        var fijo_anual_2=$("#fijo_anual_2").text();
        var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//--------------------condicion con propuesta fijo anual
        var fijomvar=$("#fijo_a_mas_variable_a_val").val();//-----------------------------------------------------fijo mas variable
        var fon_aho_sal_fi_act_por_sub_fij_nual_ = $("#fon_aho_sal_fi_act_por_sub_fij_nual").text();
        var fon_aho_sal_fi_act_por_sub_fij_nual=fon_aho_sal_fi_act_por_sub_fij_nual_.substring(2).replace(/,/g, '');//
        // alert(fijo_anual_22);
        // alert(fond_ahorro_prropuesta);
        var cond_fond_ahorro_sal_fijo = fijo_anual_22*fond_ahorro_prropuesta;
        $("#cond_fond_ahorro_sal_fijo").text('$ '+addCommas(cond_fond_ahorro_sal_fijo.toFixed(2)));
        var porc_fondo_ahorro_sal_fijo = (((cond_fond_ahorro_sal_fijo/fon_aho_sal_fi_act_por_sub_fij_nual)-1)*100);
        $("#porc_fondo_ahorro_sal_fijo").text(porc_fondo_ahorro_sal_fijo.toFixed(2));
        var incr_en_sobre_cost_act_fond_ahorr = cond_fond_ahorro_sal_fijo-fon_aho_sal_fi_act_por_sub_fij_nual;
        $("#incr_en_sobre_cost_act_fond_ahorr").text('$'+ addCommas(incr_en_sobre_cost_act_fond_ahorr.toFixed(2)));  
        var incr_sobr_cost_tot_act_fond_ahor = (incr_en_sobre_cost_act_fond_ahorr/fon_aho_sal_fi_act_por_sub_fij_nual)*100;
        $("#incr_sobr_cost_tot_act_fond_ahor").text(incr_sobr_cost_tot_act_fond_ahor.toFixed(2));
        var porc_incre_nom_actual_fond_ahorro = (cond_fond_ahorro_sal_fijo/fijoanual)*100;
        $("#porc_incre_nom_actual_fond_ahorro").text(porc_incre_nom_actual_fond_ahorro.toFixed(2));
        var prop_sob_cost_tot_cct_fon_ahorro = (incr_en_sobre_cost_act_fond_ahorr/fijoanual)*100;
        $("#prop_sob_cost_tot_cct_fon_ahorro").text(prop_sob_cost_tot_cct_fon_ahorro.toFixed(2));
        var prop_sob_cost_tot_cct_fijo_fond_ahorro = (incr_en_sobre_cost_act_fond_ahorr/fijomvar)*100;
        $("#prop_sob_cost_tot_cct_fijo_fond_ahorro").text(prop_sob_cost_tot_cct_fijo_fond_ahorro.toFixed(2));
        //totales
        
                //para subtotales de salario 

                var cond_con_propues_sal_fijo = $("#cond_con_propues_sal_fijo").text();
        var cond_con_propues_sal_fijo_2 = cond_con_propues_sal_fijo.substring(2).replace(/,/g, '');
        var agu_sal_fijo_1 = $("#agu_sal_fijo").text();
        var agu_sal_fijo = agu_sal_fijo_1.substring(2).replace(/,/g, '');
        var cond_fond_ahorro_sal_fijo = $("#cond_fond_ahorro_sal_fijo").text();
        var cond_fond_ahorro_sal_fijo_2 = cond_fond_ahorro_sal_fijo.substring(2).replace(/,/g, '');
        var subto_prestfij = parseFloat(agu_sal_fijo)+parseFloat(cond_con_propues_sal_fijo_2)+parseFloat(cond_fond_ahorro_sal_fijo_2);
        //subtot prestfoja proporcion
        $("#sub_tot_cond").text('$ '+addCommas(subto_prestfij.toFixed(2)));
        var incre_en_agu_sal_fijo_ = $("#incre_en_agu_sal_fijo").text();
        var incre_en_agu_sal_fijo = incre_en_agu_sal_fijo_.substring(2).replace(/,/g, '');
        var val1 = (incre_en_agu_sal_fijo/fijoanual)*100;
        var val2 = $("#pro_sob_cost_act_cct_prima_cav").text();
        var val3 = $("#prop_sob_cost_tot_cct_fon_ahorro").text();
        var subtoprops = val1+parseFloat(val2)+parseFloat(val3);
        $("#sub_tot_prop_sob_cost_cct").text(subtoprops.toFixed(2));
        //subtot proporciosob
        var val11 = (incre_en_agu_sal_fijo/fijomvar)*100;
        var val22 = $("#pro_sob_cos_tot_cct_prima_vac").text();
        var val33 = $("#prop_sob_cost_tot_cct_fijo_fond_ahorro").text();
        //
        var subtoprop = val11+parseFloat(val22)+parseFloat(val33);
        $("#sub_tot_prop_sob_cost_cct_fijo_mas_var").text(subtoprop.toFixed(2));
        var subtotal_prest_fijas=$("#subtotal_prest_fijas").text();
        var subtotal_prest_fijas2=subtotal_prest_fijas.substring(2).replace(/,/g, '');
        $("#sub_tot_porc").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_incr_en").text((subto_prestfij-subtotal_prest_fijas2).toFixed(2));
        $("#sub_tot_inc_sob_cost_to_act").text((((subto_prestfij/subtotal_prest_fijas2)-1)*100).toFixed(2));
        $("#sub_tot_inc_sob_nomina").text(((subto_prestfij/fijoanual)*100).toFixed(2)); 
    }

    function prest_variables_propuesta(){////////////////////////prestaciones variables porcentae de propuesta change input
        var prest_variables_propuesta_ = $('#prest_variables_propuesta').val();
        var prest_variables_propuesta = prest_variables_propuesta_*0.01;
        // alert(fond_ahorro_prropuesta);
        var fijoanual = $("#fijo_anual_val").val();//--------------------------------------------------------------fijo anual
        var fijo_anual_2=$("#fijo_anual_2").text();
        var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//--------------------condicion con propuesta fijo anual
        var fijomvar=$("#fijo_a_mas_variable_a_val").val();//-----------------------------------------------------fijo mas variable
        var fon_aho_sal_fi_act_por_sub_fij_nual_ = $("#fon_aho_sal_fi_act_por_sub_fij_nual").text();
        var fon_aho_sal_fi_act_por_sub_fij_nual=fon_aho_sal_fi_act_por_sub_fij_nual_.substring(2).replace(/,/g, '');//
        var condi_prest_var = fijo_anual_22*prest_variables_propuesta;

        $("#condi_prest_var").text('$ '+addCommas(condi_prest_var.toFixed(2))); 
        $("#condi_prest_var_2").text('$ '+addCommas(condi_prest_var.toFixed(2))); 
        $("#variable_anual_2").text('$ '+addCommas(condi_prest_var.toFixed(2))); 
        var cond_act_pres_var_=$("#cond_act_pres_var").text();
        var cond_act_pres_var=cond_act_pres_var_.substring(2).replace(/,/g, '');//
        // alert(condi_prest_var);
        // alert(cond_act_pres_var);
        var porc_prest_variables=  ((condi_prest_var/cond_act_pres_var)-1)*100;
        // alert(porc_prest_variables);
        $("#porc_prest_variables").text(porc_prest_variables.toFixed(2)); 
        $("#porc_prest_variables_2").text(porc_prest_variables.toFixed(2)); 
        $("#propuesta_fijo_anual_2").text(porc_prest_variables.toFixed(2)); 
        
        var inc_en_prest_variables = condi_prest_var-cond_act_pres_var;
        $("#inc_en_prest_variables").text('$ '+ addCommas(inc_en_prest_variables.toFixed(2)));
        $("#inc_en_prest_variables_2").text('$ '+ addCommas(inc_en_prest_variables.toFixed(2)));
        $("#incre_en_sobre_costo_actual_2").text('$ '+ addCommas(inc_en_prest_variables.toFixed(2)));
        var incre_sobre_prest_variables = (inc_en_prest_variables/cond_act_pres_var)*100;
        $("#incre_sobre_prest_variables").text(incre_sobre_prest_variables.toFixed(2));
        $("#incre_sobre_prest_variables_2").text(incre_sobre_prest_variables.toFixed(2));
        $("#incre_sobre_cost_tot_act_2").text(incre_sobre_prest_variables.toFixed(2));

        var porc_increm_nom_actual_prest_variables = (condi_prest_var/fijoanual)*100;
        $("#porc_increm_nom_actual_prest_variables").text(porc_increm_nom_actual_prest_variables.toFixed(2));
        $("#porc_increm_nom_actual_prest_variables_2").text(porc_increm_nom_actual_prest_variables.toFixed(2));
        $("#porce_increm_nomi_actual_2").text(porc_increm_nom_actual_prest_variables.toFixed(2));

        var pro_sobr_cost_tot_prest_variables = (inc_en_prest_variables/fijoanual)*100;
        $("#pro_sobr_cost_tot_prest_variables").text(pro_sobr_cost_tot_prest_variables.toFixed(2));
        $("#pro_sobr_cost_tot_prest_variables_2").text(pro_sobr_cost_tot_prest_variables.toFixed(2));
        $("#prop_sobre_costo_total_CCT_2").text(pro_sobr_cost_tot_prest_variables.toFixed(2));
        
        var pro_sobr_cost_tot_mas_var_prest_variables = (inc_en_prest_variables/fijomvar)*100;
        $("#pro_sobr_cost_tot_mas_var_prest_variables").text(pro_sobr_cost_tot_mas_var_prest_variables.toFixed(2));
        $("#pro_sobr_cost_tot_mas_var_prest_variables_2").text(pro_sobr_cost_tot_mas_var_prest_variables.toFixed(2));
        $("#prop_sb_cost_fijomasvar_2").text(pro_sobr_cost_tot_mas_var_prest_variables.toFixed(2));
        // alert(fijo_anual_22);
        // alert(condi_prest_var);
        var suma_fijo_mas_var_2 = parseFloat(fijo_anual_22)+parseFloat(condi_prest_var);
        $("#fijo_a_mas_variable_a_2").text('$ '+addCommas(suma_fijo_mas_var_2.toFixed(2)));
        
        // $("#fijo_anual_2").text();
    }



    function CalcularTotales(){
        var fijoanual_ = $("#fijo_anual_val").val();//fijo anual
        var fijoanual = parseFloat(fijoanual_).toFixed(2);//--------------------------------------------------------------------------------
        $("#totalsalfijo").text('$ ' +addCommas(fijoanual));   
        var subtotal_prest_fijas_=$("#subtotal_prest_fijas").text();
        var subtotal_prest_fijas=subtotal_prest_fijas_.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual para la suma
        var cond_act_pres_var_2_=$("#cond_act_pres_var_2").text();
        var cond_act_pres_var_2=cond_act_pres_var_2_.substring(2).replace(/,/g, '');
        var d_9_=$("#D-9").text();
        var d_9=d_9_.substring(2).replace(/,/g, ''); 
        var pres_fijas_var_ben_suma_=parseFloat(subtotal_prest_fijas)+parseFloat(cond_act_pres_var_2)+parseFloat(d_9);
        var pres_fijas_var_ben_suma =parseFloat(pres_fijas_var_ben_suma_).toFixed(2);///------------------------------------------------------
        $("#pres_fijas_var_ben_suma").text('$ '+addCommas(pres_fijas_var_ben_suma)); 

        var total_carga_social_seg_social_2 = $("#total_carga_social_seg_social_2").text();
        var total_carga_social_seg_social_2_ = total_carga_social_seg_social_2.substring(2).replace(/,/g, '');//-----------------------------------------------------------------------------
        
        $("#car_soc_tot").text(total_carga_social_seg_social_2);
        var sumanom1 = parseFloat(fijoanual_)+parseFloat(pres_fijas_var_ben_suma_);
        var sumanom2 = (sumanom1+parseFloat(total_carga_social_seg_social_2_)).toFixed(2);
        $("#cost_nom_totales").text('$ '+addCommas(sumanom2));//-------------------------------------------------------------------------------

        var fijo_anual_2=$("#fijo_anual_2").text();
        var fijo_anual_22=fijo_anual_2.substring(2).replace(/,/g, '');//--------------------condicion con propuesta fijo anual
        $('#AT2-1').text(fijo_anual_2);

        var sub_tot_cond=$("#sub_tot_cond").text();
        var sub_tot_cond2=sub_tot_cond.substring(2).replace(/,/g, '');//-

        var condi_prest_var_2=$("#condi_prest_var_2").text();
        var condi_prest_var_22=condi_prest_var_2.substring(2).replace(/,/g, '');//-

        var f_9_=$("#F-9").text();
        var f_9=f_9_.substring(2).replace(/,/g, ''); 
        var cond_2_tot = parseFloat(sub_tot_cond2)+parseFloat(condi_prest_var_22);
        var cond_2_tot2 = (cond_2_tot+parseFloat(f_9)).toFixed(2);
        $("#AT2-2").text('$ '+addCommas(cond_2_tot2));
        
        var carga_soc_imp_seg_soc_2_=$("#carga_soc_imp_seg_soc_2").text();
        var carga_soc_imp_seg_soc_2=carga_soc_imp_seg_soc_2_.substring(2).replace(/,/g, ''); 
        $("#AT2-3").text('$ ' + addCommas(carga_soc_imp_seg_soc_2));

        var suma_cond= (parseFloat(fijo_anual_22)+parseFloat(cond_2_tot2));
        var suma_cond2tot= (parseFloat(suma_cond)+parseFloat(carga_soc_imp_seg_soc_2));

        $("#AT2-4").text('$ ' + addCommas(suma_cond2tot.toFixed(2)));

        $("#BT2-1").text((((fijo_anual_22/fijoanual)-1)*100).toFixed(2));
        $("#BT2-2").text((((cond_2_tot2/pres_fijas_var_ben_suma)-1)*100).toFixed(2));
        $("#BT2-3").text((((carga_soc_imp_seg_soc_2/total_carga_social_seg_social_2_)-1)*100).toFixed(2));
        $("#BT2-4").text((((suma_cond2tot/sumanom2)-1)*100).toFixed(2));

        $("#CT2-1").text(addCommas('$ ' + (fijo_anual_22-fijoanual).toFixed(2)));
        $("#CT2-2").text(addCommas('$ ' + (cond_2_tot2-pres_fijas_var_ben_suma).toFixed(2)));
        $("#CT2-3").text(addCommas('$ ' + (carga_soc_imp_seg_soc_2-total_carga_social_seg_social_2_).toFixed(2)));
        $("#CT2-4").text(addCommas('$ ' + (suma_cond2tot-sumanom2).toFixed(2)));

        var dt2_1= (((fijo_anual_22-fijoanual)-1)*100)/fijoanual;
        var dt2_2= (((cond_2_tot2-pres_fijas_var_ben_suma)-1)*100)/pres_fijas_var_ben_suma;
        var dt2_3= (((carga_soc_imp_seg_soc_2-total_carga_social_seg_social_2_)-1)*100)/total_carga_social_seg_social_2_;
        var dt2_4= (((suma_cond2tot-sumanom2)-1)*100)/sumanom2;

        $("#DT2-1").text(dt2_1.toFixed(2));
        $("#DT2-2").text(dt2_2.toFixed(2));
        $("#DT2-3").text(dt2_3.toFixed(2));
        $("#DT2-4").text(dt2_4.toFixed(2));

        $("#ET2-1").text(((fijo_anual_22/fijoanual)*100).toFixed(2));
        $("#ET2-2").text(((cond_2_tot2/fijoanual)*100).toFixed(2));
        $("#ET2-3").text(((carga_soc_imp_seg_soc_2/fijoanual)*100).toFixed(2));
        $("#ET2-4").text(((suma_cond2tot/fijoanual)*100).toFixed(2));

        $("#FT2-1").text((((fijo_anual_22-fijoanual)/fijoanual)*100).toFixed(2));
        $("#FT2-2").text((((cond_2_tot2-pres_fijas_var_ben_suma)/fijoanual)*100).toFixed(2));
        $("#FT2-3").text((((carga_soc_imp_seg_soc_2-total_carga_social_seg_social_2_)/fijoanual)*100).toFixed(2));
        $("#FT2-4").text((((suma_cond2tot-sumanom2)/fijoanual)*100).toFixed(2));

        var fijo_a_mas_variable_a_ = $("#fijo_a_mas_variable_a").text();
        var fijo_a_mas_variable_a=fijo_a_mas_variable_a_.substring(2).replace(/,/g, ''); 
        // CT2-1
        $("#GT2-1").text(((fijo_anual_22-fijoanual)/fijo_a_mas_variable_a).toFixed(2));
        $("#GT2-2").text(((cond_2_tot2-pres_fijas_var_ben_suma)/fijo_a_mas_variable_a).toFixed(2));
        $("#GT2-3").text(((carga_soc_imp_seg_soc_2-total_carga_social_seg_social_2_)/fijo_a_mas_variable_a).toFixed(2));
        $("#GT2-4").text(((suma_cond2tot-sumanom2)/fijo_a_mas_variable_a).toFixed(2));     
    }

    function TotalOtrosGastos(){
        var b1 = $("#BT3-1").val();
        var b2 = $("#BT3-2").val();
        var b3 = $("#BT3-3").val();
        var fijo_anual_val = $("#fijo_anual_val").val();
        var fijo_a_mas_variable_a_ =$("#fijo_a_mas_variable_a").text();
        var fijo_a_mas_variable_a=fijo_a_mas_variable_a_.substring(2).replace(/,/g, '');//fijo mas variavle
        var sumatotalesD = 0;
        if(b1!='' && b2!='' && b3!=''){
            var tot_cost_sindi_=parseFloat(b1)+parseFloat(b2);
            var tot_cost_sindi=tot_cost_sindi_+parseFloat(b3);//--------------------------------------
            $("#BT3-4").text('$ ' + addCommas(tot_cost_sindi.toFixed(2)));//
            var cost_nom_totales_ = $("#cost_nom_totales").text();
            var cost_nom_totales=cost_nom_totales_.substring(2).replace(/,/g, '');//condicion con propuesta fijo anual
            var suma_tot_3=parseFloat(cost_nom_totales)+tot_cost_sindi;
            $("#BT3-5").text('$ ' + addCommas(suma_tot_3.toFixed(2)));//

        }else{
            $("#BT3-4").text('0.00');//
        }
        ////////////////////////////////////////////
        if(b1!=""){
            var prop_neg_ = $("#prop_neg").val();
            var prop_neg = prop_neg_*0.01;
            var pago_sind_x_rev_cct=b1*prop_neg;
            // var pago_sind_x_rev_cct=b1*pago_sind_x_rev_cct_;
            var bt4_1=parseFloat(pago_sind_x_rev_cct)+parseFloat(b1);
            $("#BT4-1").text('$ ' + addCommas(bt4_1.toFixed(2)));
            $("#CT4-1").text((((bt4_1/b1)-1)*100).toFixed(2));
            var dt4_1=(bt4_1-b1).toFixed(2)
            $("#DT4-1").text('$ '+ addCommas(dt4_1));
            $("#ET4-1").text(((dt4_1/b1)*100).toFixed(2));
            $("#FT4-1").text(((bt4_1/fijo_anual_val)*100).toFixed(2));
            $("#GT4-1").text(((dt4_1/fijo_anual_val)*100).toFixed(2));
            $("#HT4-1").text(((dt4_1/fijo_a_mas_variable_a)).toFixed(5));   
            
            var bt4_1_ = $("#BT4-1").text();
            var bt4_1=bt4_1_.substring(2).replace(/,/g, '');
            var bt4_2_ = $("#BT4-2").text();
            var bt4_2=bt4_2_.substring(2).replace(/,/g, '');
            var bt4_3_ = $("#BT4-3").text();
            var bt4_3=bt4_3_.substring(2).replace(/,/g, '');
            var suma_cost_sind_tot_4_ = parseFloat(bt4_1)+parseFloat(bt4_2);
            var suma_cost_sind_tot_4 = suma_cost_sind_tot_4_+parseFloat(bt4_3);
            if(bt4_1_!="" && bt4_2_!="" && bt4_3_!=""){
                var bt4_4 = $("#BT4-4").text('$ ' +addCommas(suma_cost_sind_tot_4.toFixed(2)));  
                var ct4_4=((suma_cost_sind_tot_4/tot_cost_sindi)-1)*100;
                $("#CT4-4").text(ct4_4.toFixed(2))
                var dt4_1_=$("#DT4-1").text();
                var dt4_1=dt4_1_.substring(2).replace(/,/g, '');//------------
                var dt4_2_= $("#DT4-2").text();
                var dt4_2 = dt4_2_.substring(2).replace(/,/g, '');
                var dt4_3_= $("#DT4-3").text();
                var dt4_3 = dt4_3_.substring(2).replace(/,/g, '');
               var dt4_4_= parseFloat(dt4_1)+parseFloat(dt4_2);
               var dt4_4 = dt4_4_+parseFloat(dt4_3);
               $("#DT4-4").text('$ ' + addCommas(dt4_4.toFixed(2)));
               $("#ET4-4").text(((dt4_4/tot_cost_sindi)*100).toFixed(2));
               $("#FT4-4").text(((suma_cost_sind_tot_4/fijo_anual_val)*100).toFixed(2));
               $("#GT4-4").text(((dt4_4/fijo_anual_val)*100).toFixed(2));
               $("#HT4-4").text((dt4_4/fijo_a_mas_variable_a).toFixed(5));
               var at2_4_ = $("#AT2-4").text();
               var at2_4 = at2_4_.substring(2).replace(/,/g, '');
               var bt4_5 = (suma_cost_sind_tot_4+parseFloat(at2_4));
               $("#BT4-5").text('$ '+ addCommas(bt4_5.toFixed(2)));
               var ct4_5 = (bt4_5/suma_tot_3)*100;
               $("#CT4-5").text('$ '+ addCommas(ct4_5.toFixed(2)));
               var ct2_4_ = $("#CT2-4").text();
               var ct2_4 = ct2_4_.substring(2).replace(/,/g, '');
               var dt4_5 = (parseFloat(ct2_4)+dt4_4);
               $("#DT4-5").text('$ '+ addCommas(dt4_5.toFixed(2)));
               $("#ET4-5").text((dt4_5/suma_tot_3).toFixed(2));
               var ft4_5 = ((ct4_5.toFixed(2)*0.01)/bt4_5).toFixed(2);
               $("#FT4-5").text(ft4_5);
               $("#GT4-5").text(((dt4_5/fijo_anual_val)*100).toFixed(2));
               $("#HT4-5").text((dt4_5/fijo_a_mas_variable_a).toFixed(2));
            }
            
              
        }
        if(b2!=""){
            var prop_neg_ = $("#prop_neg").val();
            var prop_neg = prop_neg_*0.01;
            var pago_sind_x_rev_cct=b2*prop_neg;
            // var pago_sind_x_rev_cct=b1*pago_sind_x_rev_cct_;
            var bt4_2=parseFloat(pago_sind_x_rev_cct)+parseFloat(b2);
            $("#BT4-2").text('$ ' + addCommas(bt4_2.toFixed(2)));
            $("#CT4-2").text((((bt4_2/b2)-1)*100).toFixed(2));
            var dt4_2=(bt4_2-b2).toFixed(2)
            $("#DT4-2").text('$ '+ addCommas(dt4_2));
            $("#ET4-2").text(((dt4_2/b2)*100).toFixed(2));
            $("#FT4-2").text(((bt4_2/fijo_anual_val)*100).toFixed(2));
            $("#GT4-2").text(((dt4_2/fijo_anual_val)*100).toFixed(2));
            $("#HT4-2").text(((dt4_2/fijo_a_mas_variable_a)).toFixed(5));

            var bt4_1_ = $("#BT4-1").text();
            var bt4_1=bt4_1_.substring(2).replace(/,/g, '');
            var bt4_2_ = $("#BT4-2").text();
            var bt4_2=bt4_2_.substring(2).replace(/,/g, '');
            var bt4_3_ = $("#BT4-3").text();
            var bt4_3=bt4_3_.substring(2).replace(/,/g, '');
            var suma_cost_sind_tot_4_ = parseFloat(bt4_1)+parseFloat(bt4_2);
            var suma_cost_sind_tot_4 = suma_cost_sind_tot_4_+parseFloat(bt4_3);
            if(bt4_1_!="" && bt4_2_!="" && bt4_3_!=""){
                var bt4_4 = $("#BT4-4").text('$ ' +addCommas(suma_cost_sind_tot_4.toFixed(2))); 
                var ct4_4=((suma_cost_sind_tot_4/tot_cost_sindi)-1)*100;
                $("#CT4-4").text(ct4_4.toFixed(2))
                var dt4_1_=$("#DT4-1").text();
                var dt4_1=dt4_1_.substring(2).replace(/,/g, '');//------------
                var dt4_2_= $("#DT4-2").text();
                var dt4_2 = dt4_2_.substring(2).replace(/,/g, '');
                var dt4_3_= $("#DT4-3").text();
                var dt4_3 = dt4_3_.substring(2).replace(/,/g, '');
               var dt4_4_= parseFloat(dt4_1)+parseFloat(dt4_2);
               var dt4_4 = dt4_4_+parseFloat(dt4_3);
               $("#DT4-4").text('$ ' + addCommas(dt4_4.toFixed(2)));
               $("#ET4-4").text(((dt4_4/tot_cost_sindi)*100).toFixed(2));
               $("#FT4-4").text(((suma_cost_sind_tot_4/fijo_anual_val)*100).toFixed(2));
               $("#GT4-4").text(((dt4_4/fijo_anual_val)*100).toFixed(2));
               $("#HT4-4").text((dt4_4/fijo_a_mas_variable_a).toFixed(5));
               var at2_4_ = $("#AT2-4").text();
               var at2_4 = at2_4_.substring(2).replace(/,/g, '');
               var bt4_5 = (suma_cost_sind_tot_4+parseFloat(at2_4));
               $("#BT4-5").text('$ '+ addCommas(bt4_5.toFixed(2)));
               var ct4_5 = (bt4_5/suma_tot_3)*100;
               $("#CT4-5").text('$ '+ addCommas(ct4_5.toFixed(2)));
               var ct2_4_ = $("#CT2-4").text();
               var ct2_4 = ct2_4_.substring(2).replace(/,/g, '');
               var dt4_5 = (parseFloat(ct2_4)+dt4_4);
               $("#DT4-5").text('$ '+ addCommas(dt4_5.toFixed(2)));
               $("#ET4-5").text((dt4_5/suma_tot_3).toFixed(2));
               var ft4_5 = ((ct4_5.toFixed(2)*0.01)/bt4_5).toFixed(2);
               $("#FT4-5").text(ft4_5);
               $("#GT4-5").text(((dt4_5/fijo_anual_val)*100).toFixed(2));
               $("#HT4-5").text((dt4_5/fijo_a_mas_variable_a).toFixed(2)); 
            }  

            
        }
        if(b3!=""){
            var prop_neg_ = $("#prop_neg").val();
            var prop_neg = prop_neg_*0.01;
            var pago_sind_x_rev_cct=b3*prop_neg;
            // var pago_sind_x_rev_cct=b1*pago_sind_x_rev_cct_;
            var bt4_3=parseFloat(pago_sind_x_rev_cct)+parseFloat(b3);
            $("#BT4-3").text('$ ' + addCommas(bt4_3.toFixed(2)));
            $("#CT4-3").text((((bt4_3/b3)-1)*100).toFixed(2));
            var dt4_3=(bt4_3-b3).toFixed(2)
            $("#DT4-3").text('$ '+ addCommas(dt4_3));
            $("#ET4-3").text(((dt4_3/b3)*100).toFixed(2));
            $("#FT4-3").text(((bt4_3/fijo_anual_val)*100).toFixed(2));
            $("#GT4-3").text(((dt4_3/fijo_anual_val)*100).toFixed(2));
            $("#HT4-3").text(((dt4_3/fijo_a_mas_variable_a)).toFixed(5));

            var bt4_1_ = $("#BT4-1").text();
            var bt4_1=bt4_1_.substring(2).replace(/,/g, '');
            var bt4_2_ = $("#BT4-2").text();
            var bt4_2=bt4_2_.substring(2).replace(/,/g, '');
            var bt4_3_ = $("#BT4-3").text();
            var bt4_3=bt4_3_.substring(2).replace(/,/g, '');
            var suma_cost_sind_tot_4_ = parseFloat(bt4_1)+parseFloat(bt4_2);
            var suma_cost_sind_tot_4 = suma_cost_sind_tot_4_+parseFloat(bt4_3);
            if(bt4_1_!="" && bt4_2_!="" && bt4_3_!=""){
                var bt4_4 = $("#BT4-4").text('$ ' +addCommas(suma_cost_sind_tot_4.toFixed(2)));
                var ct4_4=((suma_cost_sind_tot_4/tot_cost_sindi)-1)*100;
                $("#CT4-4").text(ct4_4.toFixed(2))
                var dt4_1_=$("#DT4-1").text();
                var dt4_1=dt4_1_.substring(2).replace(/,/g, '');//------------
                var dt4_2_= $("#DT4-2").text();
                var dt4_2 = dt4_2_.substring(2).replace(/,/g, '');
                var dt4_3_= $("#DT4-3").text();
                var dt4_3 = dt4_3_.substring(2).replace(/,/g, '');
               var dt4_4_= parseFloat(dt4_1)+parseFloat(dt4_2);
               var dt4_4 = dt4_4_+parseFloat(dt4_3);
               $("#DT4-4").text('$ ' + addCommas(dt4_4.toFixed(2)));
               $("#ET4-4").text(((dt4_4/tot_cost_sindi)*100).toFixed(2));
               $("#FT4-4").text(((suma_cost_sind_tot_4/fijo_anual_val)*100).toFixed(2));
               $("#GT4-4").text(((dt4_4/fijo_anual_val)*100).toFixed(2));
               $("#HT4-4").text((dt4_4/fijo_a_mas_variable_a).toFixed(5));
               var at2_4_ = $("#AT2-4").text();
               var at2_4 = at2_4_.substring(2).replace(/,/g, '');
               var bt4_5 = (suma_cost_sind_tot_4+parseFloat(at2_4));
               $("#BT4-5").text('$ '+ addCommas(bt4_5.toFixed(2)));
               var ct4_5 = (bt4_5/suma_tot_3)*100;
               $("#CT4-5").text('$ '+ addCommas(ct4_5.toFixed(2)));
               var ct2_4_ = $("#CT2-4").text();
               var ct2_4 = ct2_4_.substring(2).replace(/,/g, '');
               var dt4_5 = (parseFloat(ct2_4)+dt4_4);
               $("#DT4-5").text('$ '+ addCommas(dt4_5.toFixed(2)));
               $("#ET4-5").text((dt4_5/suma_tot_3).toFixed(2));
               var ft4_5 = ((ct4_5.toFixed(2)*0.01)/bt4_5).toFixed(2);
               $("#FT4-5").text(ft4_5);
               $("#GT4-5").text(((dt4_5/fijo_anual_val)*100).toFixed(2));
               $("#HT4-5").text((dt4_5/fijo_a_mas_variable_a).toFixed(2));  
            } 

            
        }

    }

</script>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
// $('.tabladata').DataTable();

    // --------------------------------------------------------------------------------------------------------------------------------//
    // $('#BuscarPlantilla').click(function(event) {//buscar la subdivision de personal
</script>
