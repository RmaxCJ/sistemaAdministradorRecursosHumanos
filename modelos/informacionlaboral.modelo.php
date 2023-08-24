<?php
	require_once "conexion.php";
	class ModeloInformacion{

        static public function mdlMostrarInformacion($tabla,$pais,$divisiones)
        {
            conexion::conectar();
            if($divisiones=="TODAS"){
                $query="select AIL.id as idIL, AIL.anio, AIL.id_archivo, AIL.pais,AIL.mes, A.nombre, A.archivo, A.fecha_alta from ".$tabla." AIL, Archivos A where AIL.id_archivo=A.id order by AIL.id desc";
            }else{
                $query="select AIL.id as idIL, AIL.anio, AIL.id_archivo, AIL.pais,AIL.mes, A.nombre, A.archivo, A.fecha_alta from ".$tabla." AIL, Archivos A where AIL.id_archivo=A.id and AIL.pais='".$pais."'   order by AIL.id desc";
            }
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
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
        static public function mdlIngresarArchivosInformacion($tabla3,$idArchivo,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla3." (anio,id_archivo,pais,mes)values(".$datos['anio'].",'".$idArchivo."','".$datos['pais']."',".$datos['mes'].")";
			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}

	}