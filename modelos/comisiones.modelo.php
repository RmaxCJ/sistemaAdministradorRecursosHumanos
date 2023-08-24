<?php
	require_once "conexion.php";
	class ModeloComisiones{

        static public function mdlMostrarComisiones($tabla,$divisiones)
        {
            conexion::conectar();

            if($divisiones=='TODAS'){
                $cod="";
            }else{
                // $cod=" and D.cod_division='".$divisiones."' ";
                $cod=" and cod_division in(".$divisiones.") ";
                
            }
            
            $query="SELECT DISTINCT C.*, D.cod_division, D.division FROM ".$tabla." as C, divisiones as D WHERE C.cod_division=D.cod_division   ".$cod."  ";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlMostrarComisionesDivisiones($divisiones)
        {
            conexion::conectar();
            // print_r($divisiones);
            // $query="Select C.cod_division, D.cod_division, D.division 
            // from Comisiones C, Divisiones D where C.cod_division!=D.cod_division AND pais='mexico'";
            // echo $divisiones;

            if($divisiones=='TODAS'){
                $cod="";
            }else{
                // $cod=" and D.cod_division='".$divisiones."' ";
                $cod=" and cod_division in(".$divisiones.") ";
                
            }
        
                  $query="SELECT cod_division,  division FROM Divisiones WHERE cod_division not in (select distinct cod_division from Comisiones) and pais='mexico'  ". $cod."  ";
                                                                                          

            // $query="Select * from  Divisiones  where  pais='mexico'";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

        static public function mdlMostrarArchivoComisiones($tabla,$cod_division,$tipo_com)
        {
            conexion::conectar();
            

            $query="SELECT C.id, C.cod_division, AC.id_comisiones, AC.id_archivo, AC.tipo_comisiones, A.nombre, A.archivo, A.fecha_alta 
            FROM Comisiones C, ArchivosComisiones AC, Archivos A 
            WHERE C.cod_division='".$cod_division."' and AC.tipo_comisiones=".$tipo_com." and C.id=AC.id_comisiones and AC.id_archivo=A.id order by A.fecha_alta desc";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlIngresarComisiones($tabla,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla." (cod_division, estatus1, fecha_inicio1, fecha_termino1, estatus2, fecha_inicio2, fecha_termino2, estatus3, fecha_inicio3, fecha_termino3,estatus4, fecha_inicio4, fecha_termino4, estatus5, fecha_inicio5, fecha_termino5) values('".$datos['cod_division']."','".$datos['estatus1']."','".$datos['fecha_inicio1']."','".date("Y-m-d")."','".$datos['estatus2']."','".$datos['fecha_inicio2']."','".$datos['fecha_termino2']."','".$datos['estatus3']."','".$datos['fecha_inicio3']."','".$datos['fecha_termino3']."','".$datos['estatus4']."','".$datos['fecha_inicio4']."','".$datos['fecha_termino4']."','".$datos['estatus5']."','".$datos['fecha_inicio5']."','".$datos['fecha_termino5']."')";
			if(mssql_query($query)){
                $query2     ="SELECT MAX(id) AS id FROM Comisiones";
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
        static public function mdlIngresarArchivosComisiones($tabla3,$id,$idArchivo,$x)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla3." (id_comisiones,id_archivo,tipo_comisiones)values('".$id."','".$idArchivo."','".$x."')";
			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
        static public function mdlModificarComisiones($tabla,$datos)
        {			
			conexion::conectar();
            $tipo=$datos['tipo'];
             $query="UPDATE ".$tabla." SET
            estatus".$tipo."='".$datos['estatus']."', fecha_inicio".$tipo."='".$datos['fecha_inicio']."',fecha_termino".$tipo."='".$datos['fecha_termino']."' 
            WHERE cod_division='".$datos['cod_division']."' AND id=".$datos['id']." ";

			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
	}