<?php
require_once "conexion.php";
class ModeloDemandas
{

    static public function  mdlVPs()
    {
        conexion::conectar();
        $query="SELECT * FROM Vicepresidencias";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }
    static public function  mdlSociedades()
    {
        conexion::conectar();
        $query="SELECT * FROM Sociedades";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }
    static public function  mdlMonedas()
    {
        conexion::conectar();
        $query="SELECT * FROM MonedasValor";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static public function  mdlMonedaxPais($pais)
    {
        conexion::conectar();
        $query="SELECT * FROM MonedasValor where pais like '%".$pais."%'";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static public function  mdlDemandasInternasxPais($pais,$divisionesDisponibles)
    {
        conexion::conectar();
        if ($divisionesDisponibles=="ALL")
        {
            $query="SELECT D.id,E.nombre,D.num_empleado,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN,D.contingencia_inicial_local,D.contingencia_abogados_local,D.contingencia_inicial_MXN,D.contingencia_abogados_MXN,D.id_moneda,D.riesgo,D.fecha_baja,D.antiguedad,D.motivo_salida,D.CECO,E.fecha_ingreso
                FROM Demandas as D,Empleados as E,Divisiones as Div,Vicepresidencias as V,Areas as A
                where D.num_empleado=E.num_empleado and E.cod_division=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.pais like '%".$pais."%' order by id desc";


        }
        else
        {
             $query="SELECT D.id,E.nombre,D.num_empleado,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN,D.contingencia_inicial_local,D.contingencia_abogados_local,D.contingencia_inicial_MXN,D.contingencia_abogados_MXN,D.id_moneda,D.riesgo,D.fecha_baja,D.antiguedad,D.motivo_salida,D.CECO,E.fecha_ingreso
            FROM Demandas as D,Empleados as E,Divisiones as Div,Vicepresidencias as V,Areas as A
            where D.num_empleado=E.num_empleado and E.cod_division=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.cod_division in (".$divisionesDisponibles.") order by id desc";


        }

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static public function  mdlDemandasExternasxPais($pais,$divisionesDisponibles)
    {
        conexion::conectar();
        if ($divisionesDisponibles=="ALL")
        {


//$query="SELECT D.id,S.sindicato,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN,D.nombre
//FROM Demandas as D,Sindicatos as S,Divisiones as Div,Vicepresidencias as V,Areas as A
//where D.id_proveedor=S.id_proveedor and S.cod_division=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.pais like '%".$pais."%'";

             $query="SELECT D.id,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN,D.nombre,D.proveedor_externo,D.contingencia_inicial_local,D.contingencia_abogados_local,D.contingencia_inicial_MXN,D.contingencia_abogados_MXN,D.id_moneda ,D.riesgo,D.fecha_baja,D.antiguedad,D.motivo_salida,D.CECO
        FROM Demandas as D,Divisiones as Div,Vicepresidencias as V,Areas as A
        where D.localidad_externa=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.pais like '%".$pais."%' order by id desc";

        }
        else
        {
              $query="SELECT D.id,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN,D.nombre,D.proveedor_externo,D.contingencia_inicial_local,D.contingencia_abogados_local,D.contingencia_inicial_MXN,D.contingencia_abogados_MXN,D.id_moneda,D.riesgo,D.fecha_baja,D.antiguedad,D.motivo_salida,D.CECO    
        FROM Demandas as D,Divisiones as Div,Vicepresidencias as V,Areas as A
        where D.localidad_externa=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.cod_division in (".$divisionesDisponibles.") order by id desc";
        }
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static public function  mdlAreasPorVPs($datos)
    {
//        print_r($datos);
        conexion::conectar();
        $query="SELECT * FROM VP_Areas as VPA, Areas as A  where VPA.id_area=A.id and id_vicepresidencia=".$datos['idVP'];

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static public function mdlGuardarDemanda($datos)
    {

//        echo "mdl";
//        print_r($datos);

         conexion::conectar();
        $fechaHoy=date('Y-m-d');

           $query = "insert into Demandas(num_empleado,fecha_recepcion,tipo_empleado,fecha_baja,antiguedad,motivo_salida,id_vp,id_area,contingencia_inicial_local,contingencia_abogados_local,contingencia_inicial_MXN,contingencia_abogados_MXN,riesgo,id_sociedad,CECO,estatus,id_moneda,provision_local,provision_mxn)values(".$datos['num_EmpleadoActive'].",'".$fechaHoy."','".$datos['tipoEmp']."','".$datos['fechaBaja']."',".$datos['antiguedad'].",'".$datos['motivoSalida']."',".$datos['vp'].",".$datos['area'].",".$datos['CIML'].",".$datos['CAML'].",".round($datos['CIMXN'],2).",".round($datos['CAMXN'],2).",'".$datos['riesgo']."',".$datos['sociedad'].",'".$datos['CECO']."','".$datos['descripcion']."',".$datos['moneda'].",".round($datos['PDML'],2).",".round($datos['PDMXN'],2).")";
//            mssql_query($query);
//        echo mssql_query($query);
        if(mssql_query($query))
        {
            return "ok";
        }else
        {
            return "error";
        }


    }

    static public function mdlCerrarDemanda($datos)
    {
//            echo "mdl<pre>";
//            print_r($datos);
//            echo "</pre>";
        conexion::conectar();
         $query="UPDATE Demandas SET fecha_cierre='".$datos['fechaCierre']."',cierre_bruto_local=".$datos['ICBML'].",cierre_neto_local=".$datos['ICNML'].",cierre_bruto_MXN=".round($datos['ICBMXN'], 2).",cierre_neto_MXN=".round($datos['ICNMXN'], 2)." WHERE id=".$datos['demandaID'];

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }

    static public function mdlGuardarEdicion($datos)
    {
//            echo "mdl<pre>";
//            print_r($datos);
//            echo "</pre>";
        conexion::conectar();
         $query="UPDATE Demandas SET estatus='".$datos['descripcionEdit']."',contingencia_inicial_local=".$datos['CIML'].",contingencia_abogados_local=".$datos['CAML'].",contingencia_inicial_MXN=".round($datos['CIMXN'], 2).",contingencia_abogados_MXN=".round($datos['CAMXN'], 2).",id_moneda=".$datos['monedaEdit']." WHERE id=".$datos['demandaID'];

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }

    static public function mdlGuardarDemandaExterna($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
        $fechaHoy=date('Y-m-d');

         $query = "insert into Demandas(proveedor_externo,localidad_externa,nombre,fecha_recepcion,tipo_empleado,fecha_baja,antiguedad,motivo_salida,id_vp,id_area,contingencia_inicial_local,contingencia_abogados_local,contingencia_inicial_MXN,contingencia_abogados_MXN,riesgo,id_sociedad,CECO,estatus,id_moneda,provision_local,provision_mxn)values('".$datos['proveedor']."','".$datos['localidad']."','".$datos['nombre']."','".$fechaHoy."','".$datos['tipoEmp']."','".$datos['fechaBaja']."',".$datos['antiguedad'].",'".$datos['motivoSalida']."',".$datos['vp'].",".$datos['area'].",".$datos['CIML'].",".$datos['CAML'].",".round($datos['CIMXN'],2).",".round($datos['CAMXN'],2).",'".$datos['riesgo']."',".$datos['sociedad'].",'".$datos['CECO']."','".$datos['descripcion']."',".$datos['moneda'].",".round($datos['PDML'],2).",".round($datos['PDMXN'],2).")";
//            mssql_query($query);
//        echo mssql_query($query);
        if(mssql_query($query))
        {
            return "ok";
        }else
        {
            return "error";
        }


    }

    static public function mdlIngresarArchivosDemandas($tabla3,$idDemanda,$idArchivo)
    {

        conexion::conectar();
        $query = "insert into ".$tabla3." (id_archivo,id_demanda)values('".$idArchivo."','".$idDemanda."')";
//            mssql_query($query);
        if(mssql_query($query)){
            //regrear id de guardado de la minuta
            return "ok";
        }else{
            return "error";
        }
    }

    static public function mdlMostrarHistorialArchivosxDemanda($id)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2= "SELECT A.id as idAr,A.archivo,A.nombre,A.id_usuario,U.num_empleado,U.usuario,A.fecha_alta
                    FROM Demandas as D,ArchivosDemandas as AD,Archivos as A,Usuarios as U
                    WHERE  AD.id_demanda=D.id and AD.id_archivo=A.id and AD.id_demanda='".$id."' and A.id_tipo=15 and A.id_usuario=U.id ";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlReportesDemandaAbogados($tabla3,$idArchivo,$codDivision,$idUsuario,$comentario)
    {

        conexion::conectar();
        // echo $codDivision;
        $codDiv = $codDivision;
        if($codDiv!=''){
            $array = explode(",", $codDiv);
            foreach ($array as $value) {//serecorren los arregl
                // echo $value.'<br>';
                // if ($value === end($array)) {
                //     // return "ok";
                //     $ok1 = 'ok';
                // }else{

                    $query = "insert into ".$tabla3." (id_archivo,cod_division,id_usuario,comentario)values(".$idArchivo.",'".$value."',".$idUsuario.",'".$comentario."')";
                    mssql_query($query);
                // }

            }
            return "ok";
        }
//           $query = "insert into ".$tabla3." (id_archivo,cod_division,id_usuario,comentario)values(".$idArchivo.",'".$codDivision."',".$idUsuario.",'".$comentario."')";
// //            mssql_query($query);
//         if(mssql_query($query)){
//             //regrear id de guardado de la minuta
//             return "ok";
//         }else{
//             return "error";
//         }
    }

    static public function  mdlVisualizarReportes($divisionesDisponibles)
    {
        if ($divisionesDisponibles=="ALL")
        {
            conexion::conectar();
            $query="SELECT AR.id as IDARCHIVO, AR.archivo,AR.nombre as NOMBREARCHIVO,CONVERT(char(17),AR.fecha_alta,103) as fecha_alta,Div.division,U.num_empleado,U.usuario,RDA.comentario
                    FROM ReportesDemandaAbogados as RDA,Archivos as AR,Divisiones as Div,Usuarios as U
                    where RDA.id_archivo=AR.id and RDA.cod_division=Div.cod_division and RDA.id_usuario=U.id order by AR.fecha_alta desc";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
        }
        else
        {
            conexion::conectar();
             $query="SELECT AR.id as IDARCHIVO, AR.archivo,AR.nombre as NOMBREARCHIVO,AR.fecha_alta,Div.division,U.num_empleado,U.usuario
                    FROM ReportesDemandaAbogados as RDA,Archivos as AR,Divisiones as Div,Usuarios as U
                    where RDA.id_archivo=AR.id and RDA.cod_division=Div.cod_division and RDA.id_usuario=U.id and Div.cod_division in (".$divisionesDisponibles.")";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
        }



    }



}