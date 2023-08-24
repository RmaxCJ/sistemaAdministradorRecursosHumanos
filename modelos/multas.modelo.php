<?php
require_once "conexion.php";
class ModeloMultas
{



    static public function mdlGuardarMulta($datos)
    {

//        echo "mdl";
//        print_r($datos);
        conexion::conectar();
         $query = "insert into Multas(num_empleado,fecha_generacion_multa,region,area,motivo,defensa,observaciones,estatus,monto,montoMXN,plan_accion,id_moneda,pago_multa)values('".$datos['num_EmpleadoActive']."','".$datos['generacionMulta']."','".$datos['region']."','".$datos['areaRevisada']."','".$datos['motivo']."','".$datos['medios']."','".$datos['observaciones']."','".$datos['estatus']."',".$datos['monto'].",".$datos['montoMXN'].",'".$datos['planAccion']."',".$datos['moneda'].",'".$datos['fechaPagoMulta']."')";
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
    static public function mdlGuardarEdicionMulta($datos)
    {

//        echo "mdl";
//        print_r($datos);
        conexion::conectar();
          $query = "UPDATE Multas SET fecha_generacion_multa='".$datos['generacionMulta']."',region='".$datos['region']."',area='".$datos['areaRevisada']."',motivo='".$datos['motivo']."',defensa='".$datos['medios']."',observaciones='".$datos['observaciones']."',estatus='".$datos['estatus']."',monto=".$datos['monto'].",montoMXN=".$datos['montoMXN'].",plan_accion='".$datos['planAccion']."',id_moneda=".$datos['moneda'].",pago_multa='".$datos['fechaPagoMulta']."' WHERE id=".$datos['IDMULTAEDIT'];
//exit();

if(mssql_query($query))
        {
            return "ok";
        }else
        {
            return "error";
        }


    }

    static public function mdlArchivosMultas($tabla3,$idArchivo,$idMulta)
    {

        conexion::conectar();
         $query = "insert into ".$tabla3." (id_archivo,id_multa)values(".$idArchivo.",".$idMulta.")";
//            mssql_query($query);
        if(mssql_query($query)){
            //regrear id de guardado de la minuta
            return "ok";
        }else{
            return "error";
        }
    }

    static public function mdlMostrarHistorialArchivosxMulta($id)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

         $query2= "SELECT  CONVERT(char(16),A.fecha_alta,103) as fecha_alta2,* FROM ArchivosMultas AM,Archivos as A,Usuarios as U 
                       WHERE AM.id_archivo=A.id and AM.id_multa=".$id." and U.id=A.id_usuario";

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlMostrarMulta($divisiones)
    {
//        echo "mdlMostrarPagosPorDia";
//        echo $divisiones;
        conexion::conectar();

        if ($divisiones=='ALL')
        {

            $query2= "SELECT M.id as IDmulta,M.num_empleado,M.fecha_generacion_multa,M.region,M.area,M.motivo,M.defensa,M.observaciones,M.estatus as estatusMulta,M.monto,M.montoMXN,M.plan_accion,E.nombre,D.pais,D.division,M.pago_multa,M.fecha_generacion_multa,M.observaciones,E.posicion,M.defensa,M.id_moneda
 FROM Multas as M,Empleados as E,Divisiones as D
                       WHERE M.num_empleado=E.num_empleado and E.cod_division=D.cod_division  order by M.id desc";


        }
        else{


            $query2= "SELECT M.id as IDmulta,M.num_empleado,M.fecha_generacion_multa,M.region,M.area,M.motivo,M.defensa,M.observaciones,M.estatus as estatusMulta,M.monto,M.montoMXN,M.plan_accion,E.nombre,D.pais,D.division,M.pago_multa,M.fecha_generacion_multa,M.observaciones,E.posicion,M.defensa,M.id_moneda
 FROM Multas as M,Empleados as E,Divisiones as D
                       WHERE M.num_empleado=E.num_empleado and E.cod_division=D.cod_division and D.cod_division in (".$divisiones.") order by M.id desc";

        }


        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }



//    static public function mdlBorrarRevision($id)
//    {
////        print_r($id);
//        conexion::conectar();
//        $query="Delete From Revisiones where id=".$id;
//
////            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";
//
//        if(mssql_query($query))
//        {
//            return "ok";
//        }else{
//            return "error";
//        }
//    }


}