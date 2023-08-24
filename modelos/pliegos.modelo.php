<?php
require_once "conexion.php";
class ModeloPliegos{

    // select * from AcuerdosMinuta where id_minuta = 1
    static public function mdlMostrarPliegos($cod_division,$pais)
    {
        //echo "mdlMostrarPliegos";
        conexion::conectar();
        // echo $cod_division;
        // echo $pais;

        if ($pais==null|| $pais=="") // perfil 3 (sindicato, solo su division)
        {

            $query= "SELECT P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,AP.id as IDAP,S.sindicato,U.usuario,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo,S.nombre_corto,D.division,P.generales,U.num_empleado,U.nombre_usuario
                    FROM Pliegos as P, ArchivosPliego as AP, Sindicatos as S,Usuarios as U, Archivos as AR,Divisiones as D
                    WHERE AP.id_pliego=P.id and P.id_sindicato=S.id and P.id_usuario=U.id and AP.id_archivo=AR.id and S.cod_division=D.cod_division and D.cod_division='".$cod_division."' and P.tipo_creacion='Cargado' order by fecha_alta desc";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        }
        elseif ($cod_division==null|| $cod_division=="")// perfil 4 (Abogado general, solo su pais [todas las divisiones])
        {

            $query= "SELECT P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,AP.id as IDAP,S.sindicato,U.usuario,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo,S.nombre_corto,D.division,P.generales,U.num_empleado,U.nombre_usuario
                    FROM Pliegos as P, ArchivosPliego as AP, Sindicatos as S,Usuarios as U, Archivos as AR,Divisiones as D
                    WHERE AP.id_pliego=P.id and P.id_sindicato=S.id and P.id_usuario=U.id and AP.id_archivo=AR.id and S.cod_division=D.cod_division and D.pais='".$pais."' and P.tipo_creacion='Cargado' order by fecha_alta desc";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo


        }
        elseif ($cod_division!=null|| $cod_division!="")// perfil 2 o 4(Abogado general, solo su pais [todas las divisiones])
        {
            if($cod_division!="admin"){   
                $query= "SELECT P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,AP.id as IDAP,S.sindicato,U.usuario,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo,S.nombre_corto,D.division,P.generales,U.num_empleado,U.nombre_usuario
                        FROM Pliegos as P, ArchivosPliego as AP, Sindicatos as S,Usuarios as U, Archivos as AR,Divisiones as D
                        WHERE AP.id_pliego=P.id and P.id_sindicato=S.id and P.id_usuario=U.id and AP.id_archivo=AR.id and S.cod_division=D.cod_division and D.pais='".$pais."' and P.tipo_creacion='Cargado' and D.cod_division in(".$cod_division.") order by fecha_alta desc";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo
            }
            elseif ($pais=="admin" && $cod_division=="admin")
            {

              $query= "SELECT P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,AP.id as IDAP,S.sindicato,U.usuario,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo,S.nombre_corto,D.division,P.generales,U.num_empleado,U.nombre_usuario
                        FROM Pliegos as P, ArchivosPliego as AP, Sindicatos as S,Usuarios as U, Archivos as AR,Divisiones as D
                        WHERE AP.id_pliego=P.id and P.id_sindicato=S.id and P.id_usuario=U.id and AP.id_archivo=AR.id and S.cod_division=D.cod_division and P.tipo_creacion='Cargado' order by fecha_alta desc";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo


            }

        }
        


        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static public function mdlMostrarPliegosCreados($cod_division,$pais)
    {
//        echo "mdlMostrarPliegosCreadosADMIN<pre>";
//        print_r($cod_division);
//        print_r($pais);
//        echo "<pre>";
        conexion::conectar();

        if ($pais==null|| $pais=="") // perfil 3 (sindicato, solo su division)
        {
            $query= "SELECT  P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,S.sindicato,U.usuario,D.division,P.generales,U.num_empleado,U.nombre_usuario
                    FROM Pliegos as P, Sindicatos as S,Usuarios as U,Divisiones as D
                    WHERE P.id_sindicato=S.id and P.id_usuario=U.id  and S.cod_division=D.cod_division and D.cod_division='".$cod_division."' and P.tipo_creacion='Creado' order by fecha_alta desc";//


        }
        elseif ($cod_division==null|| $cod_division=="")// perfil 4 (Abogado general, solo su pais [todas las divisiones])
        {
             $query= "SELECT  P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,S.sindicato,U.usuario,D.division,P.generales,U.num_empleado,U.nombre_usuario
                    FROM Pliegos as P, Sindicatos as S,Usuarios as U,Divisiones as D
                    WHERE P.id_sindicato=S.id and P.id_usuario=U.id  and S.cod_division=D.cod_division and D.pais='".$pais."' and P.tipo_creacion='Creado' order by fecha_alta desc";//


        }
        elseif ($cod_division!=null|| $cod_division!="")// perfil 4 (Abogado general, solo su pais [todas las divisiones])
        {
            if($cod_division!="admin"){   
                $query= "SELECT  P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,S.sindicato,U.usuario,D.division,P.generales,U.num_empleado,U.nombre_usuario
                    FROM Pliegos as P, Sindicatos as S,Usuarios as U,Divisiones as D
                    WHERE P.id_sindicato=S.id and P.id_usuario=U.id  and S.cod_division=D.cod_division and D.pais='".$pais."' and P.tipo_creacion='Creado' and D.cod_division in(".$cod_division.") order by fecha_alta desc";//
            }
            elseif ($pais=="admin" && $cod_division=="admin")
            {
                  $query= "SELECT  P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,S.sindicato,U.usuario,D.division,P.generales,U.num_empleado,U.nombre_usuario
                        FROM Pliegos as P, Sindicatos as S,Usuarios as U,Divisiones as D
                        WHERE P.id_sindicato=S.id and P.id_usuario=U.id  and S.cod_division=D.cod_division and P.tipo_creacion='Creado' order by fecha_alta desc";//
    
    
            }

        }
        


        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

///////////////////////////////////////////////////////////////////////////////ingresar pliegos
    static public function mdlIngresarPliegos($tabla,$datos)
    {
        conexion::conectar();

         $query = "insert into ".$tabla." (id_sindicato,estatus,id_usuario,fecha_alta,generales,tipo_creacion)values(".$datos['id_sindicato'].",'".$datos['estatus']."','".$datos['id_usuario']."','".$datos['fecha_alta']."','".$datos['tema']."','".$datos['tipoCreacion']."')";
//            mssql_query($query);
        if(mssql_query($query)){
            //regrear id de guardado de la minuta

            $query2     ="SELECT MAX(id) AS id FROM Pliegos";
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
    static public function mdlIngresarPeticiones($tabla,$datos,$idPliego)
    {
        conexion::conectar();
        $jsonPet = $datos['jsonPeticiones'];

        $array = explode("~", $jsonPet);
//        print_r($array);
         $totalValores= count($array);
        unset($array[$totalValores-1]);
         $totalTotal=count($array);

         for ($i = 0; $i <= $totalTotal; $i++)
         {

//            echo "<br>";
//            echo $i;
             $query = "insert into ".$tabla." (id_pliego,peticion)values('".$idPliego."','".$array[$i]."')";
             $sql= mssql_query($query);
//             print_r($sql);
             if ($array[$i] === end($array))
            {
                // echo "ÚLTIMO ELEMENTO";
                return "ok";
               // echo "ok<br>";
            }
//             else{
//                 echo "todavia no<br>";
//             }

        }
        // print_r($array);




    }

    static public function mdlIngresarArchivos($tabla2,$datos2)
    {
//       echo "mdlIngresarArchivos<br>";
//        echo "<pre>";
//        print_r($datos2);
//        echo "</pre>";
        conexion::conectar();
          $query = "insert into ".$tabla2." (id_tipo,anio,nombre,archivo,id_usuario,fecha_alta)values(".$datos2['id_tipo'].",'".$datos2['anio']."','".$datos2['nombre']."','".$datos2['archivo']."',".$datos2['id_usuario'].",'".$datos2['fecha_alta']."')";
//            mssql_query($query);
        if(mssql_query($query)){
            //regrear id de guardado de la minuta

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

    static public function mdlIngresarArchivosPliegos($tabla3,$idPliego,$idArchivo)
    {
        conexion::conectar();
        $query = "insert into ".$tabla3." (id_pliego,id_archivo)values('".$idPliego."','".$idArchivo."')";
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



    static public function mdlDatosPliegoById($id)
    {
        conexion::conectar();


        $query= "SELECT P.id as IDPliego,P.id_sindicato,P.estatus,P.id_usuario,P.fecha_alta,S.sindicato,U.usuario,S.cod_division,D.pais,S.logo,D.division,D.cod_division
                    FROM Pliegos as P, Sindicatos as S,Usuarios as U,Divisiones as D
                    WHERE  P.id_sindicato=S.id and P.id_usuario=U.id and S.cod_division=D.cod_division and P.id=$id";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }
    static public  function mdlPeticionesByIdPliego($id)
    {
        conexion::conectar();


        $query= "SELECT * FROM Peticiones where id_pliego=$id";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }


}