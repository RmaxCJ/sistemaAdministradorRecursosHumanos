<?php
	require_once "conexion.php";
	class ModeloRit{

        static public function mdlMostrarRit($tabla,$divisiones,$pais)
        {
            conexion::conectar();
            if($divisiones=="TODAS"){
                $query="SELECT DISTINCT R.cod_division, D.cod_division, D.division FROM ".$tabla." as R, divisiones as D WHERE R.cod_division=D.cod_division and D.pais='".$pais."'";
            }else{
               $query="SELECT DISTINCT R.cod_division, D.cod_division, D.division FROM ".$tabla." as R, divisiones as D WHERE R.cod_division=D.cod_division and D.cod_division in(".$divisiones.") and D.pais='".$pais."'";
            }
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlMostrarObservacionRit($tabla)
        {
            conexion::conectar();
            
            $query="SELECT * FROM ".$tabla." order by id desc";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlMostrarObsRit($tabla)
        {
            conexion::conectar();
            
            $query="SELECT * FROM ObservacionesRit WHERE id= (SELECT MAX(id) FROM ObservacionesRit )";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlMostrarArchivoRit($tabla,$cod_division)
        {
            conexion::conectar();
            

            $query="SELECT TOP 3 R.id, R.cod_division, AR.id_rit, AR.id_archivo, AR.comentario, A.nombre, A.archivo, A.fecha_alta FROM Rit R, ArchivosRit AR, Archivos A 
            WHERE R.cod_division='".$cod_division."' and R.id=AR.id_rit and AR.id_archivo=A.id order by A.fecha_alta desc";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlIngresarRit($tabla,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla." (cod_division) values('".$datos['cod_division']."')";
			if(mssql_query($query)){
                $query2     ="SELECT MAX(id) AS id FROM Rit";
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
        static public function mdlIngresarArchivos($tabla2,$datos2,$datos)
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
        static public function mdlIngresarArchivosRit($tabla3,$id,$idArchivo,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla3." (id_rit,id_archivo,comentario)values('".$id."','".$idArchivo."','".$datos['comentario']."')";
			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
        static public function mdlIngresarObservacionRit($tabla,$datos)
        {
			conexion::conectar();
            $query = "insert into ".$tabla." (observaciones,fecha_alta,alcance,meta)values('".$datos['observacion']."','".$datos['fecha_alta']."','".$datos['alcance']."','".$datos['meta']."')";
			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
	}