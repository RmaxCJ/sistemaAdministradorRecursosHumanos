<?php
require_once "conexion.php";
class ModeloValuaciones
{
    static public function mdlMostrarValuaciones()
    {
        conexion::conectar();
        $query="select V.*, D.cod_division, D.division from Valuaciones V, Divisiones D where V.cod_division=D.cod_division";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlIngresarArchivosCCT($tabla2,$datos2)
    {

        conexion::conectar();
        $query = "insert into ".$tabla2." (id_tipo,anio,nombre,archivo,id_usuario,fecha_alta)values(".$datos2['id_tipo'].",'".$datos2['anio']."','".$datos2['nombre']."','".$datos2['archivo']."',".$datos2['id_usuario'].",'".$datos2['fecha_alta']."')";

        if(mssql_query($query)){

            $query2     ="SELECT MAX(id) AS id FROM Archivos";
            $sql = mssql_query($query2);
            while($rs = mssql_fetch_object($sql))
            {
                $id[] = $rs;
            }
            return $id;
        }
        else{
            return "error";
        }
    }

    static public function mdlMostrarValuacionesDivision()
    {
        conexion::conectar();
        $query="SELECT DISTINCT PV.cod_division, D.cod_division AS cod_div, D.division 
        FROM PlantillaValuacion PV, Divisiones D
         WHERE  PV.cod_division=D.cod_division";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static public function mdlBuscarDivisionPersonal($tabla, $datos)
    {
        conexion::conectar();
         $query="select DISTINCT PV.subdivision, PV.cod_division 
        from PlantillaValuacion AS PV 
        where cod_division='".$datos['cod_division']."'";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlBuscarBeneficios($tabla, $id_valuacion)
    {
        conexion::conectar();
         $query="select * from BeneficiosValuaciones where id_valuacion=".$id_valuacion."";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlBuscarDatos($tabla, $datos)
    {
        conexion::conectar();
        //  $query="select PV.* 
        //  from PlantillaValuacion AS PV 
        //  where PV.subdivision='".$datos['subdivision']."'";

        //  $query="select PV.nombre_posicion, sum(PV.salario_base_ref_diaria) as sal_diarioXno_emp, sum(PV.sbc) as sbc,  count(id) no_empleado, 
        //  sum(PV.dias_aguinaldo) as dias_aguinaldo, sum(PV.bono_productividad) as bono_productividad, sum(PV.prima_vacacional_actual) as prima_vacacional_actual, 
        //  sum(PV.vacaciones_dias_actual) as vacaciones_dias_actual, sum(PV.fondo_ahorro_actual) as fondo_ahorro_actual, sum(PV.total_carga) as total_carga
        //  from PlantillaValuacion AS PV 
        //  where PV.subdivision ='".$datos['subdivision']."' group by PV.nombre_posicion";

         $query="select PV.categoria, RTRIM(PV.nombre_posicion) as nombre_posicion, avg(PV.salario_base_ref_diaria) as sal_diarioXno_emp, avg(PV.sbc) as sbc,  count(id) no_empleado, sum(PV.dias_aguinaldo) as dias_aguinaldo, 
         avg(isnull(PV.bono_productividad, 0)) as bono_productividad, avg(PV.prima_vacacional_actual) as prima_vacacional_actual, sum(PV.vacaciones_dias_actual) as vacaciones_dias_actual, avg(PV.fondo_ahorro_actual) as fondo_ahorro_actual, avg(PV.total_carga) as total_carga, PV.cod_division, PV.anio
         from PlantillaValuacion AS PV
         where anio=".$datos['anio']." and PV.cod_division='".$datos['cod_division']."' and PV.subdivision ='".$datos['subdivision']."' 
         group by PV.nombre_posicion,PV.cod_division,PV.categoria,anio
         union
         select categoria,RTRIM(nombre_posicion) as nombre_posicion, salario_base, 0 as sbc, 0 as no_empleado, 0 as dias_aguinaldo, 0 as bono_productividad, 0 as prima_vacacional_actual, 0 as vacaciones_dias_actual, 0 as fondo_ahorro_actual, 
         0 as total_carga, cod_division,  anio
         from Tabuladores
         where cod_division='".$datos['cod_division']."' and anio=".$datos['anio']." and nombre_posicion not in (select nombre_posicion from PlantillaValuacion
         where anio=2020 and cod_division='".$datos['cod_division']."' and subdivision ='".$datos['subdivision']."')
         order by 1,2";
        
        //  $query="select PV.categoria, PV.nombre_posicion, sum(PV.salario_base_ref_diaria) as sal_diarioXno_emp, sum(PV.sbc) as sbc,  count(id) no_empleado, sum(PV.dias_aguinaldo) as dias_aguinaldo, 
        //  sum(PV.bono_productividad) as bono_productividad, sum(PV.prima_vacacional_actual) as prima_vacacional_actual, sum(PV.vacaciones_dias_actual) as vacaciones_dias_actual, sum(PV.fondo_ahorro_actual) as fondo_ahorro_actual, sum(PV.total_carga) as total_carga, PV.cod_division, PV.anio
        //  from PlantillaValuacion AS PV
        //  where anio=".$datos['anio']." and PV.cod_division='".$datos['cod_division']."' and PV.subdivision ='".$datos['subdivision']."' 
        //  group by PV.nombre_posicion,PV.cod_division,PV.categoria,anio
        //  union
        //  select categoria, nombre_posicion, salario_base, 0 as sbc, 0 as no_empleado, 0 as dias_aguinaldo, 0 as bono_productividad, 0 as prima_vacacional_actual, 0 as vacaciones_dias_actual, 0 as fondo_ahorro_actual, 
        //  0 as total_carga, cod_division,  anio
        //  from Tabuladores
        //  where cod_division='".$datos['cod_division']."' and anio=".$datos['anio']." and nombre_posicion not in (select nombre_posicion from PlantillaValuacion
        //  where anio=2020 and cod_division='".$datos['cod_division']."' and subdivision ='".$datos['subdivision']."')
        //  order by 1,2";
        

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlGuardarArchivoCCTSindicato($idArchivo,$sindicatoID)
    {

        //echo "mdl";
        //print_r($datos);
        conexion::conectar();

        $query = "insert into ArchivoCCT (id_archivo,id_sindicato)values($idArchivo,$sindicatoID)";
        //    mssql_query($query);

        if(mssql_query($query)){
            return "ok";
        }else{
            return "error";
        }


    }

    static public function mdlIngresarValuacion($tabla,$datos)
    {			
        conexion::conectar();
          $query = "insert into ".$tabla." 
         (cod_division,subdivision,anio,prop_neg,prest_fijas_agui_sal_fijo, prest_fijas_prima_vac_sal_fijo, prest_fijas_fond_ahorro_sal_fijo, prest_var_bono_prod, otros_gastos_rev_cct, otros_gastos_iguala_sind, otros_gastos_fom_dep_bolsas,fecha_alta)
         values
         ('".$datos['cod_division']."','".$datos['subdivision']."',".$datos['anio'].",".$datos['prop_neg'].",".$datos['prest_fijas_agui_sal_fijo'].",".$datos['prest_fijas_prima_vac_sal_fijo'].",".$datos['prest_fijas_fond_ahorro_sal_fijo'].",".$datos['prest_var_bono_prod'].",".$datos['otros_gastos_rev_cct'].",".$datos['otros_gastos_iguala_sind'].",".$datos['otros_gastos_fom_dep_bolsas'].",'".$datos['fecha_alta']."')";
        //    mssql_query($query);
        if(mssql_query($query)){
            $query2     ="SELECT MAX(id) AS id FROM  Valuaciones";
            $sql = mssql_query($query2);
            while($rs = mssql_fetch_object($sql))
            {
                 $id[] = $rs;
            }
            return $id;
        }
        else{
            return "error";
        }
    }
    static public function mdlIngresarBeneficiosValuacion($tabla2,$id,$datos)
    {			
        conexion::conectar();
        $arrayBene = $datos['arrayBeneficios'];//variable creada con jquery con arreglos de acuerdos 
        $array = explode("~", $arrayBene);//separando por tilde para poder leer los arreglos que vengan
        foreach ($array as $value) {//serecorren los arreglos
            // mssql_query($query);
            if ($value === end($array)) {
                // echo "ÚLTIMO ELEMENTO";
                return "ok";
                // $ok1 = 'ok';
            }else{
                // return "error";
                // echo "$value <br>";
                $array2 = explode("/", $value);
                $id_beneficio             = $array2[0]; // primer arreglo
                $no_trabajadores          = $array2[1]; // segundo arreglo
                $monto_x_colaborador      = $array2[2]; // segundo arreglo
                $prop_monto_x_colaborador = $array2[3]; // segundo arreglo
                $query = "insert into ".$tabla2." (id_valuacion,id_beneficio,no_trabajadores,monto_x_colaborador,prop_monto_x_colaborador)values('".$id."','".$id_beneficio."','".$no_trabajadores."','".$monto_x_colaborador."','".$prop_monto_x_colaborador."')";
                mssql_query($query);
            }
        }
    }



}