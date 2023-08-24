<?php
require_once "conexion.php";
class ModeloRevisiones
{



    static public function  mdlDemandasInternasxPais($pais)
    {
        conexion::conectar();
        $query="SELECT D.id,E.nombre,D.num_empleado,Div.pais,D.estatus,V.nombre_vicepresidencia,A.nombre_area,D.fecha_cierre,D.cierre_bruto_local,D.cierre_neto_local,D.cierre_bruto_MXN,D.cierre_neto_MXN
FROM Demandas as D,Empleados as E,Divisiones as Div,Vicepresidencias as V,Areas as A
where D.num_empleado=E.num_empleado and E.cod_division=Div.cod_division and D.id_vp=V.id and D.id_area=A.id and Div.pais like '%".$pais."%'";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }

    static  public  function mdlMostrarRevisiones($divisiones)
    {
//        echo $divisiones;

        if ($divisiones=='ALL')
        {
            $query="SELECT R.id,R.num_empleado,R.inicio_revision,R.fin_revision,R.motivo,R.fecha_pago_multa,R.monto,R.montoMXN,R.tipo_revision,R.region,R.area_revisada,R.defensa,R.resultado,R.observaciones,R.distintivo,R.realizoPago,R.estatus,E.nombre,D.division,D.pais,MV.nombre_moneda,MV.diferencia_mxn,MV.signo,E.posicion
 FROM Revisiones as R,Empleados as E,Divisiones as D,MonedasValor as MV
                WHERE  R.num_empleado=E.num_empleado and E.cod_division=D.cod_division and R.id_moneda=MV.id order by R.id desc";

        }
        else
        {
            $query="SELECT R.id,R.num_empleado,R.inicio_revision,R.fin_revision,R.motivo,R.fecha_pago_multa,R.monto,R.montoMXN,R.tipo_revision,R.region,R.area_revisada,R.defensa,R.resultado,R.observaciones,R.distintivo,R.realizoPago,R.estatus,E.nombre,D.division,D.pais,MV.nombre_moneda,MV.diferencia_mxn,MV.signo,E.posicion
                 FROM Revisiones as R,Empleados as E,Divisiones as D,MonedasValor as MV
                                WHERE  R.num_empleado=E.num_empleado and E.cod_division=D.cod_division and R.id_moneda=MV.id and D.cod_division in (".$divisiones.") order by R.id desc";

        }
        conexion::conectar();

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }

        return $result;
    }

    static public function mdlGuardarRevision($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
          $query = "insert into Revisiones(num_empleado, inicio_revision, fin_revision, motivo, fecha_pago_multa, monto, montoMXN, id_moneda, tipo_revision, region, area_revisada, defensa, resultado, observaciones, distintivo, realizoPago,estatus)values(".$datos['num_EmpleadoActive'].",'".$datos['inicioRevision']."','".$datos['terminoRevision']."','".$datos['motivo']."','".$datos['fechaPagoMulta']."',".$datos['monto'].",".$datos['montoMXN'].",".$datos['moneda'].",'".$datos['tipoRev']."','".$datos['region']."','".$datos['areaRevisada']."','".$datos['medios']."','".$datos['resultado']."','".$datos['observaciones']."','".$datos['Distintivo']."','".$datos['multa']."','".$datos['estatus']."')";
//            mssql_query($query);
//        echo mssql_query($query);
//        exit();
        if(mssql_query($query))
        {
            return "ok";
        }else
        {
            return "error";
        }


    }

    static public function mdlArchivosRevisiones($tabla3,$idArchivo,$idRevision)
    {

        conexion::conectar();
         $query = "insert into ".$tabla3." (id_archivo,id_revision)values(".$idArchivo.",".$idRevision.")";
//            mssql_query($query);
        if(mssql_query($query)){
            //regrear id de guardado de la minuta
            return "ok";
        }else{
            return "error";
        }
    }

    static public function ctrMostrarHistorialArchivosxRevision($id)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

          $query2= "SELECT * FROM ArchivosRevisiones AR,Archivos as A,Usuarios as U 
                       WHERE AR.id_archivo=A.id and AR.id_revision=".$id." and U.id=A.id_usuario";

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }





    static public function mdlBorrarRevision($id)
    {
//        print_r($id);
        conexion::conectar();
          $query="Delete From Revisiones where id=".$id;

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    } 

    static public function mdlGuardarEdicionRevision($datos)
    {

//        echo "mdl";
//        print_r($datos);
//        exit();
        conexion::conectar();
         $query = "UPDATE Revisiones SET motivo='".$datos['motivo']."',region='".$datos['region']."',area_revisada='".$datos['areaRevisada']."',defensa='".$datos['medios']."',observaciones='".$datos['observaciones']."',estatus='".$datos['estatus']."',inicio_revision='".$datos['inicioRevisionEdit']."',fin_revision='".$datos['finRevisionEdit']."',realizoPago='".$datos['multaEdit']."',tipo_revision ='".$datos['tipoRevEdit']."' WHERE id=".$datos['idRevision'];
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


}