<?php
require_once "conexion.php";
class ModeloNegociaciones
{

    static public function mdlMostrarNegociacionesCalendario($cod_division)
    {
//        echo "mdlMostrarNegociacionesCalendario";
        conexion::conectar();
        if ($cod_division!="")
        {
            $query= "SELECT N.id, N.fecha_vencimiento as start,D.division+' - '+N.estatus as title,case N.estatus when 'Cerrada' then 'blue' when 'Atrasada' then 'orange' when 'Pendiente En Tiempo' then 'green' when 'Pendiente Fuera de Tiempo' then 'red' end as color
                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D
                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division and D.cod_division in(".$cod_division.") ";

        }
        elseif ($cod_division=="" || $cod_division==null)
        {
            $query= "SELECT N.id, N.fecha_vencimiento as start,D.division+' - '+N.estatus as title,case N.estatus when 'Cerrada' then 'blue' when 'Atrasada' then 'orange' when 'Pendiente En Tiempo' then 'green' when 'Pendiente Fuera de Tiempo' then 'red' end as color
                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D
                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division";

        }



//        $query="SELECT * FROM Facturas";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;

        }

        return $result;
    }

    static public function mdlAlertaNegociacionesPendientes($divisiones)
    {
//        echo "mdlMostrarNegociacionesCalendario";
        conexion::conectar();
        if ($divisiones!="")
        {
            $query= "SELECT N.id, N.fecha_vencimiento as start,D.division+' - '+N.estatus as title,case N.estatus when 'Cerrada' then 'green' when 'Atrasada' then 'red' when 'Pendiente' then 'orange' end as color
                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D
                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division and D.cod_division in(".$divisiones.") and N.estatus='Atrasada'";

        }
        elseif ($divisiones=="" || $divisiones==null)
        {
            $query= "SELECT N.id, N.fecha_vencimiento as start,D.division+' - '+N.estatus as title,case N.estatus when 'Cerrada' then 'green' when 'Atrasada' then 'red' when 'Pendiente' then 'orange' end as color
                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D
                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division and N.estatus='Atrasada'";

        }



//        $query="SELECT * FROM Facturas";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;

        }

        return $result;
    }
    static public function mdlMostrarNegociacionesPorDia($dia)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

//        $query2= "SELECT N.id as IDNeg,N.tipo_revision,N.fecha_vencimiento,N.renovacion,N.Comentarios,N.estatus,S.id as idSin,S.sindicato,S.nombre_corto,S.cod_division,S.id_proveedor,D.division,A.id as idAr,A.archivo,A.nombre
//                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D,ArchivoCCT as AC,Archivos as A
//                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division and AC.id_sindicato=S.id and AC.id_archivo=A.id and N.fecha_vencimiento='".$dia."'";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $query2= "SELECT N.id as IDNeg,N.tipo_revision,N.fecha_vencimiento,N.periodo,N.renovacion,N.Comentarios,N.estatus,S.id as idSin,S.sindicato,S.nombre_corto,S.cod_division,S.id_proveedor,D.division,N.fecha_cierre
                    FROM Negociaciones as N, Sindicatos as S,Divisiones as D
                    WHERE N.id_sindicato=S.id and S.cod_division=D.cod_division and N.fecha_vencimiento='".$dia."'";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo
        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }
    static public function mdlMostrarArchivoporSindicato($idSin)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2= "SELECT S.id as idSin,S.sindicato,S.nombre_corto,S.cod_division,S.id_proveedor,A.id as idAr,A.archivo,A.nombre,SC.contenido,SC.id as idContenido
                    FROM Sindicatos as S,SindicatosCCT as SC,Archivos as A
                    WHERE  SC.id_sindicato=S.id and SC.id_archivoOriginal=A.id and SC.id_sindicato='".$idSin."' and A.id_tipo=8";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlContenidoCCT($idContenido)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2= "Select *from SindicatosCCT where id=".$idContenido;// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlMostrarHistorialCCTporSindicato($idSin)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2= "SELECT S.id as idSin,S.sindicato,S.nombre_corto,S.cod_division,S.id_proveedor,A.id as idAr,A.archivo,A.nombre,A.id_usuario,U.num_empleado,U.usuario,A.fecha_alta
                    FROM Sindicatos as S,SindicatosCCT as SC,Archivos as A,Usuarios as U
                    WHERE  SC.id_sindicato=S.id and SC.id_archivoOriginal=A.id and SC.id_sindicato='".$idSin."' and A.id_tipo=7 and A.id_usuario=U.id ";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlMostrarBitacoraNegociacion($IDNeg)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

         $query2= "SELECT * from BitacoraNegociacion where id_negociacion=".$IDNeg;// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
//        print_r($result2);
        return $result2;

    }

    static public function mdlUltimaFechaNego($IDNeg)
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2= "select TOP 1 * from BitacoraNegociacion where id_negociacion=".$IDNeg." order by id desc";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql2 = mssql_query($query2);

        while($rs2 = mssql_fetch_object($sql2))
        {
            $result2[] = $rs2;
        }
//        print_r($result2);
        return $result2;

    }

    static public function mdlCambiarFechaBitacora($datos)
    {


        conexion::conectar();

         $query = "insert into BitacoraNegociacion(id_negociacion,fecha_original,fecha_nueva,id_usuario,comentarios)values(".$datos['idNego'].",'".$datos['fechaAnterior']."','".$datos['fechaNueva']."','".$datos['idUser']."','".$datos['motivosCambio']."')";
//            mssql_query($query);

        if(mssql_query($query))
        {
             $query2="UPDATE Negociaciones SET renovacion='".$datos['fechaNueva']."',estatus='Pendiente En Tiempo' WHERE id=".$datos['idNego'];

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query2))
            {
                return "ok";
//                session_destroy();
            }else{
                return "error";
            }
//            return "ok";
        }else{
            return "error";
        }


    }

    static public function mdlCerrarNegociacion($datos)
    {
        conexion::conectar();
//            $default=date('d/m').'_'.$datos['nameUsuario'].'_'.date('Y');
//            echo $default;
//            echo "<br>";
//        $fechaHoy=date('Y-m-d');
        $fechaHoy=$datos['fechaCierre'];
//            echo $passcifrado;

        $query="UPDATE Negociaciones SET fecha_cierre='".$fechaHoy."',estatus='Cerrada' WHERE id=".$datos['idNegoCierre'];
//exit();
//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
            session_destroy();
        }else{
            return "error";
        }
    }

    static public function mdlActualizarWord($contenido,$idContenido)
    {
//            echo "mdl<pre>";
//        print_r($idContenido);
//        print_r($contenido);
//            echo "</pre>";
//        exit();

        conexion::conectar();
         $query="UPDATE SindicatosCCT SET contenido='".$contenido."' WHERE id=".$idContenido;

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }


}