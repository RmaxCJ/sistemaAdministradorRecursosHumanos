<?php
require_once "conexion.php";
class ModeloCCT
{


    static public function mdlIngresarArchivosCCT($tabla2,$datos2)
    {
//       echo "mdlIngresarArchivos<br>";
//        echo "<pre>";
//        print_r($datos2);
//        echo "</pre>";
        conexion::conectar();
        $query = "insert into ".$tabla2." (id_tipo,anio,nombre,archivo,id_usuario,fecha_alta,cod_division)values(".$datos2['id_tipo'].",'".$datos2['anio']."','".$datos2['nombre']."','".$datos2['archivo']."',".$datos2['id_usuario'].",'".$datos2['fecha_alta']."','".$datos2['cod_division']."')";
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

    static public function mdlMostrarCCT($año,$division)
    {

        conexion::conectar();
        if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
        {
        //    echo $query="SELECT * FROM Archivos where id_tipo=7 and anio=".$año." and nombre like '%".$division."%' ";
        //    echo $query="SELECT A.anio, A.id_tipo, A.nombre, A.archivo, A.fecha_alta, D.cod_division, D.division FROM Archivos A, Divisiones as D where id_tipo=7 and anio=".$año."  and D.cod_division in(".$division.") ";

           $query="SELECT A.anio, A.id_tipo, A.nombre, A.archivo, A.fecha_alta, D.cod_division, D.division 
          FROM Archivos A, Divisiones as D 
          where id_tipo=7 and anio=".$año." AND A.cod_division=D.cod_division  and D.cod_division in(".$division.")";
           

        }
        else
        {
        //   echo  $query="SELECT * FROM Archivos where id_tipo=7 and anio=".$año;
            $query="SELECT A.anio, A.id_tipo, A.nombre, A.archivo, A.fecha_alta, D.cod_division, D.division 
           FROM Archivos A, Divisiones as D where id_tipo=7 and anio=".$año."  AND A.cod_division=D.cod_division";

        }

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        return $result;




    }

    static public function mdlGuardarArchivoCCTSindicato($idArchivo,$sindicatoID)
    {

//echo "mdl";
//print_r($datos);
        conexion::conectar();

        $query = "insert into ArchivoCCT (id_archivo,id_sindicato)values($idArchivo,$sindicatoID)";
//            mssql_query($query);

        if(mssql_query($query)){
            return "ok";
        }else{
            return "error";
        }


    }



}