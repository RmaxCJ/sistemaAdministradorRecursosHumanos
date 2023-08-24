<?php
require_once "conexion.php";
class ModeloPagos
{

    static public function mdlMostrarPagosCalendario($cod_division)
    {
//                echo "mdlMostrarPagosCalendario";
        conexion::conectar();

        if ($cod_division=="" || $cod_division==null)
        
        {
              $query="
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado' then 'green' when 'Pendiente' then 'red' when 'Registrado' then '#f2c010'  when 'Recepcion' then 'red'  when 'En Validacion' then 'red'  when 'Rechazado' then 'red'  when 'Validado' then 'red'  end as color
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
                    WHERE P.id_proveedor=Prov.id  and P.cod_divisionP=D.cod_division and Prov.id not in (select id_proveedor from Sindicatos)
                    UNION
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado' then 'green' when 'Pendiente' then 'red' when 'Registrado' then '#f2c010'  when 'Recepcion' then 'red'  when 'En Validacion' then 'red'  when 'Rechazado' then 'red'  when 'Validado' then 'red'  end as color
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and S.id_proveedor=Prov.id  and S.cod_division=D.cod_division 

        ";
        }
        else{
              $query="
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado' then 'green' when 'Pendiente' then 'red' when 'Registrado' then '#f2c010'  when 'Recepcion' then 'red'  when 'En Validacion' then 'red'  when 'Rechazado' then 'red'  when 'Validado' then 'red'  end as color
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
                    WHERE P.id_proveedor=Prov.id  and P.cod_divisionP=D.cod_division and D.cod_division in(".$cod_division.") and Prov.id not in (select id_proveedor from Sindicatos)
                    UNION
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title ,case P.estatus when 'Pagado' then 'green' when 'Pendiente' then 'red' when 'Registrado' then '#f2c010'  when 'Recepcion' then 'red'  when 'En Validacion' then 'red'  when 'Rechazado' then 'red'  when 'Validado' then 'red'  end as color
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and S.id_proveedor=Prov.id  and S.cod_division=D.cod_division  and D.cod_division in(".$cod_division.")

        ";
        }


        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
          //            echo $rs;
                    $result[] = $rs;
                }
                return $result;
    }

    static public function mdlAlertaPagosPendientes($divisiones)
    {
//                echo "mdlMostrarPagosCalendario";
        conexion::conectar();

        if ($divisiones=="" || $divisiones==null)
        {
            $query="
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado ' then 'green' when 'Pendiente ' then 'red' when 'Registrado ' then 'orange' end as color
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
                    WHERE P.id_proveedor=Prov.id  and P.cod_divisionP=D.cod_division and Prov.id not in (select id_proveedor from Sindicatos) and P.estatus='Pendiente'
                    UNION
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado ' then 'green' when 'Pendiente ' then 'red' when 'Registrado ' then 'orange' end as color
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and S.id_proveedor=Prov.id  and S.cod_division=D.cod_division  and P.estatus='Pendiente'

        ";
        }
        else{
             $query="
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title,case P.estatus when 'Pagado ' then 'green' when 'Pendiente ' then 'red' when 'Registrado ' then 'orange' end as color
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
                    WHERE P.id_proveedor=Prov.id  and P.cod_divisionP=D.cod_division and D.cod_division in(".$divisiones.") and Prov.id not in (select id_proveedor from Sindicatos)  and P.estatus='Pendiente'
                    UNION
                    SELECT P.id,P.fecha_vencimiento as start,D.division+' - '+P.estatus as title ,case P.estatus when 'Pagado ' then 'green' when 'Pendiente ' then 'red' when 'Registrado ' then 'orange' end as color
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and S.id_proveedor=Prov.id  and S.cod_division=D.cod_division  and D.cod_division in(".$divisiones.")  and P.estatus='Pendiente'

        ";
        }


        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            //            echo $rs;
            $result[] = $rs;
        }
        return $result;
    }



    static public function mdlMostrarPagos()
    {
            //        echo "mdlMostrarOrdenes";
            conexion::conectar();


            $query= "SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,Prov.proveedor,Prov.rfc,Prov.moneda,Prov.contacto
                    FROM Pagos as P, Proveedores as Prov
                    WHERE P.id_proveedor=Prov.id  ";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

            //        $query= "SELECT * from Pagos WHERE estatus='Pendiente'";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo



            //        $query="SELECT * FROM Facturas";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static public function mdlMostrarPagosPorDia($dia,$cod_division)
    {
//                echo "mdlMostrarPagosPorDia";
//                echo $cod_division;
        conexion::conectar();

        if ($cod_division=="" || $cod_division==null)
        {
//            $query2= "SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,Prov.proveedor as nombre,D.division
//                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
//                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and Prov.cod_planta=D.cod_division
//                    UNION
//                    SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,S.sindicato as nombre, D.division
//                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D
//                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and S.id_proveedor=Prov.id and S.cod_division=D.cod_division
//                    ";

            $query2= "SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,Prov.proveedor as nombre,D.division
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and P.cod_divisionP=D.cod_division and Prov.id not in (select id_proveedor from Sindicatos)
                    UNION
                    SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,S.sindicato as nombre, D.division
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and S.id_proveedor=Prov.id and S.cod_division=D.cod_division         
                    ";
        }
        else
        {
             $query2= "SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,Prov.proveedor as nombre,D.division
                    FROM Pagos as P, Proveedores as Prov, Divisiones as D
                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and P.cod_divisionP=D.cod_division and D.cod_division in(".$cod_division.") and Prov.id not in (select id_proveedor from Sindicatos)
                    UNION
                    SELECT P.id as IDPAGO, P.concepto,P.monto,P.estatus,P.fecha_vencimiento,S.sindicato as nombre,D.division
                    FROM Pagos as P, Proveedores as Prov,Sindicatos as S,Divisiones as D 
                    WHERE P.id_proveedor=Prov.id  and P.fecha_vencimiento='".$dia."' and S.id_proveedor=Prov.id  and S.cod_division=D.cod_division  and D.cod_division in(".$cod_division.")              
                    ";
        }


        $sql2 = mssql_query($query2);

            while($rs2 = mssql_fetch_object($sql2))
            {
                $result2[] = $rs2;
            }
            return $result2;

    }
    static public function mdlValidarPago($post,$status)
    {
        conexion::conectar();
        // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
        $fechaHoy=date('Y-m-d H:i:s');
        $query="UPDATE Pagos SET estatus='".$status."',fecha_validado='".$fechaHoy."' WHERE id=".$post['pago']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlRechazarPago($post,$status)
    {
        conexion::conectar();
        // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
        $query="UPDATE Pagos SET estatus='".$status."' WHERE id=".$post['pago']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlGActualizarRecepcion($post,$status)
    {
        conexion::conectar();
        $fechaHoy=date('Y-m-d H:i:s');
        $query="UPDATE Pagos SET fecha_recepcion='".$fechaHoy."',estatus='".$status."' WHERE id=".$post['pago']."";


        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlGuardarRecepcion($post)
    {
        conexion::conectar();
        $query="UPDATE Facturas SET num_recepcion='".$post['numeroRecepcion']."' WHERE id_pago=".$post['pago']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }

    static public function mdlActualizarFechaProgramada($post)
    {
        //        echo "mdlActualizarFechaProgramada";
        //        print_r($post);
            conexion::conectar();
        //    echo "<br>";
         $query="UPDATE Facturas SET fecha_programada_pago='".$post['fechaRegistroPago']."' WHERE id_pago=".$post['pago']."";


        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlActualizarRegistro($post,$estatus)
    {
        //    echo "mdlActualizarRegistro";
        conexion::conectar();
        $query="UPDATE Pagos SET estatus='".$estatus."' WHERE id=".$post['pago']."";


        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlAgregarNuevoPago($post)
    {
        conexion::conectar();
         $query = "insert into Pagos(id_proveedor,concepto,monto,estatus,fecha_vencimiento)values(".$post['sindicato'].",'".$post['Concepto']."',".$post['monto'].",'".$post['estatus']."','".$post['fecha_vencimiento']."')";
        //    mssql_query($query);
        if(mssql_query($query))
        {
            //regrear id de guardado de la minuta
            return "ok";
        }else
        {
            return "error";
        }
    }
    static public function mdlIngresarArchivos($tabla2,$datos2)
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
    static public function mdlGuardarComprobante($tabla3,$idArchivo,$datos)
    {			
        conexion::conectar();
         $query = "insert into ".$tabla3." (id_pago,id_archivo,id_usuario,fecha_alta)values('".$datos['id_pago']."','".$idArchivo."','".$datos['id_usuario']."','".date('Y-m-d H:i:s')."')";
         
         $query2="UPDATE Pagos SET estatus='Pagado' WHERE id=".$datos['id_pago']."";
        if(mssql_query($query)){
            if(mssql_query($query2)){
                return "ok";
            }else{
                return "error";
            }
            // return "ok";
        }else{
            return "error";
        }
    }
    static public function mdlMostrarArchivosComprobante($tabla,$id_pago)
    {
        conexion::conectar();
        

        $query="SELECT top 1 C.id, C.id_pago, C.id_archivo, A.nombre, A.archivo, A.fecha_alta FROM Comprobantes C, Archivos A 
        WHERE C.id_pago=".$id_pago." and C.id_archivo=A.id order by A.fecha_alta desc";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static  public  function mdlFacturaxPago($id_pago)
    {
        conexion::conectar();


         $query="select top 1 P.id as id_pago,  P.concepto, P.monto, F.id as id_factura, F.id_pago, F.id_archivo_pdf , F.comentario, A.id, A.nombre, A.archivo
         from Facturas as F, Pagos as P, Archivos as A 
         where P.id=F.id_pago and F.id_archivo_pdf=A.id and F.id_pago=".$id_pago."order by F.id desc";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static  public  function mdlOrdenxPago($id_pago)
    {
        conexion::conectar();


         $query="select top 1 P.id as id_pago,  P.concepto, P.monto, F.id as id_ordenCOmpra, F.id_pago, F.id_archivo, A.id, A.nombre, A.archivo
         from OrdenesCompra as F, Pagos as P, Archivos as A 
         where P.id=F.id_pago and F.id_archivo=A.id and F.id_pago=".$id_pago."order by F.id desc";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlEliminarPago($tabla,$datos)
    {
//        echo "mdlEliminarPago";
        conexion::conectar();
//            $query="UPDATE ".$tabla." SET activo='B' WHERE id=".$datos['idUsuario']."";

         $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['IdPago']."";
//        exit();
        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }
    }


    static  public  function ctrNumRecepcionxPago($datos)
    {
        conexion::conectar();


        $query="select *from Facturas where id_pago=".$datos['IdPago'];

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static  public  function mdlBuscarFechasRecepcion($datos)
    {
        conexion::conectar();


        $query="select CONVERT(char(17),fecha_programada_pago,103) as fecha_programada_pago from Facturas where id_pago=".$datos['IdPago'];

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }


}