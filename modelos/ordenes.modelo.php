<?php
require_once "conexion.php";
class ModeloOrdenes{

    static public function mdlMostrarOrdenes()
    {
//        echo "mdlMostrarOrdenes";
        conexion::conectar();


        $query= "SELECT OC.orden_compra,OC.concepto,OC.monto,OC.fecha_alta,P.num_proveedor,AR.archivo,U.usuario,Pag.concepto,Pag.monto,Pag.estatus
                    FROM OrdenesCompra as OC, Proveedores as P,Archivos as AR,Usuarios as U, Pagos as Pag
                    WHERE OC.id_pago=Pag.id and Pag.id_proveedor=P.id and OC.id_archivo=AR.id and AR.id_usuario=U.id";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo
        //$query="SELECT * FROM OrdenesCompra";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

///////////////////////////////////////////////////////////////////////////////ingresar pliegos

    static public function mdlIngresarOrdenes($tabla2,$datos2)
    {
//        echo "mdlIngresarOrdenes<br>";
//        echo "<pre>";
//        print_r($tabla2);
//        print_r($datos2);
//        echo "</pre>";
        conexion::conectar();
         $query = "insert into ".$tabla2." (id_archivo,orden_compra,concepto,monto,fecha_alta,id_pago)values(".$datos2['id_archivo'].",'".$datos2['orden_compra']."','".$datos2['concepto']."','".$datos2['monto']."','".$datos2['fecha_alta']."',".$datos2['id_pago'].")";
//            mssql_query($query);

        if(mssql_query($query)){
            //regrear id de guardado de la minuta
            return "ok";
        }else{
            return "error";
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

    static public function mdlBuscarInfo($post)
    {
        conexion::conectar();


         $query= "SELECT OC.concepto,OC.monto,AR.archivo 
                  FROM OrdenesCompra as OC,Archivos as AR
                  where OC.id_archivo=AR.id and id_pago=".$post['pago'];

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }


}