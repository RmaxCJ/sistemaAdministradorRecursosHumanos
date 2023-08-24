<?php
require_once "conexion.php";
class ModeloPagos
{

    static public function mdlMostrarPagos()
    {
//        echo "mdlMostrarOrdenes";
        conexion::conectar();


        $query= "SELECT P.id as IDPAGO, P.concepto.,P.monto,P.estatus,P.fecha_vencimiento,Prov.proveedor,Prov.rfc,Prov.moneda,Prov.contacto
                    FROM Pagos as P, Proveedores as Prov
                    WHERE P.id_proveedor=Prov.id  ";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo
//       echo $query= "SELECT F.id as FactID,F.concepto,F.anio,F.mes,F.monto,F.estatus,F.fecha_alta,P.proveedor,P.rfc,P.correo,P.cod_planta,
//                    FROM Facturas as F, Proveedor as P
//                    WHERE F.id_proveedor=P.id";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

//        $query="SELECT * FROM Facturas";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

///////////////////////////////////////////////////////////////////////////////ingresar pliegos

    static public function mdlIngresarRecibos($tabla2,$datos2)
    {
//        echo "mdlIngresarRecibos<br>";
//        echo "<pre>";
//        print_r($tabla2);
//        print_r($datos2);
//        echo "</pre>";

        conexion::conectar();
        if ($datos2['id_archivo_xml']=='' || $datos2['id_archivo_xml']==null)
        {
            $query = "insert into ".$tabla2." (id_proveedor,id_archivo_pdf,concepto,anio,mes,monto,estatus,comentario,fecha_alta,fecha_programada_pago)values(".$datos2['id_proveedor'].",".$datos2['id_archivo_pdf'].",'".$datos2['concepto']."','".$datos2['anio']."',".$datos2['mes'].",".$datos2['monto'].",'".$datos2['estatus']."','".$datos2['comentario']."','".$datos2['fecha_alta']."','".$datos2['fecha_programada_pago']."')";
//            mssql_query($query);

            if(mssql_query($query))
            {
                //regrear id de guardado de la minuta
                return "ok";
            }else
            {
                return "error";
            }
        }
        else
        {
            $query = "insert into ".$tabla2." (id_proveedor,id_archivo_pdf,id_archivo_xml,concepto,anio,mes,monto,estatus,comentario,fecha_alta,fecha_programada_pago)values(".$datos2['id_proveedor'].",".$datos2['id_archivo_pdf'].",".$datos2['id_archivo_xml'].",'".$datos2['concepto']."','".$datos2['anio']."',".$datos2['mes'].",".$datos2['monto'].",'".$datos2['estatus']."','".$datos2['comentario']."','".$datos2['fecha_alta']."','".$datos2['fecha_programada_pago']."')";
//            mssql_query($query);

            if(mssql_query($query))
            {
                //regrear id de guardado de la minuta
                return "ok";
            }else
            {
                return "error";
            }
        }


    }

/////////////////////////////////////////////////////////////////////////////////////editar pliegos
    static public function mdlEditarPliegos($tabla,$datos)
    {
        conexion::conectar();
        $query="UPDATE ".$tabla." SET id_sindicato='".$datos['id_sindicato']."',tema='".$datos['tema']."',estatus='".$datos['estatus']."',id_usuario='".$datos['id_usuario']."',generales='".$datos['generales']."' WHERE id=".$datos['id']."";
        if(mssql_query($query)){
            return "ok";
        }
        else{
            return "error";
        }
    }


/////////////////////////////////////////////////////////////////////////borrar pliegos
    static public function mdlBorrarPliegos($tabla,$datos)
    {
        conexion::conectar();
        // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
        $query="UPDATE ".$tabla." SET estatus='Inactivo' WHERE id=".$datos['id']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }


}